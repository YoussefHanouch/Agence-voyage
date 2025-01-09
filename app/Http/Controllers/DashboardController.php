<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Vol;
use App\Models\Voiture;
use App\Models\ReservationHotel;
use App\Models\ReservationVol;
use App\Models\ReservationVoiture;
use App\Models\User;

class DashboardController extends Controller
{
    public function statistics()
    {
        $voles = Vol::simplePaginate(4);
        $carReservationsCount = ReservationVoiture::count();
        $hotelReservationsCount = ReservationHotel::count();
        $flightReservationsCount = ReservationVol::count();

        // Get the number of users by type
        $clientCount = User::where('type', 'client')->count();
        $adminCount = User::where('type', 'admin')->count();

        // Return the view with the collected data
        return view('dashboard', compact(
            'carReservationsCount', 
            'hotelReservationsCount', 
            'flightReservationsCount', 
            'clientCount', 
            'adminCount',
            'voles',
        ));

       
    }

    public function index(Request $request)
    {
        $cars = Voiture::paginate(3); // Adjust the number of items per page as needed
        if ($request->ajax()) {
            return view('partials.cars', compact('cars'))->render();
        }
        return view('welcome', compact('cars'));
    }
    
}
