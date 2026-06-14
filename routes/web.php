<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\SetterController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/database-design', [HomeController::class, 'databaseDesign'])->name('database.design');

Route::get('/contests', [ContestController::class, 'index'])->name('contests.index');
Route::get('/contests/{slug}', [ContestController::class, 'show'])->name('contests.show');

Route::get('/problems', [ProblemController::class, 'index'])->name('problems.index');
Route::get('/problems/{code}', [ProblemController::class, 'show'])->name('problems.show');

Route::get('/submit/{problem?}', [SubmissionController::class, 'create'])->name('submissions.create');
Route::post('/submit', [SubmissionController::class, 'store'])->name('submissions.store');

Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/setter', [SetterController::class, 'index'])->name('setter.index');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
