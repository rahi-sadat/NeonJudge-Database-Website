<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

class SubmissionController extends Controller
{
    public function create(?string $problem = null): View
    {
        $languages = config('judge0.languages');

        return view('submissions.create', compact('languages', 'problem'));
    }

    public function store(Request $request): RedirectResponse
    {
        $languages = config('judge0.languages');

        $data = $request->validate([
            'problem' => ['required', 'string', 'max:30'],
            'language_id' => ['required', 'integer', Rule::in(array_keys($languages))],
            'source' => ['required', 'string'],
            'stdin' => ['nullable', 'string'],
            'expected_output' => ['nullable', 'string'],
        ]);

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

            return back()
                ->withInput()
                ->with('judge_result', [
                    'status' => data_get($result, 'status.description', 'Unknown'),
                    'stdout' => data_get($result, 'stdout'),
                    'stderr' => data_get($result, 'stderr'),
                    'compile_output' => data_get($result, 'compile_output'),
                    'time' => data_get($result, 'time'),
                    'memory' => data_get($result, 'memory'),
                ]);
        } catch (Throwable $error) {
            return back()
                ->withInput()
                ->with('judge_error', 'Could not reach Judge0: '.$error->getMessage());
        }
    }
}
