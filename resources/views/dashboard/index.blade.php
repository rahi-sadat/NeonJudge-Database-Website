@extends('layouts.app')

@section('title', 'User Dashboard | NeonJudge')

@section('content')
<section class="page-header">
    <p class="eyebrow">Student Console</p>
    <h1>User Dashboard</h1>
    <p class="muted">Personal progress, submissions, and recommended practice problems.</p>
</section>

<section class="section">
    <div class="grid stat-grid">
        <article class="card stat-card"><span>Rating</span><strong>{{ $stats['rating'] }}</strong></article>
        <article class="card stat-card"><span>Solved</span><strong>{{ $stats['solved'] }}</strong></article>
        <article class="card stat-card"><span>Contests</span><strong>{{ $stats['contests'] }}</strong></article>
    </div>

    <div class="grid two-column top-space">
        <article class="card">
            <h2>Recent Submissions</h2>
            @foreach ($recent as $item)
                <div class="list-row">
                    <span>{{ $item['problem'] }} <small>{{ $item['language'] }}</small></span>
                    <x-badge :type="strtolower(str_replace(' ', '-', $item['verdict']))">{{ $item['verdict'] }}</x-badge>
                </div>
            @endforeach
        </article>

        <article class="card">
            <h2>Practice Progress</h2>
            @foreach ($progress as $label => $percent)
                <div class="progress-line">
                    <span>{{ $label }}</span>
                    <div><i style="width: {{ $percent }}%"></i></div>
                    <strong>{{ $percent }}%</strong>
                </div>
            @endforeach
        </article>
    </div>

    <article class="card top-space">
        <h2>Recommended Problems</h2>
        @foreach ($recommended as $problem)
            <div class="list-row">
                <span>{{ $problem['code'] }} - {{ $problem['title'] }}</span>
                <span>Rating {{ $problem['rating'] }} | {{ $problem['difficulty'] }}</span>
            </div>
        @endforeach
    </article>
</section>
@endsection
