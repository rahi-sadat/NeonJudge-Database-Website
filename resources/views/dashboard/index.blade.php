@extends('layouts.app')

@section('title', 'User Statistics | NeonJudge')
@section('body_class', 'page-profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/profile.css') }}">
@endpush

@section('content')
<section class="page-header">
    <p class="eyebrow">Student Console</p>
    <h1>User Statistics</h1>
    <p class="muted">Personal progress, submissions, and recommended practice problems.</p>
</section>

@auth
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
                    @php
                        $verdictType = strtolower(str_replace(' ', '-', $item['verdict']));
                    @endphp
                    <div class="list-row">
                        <span>{{ $item['problem'] }} <small>{{ $item['language'] }}</small></span>
                        <x-badge :type="$verdictType">{{ $item['verdict'] }}</x-badge>
                    </div>
                @endforeach
            </article>

            <article class="card">
                <h2>Practice Progress</h2>
                @foreach ($progress as $label => $percent)
                    @php
                        $barWidth = max(0, min(100, (int) $percent));
                    @endphp
                    <div class="progress-line">
                        <span>{{ $label }}</span>
                        <div><i style="width: {{ $barWidth }}%"></i></div>
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
@else
    <section class="section auth-section">
        <article class="auth-card">
            <h2>Login Required</h2>
            <p class="muted">Statistics are attached to your handle. Login or register to view your solves, submissions, rating, and contest history.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                <a class="btn btn-secondary" href="{{ route('register') }}">Register</a>
            </div>
        </article>
    </section>
@endauth
@endsection
