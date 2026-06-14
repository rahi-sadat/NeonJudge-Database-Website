<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProblemController extends Controller
{
    public function index(): View
    {
        // Later: replace with Problem::query()->withCount('acceptedSubmissions')->get().
        $problems = $this->problems();

        return view('problems.index', compact('problems'));
    }

    public function show(string $code): View
    {
        $problem = collect($this->problems())->firstWhere('code', strtoupper($code)) ?? $this->problems()[0];

        return view('problems.show', compact('problem'));
    }

    private function problems(): array
    {
        return [
            ['code' => 'NJ101', 'title' => 'Neon Array Balance', 'difficulty' => 'Easy', 'rating' => 900, 'solved' => 124, 'tags' => ['array', 'prefix sum']],
            ['code' => 'NJ204', 'title' => 'Campus Shortest Route', 'difficulty' => 'Medium', 'rating' => 1400, 'solved' => 67, 'tags' => ['graph', 'dijkstra']],
            ['code' => 'NJ225', 'title' => 'Query the Result Board', 'difficulty' => 'Medium', 'rating' => 1500, 'solved' => 52, 'tags' => ['sql', 'sorting']],
            ['code' => 'NJ330', 'title' => 'Trigger the Leaderboard', 'difficulty' => 'Hard', 'rating' => 1900, 'solved' => 21, 'tags' => ['trigger', 'simulation']],
            ['code' => 'NJ410', 'title' => 'Index the Galaxy', 'difficulty' => 'Hard', 'rating' => 2100, 'solved' => 13, 'tags' => ['binary search', 'database']],
        ];
    }
}
