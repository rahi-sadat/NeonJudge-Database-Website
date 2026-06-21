@extends('layouts.app')

@section('title', 'Login | NeonJudge')
@section('body_class', 'page-login')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/login.css') }}">
@endpush

@section('content')
<section class="page-header auth-header">
    <p class="eyebrow">Account Access</p>
    <h1>Login</h1>
    <p class="muted">Sign in before joining contests, submitting solutions, or creating problem sets.</p>
</section>

<section class="section auth-section">
    <form class="auth-card">
        <h2>Enter NeonJudge</h2>
        <label>
            Handle or Email
            <input class="text-input" type="text" name="login" autocomplete="username">
        </label>
        <label>
            Password
            <input class="text-input" type="password" name="password" autocomplete="current-password">
        </label>
        <button class="btn btn-primary" type="button">Login</button>
        <p class="muted">New here? <a href="{{ route('register') }}">Create an account</a>.</p>
    </form>
</section>
@endsection
