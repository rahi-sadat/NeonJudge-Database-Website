@extends('layouts.app')

@section('title', 'NeonJudge | Online Judge Platform')
@section('body_class', 'page-home')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
@endpush

@section('content')
<section class="hero">
    <div class="hero-copy">
        <p class="eyebrow">Online Judge Platform</p>
        <h1><span class="gradient-text">NeonJudge</span></h1>
        <p class="hero-subtitle">Create contests, publish problems, receive submissions, and show live standings from one sharp workspace.</p>
        <div class="hero-actions">
            <a class="btn btn-primary" href="{{ route('contests.index') }}">Explore Contests</a>
            <a class="btn btn-secondary" href="{{ route('problems.index') }}">Practice Problems</a>
            <a class="btn btn-ghost" href="{{ route('leaderboard.index') }}">View Standings</a>
        </div>
    </div>
    <div class="judge-console" aria-label="Judging dashboard">
        <div class="terminal-window">
            <div class="terminal-top">
                <span></span><span></span><span></span>
                <b>judge-worker</b>
            </div>
            <pre><code>$ neon submit NJ101 solution.cpp
compile: g++ -O2 -std=c++17
run: sample_01.in ........ <strong>OK</strong>
run: hidden_12.in ....... <strong>OK</strong>
verdict: <em>Accepted</em> | 46 ms | 12 MB</code></pre>
        </div>
        <div class="console-grid">
            <article><small>Submissions</small><strong>1,284</strong></article>
            <article><small>Accepted</small><strong>62%</strong></article>
            <article><small>Queue</small><strong>18</strong></article>
        </div>
        <div class="verdict-stream">
            <span><b>NJ101</b> Accepted <i>46 ms</i></span>
            <span><b>NJ204</b> Pending <i>queued</i></span>
            <span><b>NJ330</b> Wrong Answer <i>case 7</i></span>
        </div>
    </div>
</section>

<section class="section">
    <div class="section-heading">
        <p class="eyebrow">Core Modules</p>
        <h2>Online Judge Features</h2>
    </div>
    <div class="grid cards-grid">
        @foreach ($features as $feature)
            <x-feature-card :title="$feature['title']" :text="$feature['text']" />
        @endforeach
    </div>
</section>

<section class="section split-section">
    <div>
        <p class="eyebrow">System Architecture</p>
        <h2>Designed Around Clean Data Flow</h2>
        <p class="muted">Every screen maps to the core judge records: users, contests, problems, submissions, verdicts, standings, practice progress, and ratings.</p>
    </div>
    <div class="pill-cloud">
        @foreach ($databaseFeatures as $item)
            <span>{{ $item }}</span>
        @endforeach
    </div>
</section>

<section class="section">
    <div class="section-heading">
        <p class="eyebrow">Judge Flow</p>
        <h2>From code to verdict</h2>
    </div>
    <div class="grid flow-grid">
        @foreach ($judgeFlow as $step)
            <article class="card flow-card">
                <span>{{ $loop->iteration }}</span>
                <h3>{{ $step['title'] }}</h3>
                <p class="muted">{{ $step['text'] }}</p>
            </article>
        @endforeach
    </div>
</section>
@endsection
