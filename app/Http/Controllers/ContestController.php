<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ContestController extends Controller
{
    public function index(): View
    {
        $contests = $this->contests();

        return view('contests.index', compact('contests'));
    }

    public function show(string $slug): View
    {
        $contest = collect($this->contests())->firstWhere('slug', $slug) ?? $this->contests()[0];

        $problems = [
            ['code' => 'NJ101', 'title' => 'Neon Array Balance', 'difficulty' => 'Easy', 'score' => 100, 'time' => '1s', 'memory' => '128 MB'],
            ['code' => 'NJ204', 'title' => 'Campus Shortest Route', 'difficulty' => 'Medium', 'score' => 200, 'time' => '2s', 'memory' => '256 MB'],
            ['code' => 'NJ330', 'title' => 'Trigger the Leaderboard', 'difficulty' => 'Hard', 'score' => 300, 'time' => '3s', 'memory' => '512 MB'],
        ];

        return view('contests.show', compact('contest', 'problems'));
    }

    private function contests(): array
    {
        return [
            ['slug' => 'spring-sql-sprint', 'title' => 'Spring SQL Sprint', 'status' => 'Running', 'start' => '2026-06-05 10:00', 'end' => '2026-06-05 13:00', 'duration' => '3 hours', 'created_by' => 'Dr. Rahman', 'approval' => 'Approved'],
            ['slug' => 'neon-practice-cup', 'title' => 'Neon Practice Cup', 'status' => 'Upcoming', 'start' => '2026-06-12 19:00', 'end' => '2026-06-12 21:00', 'duration' => '2 hours', 'created_by' => 'Setter Team', 'approval' => 'Approved'],
            ['slug' => 'database-finals-challenge', 'title' => 'Database Finals Challenge', 'status' => 'Pending Approval', 'start' => '2026-06-18 09:00', 'end' => '2026-06-18 12:00', 'duration' => '3 hours', 'created_by' => 'Setter Desk', 'approval' => 'Pending'],
            ['slug' => 'intro-algorithm-arena', 'title' => 'Intro Algorithm Arena', 'status' => 'Ended', 'start' => '2026-05-20 15:00', 'end' => '2026-05-20 17:00', 'duration' => '2 hours', 'created_by' => 'ACM Club', 'approval' => 'Approved'],
        ];
    }
}
