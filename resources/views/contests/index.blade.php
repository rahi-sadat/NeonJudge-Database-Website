@extends('layouts.app')

@section('title', 'Contests | NeonJudge')

@section('content')
<section class="page-header">
    <p class="eyebrow">Contest Arena</p>
    <h1>Public Contests</h1>
    <p class="muted">Browse contest schedules, running rounds, approval status, and organizer details.</p>
</section>

<section class="section">
    <div class="toolbar" data-filter-group>
        @foreach (['All', 'Upcoming', 'Running', 'Ended'] as $filter)
            <button class="filter-btn {{ $loop->first ? 'active' : '' }}" data-filter="{{ $filter }}">{{ $filter }}</button>
        @endforeach
    </div>

    <div class="table-wrap">
        <table class="data-table" data-contest-table>
            <thead>
                <tr>
                    <th>Contest</th>
                    <th>Status</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Duration</th>
                    <th>Created By</th>
                    <th>Approval</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contests as $contest)
                    <tr data-status="{{ $contest['status'] }}">
                        <td><a href="{{ route('contests.show', $contest['slug']) }}">{{ $contest['title'] }}</a></td>
                        <td><x-badge :type="strtolower(str_replace(' ', '-', $contest['status']))">{{ $contest['status'] }}</x-badge></td>
                        <td>{{ $contest['start'] }}</td>
                        <td>{{ $contest['end'] }}</td>
                        <td>{{ $contest['duration'] }}</td>
                        <td>{{ $contest['created_by'] }}</td>
                        <td>{{ $contest['approval'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
