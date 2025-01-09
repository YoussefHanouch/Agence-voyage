<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\ReservationVol;
use App\Models\ReservationVoiture;
use App\Models\ReservationHotel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentControllerMultiple extends Controller
{
    public function processPayment(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'reservation_id' => 'required|integer',
            'reservation_type' => 'required|string|in:vol,voiture,hotel',
            'card_number' => 'required|string|max:255',
            'card_holder_name' => 'required|string|max:255',
            'card_expiry' => 'required|string|max:7',
            'card_cvc' => 'required|string|max:4',
            'amount' => 'required|numeric',
        ]);

        // Create the payment record
        $payment = new Payment();
        $payment->user_id = $request->user_id;
        $payment->reservation_id = $request->reservation_id;
        $payment->reservation_type = $request->reservation_type;
        $payment->card_number = $request->card_number;
        $payment->card_holder_name = $request->card_holder_name;
        $payment->card_expiry = $request->card_expiry;
        $payment->card_cvc = $request->card_cvc;
        $payment->amount = $request->amount;
        $payment->paid_at = now();
        $payment->save();

        // Update the reservation status based on the reservation type
        switch ($request->reservation_type) {
            case 'vol':
                $reservation = ReservationVol::find($request->reservation_id);
                break;
            case 'voiture':
                $reservation = ReservationVoiture::find($request->reservation_id);
                break;
            case 'hotel':
                $reservation = ReservationHotel::find($request->reservation_id);
                break;
            default:
                return redirect()->back()->with('error', 'Invalid reservation type');
        }

        if ($reservation) {
            $reservation->status = 'paid';
            $reservation->save();
            return redirect()->back()->with('success', 'Payment successful');
        }

        return redirect()->back()->with('error', 'Reservation not found');
    }

    public function showHotelPaymentForm($id)
    {
        $reservation = $this->getHotelReservation($id);

        if (!$reservation) {
            return redirect()->route('reservations.index')->with('error', 'Hotel reservation not found');
        }

        // Passer les données à la vue
        return view('payment', [
            'reservation' => $reservation,
            'type' => 'hotel',
            'totalAmount' => $reservation->totalAmount
        ]);
    }

    private function getHotelReservation($id)
    {
        try {
            $hotelReservation = ReservationHotel::with('hotel')->findOrFail($id);
            $hotelReservation->totalAmount = $this->calculateHotelAmount($hotelReservation);
            return $hotelReservation;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    private function calculateHotelAmount($hotelReservation)
    {
        $prixParNuit = $hotelReservation->hotel->prix_par_nuit;
        $dateArrivee = Carbon::parse($hotelReservation->date_arrivee);
        $dateDepart = Carbon::parse($hotelReservation->date_depart);
        $nombreDeNuits = $dateArrivee->diffInDays($dateDepart);
        return $prixParNuit * $nombreDeNuits;
    }

    public function showVoiturePaymentForm($id)
    {
        $reservation = $this->getVoitureReservation($id);

        if (!$reservation) {
            return redirect()->route('reservations.index')->with('error', 'Car reservation not found');
        }

        // Passer les données à la vue
        return view('payment', [
            'reservation' => $reservation,
            'type' => 'voiture',
            'totalAmount' => $reservation->totalAmount
        ]);
    }

    private function getVoitureReservation($id)
    {
        try {
            $voitureReservation = ReservationVoiture::with('voiture')->findOrFail($id);
            $voitureReservation->totalAmount = $this->calculateVoitureAmount($voitureReservation);
            return $voitureReservation;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    private function calculateVoitureAmount($voitureReservation)
    {
        $prixParJour = $voitureReservation->voiture->prix_par_jour;
        $dateDebut = Carbon::parse($voitureReservation->date_debut);
        $dateFin = Carbon::parse($voitureReservation->date_fin);
        $nombreDeJours = $dateDebut->diffInDays($dateFin);
        return $prixParJour * $nombreDeJours;
    }

    public function showVolAndVoiturePaymentForm()
    {
        // Obtenir la dernière réservation de vol et de voiture
        $lastVolReservation = ReservationVol::latest()->first();
        $lastVoitureReservation = ReservationVoiture::latest()->first();

        if (!$lastVolReservation || !$lastVoitureReservation) {
            return redirect()->route('reservations.index')->with('error', 'No recent flight or car reservations found');
        }

        // Calculer le montant total avec remise
        $volAmount = $lastVolReservation->totalAmount;
        $voitureAmount = $lastVoitureReservation->totalAmount;
        $totalAmount = ($volAmount + $voitureAmount) * 0.8; // 20% de remise

        // Passer les données à la vue
        return view('payment', [
            'lastVolReservation' => $lastVolReservation,
            'lastVoitureReservation' => $lastVoitureReservation,
            'totalAmount' => $totalAmount
        ]);
    }
    // public function showMultiplePaymentForm()
    // {
    //     // Récupérer les réservations de voiture et de vol du même jour, sans dépasser 24 heures de différence
    //     $reservationsWithAmounts = Reservation::where(function ($query) {
    //             $query->where('type', 'vol')
    //                   ->orWhere('type', 'voiture');
    //         })
    //         ->whereRaw('DATEDIFF(reservation_date, NOW()) <= 1') // Réservations dans les 24 heures
    //         ->get();

    //     // Calculer le montant total
    //     $totalAmount = $reservationsWithAmounts->sum('totalAmount');

    //     return view('payment', [
    //         'reservationsWithAmounts' => $reservationsWithAmounts,
    //         'totalAmount' => $totalAmount,
    //     ]);
    // }






}
