<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'NeonJudge')</title>
    <link rel="stylesheet" href="{{ asset('css/neonjudge.css') }}">
</head>
<body>
    <canvas class="code-rain" data-code-rain aria-hidden="true"></canvas>
    <div class="cyber-grid" aria-hidden="true"></div>
    <div class="scanline" aria-hidden="true"></div>

    <div class="app-shell">
        @include('partials.navbar')

        <main class="page-stage" data-page-stage>
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    <script src="{{ asset('js/neonjudge.js') }}"></script>
    @stack('scripts')
</body>
</html>
