<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationEquipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'equipment_id',
        'quantity',
        'total_rate'
    ];

    public function reservation(){
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }
}
