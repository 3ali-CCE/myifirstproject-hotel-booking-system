<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
   protected $fillable = [
        'hotel_id',
        'room_type',
        'capacity',
        'price',
        'room_number',
        'is_available',
        'image',  // ← ADD THIS LINE
    ];
    

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
