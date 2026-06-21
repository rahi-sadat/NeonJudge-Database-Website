@extends('layouts.app')

@section('title', 'Practice Problems | NeonJudge')
@section('body_class', 'page-problems')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/problems.css') }}">
@endpush

@section('content')
<section class="page-header">
    <p class="eyebrow">Practice Mode</p>
    <h1>Problems</h1>
    <p class="muted">Search the problem bank, filter by difficulty, and sort by recommended rating.</p>
</section>

<section class="section">
    <div class="toolbar practice-toolbar">
        <input class="search-input" data-problem-search type="search" placeholder="Search problem title">
        <select class="select-input" data-problem-filter>
            <option value="All">All Difficulties</option>
            <option value="Easy">Easy</option>
            <option value="Medium">Medium</option>
            <option value="Hard">Hard</option>
        </select>
        <select class="select-input" data-problem-sort>
            <option value="rating">Sort by rating</option>
            <option value="difficulty">Sort by difficulty</option>
        </select>
    </div>

    <div class="grid problem-grid" data-problem-list>
        @foreach ($problems as $problem)
            <article class="card problem-card" data-title="{{ strtolower($problem['title']) }}" data-difficulty="{{ $problem['difficulty'] }}" data-rating="{{ $problem['rating'] }}">
                <div class="card-row">
                    <h3><a href="{{ route('problems.show', $problem['code']) }}">{{ $problem['title'] }}</a></h3>
                    <x-badge :type="strtolower($problem['difficulty'])">{{ $problem['difficulty'] }}</x-badge>
                </div>
                <p class="muted">{{ $problem['code'] }} | Rating {{ $problem['rating'] }} | Solved {{ $problem['solved'] }}</p>
                <div class="tag-row">
                    @foreach ($problem['tags'] as $tag)
                        <span>{{ $tag }}</span>
                    @endforeach
                </div>
            </article>
        @endforeach
    </div>
</section>
@endsection
