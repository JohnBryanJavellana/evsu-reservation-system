<?php

namespace App\Http\Controllers\Patron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Room;
use App\Models\Equipment;
use App\Models\Reservation;
use App\Models\ReservationEquipment;

class PatronReservation extends Controller
{
    //
    public function reservationList(Request $request){
        $reservations = Reservation::where('user_id', $request->user()->id)->orderBy('from', 'ASC')->get();
        
        return view('authenticated.patron.reservation.reservations', [
            'reservations' => $reservations
        ]);
    }

    public function newReservation(Request $request){
        if($request->from && $request->to){
            $from = $request->from;
            $to = $request->to;

            $rooms = Room::whereNotIn('id', function ($query) use ($from, $to) {
                $query->select('room_id')
                    ->from('reservations')
                    ->where(function ($subQuery) use ($from, $to) {
                        $subQuery->where(function ($query) use ($from, $to) {
                            $query->where('from', '<=', $to)->where('to', '>=', $from);
                        })->orWhere(function ($query) use ($from, $to) {
                            $query->where('from', '<=', $from)->where('to', '>=', $from);
                        })->orWhere(function ($query) use ($from, $to) {
                            $query->where('from', '<=', $to)->where('to', '>=', $to);
                        });
                    })->where('status', 'confirmed');
            })->get();
        } else {
            $rooms = [];
        }

        return view('authenticated.patron.reservation.create-reservation', [
            'rooms' => $rooms
        ]);
    }

    public function newReservationRent(Request $request, Room $room){
        $equipments = Equipment::where('remaining_quantity', '>', 0)->get();

        if($request->method() == "POST"){
            $validation_patterns = [
                'from' => 'required|date',
                'to' => 'required|date',
                'count' => 'array'
            ];

            $validator = \Validator::make($request->all(), $validation_patterns);

            if($validator->fails()) 
            {
                return redirect()->back()->withErrors($validator)->withInput();
            } 
            else 
            {
                try {
                    $new_reservation = new Reservation;
                    $new_reservation->user_id = $request->user()->id;
                    $new_reservation->room_id = $room->id;
                    $new_reservation->from = $request->from;
                    $new_reservation->to = $request->to;
                    $new_reservation->total_rate = (float) str_replace(",", "", $request->room_rent);
                    $new_reservation->save();

                    if($request->input('count')){
                        foreach ($request->input('count') as $key => $count) {
                            if ($count > 0) {
                                $equipmentId = $key;
    
                                $new_reservation_equipment = new ReservationEquipment;
                                $new_reservation_equipment->reservation_id = $new_reservation->id;
                                $new_reservation_equipment->equipment_id = $equipmentId;
                                $new_reservation_equipment->quantity = $count;
                                $new_reservation_equipment->total_rate = (float) str_replace(",", "", $request->equipment_rent);
                                $new_reservation_equipment->save();
    
                                $equipment = Equipment::find($equipmentId);
                                $equipment->remaining_quantity = $equipment->remaining_quantity - $count;
                                $equipment->save();
                            }
                        }
                    }

                    $new_log = new Log;
                    $new_log->user_id = $request->user()->id;
                    $new_log->activity = "You've successfully creates new reservation. ID# $new_reservation->id";
                    $new_log->save();

                    return redirect('/welcome/patron/reservation/list/info/' . $new_reservation->id);
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors('<strong>Oh no!</strong> Error occured: ' . $e->getMessage());
                }
            }
        }
        
        return view('authenticated.patron.reservation.rent', [
            'room' => $room,
            'equipments' => $equipments
        ]);
    }

    public function infoReservation(Request $request, Reservation $reservation) {
        return view('authenticated.patron.reservation.show-details', [
            'reservation' => $reservation
        ]);
    }

    public function infoReservationUpdateStatus(Request $request, Reservation $reservation, string $value){
        $reservation->update([
            'status' => $value
        ]);

        return redirect()->back();
    }
}
