<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->guest(route('login'));
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->isAdmin()) {
            abort(403);
        }

        $pendingContests = [
            ['title' => 'Algorithm Finals Challenge', 'created_by' => 'Setter Desk', 'start' => '2026-06-18 09:00'],
            ['title' => 'Newcomer Code Jam', 'created_by' => 'ACM Club', 'start' => '2026-06-22 16:00'],
        ];

        $reports = [
            'Most solved problems' => 'Neon Array Balance',
            'Most active users' => 'Ayesha Rahman',
            'Contests created' => 14,
            'Total submissions' => 1286,
        ];

        return view('admin.index', compact('pendingContests', 'reports'));
    }
}
