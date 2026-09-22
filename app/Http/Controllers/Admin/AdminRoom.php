<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Room;
use App\Models\RoomPhoto;
use App\Models\Log;

class AdminRoom extends Controller
{
    //
    public function roomList(Request $request){
        $rooms = Room::all();

        return view('authenticated.administrator.rooms.rooms', [
            'rooms' => $rooms
        ]);
    }

    public function newRoom(Request $request){
        if($request->method() == "POST"){
            $validation_patterns = [
                'name' => 'required|string',
                'type' => 'required|string',
                'address' => 'required|string',
                'description' => 'required|string',
                'max_occupancy' => 'required|numeric',
                'daily_rate' => 'required|numeric',
                'photos' => 'required|array|min:1',
                'photos.*' => 'mimes:jpg,jpeg,png,bmp,tiff|max:15000',
            ];

            $validator = \Validator::make($request->all(), $validation_patterns);

            if($validator->fails()) 
            {
                return redirect()->back()->withErrors($validator)->withInput();
            } 
            else 
            {
                try {
                    $new_room = new Room;
                    $new_room->name = $request->name;
                    $new_room->type = $request->type;
                    $new_room->max_occupancy = $request->max_occupancy;
                    $new_room->daily_rate = $request->daily_rate;
                    $new_room->address = $request->address;
                    $new_room->description = $request->description;
                    $new_room->save();

                    $photos = $request->file('photos');

                    foreach ($photos as $photo){
                        $room_photo = new RoomPhoto;
                        $room_photo->room_id = $new_room->id;

                        $filename = time() . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
                        $photo->move(public_path('room-images'), $filename);

                        $room_photo->photo_url = $filename;
                        $room_photo->save();
                    }

                    $new_log = new Log;
                    $new_log->user_id = Auth::user()->id;
                    $new_log->activity = "You've successfully create a new room. ID#" . $new_room->id;
                    $new_log->save();

                    return redirect()->back()->with('message', '<strong>Success!</strong> Room has been saved!.');
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors('<strong>Oh no!</strong> Error occured: ' . $e->getMessage());
                }
            }
        }

        return view('authenticated.administrator.rooms.create-room');
    } 

    public function infoRoom(Request $request, int $room_id){
        $this_room = Room::findorFail($room_id);

        if($request->method() == "POST"){
            $validation_patterns = [
                'name' => 'required|string',
                'type' => 'required|string',
                'address' => 'required|string',
                'description' => 'required|string',
                'max_occupancy' => 'required|numeric',
                'daily_rate' => 'required|numeric',
            ];

            $photos = $request->file('photos');

            if($photos){
                $validation_patterns['photos'] = 'required|array|min:1';
                $validation_patterns['photos.*'] = 'mimes:jpg,jpeg,png,bmp,tiff|max:15000';
            }

            $validator = \Validator::make($request->all(), $validation_patterns);

            if($validator->fails()) 
            {
                return redirect()->back()->withErrors($validator)->withInput();
            } 
            else 
            {
                try {
                    $this_room->name = $request->name;
                    $this_room->type = $request->type;
                    $this_room->max_occupancy = $request->max_occupancy;
                    $this_room->daily_rate = $request->daily_rate;
                    $this_room->address = $request->address;
                    $this_room->description = $request->description;
                    $this_room->save();

                    if($photos){
                        foreach ($photos as $photo){
                            $room_photo = new RoomPhoto;
                            $room_photo->room_id = $room_id;
    
                            $filename = time() . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
                            $photo->move(public_path('room-images'), $filename);
    
                            $room_photo->photo_url = $filename;
                            $room_photo->save();
                        }
                    }

                    $new_log = new Log;
                    $new_log->user_id = Auth::user()->id;
                    $new_log->activity = "You've successfully updates room information. ID#" . $room_id;
                    $new_log->save();

                    return redirect()->back()->with('message', '<strong>Success!</strong> Room Information has been updated!.');
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors('<strong>Oh no!</strong> Error occured: ' . $e->getMessage());
                }
            }
        }

        return view('authenticated.administrator.rooms.update', [
            'thisroom' => $this_room
        ]);
    }   

    public function removeRoom(Request $request, int $room_id){
        $this_room = Room::findorFail($room_id);

        try {
            if($this_room->room_photos()->exists()){
                foreach ($this_room->room_photos as $photo){
                    if(File::exists(public_path('room-images') . '/' . $photo->photo_url)){
                        File::delete(public_path('room-images') . '/' . $photo->photo_url);
                    }
                }
            }

            $this_room->delete();

            $new_log = new Log;
            $new_log->user_id = Auth::user()->id;
            $new_log->activity = "You've successfully removed a room ID#" . $room_id;
            $new_log->save();

            return redirect()->back()->with('message', '<strong>Success!</strong> Room ID# ' . $room_id . ' has been successfully removed.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('<strong>Oh no!</strong> Error occured: ' . $e->getMessage());
        }
    }

    public function infoRoomRemovePhoto(Request $request, int $room_id, int $photo_id){
        $room_photo = RoomPhoto::findorFail($photo_id);

        try {
            if(File::exists(public_path('room-images') . '/' . $room_photo->photo_url)){
                File::delete(public_path('room-images') . '/' . $room_photo->photo_url);
            }

            $room_photo->delete();

            $new_log = new Log;
            $new_log->user_id = Auth::user()->id;
            $new_log->activity = "You've successfully removed a room photo. ROOM ID#" . $room_id;
            $new_log->save();

            return redirect()->back()->with('message', '<strong>Success!</strong> Room photo ID# ' . $room_id . ' has been successfully removed.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('<strong>Oh no!</strong> Error occured: ' . $e->getMessage());
        }
    }
}
