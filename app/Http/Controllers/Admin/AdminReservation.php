<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Room;
use App\Models\Equipment;
use App\Models\Reservation;
use App\Models\ReservationEquipment;


class AdminReservation extends Controller
{
    //
    public function reservationList(Request $request){
        $reservations = Reservation::all();
        
        return view('authenticated.administrator.reservation.reservations', [
            'reservations' => $reservations
        ]);
    }

    public function infoReservation(Request $request, Reservation $reservation) {
        return view('authenticated.administrator.reservation.show-details', [
            'reservation' => $reservation
        ]);
    }

    public function infoReservationUpdateStatus(Request $request, Reservation $reservation, string $value){
        $reservation->update([
            'status' => $value
        ]);

        if($value == "completed"){
            foreach($reservation->with_equipments as $eq){
                $e = $eq->equipment;
                $e->remaining_quantity = $e->remaining_quantity + $eq->quantity;
                $e->save();
            }
        }

        return redirect()->back();
    }
}
