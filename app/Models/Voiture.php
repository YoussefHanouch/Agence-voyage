<?php

namespace App\Models;
use App\Models\ReservationsVoiture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
    use HasFactory;
    protected $fillable = ['marque', 'modèle', 'année', 'places_disponibles', 'prix_par_jour','image'];

    public function reservationsVoitures()
    {
        return $this->hasMany(ReservationsVoiture::class);
    }
}
