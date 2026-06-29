<?php
namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Throwable;

class SubmissionController extends Controller
{
    public function create(?string $problem = null): RedirectResponse
    {
        return redirect()->route('problems.show', strtoupper($problem ?: 'NJ101'));
    }

    public function store(Request $request): RedirectResponse
    {
        if (! Auth::check()) {
            return back()->withInput()->with('judge_error', 'You must be logged in to submit code.');
        }

        $languages = config('judge0.languages');

        $data = $request->validate([
            'problem' => ['required', 'string', 'max:30'],
            'language_id' => ['required', 'integer', Rule::in(array_keys($languages))],
            'source' => ['required', 'string'],
            'stdin' => ['nullable', 'string'],
            'expected_output' => ['nullable', 'string'],
        ]);

        $problemCode = strtoupper($data['problem']);
        $judgeUrl = rtrim((string) config('judge0.url'), '/');

        if ($judgeUrl === '') {
            return back()
                ->withInput()
                ->with('judge_error', 'Judge0 is not connected yet. Add JUDGE0_URL in your .env file.');
        }

        $payload = [
            'source_code' => $data['source'],
            'language_id' => (int) $data['language_id'],
            'stdin' => $data['stdin'] ?? '',
            'enable_per_process_and_thread_time_limit' => true,
            'enable_per_process_and_thread_memory_limit' => true,
        ];

        if (! empty($data['expected_output'])) {
            $payload['expected_output'] = $data['expected_output'];
        }

        try {
            $requestBuilder = Http::timeout(20)->connectTimeout(5)->acceptJson()->asJson();

            if (config('judge0.api_key')) {
                $requestBuilder = $requestBuilder->withHeaders([
                    'X-RapidAPI-Key' => config('judge0.api_key'),
                ]);
            }

            $response = $requestBuilder->post($judgeUrl.'/submissions?base64_encoded=false&wait=true', $payload);

            if (! $response->successful()) {
                return back()
                    ->withInput()
                    ->with('judge_error', 'Judge0 returned HTTP '.$response->status().'. Check your Judge0 URL.');
            }

            $result = $response->json();
            $verdictStatus = $this->verdictStatus($result);
            $judgeMessage = $this->judgeMessage($result, $verdictStatus);

            Submission::create([
                'user_id'        => Auth::id(),
                'problem_code'   => $problemCode,
                'language_id'    => (int) $data['language_id'],
                'source_code'    => $data['source'],
                'stdin'          => $data['stdin'] ?? '',
                'expected_output' => $data['expected_output'] ?? null,
                'stdout'         => data_get($result, 'stdout'),
                'stderr'         => data_get($result, 'stderr'),
                'compile_output' => data_get($result, 'compile_output'),
                'status'         => $verdictStatus,
                'judge_token'    => data_get($result, 'token'),
                'execution_time' => data_get($result, 'time'),
                'memory_used'    => data_get($result, 'memory'),
            ]);

            return back()
                ->withInput()
                ->with('judge_result', [
                    'status' => $verdictStatus,
                    'stdout' => data_get($result, 'stdout'),
                    'stderr' => data_get($result, 'stderr'),
                    'compile_output' => data_get($result, 'compile_output'),
                    'message' => $judgeMessage,
                    'time' => data_get($result, 'time'),
                    'memory' => data_get($result, 'memory'),
                ]);
        } catch (Throwable $error) {
            return back()
                ->withInput()
                ->with('judge_error', 'Could not judge or save submission: '.$error->getMessage());
        }
    }

    private function verdictStatus(array $result): string
    {
        $status = data_get($result, 'status.description');

        if (is_string($status) && trim($status) !== '') {
            return $status;
        }

        if (! empty(data_get($result, 'compile_output'))) {
            return 'Compilation Error';
        }

        if (! empty(data_get($result, 'stderr'))) {
            return 'Runtime Error';
        }

        if (! empty(data_get($result, 'error'))) {
            return 'Judge Error';
        }

        if (! empty(data_get($result, 'message'))) {
            return 'Judge Error';
        }

        return 'Unknown';
    }

    private function judgeMessage(array $result, string $status): ?string
    {
        $message = data_get($result, 'error')
            ?: data_get($result, 'message')
            ?: data_get($result, 'compile_output')
            ?: data_get($result, 'stderr');

        if (is_string($message) && trim($message) !== '') {
            return trim($message);
        }

        return $status === 'Unknown'
            ? 'Judge0 did not return a status description for this submission.'
            : null;
    }
}
