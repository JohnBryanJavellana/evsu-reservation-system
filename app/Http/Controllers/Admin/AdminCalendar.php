<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;

class AdminCalendar extends Controller
{
    //
    public function calendar(Request $request){
        $reservations = Reservation::all();
        $events = $reservations->map(function ($reservation) {
            if($reservation->status === 'pending'){
                $color = '#8A8783FF';
            } else if($reservation->status === 'confirmed'){
                $color = '#ff9900';
            } else if($reservation->status === 'cancelled'){
                $color = '#FF0000FF';
            } else {
                $color = '#34c759';
            }
    
            return [
                'id' => $reservation->id,
                'title' => $reservation->room_used->name . ". Rented by " . $reservation->rented_by->firstname . ' ' . $reservation->rented_by->middlename . ' ' . $reservation->rented_by->lastname . ' ' . $reservation->rented_by->suffix,
                'start' => Carbon::parse($reservation->from)->format('Y-m-d'),
                'end' => Carbon::parse($reservation->to)->addDay()->format('Y-m-d'),
                'backgroundColor' => $color,
                'borderColor' => $color,
                'className' => 'clickable-event'
            ];
        })->toArray();

        return view('authenticated.administrator.calendar', [
            'events' => $events
        ]);
    }
}
