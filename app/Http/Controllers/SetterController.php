<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SetterController extends Controller
{
    public function index(): View
    {
        $actions = ['Create Problem', 'Manage Problems', 'Create Contest', 'Add Problems to Contest'];

        return view('setter.index', compact('actions'));
    }
}
