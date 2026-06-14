<footer class="footer">
    <div>
        <a class="brand footer-brand" href="{{ route('home') }}">
            <span class="brand-mark">NJ</span>
            <span>NeonJudge</span>
        </a>
        <p>Online contests, practice problems, standings, and judging workflows in one focused workspace.</p>
    </div>

    <div class="footer-links">
        <a href="{{ route('contests.index') }}">Contests</a>
        <a href="{{ route('problems.index') }}">Practice</a>
        <a href="{{ route('leaderboard.index') }}">Standings</a>
        <a href="{{ route('database.design') }}">Data Model</a>
    </div>
</footer>
