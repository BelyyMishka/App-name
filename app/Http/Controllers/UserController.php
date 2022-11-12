<?php

namespace App\Http\Controllers;

use App\Events\ChangeEmail;
use App\Models\UserNewEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Profile';
        $user = Auth::user();

        return view('user.index', [
            'title' => $title,
            'user' => $user,
        ]);
    }

    public function changeNameForm()
    {
        $title = 'Change name';
        $user = Auth::user();

        return view('user.changeNameForm', [
            'title' => $title,
            'user' => $user,
        ]);
    }

    public function changeName(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $user = Auth::user();
        $user->editName($request->input('name'));

        return redirect()->route('profile.index');
    }

    public function changePasswordForm()
    {
        $title = 'Change password';

        return view('user.changePasswordForm', [
            'title' => $title,
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
           'old_password' => 'required|min:6',
           'new_password' => 'required|min:6|confirmed'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->route('profile.changePasswordForm')->with('error', 'Wrong old password.');
        }

        $user->editPassword($request->input('new_password'));

        return redirect()->route('profile.index');
    }

    public function changeEmailForm()
    {
        $title = 'Change email';
        $user = Auth::user();

        return view('user.changeEmailForm', [
            'title' => $title,
            'user' => $user,
        ]);
    }

    public function changeEmail(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'email' => [
                'required',
                'email',
                'unique:users',
                Rule::unique('users_new_email')->where(fn ($query) => $query->where('user_id', '!=', $user->id)),
            ],
        ]);

        $token = random_int(100000, 999999);
        $userNewEmail = UserNewEmail::updateOrCreate(
            ['user_id' => $user->id],
            ['token' => Hash::make($token), 'email' => $request->input('email')],
        );

        ChangeEmail::dispatch($user, $token);

        return redirect()->route('profile.codeForm')->with('success', 'Check email to confirm action.');
    }

    public function codeForm()
    {
        $title = 'Enter code';

        return view('user.codeForm', [
            'title' => $title,
        ]);
    }

    public function code(Request $request)
    {
        $request->validate([
            'code' => 'required|size:6',
        ]);

        $user = Auth::user();
        $userNewEmail = UserNewEmail::where('user_id', $user->id)->firstOrFail();

        if ($userNewEmail->expires_at < now()) {
            $userNewEmail->delete();
            return redirect()->route('profile.index')->with('error', 'Your code has been expired.');
        }

        if (!Hash::check($request->input('code'), $userNewEmail->token)) {
            return redirect()->route('profile.codeForm')->with('error', 'Wrong code.');
        }

        $user = $user->editEmail($userNewEmail->email);
        $userNewEmail->delete();

        return redirect()->route('profile.index');
    }
}
