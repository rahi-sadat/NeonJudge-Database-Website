@extends('layouts.app')

@section('title', 'Database Design | NeonJudge')

@section('content')
<section class="page-header">
    <p class="eyebrow">Data Architecture</p>
    <h1>Data Model</h1>
    <p class="muted">Core entities, relationships, and SQL automation objects behind the judge workflow.</p>
</section>

<section class="section">
    <div class="grid cards-grid">
        @foreach ($entities as $name => $description)
            <article class="card">
                <h3>{{ $name }}</h3>
                <p class="muted">{{ $description }}</p>
            </article>
        @endforeach
    </div>

    <article class="card top-space">
        <h2>Automation Objects</h2>
        <div class="pill-cloud">
            @foreach ($future as $item)
                <span>{{ $item }}</span>
            @endforeach
        </div>
    </article>
</section>
@endsection
