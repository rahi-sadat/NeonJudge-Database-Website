<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LeaderboardController extends Controller
{
    public function index(): View
    {
        // Later: build from accepted submissions, penalties, and contest problem scores.
        $rows = [
            ['rank' => 1, 'user' => 'Ayesha Rahman', 'solved' => 5, 'score' => 920, 'penalty' => 38, 'last' => '12:42 PM'],
            ['rank' => 2, 'user' => 'Tanvir Hasan', 'solved' => 5, 'score' => 870, 'penalty' => 51, 'last' => '12:48 PM'],
            ['rank' => 3, 'user' => 'Nadia Islam', 'solved' => 4, 'score' => 760, 'penalty' => 44, 'last' => '12:36 PM'],
            ['rank' => 4, 'user' => 'Rafi Chowdhury', 'solved' => 4, 'score' => 700, 'penalty' => 73, 'last' => '12:55 PM'],
            ['rank' => 5, 'user' => 'Maliha Karim', 'solved' => 3, 'score' => 540, 'penalty' => 66, 'last' => '12:21 PM'],
        ];

        return view('leaderboard.index', compact('rows'));
    }
}
