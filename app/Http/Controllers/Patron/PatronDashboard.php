<?php

namespace App\Http\Controllers\Patron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class PatronDashboard extends Controller
{
    //
    public function dashboard(Request $request){
        $reservations = Reservation::where('user_id', $request->user()->id)->select(
            \DB::raw("MONTH(created_at) as month"),
            \DB::raw("COUNT(case when status = 'pending' then 1 end) as pending"),
            \DB::raw("COUNT(case when status = 'confirmed' then 1 end) as confirmed"),
            \DB::raw("COUNT(case when status = 'cancelled' then 1 end) as cancelled"),
            \DB::raw("COUNT(case when status = 'completed' then 1 end) as completed")
        );

        if($request->year && $request->year !== "All"){
            $reservations->whereYear('created_at', $request->year);
        }

        $reservations = $reservations->groupBy('month')->get()->toArray();
    
        // Convert to 4D array
        $data = [];
        foreach ($reservations as $reservation) {
            $data[$reservation['month']] = [
                'pending' => $reservation['pending'],
                'confirmed' => $reservation['confirmed'],
                'cancelled' => $reservation['cancelled'],
                'completed' => $reservation['completed'],
            ];
        }
    
        // Fill missing months
        for ($i = 1; $i <= 12; $i++) {
            if (!isset($data[$i])) {
                $data[$i] = [
                    'pending' => 0,
                    'confirmed' => 0,
                    'cancelled' => 0,
                    'completed' => 0,
                ];
            }
        }
    
        // Sort by month
        ksort($data);
    
        return view('authenticated.patron.dashboard', [
            'monthlyReservations' => $data
        ]);
    }
}
