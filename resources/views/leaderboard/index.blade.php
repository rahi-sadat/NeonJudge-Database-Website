@extends('layouts.app')

@section('title', 'Leaderboard | NeonJudge')
@section('body_class', 'page-leaderboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/leaderboard.css') }}">
@endpush

@section('content')
<section class="page-header">
    <p class="eyebrow">Contest Ranking</p>
    <h1>Leaderboard</h1>
    <p class="muted">Track solved counts, total score, penalty time, and latest accepted submissions.</p>
</section>

<section class="section">
    <div class="toolbar">
        <button class="filter-btn active" data-sort-leaderboard="score">Sort by Score</button>
        <button class="filter-btn" data-sort-leaderboard="penalty">Sort by Penalty</button>
    </div>
    <div class="table-wrap">
        <table class="data-table" data-leaderboard-table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>User</th>
                    <th>Solved</th>
                    <th>Total Score</th>
                    <th>Penalty Time</th>
                    <th>Last Submission</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <tr class="{{ $row['rank'] <= 3 ? 'top-rank' : '' }}">
                        <td>#{{ $row['rank'] }}</td>
                        <td>{{ $row['user'] }}</td>
                        <td>{{ $row['solved'] }}</td>
                        <td data-score="{{ $row['score'] }}">{{ $row['score'] }}</td>
                        <td data-penalty="{{ $row['penalty'] }}">{{ $row['penalty'] }} min</td>
                        <td>{{ $row['last'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
