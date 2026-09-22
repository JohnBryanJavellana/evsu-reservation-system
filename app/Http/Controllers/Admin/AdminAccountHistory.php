<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;

class AdminAccountHistory extends Controller
{
    //
    public function log(Request $request){
        $histories = Log::orderBy('created_at', 'DESC')->get();
   
        return view('authenticated.administrator.account-history', [
            'histories' => $histories
        ]);
    }
}
