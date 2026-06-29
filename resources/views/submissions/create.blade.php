@extends('layouts.app')

@section('title', 'Submit Solution | NeonJudge')
@section('body_class', 'page-submission-create')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/submission-create.css') }}">
@endpush

@section('content')
@php
    $starterCode = "#include <bits/stdc++.h>\nusing namespace std;\n\nint main() {\n    cout << \"Hello NeonJudge\" << '\\n';\n    return 0;\n}\n";
    $judgeResult = session('judge_result');
    $judgeStatusClass = $judgeResult ? trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($judgeResult['status'])), '-') : 'pending';
    $pastSubmissions = $pastSubmissions ?? collect();
    $hasAcceptedSubmission = $hasAcceptedSubmission ?? false;
    $selectedProblem = old('problem', $problem ?? 'NJ101');
@endphp

<section class="page-header">
    <p class="eyebrow">Submission Lab</p>
    <h1>Submit Solution {{ $problem ? 'for '.$problem : '' }}</h1>
    <p class="muted">Paste your source code, choose a language, and send it into the judging queue.</p>
</section>

<section class="section form-section">
    <form class="card form-card" method="post" action="{{ route('submissions.store') }}">
        @csrf
        <label>
            Problem Code
            <input class="text-input" name="problem" value="{{ $selectedProblem }}">
            @error('problem')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </label>
        <label>
            Language
            <select class="select-input" name="language_id">
                @foreach ($languages as $languageId => $languageName)
                    <option value="{{ $languageId }}" @selected((int) old('language_id', 54) === $languageId)>
                        {{ $languageName }}
                    </option>
                @endforeach
            </select>
            @error('language_id')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </label>
        <label>
            Source Code
            <textarea class="code-editor" name="source" rows="14">{{ old('source', $starterCode) }}</textarea>
            @error('source')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </label>

        <label>
            Input
            <textarea class="text-area" name="stdin" rows="4">{{ old('stdin') }}</textarea>
        </label>

        <label>
            Expected Output
            <textarea class="text-area" name="expected_output" rows="4">{{ old('expected_output') }}</textarea>
        </label>

        <button class="btn btn-primary" type="submit">Submit Solution</button>
    </form>

    <aside class="card verdict-card">
        <p class="eyebrow">Verdict Stream</p>

        @if (session('judge_error'))
            <h2>Not Connected</h2>
            <p class="judge-message judge-message-error">{{ session('judge_error') }}</p>
        @elseif ($judgeResult)
            <h2>{{ $judgeResult['status'] }}</h2>
            <x-badge :type="$judgeStatusClass">{{ $judgeResult['time'] ?? '-' }}s | {{ $judgeResult['memory'] ?? '-' }} KB</x-badge>

            @if (! empty($judgeResult['stdout']))
                <pre class="top-space">{{ $judgeResult['stdout'] }}</pre>
            @endif
        @else
            <h2>Pending</h2>
            <div class="loader"></div>
        @endif
    </aside>

    <article class="card submission-history-card">
        <div class="submission-history-top">
            <div>
                <p class="eyebrow">History</p>
                <h2>{{ strtoupper($selectedProblem) }} Attempts</h2>
            </div>

            @if ($hasAcceptedSubmission)
                <x-badge type="accepted">Solved</x-badge>
            @endif
        </div>

        @guest
            <p class="muted">Login to save attempts and see your verdict history for this problem.</p>
        @else
            @if ($hasAcceptedSubmission)
                <div class="submission-solved-note">
                    <strong>Already solved</strong>
                    <small>Your Accepted submission is saved in the history below.</small>
                </div>
            @endif

            @if ($pastSubmissions->isEmpty())
                <p class="muted">No submissions saved for this problem yet.</p>
            @else
                <div class="table-wrap">
                    <table class="data-table submission-history-table">
                        <thead>
                            <tr>
                                <th>Verdict</th>
                                <th>Language</th>
                                <th>Time</th>
                                <th>Memory</th>
                                <th>Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pastSubmissions as $submission)
                                @php
                                    $statusClass = trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($submission->status)), '-');
                                    $languageName = $languages[$submission->language_id] ?? 'Language '.$submission->language_id;
                                @endphp
                                <tr>
                                    <td><x-badge :type="$statusClass">{{ $submission->status }}</x-badge></td>
                                    <td>{{ $languageName }}</td>
                                    <td>{{ $submission->execution_time ?? '-' }}s</td>
                                    <td>{{ $submission->memory_used ?? '-' }} KB</td>
                                    <td>{{ optional($submission->created_at)->diffForHumans() ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endguest
    </article>
</section>
@endsection
