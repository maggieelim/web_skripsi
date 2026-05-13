<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }

        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($attributes)) {
            session()->regenerate();
            $user = Auth::user();
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }

    public function destroy(Request $request)
    {
        $redirectTo = $request->redirect_to ?? '/login';

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect($redirectTo)
            ->with(['success' => 'You\'ve been logged out.']);
    }
}
