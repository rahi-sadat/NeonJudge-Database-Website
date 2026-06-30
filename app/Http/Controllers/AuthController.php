<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'handle' => ['required', 'string', 'alpha_dash', 'max:32', 'unique:users,handle'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);

       DB::insert("
        INSERT INTO users (handle, email, password, role, rating, created_at, updated_at)
        VALUES (?, ?, ?, 'user', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    ", [
        $validated['handle'],
        $validated['email'],
        Hash::make($validated['password'])
    ]);
       $user = User::where('email', $validated['email'])->first();
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('profile.show')->with('status', 'Account created. Welcome to NeonJudge.');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'handle';

        if (! Auth::attempt([$field => $credentials['login'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'login' => 'These credentials do not match our records.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('profile.show'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
