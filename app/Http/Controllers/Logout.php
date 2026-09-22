<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;

class Logout extends Controller
{
    public function logout_user(Request $request)
    {
        return Auth::logout() && Session::flush() 
            ? redirect()->to('/login') 
            : redirect()->back()->withErrors("<stong>Can't Logout. Please try again later..</strong>");
    }
}
