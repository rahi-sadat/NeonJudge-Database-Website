<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $pendingContests = [
            ['title' => 'Database Finals Challenge', 'created_by' => 'Setter Desk', 'start' => '2026-06-18 09:00'],
            ['title' => 'First Year Warmup', 'created_by' => 'ACM Club', 'start' => '2026-06-22 16:00'],
        ];

        $suspicious = [
            ['user' => 'coder_rahim', 'problem' => 'NJ330', 'reason' => 'Many submissions in a short time', 'time' => '12:58 PM'],
            ['user' => 'nabila_dev', 'problem' => 'NJ204', 'reason' => 'Similar code pattern flagged', 'time' => '01:10 PM'],
        ];

        $reports = [
            'Most solved problems' => 'Neon Array Balance',
            'Most active users' => 'Ayesha Rahman',
            'Contests created' => 14,
            'Total submissions' => 1286,
        ];

        return view('admin.index', compact('pendingContests', 'suspicious', 'reports'));
    }
}
