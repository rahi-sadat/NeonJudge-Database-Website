@extends('layouts.app')

@section('title', 'Problem Setter Panel | NeonJudge')

@section('content')
<section class="page-header">
    <p class="eyebrow">Setter Workspace</p>
    <h1>Problem Setter Panel</h1>
    <p class="muted">Create problems, manage contest sets, and prepare content for admin approval.</p>
</section>

<section class="section">
    <div class="grid cards-grid">
        @foreach ($actions as $action)
            <article class="card action-card">{{ $action }}</article>
        @endforeach
    </div>

    <form class="card form-card top-space">
        <h2>Create Problem</h2>
        <div class="form-grid">
            <label>Title <input class="text-input" value="Neon Array Balance"></label>
            <label>Difficulty <select class="select-input"><option>Easy</option><option>Medium</option><option>Hard</option></select></label>
            <label>Rating <input class="text-input" value="1200"></label>
            <label>Score <input class="text-input" value="100"></label>
            <label>Time Limit <input class="text-input" value="1s"></label>
            <label>Memory Limit <input class="text-input" value="128 MB"></label>
        </div>
        <label>Statement <textarea class="text-area">Write the full problem statement here.</textarea></label>
        <label>Constraints <textarea class="text-area">1 <= n <= 100000</textarea></label>
        <div class="form-grid">
            <label>Sample Input <textarea class="text-area">3&#10;1 2 3</textarea></label>
            <label>Sample Output <textarea class="text-area">6</textarea></label>
        </div>
        <button class="btn btn-secondary" type="button">Save Draft</button>
    </form>
</section>
@endsection
