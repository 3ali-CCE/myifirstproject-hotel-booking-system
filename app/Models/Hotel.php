<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
     protected $fillable = [
        'name',
        'city_id',
        'description',
        'price',
        'image',
        'address',
        'status',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
