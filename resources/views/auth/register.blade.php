@extends('layouts.app')

@section('title', 'Register | NeonJudge')
@section('body_class', 'page-register')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/register.css') }}">
@endpush

@section('content')
<section class="page-header auth-header">
    <p class="eyebrow">Join NeonJudge</p>
    <h1>Register</h1>
    <p class="muted">Create a user account to submit solutions, enter contests, and build custom contests.</p>
</section>

<section class="section auth-section">
    <form class="auth-card" method="POST" action="{{ route('register.store') }}">
        @csrf
        <h2>Create Account</h2>
        <label>
            Handle
            <input class="text-input" type="text" name="handle" value="{{ old('handle') }}" autocomplete="username" required autofocus>
            <small>This will be your public contest name.</small>
            @error('handle')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </label>
        <label>
            Email
            <input class="text-input" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
            @error('email')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </label>
        <label>
            Password
            <input class="text-input" type="password" name="password" autocomplete="new-password" required>
            <small>Password should contain at least five characters.</small>
            @error('password')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </label>
        <label>
            Confirm Password
            <input class="text-input" type="password" name="password_confirmation" autocomplete="new-password" required>
        </label>
        <button class="btn btn-primary" type="submit">Register</button>
        <p class="muted">Already registered? <a href="{{ route('login') }}">Login instead</a>.</p>
    </form>
</section>
@endsection
