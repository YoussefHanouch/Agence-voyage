<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vol extends Model
{
    use HasFactory;
  
    protected $fillable = ['compagnie_aerienne', 'numero_de_vol','date_depart', 'date_arrivee', 'lieu_depart', 'lieu_arrivee', 'places_disponibles', 'prix','image'];

    // Relation avec les réservations de vols
    public function reservationsVols()
    {
        return $this->hasMany(ReservationVol::class);
    }
}
