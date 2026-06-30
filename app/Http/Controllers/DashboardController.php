<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Later: load these numbers from users, submissions, contests, and practice_records tables.
        $stats = [
            'rating' => 1540,
            'solved' => 42,
            'contests' => 8,
        ];

        $recent = [
            ['problem' => 'Neon Array Balance', 'language' => 'C++', 'verdict' => 'Accepted', 'time' => '2 minutes ago'],
            ['problem' => 'Campus Shortest Route', 'language' => 'Python', 'verdict' => 'Wrong Answer', 'time' => '1 hour ago'],
            ['problem' => 'Tournament Pairing', 'language' => 'Java', 'verdict' => 'Accepted', 'time' => 'Yesterday'],
        ];

        $progress = ['Easy' => 76, 'Medium' => 48, 'Hard' => 19];

        $recommended = [
            ['code' => 'NJ225', 'title' => 'Tournament Pairing', 'difficulty' => 'Medium', 'rating' => 1500],
            ['code' => 'NJ330', 'title' => 'Crystal Maze Escape', 'difficulty' => 'Hard', 'rating' => 1900],
        ];

        return view('dashboard.index', compact('stats', 'recent', 'progress', 'recommended'));
    }
}
