<?php

namespace App\Http\Controllers;

use App\Events\Registered;
use App\Models\User;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerifyController extends Controller
{
    public function verify($token)
    {
        $title = 'Email verified';
        $userVerify = UserVerify::where('token', $token)->firstOrFail();
        $user = User::verifyEmail($userVerify->user_id);
        $userVerify->delete();

        Session::flash('autoredirect', true);
        return view('verify.verify', [
            'title' => $title,
        ]);
    }

    public function resendForm()
    {
        $title = 'Resend token';

        return view('verify.resendForm', [
            'title' => $title,
        ]);
    }

    public function resend(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return redirect()->route('auth.registerForm')->with('error', 'You have not registered yet.');
        }

        if (!empty($user->email_verified_at)) {
            return redirect()->route('auth.loginForm')->with('error', 'You have already verified your email.');
        }

        $userVerify = UserVerify::updateToken($user);
        Registered::dispatch($userVerify);

        return redirect()->route('auth.loginForm')->with('success', 'Check email to end registration.');
    }
}
