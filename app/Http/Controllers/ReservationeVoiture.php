<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voiture;
use App\Models\ReservationVoiture;
use Illuminate\Support\Facades\Auth; // Ensure Auth is imported

class ReservationeVoiture extends Controller
{
    public function index(Request $request)
    {
        $query = Voiture::query();
    
        // Appliquer les filtres
        if ($request->filled('marque')) {
            $query->where('marque', 'like', '%' . $request->marque . '%');
        }
        if ($request->filled('modèle')) {
            $query->where('modèle', 'like', '%' . $request->modèle . '%');
        }
        if ($request->filled('année')) {
            $query->where('année', $request->année);
        }
        if ($request->filled('places_disponibles')) {
            $query->where('places_disponibles', '>=', $request->places_disponibles);
        }
    
        $voitures = $query->simplePaginate(10);
    
        return view('reservation_voiture.index', compact('voitures'));
    }
    

    public function info($id){
        $voiture = Voiture::find($id);
        return view('reservation_voiture.info',compact('voiture'));
    }

    public function add_reservation(Request $req , $id){
        $voiture = Voiture::find($id);
        $req->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
           
        ]);
        $id_user = Auth::user()->id;
        ReservationVoiture::create([
           'user_id' => $id_user,
           'voiture_id' => $voiture->id,
           'date_debut' => $req->date_debut,
           'date_fin' => $req->date_fin,
        ]);
        $reservationn = ReservationVoiture::where('user_id',1)->orderBy('created_at','desc')->limit(1)->get();
        $reservation = $reservationn[0];
        $message = 'Voiture Bien Reserver';
        return view('reservation_voiture.detaill_reservation',compact('reservation','voiture','message'));
    }



    public function mes_reservation()
{
    // Vérifier le rôle de l'utilisateur
    if (Auth::user()->type === 'admin') {
        // Récupérer toutes les réservations de voitures
        $reservation = ReservationVoiture::orderBy('created_at', 'desc')->paginate(10);
    } else {
        // Récupérer les réservations de voitures de l'utilisateur connecté
        $reservation = ReservationVoiture::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
    }

    // Passer les réservations à la vue appropriée
    return view('reservation_voiture.mes_reservation', compact('reservation'));
}
    public function suprimer($id){
        $reservation = ReservationVoiture::find($id);
        $reservation->delete();
        $message = 'Reservation A Supprimer Avec Succes';
        return redirect()->route('mes_reservation')->with('success', $message);
    }
    

    public function detaill_reservation($id){
        $reservation = ReservationVoiture::find($id);
        $voiture = Voiture::find($reservation->voiture_id);
        $message = '';
        return view('reservation_voiture.detaill_reservation',compact('reservation','voiture','message'));
    }



public function historiqueReservations()
{
    // Vérifier le rôle de l'utilisateur
    if (Auth::user()->type === 'admin') {
        // Récupérer toutes les réservations de voitures
        $reservations = ReservationVoiture::orderBy('created_at', 'desc')->paginate(10);
    } else {
        // Récupérer les réservations de voitures de l'utilisateur connecté
        $reservations = ReservationVoiture::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
    }

    // Passer les réservations à la vue appropriée
    return view('reservation_voiture.historiquevoiture', compact('reservations'));
}

}
