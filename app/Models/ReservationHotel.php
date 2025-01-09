<?php

namespace App\Models;
use App\Models\User;
use App\Models\Hotel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationHotel extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'hotel_id', 'date_arrivee', 'date_depart','nombre_de_places','status'];
    protected $table='reservation_hotels';
    

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
 

// ReservationVoiture Model
public function voiture()
{
    return $this->belongsTo(Voiture::class);
}

// ReservationVol Model
public function vol()
{
    return $this->belongsTo(Vol::class);
}
}
