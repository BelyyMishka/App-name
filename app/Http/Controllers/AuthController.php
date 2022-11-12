<?php

namespace App\Http\Controllers;

use App\Events\Registered;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function loginForm()
    {
        $title = 'Login';

        return view('auth.loginForm', [
            'title' => $title,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return redirect()->route('auth.loginForm')->with('error', 'Wrong email and/or password.');
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->route('auth.loginForm')->with('error', 'Wrong email and/or password.');
        }

        if (empty($user->email_verified_at)) {
            return redirect()->route('auth.loginForm')->with('error', 'You have not verify your email yet.');
        }

        Auth::login($user, true);

        return redirect()->route('index');
    }

    public function registerForm()
    {
        $title = 'Register';

        return view('auth.registerForm', [
            'title' => $title,
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|unique:users_new_email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $userVerify = UserVerify::create([
            'user_id' => $user->id,
            'token' => Str::random(64),
        ]);

        Registered::dispatch($userVerify);

        return redirect()->route('auth.loginForm')->with('success', 'Check email to end registration.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.loginForm');
    }
}
