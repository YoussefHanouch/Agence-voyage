<?php

namespace App\Models;
use App\Models\ReservationHotel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'ville', 'adresse', 'étoiles', 'prix_par_nuit','image',];

    public function reservationsHotels()
    {
        return $this->hasMany(ReservationHotel::class);
    }
}
