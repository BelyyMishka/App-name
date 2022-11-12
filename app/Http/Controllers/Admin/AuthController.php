<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('admin.auth.loginForm');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $data = $request->only(['email', 'password']);

        if (Auth::guard('admin')->attempt($data, true)) {
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }

        return redirect()->route('admin.auth.loginForm')->with('error', 'Wrong email and/or password.');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.auth.login');
    }
}
