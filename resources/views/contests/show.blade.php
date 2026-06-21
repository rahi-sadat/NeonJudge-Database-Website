@extends('layouts.app')

@section('title', $contest['title'].' | NeonJudge')
@section('body_class', 'page-contest-details')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/contest-details.css') }}">
@endpush

@section('content')
<section class="page-header">
    <p class="eyebrow">Contest Details</p>
    <h1>{{ $contest['title'] }}</h1>
    <p class="muted">{{ $contest['start'] }} to {{ $contest['end'] }} | {{ $contest['duration'] }}</p>
    <x-badge :type="strtolower(str_replace(' ', '-', $contest['status']))">{{ $contest['status'] }}</x-badge>
</section>

<section class="section">
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Problem</th>
                    <th>Difficulty</th>
                    <th>Score</th>
                    <th>Time</th>
                    <th>Memory</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($problems as $problem)
                    <tr>
                        <td>{{ $problem['code'] }}</td>
                        <td><a href="{{ route('problems.show', $problem['code']) }}">{{ $problem['title'] }}</a></td>
                        <td><x-badge :type="strtolower($problem['difficulty'])">{{ $problem['difficulty'] }}</x-badge></td>
                        <td>{{ $problem['score'] }}</td>
                        <td>{{ $problem['time'] }}</td>
                        <td>{{ $problem['memory'] }}</td>
                        <td><a class="btn btn-small" href="{{ route('submissions.create', $problem['code']) }}">Submit Solution</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a class="btn btn-secondary top-space" href="{{ route('leaderboard.index') }}">View Leaderboard</a>
</section>
@endsection
