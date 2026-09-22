<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request) {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT ? back()->with(['message' => __($status)]) : back()->withErrors(['error' => __($status)]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required_with:password_confirmation', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'password_confirmation' => 'same:password'
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'), function (User $user, string $password) use ($request) {
                $user->forceFill([ 'password' => $password ])->setRememberToken(Str::random(60));
                $user->save();
     
                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET 
            ? redirect('/')->with('message', __($status)) 
            : back()->withErrors(['error' => __($status)]);
    }
}
