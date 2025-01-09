<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Payment;
use App\Models\ReservationVoiture;
use App\Models\ReservationVol;
use App\Models\ReservationHotel;
use Illuminate\Support\Facades\Auth; // Ensure Auth is imported
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ReservationHotels extends Controller
{

   
    
    public function index(Request $request)
    {
        $query = Hotel::query();

        // Apply filters
        if ($request->filled('ville')) {
            $query->where('ville', 'like', '%' . $request->ville . '%');
        }
        if ($request->filled('étoiles')) {
            $query->where('étoiles', $request->étoiles);
        }
        if ($request->filled('prix_max')) {
            $query->where('prix_par_nuit', '<=', $request->prix_max);
        }

        $hotels = $query->simplePaginate(4);

        return view('reservation_hotel.index', compact('hotels'));
    }

    public function info($id){
        $hotel = Hotel::find($id);
        return view('reservation_hotel.info',compact('hotel'));
    }

    public function add_reservation(Request $req , $id){
        $hotel = Hotel::find($id);
        $req->validate([
            'date_arrivee' => 'required|date',
            'date_depart' => 'required|date',
            'nombre_de_places' => 'required|numeric',
           
        ]);
        $id_user = Auth::user()->id;

        ReservationHotel::create([
           'user_id' => $id_user,
           'hotel_id' => $hotel->id,
           'date_arrivee' => $req->date_arrivee,
           'date_depart' => $req->date_depart,
           'nombre_de_places' => $req->nombre_de_places,
        ]);
        $reservationn = ReservationHotel::where('user_id',1)->orderBy('created_at','desc')->limit(1)->get();
        $reservation = $reservationn[0];
        $message = 'Hotel Bien Reserver';
        return view('reservation_hotel.detaill_reservation',compact('reservation','hotel','message'));
    }

   


    // public function pay($id)
    // {
    //     $reservation = ReservationHotel::findOrFail($id);

    //     // Afficher la vue de paiement
    //     return view('payment', compact('reservation'));
    // }


    // public function processPayment(Request $request, $id)
    // {
    //     $request->validate([
    //         'card_number' => 'required|string|max:255',
    //         'card_holder_name' => 'required|string|max:255',
    //         'card_expiry' => 'required|string|max:7',
    //         'card_cvc' => 'required|string|max:4',
    //         'amount' => 'required|numeric',
    //     ]);

    //     $reservation = ReservationHotel::findOrFail($id);

    //     DB::beginTransaction();

    //     try {
    //         // Créer l'enregistrement de paiement
    //         $payment = new Payment();
    //         $payment->user_id = $reservation->user_id;
    //         $payment->reservation_id = $reservation->id;
    //         $payment->reservation_type = 'hotel';
    //         $payment->card_number = $request->card_number;
    //         $payment->card_holder_name = $request->card_holder_name;
    //         $payment->card_expiry = $request->card_expiry;
    //         $payment->card_cvc = $request->card_cvc;
    //         $payment->amount = $request->amount;
    //         $payment->paid_at = now();
    //         $payment->save();

    //         // Mettre à jour le statut de la réservation
    //         $reservation->status = 'paid';
    //         $reservation->save();

    //         DB::commit();

    //         return redirect()->route('reservations.pending')->with('success', 'Payment successful');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with('error', 'Payment failed. Please try again.');
    //     }
    // }



    public function pay(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|integer',
            'reservation_type' => 'required|string|in:hotel,voiture,vol',
            'card_number' => 'required|string|max:255',
            'card_holder_name' => 'required|string|max:255',
            'card_expiry' => 'required|string|max:7',
            'card_cvc' => 'required|string|max:4',
            'amount' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            // Créer l'enregistrement de paiement
            $payment = Payment::create([
                'user_id' => auth()->id(),
                'reservation_id' => $request->reservation_id,
                'reservation_type' => $request->reservation_type,
                'card_number' => $request->card_number,
                'card_holder_name' => $request->card_holder_name,
                'card_expiry' => $request->card_expiry,
                'card_cvc' => $request->card_cvc,
                'amount' => $request->amount,
                'paid_at' => now(),
            ]);

            // Mettre à jour le statut de la réservation
            switch ($request->reservation_type) {
                case 'hotel':
                    $reservation = ReservationHotel::findOrFail($request->reservation_id);
                    $reservation->status = 'paid';
                    $reservation->save();
                    break;
                case 'voiture':
                    $reservation = ReservationVoiture::findOrFail($request->reservation_id);
                    $reservation->status = 'paid';
                    $reservation->save();
                    break;
                case 'vol':
                    $reservation = ReservationVol::findOrFail($request->reservation_id);
                    $reservation->status = 'paid';
                    $reservation->save();
                    break;
            }

            DB::commit();

            return redirect()->route('reservations.pending')->with('success', 'Payment successful');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Payment failed. Please try again.');
        }
    }

public function mes_reservation()
{
    // Vérifier le rôle de l'utilisateur
    if (Auth::user()->type === 'admin') {
        // Récupérer toutes les réservations d'hôtels
        $reservation = ReservationHotel::orderBy('created_at', 'desc')->paginate(10);
    } else {
        // Récupérer les réservations d'hôtels de l'utilisateur connecté
        $reservation = ReservationHotel::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
    }

    // Passer les réservations à la vue appropriée
    return view('reservation_hotel.mes_reservation', compact('reservation'));
}

    public function suprimer($id){
        $reservation = ReservationHotel::find($id);
        $reservation->delete();
       
        return redirect()->route('reservation_hotels')->with('message','Reservation A Supprimer Avec Succes');
    }

    public function detaill_reservation($id){
        $reservation = ReservationHotel::find($id);
        $hotel = Hotel::find($reservation->hotel_id);
        $message = '';
        return view('reservation_hotel.detaill_reservation',compact('reservation','hotel','message'));
    }

public function historiqueReservations()
{
    // Vérifier le rôle de l'utilisateur
    if (Auth::user()->type === 'admin') {
        // Récupérer toutes les réservations d'hôtels
        $reservations = ReservationHotel::orderBy('created_at', 'desc')->paginate(10);
    } else {
        // Récupérer les réservations d'hôtels de l'utilisateur connecté
        $reservations = ReservationHotel::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
    }

    // Passer les réservations à la vue appropriée
    return view('reservation_hotel.historiqueHotel', compact('reservations'));
}

}
