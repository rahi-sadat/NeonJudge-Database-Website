<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubmissionController extends Controller
{
    public function create(?string $problem = null): View
    {
        $languages = ['C', 'C++', 'Java', 'Python', 'PHP'];

        return view('submissions.create', compact('languages', 'problem'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Later: validate, store submission, enqueue judge job, then show real verdict.
        return redirect()->route('submissions.create')->with('submitted', true);
    }
}
