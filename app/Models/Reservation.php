<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'status'
    ];

    protected $dates = ['from', 'to'];

    public function rented_by(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room_used(){
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function with_equipments(){
        return $this->hasMany(ReservationEquipment::class);
    }
}
