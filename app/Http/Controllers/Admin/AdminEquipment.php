<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Log;

class AdminEquipment extends Controller
{
    //
    public function equipmentList(Request $request){
        $equipments = Equipment::all();

        return view('authenticated.administrator.equipments.equipments', [
            'equipments' => $equipments
        ]);
    }

    public function newEquipment(Request $request){
        if($request->method() == "POST"){
            $validation_patterns = [
                'name' => 'required|string',
                'quantity' => 'required|numeric',
                'daily_rate' => 'required|numeric',
                'photo' => 'required',
                'description' => 'required|string',
            ];

            $validator = \Validator::make($request->all(), $validation_patterns);

            if($validator->fails()) 
            {
                return redirect()->back()->withErrors($validator)->withInput();
            } 
            else 
            {
                try {
                    $new_equipment = new Equipment;
                    $new_equipment->name = $request->name;
                    $new_equipment->quantity = $request->quantity;
                    $new_equipment->remaining_quantity = $request->quantity;
                    $new_equipment->description = $request->description;
                    $new_equipment->daily_rate = $request->daily_rate;

                    $avatar = $request->file('photo');
                    $newFileName = time() . '-' . uniqid() . '-' . 'equipment-image.' . $avatar->getClientOriginalExtension();
                    $avatar->move(public_path('equipment-images'), $newFileName);

                    $new_equipment->photo_url = $newFileName;
                    $new_equipment->save();

                    $new_log = new Log;
                    $new_log->user_id = Auth::user()->id;
                    $new_log->activity = "You've successfully created new equipment. ID#" . $new_equipment->id;
                    $new_log->save();

                    return redirect()->back()->with('message', '<strong>Success!</strong> New equipment has been successfully created.');
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors('<strong>Oh no!</strong> Error occured: ' . $e->getMessage());
                }
            }
        }

        return view('authenticated.administrator.equipments.create-equipment');
    }

    public function infoEquipment(Request $request, int $equipment_id){
        $this_equipment = Equipment::findorFail($equipment_id);

        if($request->method() == "POST"){
            $validation_patterns = [
                'name' => 'required|string',
                'quantity' => 'required|numeric',
                'daily_rate' => 'required|numeric',
                'description' => 'required|string',
            ];

            $validator = \Validator::make($request->all(), $validation_patterns);

            if($validator->fails()) 
            {
                return redirect()->back()->withErrors($validator)->withInput();
            } 
            else 
            {
                try {
                    $this_equipment->name = $request->name;
                    $this_equipment->quantity = $request->quantity;
                    $this_equipment->remaining_quantity = $this_equipment->remaining_quantity >= $request->quantity 
                        ? $this_equipment->quantity
                        : $this_equipment->remaining_quantity + ($request->quantity - $this_equipment->remaining_quantity);
                    $this_equipment->description = $request->description;
                    $this_equipment->daily_rate = $request->daily_rate;

                    $avatar = $request->file('photo');

                    if($avatar){
                        if(File::exists(public_path('equipment-images') . '/' . $this_equipment->photo_url)){
                            File::delete(public_path('equipment-images') . '/' . $this_equipment->photo_url);
                        }
                        
                        $newFileName = time() . '-' . uniqid() . '-' . 'equipment-image.' . $avatar->getClientOriginalExtension();
                        $avatar->move(public_path('equipment-images'), $newFileName);
                        $this_equipment->photo_url = $newFileName;
                    }

                    $this_equipment->save();

                    $new_log = new Log;
                    $new_log->user_id = Auth::user()->id;
                    $new_log->activity = "You've successfully updated an equipment details. ID#" . $equipment_id;
                    $new_log->save();

                    return redirect()->back()->with('message', '<strong>Success!</strong> Equipment details has been successfully created.');
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors('<strong>Oh no!</strong> Error occured: ' . $e->getMessage());
                }
            }
        }

        return view('authenticated.administrator.equipments.update', [
            'thisequipment' => $this_equipment
        ]);
    }

    public function removeEquipment(Request $request, int $equipment_id){
        $this_equipment = Equipment::findorFail($equipment_id);

        try {
            if(File::exists(public_path('equipment-images') . '/' . $this_equipment->photo_url)){
                File::delete(public_path('equipment-images') . '/' . $this_equipment->photo_url);
            }

            $this_equipment->delete();

            $new_log = new Log;
            $new_log->user_id = Auth::user()->id;
            $new_log->activity = "You've successfully removed an equipment. ID#" . $equipment_id;
            $new_log->save();

            return redirect()->back()->with('message', '<strong>Success!</strong> Equipment ID# ' . $equipment_id . ' has been successfully removed.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('<strong>Oh no!</strong> Error occured: ' . $e->getMessage());
        }
    }
}
