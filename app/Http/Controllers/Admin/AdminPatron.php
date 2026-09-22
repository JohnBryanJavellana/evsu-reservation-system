<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Mail\AdminChangedYourPassword;
use App\Mail\RegistrationTemporaryPassword;
use App\Models\User;
use App\Models\Log;

class AdminPatron extends Controller
{
    //
    public function patronList(Request $request){
        $patrons = User::where('role', 'Patron')->get();

        return view('authenticated.administrator.patron.patrons', [
            'patrons' => $patrons
        ]);
    }

    public function newPatron(Request $request){
        if($request->method() == "POST"){
            $validation_patterns = [
                'firstname' => 'required|string',
                'middlename' => 'required|string',
                'lastname' => 'required|string',
                'role' => 'required|string',
                'email' => 'email|required|string|unique:users'
            ];

            $validator = \Validator::make($request->all(), $validation_patterns);

            if($validator->fails()) 
            {
                return redirect()->back()->withErrors($validator)->withInput();
            } 
            else 
            {
                try {
                    $random_password = uniqid(1);

                    $new_patron = new User;
                    $new_patron->firstname = $request->firstname;
                    $new_patron->middlename = $request->middlename;
                    $new_patron->lastname = $request->lastname;
                    $new_patron->suffix = $request->suffix;
                    $new_patron->email = $request->email;
                    $new_patron->password = bcrypt($random_password);
                    $new_patron->role = $request->role;
                    $new_patron->profile_picture = "avatar.png";
                    $new_patron->save();

                    $new_log = new Log;
                    $new_log->user_id = Auth::user()->id;
                    $new_log->activity = "You've successfully created a new patron. ID#" . $new_patron->id;
                    $new_log->save();

                    \Mail::to($request->email)->send(new RegistrationTemporaryPassword(['password' => $random_password, 'role' => $request->role]));

                    return redirect()->back()->with('message', '<strong>Success!</strong> New patron has been created. ID#' . $new_patron->id);
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors('<strong>Oh no!</strong> Error occured: ' . $e->getMessage());
                }
            }
        }

        return view('authenticated.administrator.patron.create-patron');
    }

    public function removePatron(Request $request, int $patron_id){
        $this_patron = User::findorFail($patron_id);

        try {
            if(File::exists(public_path('user-images') . '/' . $this_patron->profile_picture) && $this_patron->profile_picture !== 'avatar.png'){
                File::delete(public_path('user-images') . '/' . $this_patron->profile_picture);
            }

            $this_patron->delete();

            $new_log = new Log;
            $new_log->user_id = Auth::user()->id;
            $new_log->activity = "You've successfully removed a patron ID#" . $patron_id;
            $new_log->save();

            return redirect()->back()->with('message', '<strong>Success!</strong> Patron ID# ' . $patron_id . ' has been successfully removed.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('<strong>Oh no!</strong> Error occured: ' . $e->getMessage());
        }
    }

    public function editPatron(Request $request, int $patron_id){
        $this_patron = User::findorFail($patron_id);
        
        if($request->method() == "POST"){
            $validation_patterns = [
                'firstname' => 'required|string',
                'middlename' => 'required|string',
                'lastname' => 'required|string',
                'role' => 'required|string',
                'email' => 'email|required|string|unique:users,email,' . $patron_id,
            ];

            $validator = \Validator::make($request->all(), $validation_patterns);

            if($validator->fails()) 
            {
                return redirect()->back()->withErrors($validator)->withInput();
            } 
            else 
            {
                try {
                    $this_patron->firstname = $request->firstname;
                    $this_patron->middlename = $request->middlename;
                    $this_patron->lastname = $request->lastname;
                    $this_patron->suffix = $request->suffix;
                    $this_patron->email = $request->email;
                    $this_patron->role = $request->role;

                    if($request->password){
                        $this_patron->password = bcrypt($request->password);

                        \Mail::to($request->email)->send(new AdminChangedYourPassword(['password' => $request->password, 'role' => $request->role]));
                    }

                    if ($request->file('avatar')){
                        if(File::exists(public_path('user-images') . '/' . $this_patron->profile_picture) && $this_patron->profile_picture !== 'avatar.png'){
                            File::delete(public_path('user-images') . '/' . $this_patron->profile_picture);
                        }

                        $avatar = $request->file('avatar');
                        $newFileName = time() . '-' . uniqid() . '-' . 'user-image.' . $avatar->getClientOriginalExtension();
                        $avatar->move(public_path('user-images'), $newFileName);

                        $this_patron->profile_picture = $newFileName;
                    }
                    
                    $this_patron->save();

                    $new_log = new Log;
                    $new_log->user_id = Auth::user()->id;
                    $new_log->activity = "You've successfully updated patron details of ID#" . $patron_id;
                    $new_log->save();

                    return redirect()->back()->with('message', '<strong>Success!</strong> Patron details has been successfully updated.');
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors('<strong>Oh no!</strong> Error occured: ' . $e->getMessage());
                }
            }
        }

        return view('authenticated.administrator.patron.update', [
            'thisuser' => $this_patron
        ]);
    }
}
