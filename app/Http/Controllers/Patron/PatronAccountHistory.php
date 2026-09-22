<?php

namespace App\Http\Controllers\Patron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class PatronAccountHistory extends Controller
{
    //
    public function log(Request $request){
        $histories = Log::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
   
        return view('authenticated.patron.account-history', [
            'histories' => $histories
        ]);
    }
}
