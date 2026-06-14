<nav class="navbar">
    <a class="brand" href="{{ route('home') }}">
        <span class="brand-mark">NJ</span>
        <span>NeonJudge</span>
    </a>

    <button class="nav-toggle" data-nav-toggle aria-label="Toggle navigation">Menu</button>

    <div class="nav-links" data-nav-links>
        <a href="{{ route('contests.index') }}" @if(request()->routeIs('contests.*')) aria-current="page" @endif>Contests</a>
        <a href="{{ route('problems.index') }}" @if(request()->routeIs('problems.*')) aria-current="page" @endif>Practice</a>
        <a href="{{ route('leaderboard.index') }}" @if(request()->routeIs('leaderboard.*')) aria-current="page" @endif>Standings</a>
        <a href="{{ route('dashboard.index') }}" @if(request()->routeIs('dashboard.*')) aria-current="page" @endif>Dashboard</a>
        <a href="{{ route('setter.index') }}" @if(request()->routeIs('setter.*')) aria-current="page" @endif>Setter</a>
        <a href="{{ route('admin.index') }}" @if(request()->routeIs('admin.*')) aria-current="page" @endif>Admin</a>
        <a href="{{ route('database.design') }}" @if(request()->routeIs('database.*')) aria-current="page" @endif>Data Model</a>
    </div>
</nav>
