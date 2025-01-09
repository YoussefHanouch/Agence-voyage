<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vol;
use App\Models\ReservationVol;
use App\Models\ReservationHotel;

use Illuminate\Support\Facades\Auth; // Ensure Auth is imported

class Reservationvoles extends Controller
{
    public function index(Request $request)
    {
        $query = Vol::query();

        // Apply filters
        if ($request->filled('date_depart')) {
            $query->whereDate('date_depart', $request->date_depart);
        }
        if ($request->filled('lieu_depart')) {
            $query->where('lieu_depart', 'like', '%' . $request->lieu_depart . '%');
        }
        if ($request->filled('lieu_arrivee')) {
            $query->where('lieu_arrivee', 'like', '%' . $request->lieu_arrivee . '%');
        }
        if ($request->filled('budget')) {
            $query->where('prix', '<=', $request->budget);
        }

        $voles = $query->simplePaginate(4);

        return view('reservation_vol.index', compact('voles'));
    }

    public function info($id){
        $vole = Vol::find($id);
        return view('reservation_vol.info',compact('vole'));
    }

    public function add_reservation(Request $req , $id){
        $vole = Vol::find($id);
        $req->validate([
            
            'nombre_de_places' => 'required|numeric',
           
        ]);

        $id_user = Auth::user()->id;

        ReservationVol::create([
           'user_id' => $id_user,
           'vol_id' => $vole->id,
           'nombre_de_places' => $req->nombre_de_places,
          
        ]);
        $reservationn = ReservationVol::where('user_id',1)->orderBy('created_at','desc')->limit(1)->get();
        $reservation = $reservationn[0];
        $message = 'Vole Bien Reserver';
        return view('reservation_vol.detaill_reservation',compact('reservation','vole','message'));
    }


    public function mes_reservation()
    {
        // Vérifier le rôle de l'utilisateur
        if (Auth::user()->type === 'admin') {
            // Récupérer toutes les réservations de vols
            $reservation = ReservationVol::orderBy('created_at', 'desc')->simplePaginate(4);
        } else {
            // Récupérer les réservations de vols de l'utilisateur connecté
            $reservation = ReservationVol::where('user_id', Auth::id())->orderBy('created_at', 'desc')->simplePaginate(4);
        }
    
        // Passer les réservations à la vue appropriée
        return view('reservation_vol.mes_reservation', compact('reservation'));
    }
    

    public function suprimer($id){
        $reservation = ReservationVol::find($id);
        $reservation->delete();
       
        return redirect()->route('reservation_voles')->with('success','Reservation A Supprimer Avec Succes');
    }

    public function detaill_reservation($id){
        $reservation = ReservationVol::find($id);
        $vole = Vol::find($reservation->vol_id);
        $message = '';
        return view('reservation_vol.detaill_reservation',compact('reservation','vole','message'));
    }
    public function historiqueReservations()
{
    // Vérifier le rôle de l'utilisateur
    if (Auth::user()->type === 'admin') {
        // Récupérer toutes les réservations de vols
        $reservations = ReservationVol::orderBy('created_at', 'desc')->paginate(10);
    } else {
        // Récupérer les réservations de vols de l'utilisateur connecté
        $reservations = ReservationVol::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
    }

    // Passer les réservations à la vue appropriée
    return view('reservation_vol.historiquevols', compact('reservations'));
}



public function volsVoituresDiscount()
{
    $userId = Auth::id();
    $vols = ReservationVol::where('user_id', $userId)->get();
    $voitures = ReservationVoiture::where('user_id', $userId)->get();

    $discount = 0.20; // 20% discount

    $vols->each(function($vol) use ($discount) {
        $vol->discounted_price = $vol->vol->prix * $vol->nombre_de_places * (1 - $discount);
    });

    $voitures->each(function($voiture) use ($discount) {
        $voiture->discounted_price = $voiture->voiture->prix_par_jour * $voiture->nombre_de_jours * (1 - $discount);
    });

    return view('volsVoitures', compact('vols', 'voitures'));
}

public function volsHotelsDiscount()
{
    $userId = Auth::id();
    $vols = ReservationVol::where('user_id', $userId)->get();
    $hotels = ReservationHotel::where('user_id', $userId)->get();

    $discount = 0.20; // 20% discount

    $vols->each(function($vol) use ($discount) {
        $vol->discounted_price = $vol->vol->prix * $vol->nombre_de_places * (1 - $discount);
    });

    $hotels->each(function($hotel) use ($discount) {
        $hotel->discounted_price = $hotel->hotel->prix_par_nuit * $hotel->nombre_de_nuits * (1 - $discount);
    });

    return view('volsHotels', compact('vols', 'hotels'));
}








}

