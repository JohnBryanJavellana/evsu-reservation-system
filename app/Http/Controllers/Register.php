<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\RegistrationTemporaryPassword;
use App\Models\User;
use App\Models\Log;

class Register extends Controller
{
    public function register(Request $request){
        if($request->method() === "POST") {
            $validation_patterns = [
                'first_name' => 'required|string',
                'middle_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'email|required|string'
            ];

            $validator = \Validator::make($request->all(), $validation_patterns);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                try {
                    $temp_password = uniqid(1);

                    $new_user = new User;
                    $new_user->firstname = $request->first_name;
                    $new_user->middlename = $request->middle_name;
                    $new_user->lastname = $request->last_name;
                    $new_user->suffix = $request->suffix;
                    $new_user->email = $request->email;
                    $new_user->password = bcrypt($temp_password);
                    $new_user->role = "Patron";
                    $new_user->profile_picture = "avatar.png";
                    $new_user->save();

                    \Mail::to($request->email)->send(new RegistrationTemporaryPassword(['password' => $temp_password, 'role' => "Patron"]));

                    return redirect()->back()->with('message', '<strong>Well done!</strong> You\'r application has been registered.');
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors("Error: $e");
                }
            }
        }

        return view('register');
    }
}
