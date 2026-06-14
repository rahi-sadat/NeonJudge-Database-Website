<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $features = [
            ['title' => 'Live Contest', 'text' => 'Timed contests with status, duration, and assigned problem sets.'],
            ['title' => 'Instant Verdict', 'text' => 'Submission pipeline prepared for pending, accepted, wrong answer, and runtime states.'],
            ['title' => 'Dynamic Leaderboard', 'text' => 'Rank users by solved count, score, penalty, and last submission time.'],
            ['title' => 'Practice by Difficulty', 'text' => 'Filter practice problems by easy, medium, hard, rating, and tags.'],
            ['title' => 'Problem Setter Panel', 'text' => 'Draft problems, contests, samples, limits, constraints, and scoring rules.'],
            ['title' => 'Admin Approval System', 'text' => 'Approve contests, monitor suspicious submissions, and review reports.'],
        ];

        $databaseFeatures = ['users', 'contests', 'problems', 'submissions', 'leaderboards', 'rating history', 'SQL views', 'PL/SQL triggers'];

        $judgeFlow = [
            ['title' => 'Submit', 'text' => 'A contestant chooses a language and sends source code for a specific problem.'],
            ['title' => 'Compile', 'text' => 'A judge worker compiles the code in an isolated environment with language-specific commands.'],
            ['title' => 'Run Tests', 'text' => 'The worker runs the program against hidden test cases with time and memory limits.'],
            ['title' => 'Publish Verdict', 'text' => 'The result becomes Accepted, Wrong Answer, Time Limit Exceeded, Runtime Error, or Compilation Error.'],
        ];

        return view('home', compact('features', 'databaseFeatures', 'judgeFlow'));
    }

    public function databaseDesign(): View
    {
        $entities = [
            'Users' => 'Students, teachers, setters, and admins with role-based access.',
            'Contests' => 'Contest metadata, schedule, duration, creator, and approval status.',
            'Problems' => 'Problem statements, samples, difficulty, tags, ratings, limits, and scores.',
            'Contest Problems' => 'Many-to-many mapping between contests and selected problems.',
            'Submissions' => 'Submitted code, language, verdict, runtime, memory, and timestamps.',
            'Languages' => 'Allowed programming languages and execution configuration.',
            'Leaderboard' => 'Aggregated contest ranking by solved count, score, and penalty.',
            'Practice Records' => 'Practice solves, attempts, difficulty progress, and user history.',
            'Rating History' => 'Contest rating changes for long-term performance tracking.',
        ];

        $future = ['SQL schema', 'constraints', 'triggers', 'PL/SQL procedures', 'functions', 'views', 'indexing', 'reports'];

        return view('database-design', compact('entities', 'future'));
    }
}
