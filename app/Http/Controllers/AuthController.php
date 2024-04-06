<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }


    public function login(Request $request)
    {
        $validated =   $request->validate([
            'username' => 'required|min:3',
            'password' => 'required'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return route('dashboard');
        }
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
