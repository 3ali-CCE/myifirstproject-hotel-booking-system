<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'image',
        'country',
        'description',
    ];

     public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
