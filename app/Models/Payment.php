<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReservationVol;
use App\Models\ReservationVoiture;
use App\Models\ReservationHotel;
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reservation_id',
        'reservation_type',
        'card_number',
        'card_holder_name',
        'card_expiry',
        'card_cvc',
        'amount',
        'paid_at',
    ];

    /**
     * Get the user that owns the payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reservation associated with the payment.
     * This method uses the `reservation_type` and `reservation_id` to dynamically
     * determine the model class.
     */
    public function reservation()
    {
        switch ($this->reservation_type) {
            case 'vol':
                return $this->belongsTo(ReservationVol::class, 'reservation_id');
            case 'voiture':
                return $this->belongsTo(ReservationVoiture::class, 'reservation_id');
            case 'hotel':
                return $this->belongsTo(ReservationHotel::class, 'reservation_id');
            default:
                throw new \Exception("Invalid reservation type");
        }
    }
}
