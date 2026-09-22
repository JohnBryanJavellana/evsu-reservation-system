<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class Login extends Controller
{
    public function login(Request $request){
        if($request->method() === "POST") {
            $validation_patterns = [
                'email' => 'email|required|string',
                'password' => 'required|string'
            ];

            $validator = \Validator::make($request->only('email', 'password'), $validation_patterns);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                if(Auth::attempt($request->only('email', 'password'))){
                    if(Auth::user()->is_archived == 1){
                        return redirect()->back()->withErrors("<strong>Oh no!</strong> Your account has been disabled by the admin. Please try again later");
                    }

                    $new_log = new Log;
                    $new_log->user_id = Auth::user()->id;
                    $new_log->activity = "You've logged in to your account";
                    $new_log->save();

                    if (Auth::user()->role == "Administrator"){
                        return redirect()->to('/welcome/administrator/dashboard');
                    } else {
                        return redirect()->to('/welcome/patron/dashboard');
                    }
                } else {
                    return redirect()->back()->withErrors('<strong>Oh no!</strong> Invalid username or password');
                }
            }
        }

        return view('login');
    }
}
