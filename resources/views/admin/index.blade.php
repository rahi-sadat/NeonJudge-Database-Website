@extends('layouts.app')

@section('title', 'Admin Dashboard | NeonJudge')
@section('body_class', 'page-admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/admin.css') }}">
@endpush

@section('content')
<section class="page-header">
    <p class="eyebrow">Admin Console</p>
    <h1>Contest Dashboard</h1>
    <p class="muted">Review pending contests and platform reports.</p>
</section>

<section class="section">
    <div class="grid two-column">
        <article class="card">
            <h2>Pending Contests</h2>
            @foreach ($pendingContests as $contest)
                <div class="approval-row">
                    <span>{{ $contest['title'] }} <small>{{ $contest['created_by'] }} | {{ $contest['start'] }}</small></span>
                    <span>
                        <button class="btn btn-small btn-primary">Approve</button>
                        <button class="btn btn-small btn-danger">Reject</button>
                    </span>
                </div>
            @endforeach
        </article>

        <article class="card">
            <h2>Reports</h2>
            @foreach ($reports as $label => $value)
                <div class="list-row"><span>{{ $label }}</span><strong>{{ $value }}</strong></div>
            @endforeach
        </article>
    </div>
</section>
@endsection
