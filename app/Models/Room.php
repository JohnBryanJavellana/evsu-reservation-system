<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Room extends Model
{
    use HasFactory;

    public function room_photos(){
        return $this->hasMany(RoomPhoto::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reservations_backward()
    {
        return $this->hasMany(Reservation::class)->orderBy('created_at', 'DESC');
    }

    public function isAvailable($date = null)
    {
        $date = $date ?? Carbon::today();
        return !$this->reservations()
            ->whereDate('from', '<=', $date)
            ->whereDate('to', '>=', $date)
            ->exists();
    }

    public function nextAvailableDate()
    {
        $nextDate = Carbon::today();

        while (true) {
            if ($this->isAvailable($nextDate)) {
                break;
            }

            $nextDate->addDay();
        }

        return $nextDate->format('Y-m-d');
    }
}
