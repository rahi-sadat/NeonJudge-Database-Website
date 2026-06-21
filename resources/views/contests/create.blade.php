@extends('layouts.app')

@section('title', 'Create Contest | NeonJudge')
@section('body_class', 'page-contest-create')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/contest-create.css') }}">
@endpush

@section('content')
@php
    $currentUser = null;

    if (app()->bound('auth') && config('auth.defaults.guard')) {
        try {
            $currentUser = auth()->user();
        } catch (\Throwable $exception) {
            $currentUser = null;
        }
    }
@endphp

<section class="page-header">
    <p class="eyebrow">Custom Contest</p>
    <h1>Create Contest</h1>
    <p class="muted">Prepare a contest draft for admin approval before it becomes public.</p>
</section>

@if ($currentUser)
    <section class="section form-section">
        <form class="form-card">
            <h2>Contest Details</h2>
            <div class="form-grid">
                <label>Title <input class="text-input" value="Neon Practice Round"></label>
                <label>Visibility <select class="select-input"><option>Public after approval</option><option>Private practice</option></select></label>
                <label>Start Time <input class="text-input" value="2026-06-30 19:00"></label>
                <label>Duration <input class="text-input" value="2 hours"></label>
            </div>
            <label>Description <textarea class="text-area">Short description for contestants.</textarea></label>
            <label>Problem Codes <input class="text-input" value="NJ101, NJ204"></label>
            <button class="btn btn-secondary" type="button">Save Draft</button>
        </form>

        <aside class="card verdict-card">
            <p class="eyebrow">Approval Flow</p>
            <h2>Pending Admin Review</h2>
            <p class="muted">This draft will be reviewed by an admin before registration opens.</p>
            <div class="divider"></div>
            <p class="muted">Admins can also create approved contests directly from their panel.</p>
        </aside>
    </section>
@else
    <section class="section auth-section">
        <article class="auth-card">
            <h2>Login Required</h2>
            <p class="muted">You can browse contests freely, but you need an account before creating a contest draft.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                <a class="btn btn-secondary" href="{{ route('register') }}">Register</a>
            </div>
        </article>
    </section>
@endif
@endsection
