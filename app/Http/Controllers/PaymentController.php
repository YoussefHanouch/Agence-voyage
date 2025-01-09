<?php

namespace App\Http\Controllers;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\ReservationVol;
use App\Models\ReservationVoiture;
use App\Models\ReservationHotel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class PaymentController extends Controller
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

    // Fonction pour récupérer une réservation d'hôtel
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

    // Fonction pour calculer le montant total d'une réservation d'hôtel
    private function calculateHotelAmount($hotelReservation)
    {
        $prixParNuit = $hotelReservation->hotel->prix_par_nuit;
        $dateArrivee = Carbon::parse($hotelReservation->date_arrivee);
        $dateDepart = Carbon::parse($hotelReservation->date_depart);
        $nombreDeNuits = $dateArrivee->diffInDays($dateDepart);
        return $prixParNuit * $nombreDeNuits;
    }


    public function showvoiturePaymentForm($id)
    {
        $reservation = $this->geVoitureReservation($id);

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

    // Fonction pour récupérer une réservation de voiture
    private function geVoitureReservation($id)
    {
        try {
            $carReservation = ReservationVoiture::with('voiture')->findOrFail($id);
            $carReservation->totalAmount = $this->calculateCarAmount($carReservation);
            return $carReservation;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    // Fonction pour calculer le montant total d'une réservation de voiture
    private function calculateCarAmount($carReservation)
    {
        $prixParJour = $carReservation->voiture->prix_par_jour;
        $dateDebut = Carbon::parse($carReservation->date_debut);
        $dateFin = Carbon::parse($carReservation->date_fin);
        $nombreDeJours = $dateDebut->diffInDays($dateFin);
        return $prixParJour * $nombreDeJours;
    }
    public function showvolsPaymentForm($id)
    {
        $reservation = $this->getVolsReservation($id);

        if (!$reservation) {
            return redirect()->route('reservations.index')->with('error', 'Flight reservation not found');
        }

        // Passer les données à la vue
        return view('payment', [
            'reservation' => $reservation,
            'type' => 'vol',
            'totalAmount' => $reservation->totalAmount
        ]);
    }

    // Fonction pour récupérer une réservation de vol
    private function getVolsReservation($id)
    {
        try {
            $flightReservation = ReservationVol::with('vol')->findOrFail($id);
            $flightReservation->totalAmount = $this->calculateVolsAmount($flightReservation);
            return $flightReservation;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    // Fonction pour calculer le montant total d'une réservation de vol
    private function calculateVolsAmount($flightReservation)
    {
        $prix = $flightReservation->vol->prix;
        $nombreDePlaces = $flightReservation->nombre_de_places;
        return $prix * $nombreDePlaces;
    
}
public function showMultiplePaymentForm(Request $request)
    {
        $userId = Auth::id();

        // Récupérer les réservations de vols, voitures, et hôtels
        $volReservations = ReservationVol::where('user_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->where('status', 'pending')  // Filtrer uniquement les réservations en attente
            ->orderBy('created_at', 'desc')
            ->get()
            ->first(); // Récupérer la dernière réservation de vol du jour

        $carReservations = ReservationVoiture::where('user_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->where('status', 'pending')  // Filtrer uniquement les réservations en attente
            ->orderBy('created_at', 'desc')
            ->get()
            ->first(); // Récupérer la dernière réservation de voiture du jour

        $hotelReservations = ReservationHotel::where('user_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->where('status', 'pending')  // Filtrer uniquement les réservations en attente
            ->orderBy('created_at', 'desc')
            ->get()
            ->first(); // Récupérer la dernière réservation d'hôtel du jour

        // Combiner toutes les réservations dans un tableau
        $reservations = collect([$volReservations, $carReservations, $hotelReservations])->filter();

        // Calculer le montant total pour chaque réservation
        $reservationsWithAmounts = $reservations->map(function ($reservation) {
            $reservation->totalAmount = $this->calculateAmount($reservation);
            return $reservation;
        });

        // Calculer le montant total
        $totalAmount = $reservationsWithAmounts->sum('totalAmount');
        $discount = 0;
        if ($totalAmount > 500) { // Exemple de seuil
            $discount = $totalAmount * 0.20;
            $totalAmount -= $discount;
        }
        return view('payment.multiple', compact('reservationsWithAmounts', 'totalAmount','discount'));
    }
   public function showPaymentAll()
{
    $userId = Auth::id();
   // Récupérer les réservations de vols, voitures, et hôtels
   $volReservations = ReservationVol::where('user_id', $userId)
   ->whereDate('created_at', Carbon::today())
   ->where('status', 'pending')  // Filtrer uniquement les réservations en attente
   ->orderBy('created_at', 'desc')
   ->get()
   ->first(); // Récupérer la dernière réservation de vol du jour

$carReservations = ReservationVoiture::where('user_id', $userId)
   ->whereDate('created_at', Carbon::today())
   ->where('status', 'pending')  // Filtrer uniquement les réservations en attente
   ->orderBy('created_at', 'desc')
   ->get()
   ->first(); // Récupérer la dernière réservation de voiture du jour

$hotelReservations = ReservationHotel::where('user_id', $userId)
   ->whereDate('created_at', Carbon::today())
   ->where('status', 'pending')  // Filtrer uniquement les réservations en attente
   ->orderBy('created_at', 'desc')
   ->get()
   ->first(); // Récupérer la dernière réservation d'hôtel du jour

// Combiner toutes les réservations dans un tableau
// $reservations = collect([$volReservations, $carReservations, $hotelReservations])->filter();
$reservations = collect([$volReservations, $carReservations, $hotelReservations])->filter();

// Déterminer le type de réservation combiné
$reservationType = '';
if ($volReservations && $carReservations && $hotelReservations) {
    $reservationType = 'vol_voiture_hotel';
} elseif ($volReservations && $carReservations) {
    $reservationType = 'vol_voiture';
} elseif ($volReservations && $hotelReservations) {
    $reservationType = 'vol_hotel';
} elseif ($carReservations && $hotelReservations) {
    $reservationType = 'voiture_hotel';
} elseif ($volReservations) {
    $reservationType = 'vol';
} elseif ($carReservations) {
    $reservationType = 'voiture';
} elseif ($hotelReservations) {
    $reservationType = 'hotel';
}
// Calculer le montant total pour chaque réservation
$reservationsWithAmounts = $reservations->map(function ($reservation) {
   $reservation->totalAmount = $this->calculateAmount($reservation);
   return $reservation;
});

// Calculer le montant total
$totalAmount = $reservationsWithAmounts->sum('totalAmount');
$discount = 0;
if ($totalAmount > 500) { // Exemple de seuil
   $discount = $totalAmount * 0.20;
   $totalAmount -= $discount;
}
    // // Récupérer les réservations de vols, voitures, et hôtels
    // $volReservations = ReservationVol::where('user_id', $userId)
    //     ->whereDate('created_at', Carbon::today())
    //     ->orderBy('created_at', 'desc')
    //     ->get();

    // $carReservations = ReservationVoiture::where('user_id', $userId)
    //     ->whereDate('created_at', Carbon::today())
    //     ->orderBy('created_at', 'desc')
    //     ->get();

    // $hotelReservations = ReservationHotel::where('user_id', $userId)
    //     ->whereDate('created_at', Carbon::today())
    //     ->orderBy('created_at', 'desc')
    //     ->get();

    // // Combiner toutes les réservations dans un tableau
    // $reservations = $volReservations->merge($carReservations)->merge($hotelReservations);

    // // Calculer le montant total pour chaque réservation
    // $reservationsWithAmounts = $reservations->map(function ($reservation) {
    //     $reservation->totalAmount = $this->calculateAmount($reservation);
    //     return $reservation;
    // });

    // // Calculer le montant total
    // $totalAmount = $reservationsWithAmounts->sum('totalAmount');
    // $discount = 0;
    // if ($totalAmount > 500) { // Exemple de seuil
    //     $discount = $totalAmount * 0.20;
    //     $totalAmount -= $discount;
    // }

    // Récupérer les IDs des réservations et le type de réservation
    // $reservationIds = $reservations->pluck('id');
    // $reservationType = $reservations->first()->getTable(); // Prendre le nom de la table du premier enregistrement
    $reservationIds = $reservations->pluck('id')->toArray();

    // Passer les données à la vue
    return view('payment.create', compact('reservationsWithAmounts', 'totalAmount', 'reservationIds', 'reservationType'));
}





    private function calculateAmount($reservation)
    {
        if ($reservation instanceof ReservationVol) {
            return $this->calculateVolAmount($reservation);
        } elseif ($reservation instanceof ReservationVoiture) {
            return $this->calculateVoitureAmount($reservation);
        } elseif ($reservation instanceof ReservationHotel) {
            return $this->calculateHoteelAmount($reservation);
        }
        
        return 0;
    }
    
    private function calculateHoteelAmount($hotelReservation)
    {
        $prixParNuit = $hotelReservation->hotel->prix_par_nuit;
        $dateArrivee = Carbon::parse($hotelReservation->date_arrivee);
        $dateDepart = Carbon::parse($hotelReservation->date_depart);
        $nombreDeNuits = $dateArrivee->diffInDays($dateDepart);
        return $prixParNuit * $nombreDeNuits;
    }
    
    private function calculateVoitureAmount($carReservation)
    {
        $prixParJour = $carReservation->voiture->prix_par_jour;
        $dateDebut = Carbon::parse($carReservation->date_debut);
        $dateFin = Carbon::parse($carReservation->date_fin);
        $nombreDeJours = $dateDebut->diffInDays($dateFin);
        return $prixParJour * $nombreDeJours;
    }
    
    private function calculateVolAmount($flightReservation)
    {
        $prix = $flightReservation->vol->prix;
        $nombreDePlaces = $flightReservation->nombre_de_places;
        return $prix * $nombreDePlaces;
    }
    
    public function storeMultiple(Request $request)
    {
        $request->validate([
            'reservation_ids' => 'required|array', 
            'card_number' => 'required|string|max:19',
            'card_holder_name' => 'required|string|max:255',
            'card_expiry' => 'required',
            'card_cvc' => 'required|string|max:4',
            'amount' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            // Enregistrer le paiement
            $payment = new Payment();
            $payment->user_id = Auth::id();
            $payment->reservation_id = json_encode($this->decodeReservationIds($request->reservation_ids)); // Conservez les IDs des réservations dans un tableau JSON
            $payment->reservation_type = $request->reservation_type; // Assurez-vous d'avoir cette valeur
            $payment->card_number = $request->card_number;
            $payment->card_holder_name = $request->card_holder_name;
            $payment->card_expiry = $request->card_expiry;
            $payment->card_cvc = $request->card_cvc;
            $payment->amount = $request->amount;
            $payment->paid_at = now();
            $payment->save();

            // Debugging: Log the reservation IDs
            \Log::info('Reservation IDs: ' . json_encode($request->reservation_ids));

            // Marquer les réservations comme payées
            foreach ($this->decodeReservationIds($request->reservation_ids) as $id) {
                $id = intval($id); // Assurez-vous que l'ID est un entier
                \Log::info('Processing Reservation ID: ' . $id); // Log each ID

                if ($id === 0) {
                    throw new \Exception("Invalid reservation ID: $id");
                }

                $reservation = $this->findReservation($id); // Assurez-vous que cette méthode existe et fonctionne
                if ($reservation) {
                    $reservation->status = 'paid';
                    $reservation->save();
                } else {
                    throw new \Exception("La réservation avec l'ID $id n'a pas été trouvée.");
                }
            }

            DB::commit();

            return redirect()->route('payment.confirmation', ['payment' => $payment->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function decodeReservationIds($reservation_ids)
    {
        // Check if the reservation IDs are sent as a JSON string
        if (is_array($reservation_ids) && count($reservation_ids) == 1 && is_string($reservation_ids[0])) {
            return json_decode($reservation_ids[0], true);
        }
        return $reservation_ids;
    }

    private function findReservation($id)
    {
        $volReservation = ReservationVol::find($id);
        $carReservation = ReservationVoiture::find($id);
        $hotelReservation = ReservationHotel::find($id);

        return $volReservation ?? $carReservation ?? $hotelReservation;
    }

    // public function storeMultiple(Request $request)
    // {
    //     $request->validate([
    //         'reservation_ids' => 'required|array', // Assurez-vous que c'est un tableau
    //         'card_number' => 'required|string|max:19',
    //         'card_holder_name' => 'required|string|max:255',
    //         'card_expiry' => 'required',
    //         'card_cvc' => 'required|string|max:4',
    //         'amount' => 'required|numeric',
    //     ]);
    
    //     // Enregistrer le paiement
    //     $payment = new Payment();
    //     $payment->user_id = Auth::id();
    //     $payment->reservation_id = json_encode($request->reservation_ids); // Conservez les IDs des réservations dans un tableau JSON
    //     $payment->reservation_type = $request->reservation_type; // Assurez-vous d'avoir cette valeur
    //     $payment->card_number = $request->card_number;
    //     $payment->card_holder_name = $request->card_holder_name;
    //     $payment->card_expiry = $request->card_expiry;
    //     $payment->card_cvc = $request->card_cvc;
    //     $payment->amount = $request->amount;
    //     $payment->paid_at = now();
    //     $payment->save();
    
    //     // Marquer les réservations comme payées
    //     foreach ($request->reservation_ids as $id) {
    //         $reservation = $this->findReservation($id); // Assurez-vous que cette méthode existe et fonctionne
    //         if ($reservation) {
    //             $reservation->status = 'paid';
    //             $reservation->save();
    //         }
    //     }
    
    //     return redirect()->route('payment.confirmation', ['payment' => $payment->id]);

    // }
    
    
    public function success($amount)
{
    // Vous pouvez utiliser $amount pour afficher la confirmation
    return view('payment.succespayments', compact('amount'));
}


public function confirmation($id)
{
    $payment = Payment::findOrFail($id);
    return view('payment.succespayments', ['amount' => $payment->amount, 'paymentId' => $payment->id]);
}

public function downloadCertificate(Payment $payment)
{
    $pdf = PDF::loadView('payment.certificate', compact('payment'));
    return $pdf->download('payment_certificate.pdf');

}

    // private function findReservation($id)
    // {
    //     $volReservation = ReservationVol::find($id);
    //     $carReservation = ReservationVoiture::find($id);
    //     $hotelReservation = ReservationHotel::find($id);

    //     return $volReservation ?? $carReservation ?? $hotelReservation;
    // }

    private function getRecentReservations($userId)
    {
        $startTime = Carbon::now()->subDay(); // 24 heures en arrière

        $volReservations = ReservationVol::where('user_id', $userId)
                                         ->where('created_at', '>=', $startTime)
                                         ->with('vol')
                                         ->get();

        $carReservations = ReservationVoiture::where('user_id', $userId)
                                            ->where('created_at', '>=', $startTime)
                                            ->with('voiture')
                                            ->get();

        $hotelReservations = ReservationHotel::where('user_id', $userId)
                                            ->where('created_at', '>=', $startTime)
                                            ->with('hotel')
                                            ->get();

        return $volReservations->merge($carReservations)->merge($hotelReservations);
    }






    
    public function index()
    {
        $userId = auth()->id();  // Récupérer l'ID de l'utilisateur connecté

        if (Auth::user()->type == 'admin') {
            // Récupérer tous les paiements si l'utilisateur est un administrateur
            $payments = Payment::orderBy('paid_at', 'desc')->simplePaginate(6);
        } else {
            // Récupérer les paiements de l'utilisateur connecté
            $payments = Payment::where('user_id', $userId)
                ->orderBy('paid_at', 'desc')
                ->simplePaginate(6);
        }

        return view('payment.index', compact('payments'));
    }





    
}
