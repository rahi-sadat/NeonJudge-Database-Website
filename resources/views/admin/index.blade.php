@extends('layouts.app')

@section('title', 'Admin Panel | NeonJudge')

@section('content')
<section class="page-header">
    <p class="eyebrow">Admin Console</p>
    <h1>Admin Panel</h1>
    <p class="muted">Approve contests, monitor submissions, and review platform reports.</p>
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

    <article class="card top-space">
        <h2>Suspicious Submissions</h2>
        <div class="table-wrap">
            <table class="data-table">
                <thead><tr><th>User</th><th>Problem</th><th>Reason</th><th>Time</th></tr></thead>
                <tbody>
                    @foreach ($suspicious as $row)
                        <tr><td>{{ $row['user'] }}</td><td>{{ $row['problem'] }}</td><td>{{ $row['reason'] }}</td><td>{{ $row['time'] }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </article>
</section>
@endsection
