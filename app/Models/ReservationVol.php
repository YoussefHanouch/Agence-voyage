<?php

namespace App\Models;
use App\Models\User;
use App\Models\Vol;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationVol extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'vol_id', 'nombre_de_places'];
    protected $table='reservations_vols';

    public function vol()
    {
        return $this->belongsTo(Vol::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
