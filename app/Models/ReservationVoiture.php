<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Voiture;
use App\Models\User;


class ReservationVoiture extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'voiture_id', 'date_debut', 'date_fin','status'];
    protected $table='reservations_voitures';
    public function voiture()
    {
        return $this->belongsTo(Voiture::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
