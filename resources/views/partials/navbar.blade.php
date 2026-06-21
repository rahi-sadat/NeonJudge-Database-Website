@php
    $currentUser = null;

    if (app()->bound('auth') && config('auth.defaults.guard')) {
        try {
            $currentUser = auth()->user();
        } catch (\Throwable $exception) {
            $currentUser = null;
        }
    }

    $handle = $currentUser?->handle
        ?? $currentUser?->name
        ?? $currentUser?->email
        ?? 'My Stats';
@endphp

<nav class="navbar">
    <a class="brand" href="{{ route('home') }}">
        <span class="brand-mark">NJ</span>
        <span>NeonJudge</span>
    </a>

    <button class="nav-toggle" data-nav-toggle aria-label="Toggle navigation">Menu</button>

    <div class="nav-links" data-nav-links>
        <div class="nav-primary">
            <a href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>Home</a>
            <a href="{{ route('contests.index') }}" @if(request()->routeIs('contests.index', 'contests.show')) aria-current="page" @endif>Contests</a>
            <a href="{{ route('practice.index') }}" @if(request()->routeIs('practice.*')) aria-current="page" @endif>Practice</a>
            <a href="{{ route('problems.index') }}" @if(request()->routeIs('problems.*')) aria-current="page" @endif>Problems</a>
            <a href="{{ route('leaderboard.index') }}" @if(request()->routeIs('leaderboard.*')) aria-current="page" @endif>Standing</a>
        </div>

        <div class="nav-actions" aria-label="Account and workspace">
            @if ($currentUser)
                <a href="{{ route('contests.create') }}" @if(request()->routeIs('contests.create')) aria-current="page" @endif>Create Contest</a>
                <a class="nav-handle" href="{{ route('profile.show') }}" @if(request()->routeIs('profile.*')) aria-current="page" @endif>{{ $handle }}</a>
            @else
                <a href="{{ route('login') }}" @if(request()->routeIs('login')) aria-current="page" @endif>Login</a>
                <a class="nav-register" href="{{ route('register') }}" @if(request()->routeIs('register')) aria-current="page" @endif>Register</a>
            @endif
        </div>
    </div>
</nav>
