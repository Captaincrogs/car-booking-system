<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;


//car has many reservations
public function reservations()
{
    return $this->hasMany(Reservation::class);
}

}
