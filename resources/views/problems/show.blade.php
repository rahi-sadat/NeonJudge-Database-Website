@extends('layouts.app')

@section('title', $problem['title'].' | NeonJudge')
@section('body_class', 'page-problem-details')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/problem-details.css') }}">
@endpush

@section('content')
@php
    $starterCode = $problem['starter_code'];
    $sampleInput = $problem['sample_input']."\n";
    $sampleOutput = $problem['sample_output']."\n";
    $judgeResult = session('judge_result');
    $judgeStatusClass = $judgeResult ? trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($judgeResult['status'])), '-') : 'pending';
    $hasAcceptedSubmission = $hasAcceptedSubmission ?? false;
@endphp

<section class="page-header">
    <p class="eyebrow">{{ $problem['code'] }}</p>
    <h1>{{ $problem['title'] }}</h1>
    <p class="muted">Difficulty {{ $problem['difficulty'] }} | Rating {{ $problem['rating'] }} | Solved {{ $problem['solved'] }}</p>
</section>

<section class="section problem-workspace">
    <article class="problem-statement">
        <h2>Problem Statement</h2>
        <p>{{ $problem['statement'] }}</p>

        <h2>Input Format</h2>
        <p>{{ $problem['input_format'] }}</p>

        <h2>Output Format</h2>
        <p>{{ $problem['output_format'] }}</p>

        <h2>Constraints</h2>
        <pre>{{ $problem['constraints'] }}</pre>

        <h2>Sample Input</h2>
        <pre>{{ $problem['sample_input'] }}</pre>

        <h2>Sample Output</h2>
        <pre>{{ $problem['sample_output'] }}</pre>
    </article>

    <aside class="card judge-panel">
        <div class="judge-panel-top">
            <div>
                <p class="eyebrow">Code</p>
                <h2>Submit Solution</h2>
            </div>
            @if ($judgeResult)
                <x-badge :type="$judgeStatusClass">{{ $judgeResult['status'] }}</x-badge>
            @endif
        </div>

        @if ($hasAcceptedSubmission)
            <div class="judge-solved-note">
                <strong>Already solved</strong>
                <small>You have an Accepted submission for {{ $problem['code'] }}.</small>
            </div>
        @endif

        @if (session('judge_error'))
            <p class="judge-message judge-message-error">{{ session('judge_error') }}</p>
        @endif

        <form class="judge-form" method="post" action="{{ route('submissions.store') }}" data-judge-form>
            @csrf
            <input type="hidden" name="problem" value="{{ $problem['code'] }}">

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
                <textarea class="code-editor" name="source" rows="18">{{ old('source', $starterCode) }}</textarea>
                @error('source')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </label>

            <div class="judge-testcases">
                <label>
                    Input
                    <textarea class="text-area" name="stdin" rows="4">{{ old('stdin', $sampleInput) }}</textarea>
                </label>
                <label>
                    Expected Output
                    <textarea class="text-area" name="expected_output" rows="4">{{ old('expected_output', $sampleOutput) }}</textarea>
                </label>
            </div>

            <button class="btn btn-primary" type="submit" data-judge-submit>Submit</button>

            <div
                class="judge-inline-status {{ $judgeResult ? 'judge-status-'.$judgeStatusClass : '' }} {{ session('judge_error') ? 'judge-status-error' : '' }} {{ ! $judgeResult && ! session('judge_error') ? 'is-hidden' : '' }}"
                data-judge-status
                role="status"
                aria-live="polite"
            >
                <span class="judge-status-dot"></span>
                <span>
                    @if (session('judge_error'))
                        <strong>Could not judge</strong>
                        <small>{{ session('judge_error') }}</small>
                    @elseif ($judgeResult)
                        <strong>{{ $judgeResult['status'] }}</strong>
                        <small>{{ $judgeResult['time'] ?? '-' }}s | {{ $judgeResult['memory'] ?? '-' }} KB</small>
                    @endif
                </span>
            </div>
        </form>

        @if ($judgeResult)
            <div class="judge-result">
                <div class="judge-result-grid">
                    <span>
                        Time
                        <strong>{{ $judgeResult['time'] ?? '-' }}s</strong>
                    </span>
                    <span>
                        Memory
                        <strong>{{ $judgeResult['memory'] ?? '-' }} KB</strong>
                    </span>
                </div>

                @if (! empty($judgeResult['stdout']))
                    <h3>Output</h3>
                    <pre>{{ $judgeResult['stdout'] }}</pre>
                @endif

                @if (! empty($judgeResult['stderr']))
                    <h3>Error</h3>
                    <pre>{{ $judgeResult['stderr'] }}</pre>
                @endif

                @if (! empty($judgeResult['compile_output']))
                    <h3>Compiler Output</h3>
                    <pre>{{ $judgeResult['compile_output'] }}</pre>
                @endif
            </div>
        @endif
    </aside>
</section>
@endsection
