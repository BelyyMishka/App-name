<?php

namespace App\Http\Controllers;

use App\Events\ForgotPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotController extends Controller
{
    public function forgotForm()
    {
        $title = 'Forgot password';

        return view('forgot.forgotForm', [
            'title' => $title,
        ]);
    }

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return redirect()->route('auth.registerForm')->with('error', 'You have not registered yet.');
        }

        if (empty($user->email_verified_at)) {
            return redirect()->route('auth.loginForm')->with('error', 'You have not verify your email yet.');
        }

        // if user is registered and verified
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            ['token' => Str::random(64)]
        );

        ForgotPassword::dispatch($passwordReset);

        return redirect()->route('auth.loginForm')->with('success', 'Check email to change the password.');
    }

    public function newPasswordForm($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        $title = 'New password';

        return view('forgot.newPasswordForm', [
            'title' => $title,
            'token' => $token,
        ]);
    }

    public function newPassword(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        User::where('email', $passwordReset->email)->update([
            'password' => Hash::make($request->input('password')),
        ]);
        $passwordReset->delete();

        return redirect()->route('auth.loginForm')->with('success', 'Your password has been updated.');
    }
}
