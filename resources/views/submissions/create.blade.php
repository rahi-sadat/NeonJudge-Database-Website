@extends('layouts.app')

@section('title', 'Submit Solution | NeonJudge')

@section('content')
<section class="page-header">
    <p class="eyebrow">Submission Lab</p>
    <h1>Submit Solution {{ $problem ? 'for '.$problem : '' }}</h1>
    <p class="muted">Paste your source code, choose a language, and send it into the judging queue.</p>
</section>

<section class="section form-section">
    <form class="card form-card" method="post" action="{{ route('submissions.store') }}" data-submission-form>
        @csrf
        <label>
            Problem Code
            <input class="text-input" name="problem" value="{{ $problem ?? 'NJ101' }}">
        </label>
        <label>
            Language
            <select class="select-input" name="language">
                @foreach ($languages as $language)
                    <option>{{ $language }}</option>
                @endforeach
            </select>
        </label>
        <label>
            Source Code
            <textarea class="code-editor" name="source" rows="14">#include &lt;bits/stdc++.h&gt;
using namespace std;

int main() {
    cout &lt;&lt; "Hello NeonJudge";
    return 0;
}</textarea>
        </label>
        <button class="btn btn-primary" type="submit">Submit Solution</button>
    </form>

    <aside class="card verdict-card">
        <p class="eyebrow">Verdict Stream</p>
        <h2 data-verdict-label>Pending</h2>
        <div class="loader" data-verdict-loader></div>
        <p class="muted">The current interface shows the verdict states the judge worker will return after compilation and test execution.</p>
    </aside>
</section>
@endsection
