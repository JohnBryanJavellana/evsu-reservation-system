<?php

namespace App\Http\Controllers\Patron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;

class PatronCalendar extends Controller
{
    //
    public function calendar(Request $request){
        $reservations = Reservation::where('user_id', $request->user()->id)->get();
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
                'title' => $reservation->room_used->name . '. Type: ' . $reservation->room_used->type,
                'start' => Carbon::parse($reservation->from)->format('Y-m-d'),
                'end' => Carbon::parse($reservation->to)->addDay()->format('Y-m-d'),
                'backgroundColor' => $color,
                'borderColor' => $color,
                'className' => 'clickable-event'
            ];
        })->toArray();

        return view('authenticated.patron.calendar', [
            'events' => $events
        ]);
    }
}
