<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Userlisecontroller;
use App\Http\Controllers\HotelsController;
use App\Http\Controllers\VoituresController;
use App\Http\Controllers\VolsController;
use App\Http\Controllers\ReservationeVoiture;
use App\Http\Controllers\ReservationHotels;
use App\Http\Controllers\ReservationVoles;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentControllerMultiple;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/utilisateur/create', [Userlisecontroller::class, 'create'])->name('utilisateur.create');
    Route::post('/utilisateur', [Userlisecontroller::class, 'store'])->name('utilisateur.store');
    Route::get('/utilisateurs', [Userlisecontroller::class, 'index'])->name('utilisateur.index');
    Route::get('/utilisateur/{id}/edit', [Userlisecontroller::class, 'edit'])->name('utilisateur.edit');
    Route::PUT('/utilisateur/{id}', [Userlisecontroller::class, 'update'])->name('utilisateur.update');
    Route::delete('/utilisateur{id}', [Userlisecontroller::class, 'destroy'])->name('utilisateur.destroy');
    
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admins', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admins', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::PUT('/admins/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    
    
    Route::get('voitures', [VoituresController::class, 'index'])->name('voitures.index');
    Route::delete('suprimer_voiture/{id}', [VoituresController::class, 'suprimer'])->name('voitures.destory');;
    Route::get('form_voiture', [VoituresController::class, 'ajouter'])->name('voitures.create');;
    Route::post('add_voiture', [VoituresController::class, 'add_voiture'])->name('voitures.store');;
    Route::get('edit_voiture/{id}', [VoituresController::class, 'edite_voiture'])->name('voitures.edit');;
    Route::get('detaill_voiture/{id}', [VoituresController::class, 'detaill_voiture'])->name('voitures.show');;
    Route::PUT('update_voiture/{id}', [VoituresController::class, 'update_voiture'])->name('voitures.update');;
    
    Route::get('hotels', [HotelsController::class, 'index'])->name('hotels.index');
    Route::delete('suprimer_hotel/{id}', [HotelsController::class, 'suprimer'])->name('hotels.destroy');;
    Route::get('form_hotel', [HotelsController::class, 'ajouter'])->name('hotels.create');;
    Route::post('add_hotel', [HotelsController::class, 'add_hotel'])->name('hotels.store');;
    Route::get('edit_hotel/{id}', [HotelsController::class, 'edite_hotel'])->name('hotels.edit');;
    Route::get('detaill_hotel/{id}', [HotelsController::class, 'detaill_hotel'])->name('hotels.show');;
    Route::PUT('update_hotel/{id}', [HotelsController::class, 'update_hotel'])->name('hotels.update');;
    
    
    Route::get('vole', [VolsController::class, 'index'])->name('voles.index');
    Route::delete('vole/{id}', [VolsController::class, 'destroy'])->name('voles.destroy');
    Route::get('vole/create', [VolsController::class, 'create'])->name('voles.create');
    Route::post('vole', [VolsController::class, 'store'])->name('voles.store');
    Route::get('vole/{id}/edit', [VolsController::class, 'edit'])->name('voles.edit');
    Route::get('vole/{id}', [VolsController::class, 'show'])->name('voles.show');
    Route::PUT('vole/{id}', [VolsController::class, 'update'])->name('voles.update');
    
    });


Route::get('/', [DashboardController::class, 'index']);
Route::middleware('auth')->group(function () {

// Route pour afficher le formulaire de paiement pour une réservation d'hôtel
Route::get('/payment/hotel/{id}', [PaymentControllerMultiple::class, 'showHotelPaymentForm'])->name('payment.hotel');

// Route pour afficher le formulaire de paiement pour une réservation de voiture
Route::get('/payment/voiture/{id}', [PaymentControllerMultiple::class, 'showVoiturePaymentForm'])->name('payment.voiture');

// Route pour afficher le formulaire de paiement combiné pour les dernières réservations de vol et de voiture
Route::get('/payment/vol-et-voiture', [PaymentControllerMultiple::class, 'showVolAndVoiturePaymentForm'])->name('payment.volEtVoiture');

// Route pour traiter le paiement
Route::post('/payment/process', [PaymentControllerMultiple::class, 'processPayment'])->name('payment.process');

Route::get('/paiements', [PaymentController::class, 'index'])->name('payments.index');

Route::get('/payment/confirmation/{payment}', [PaymentController::class, 'confirmation'])->name('payment.confirmation');
Route::get('/payment/certificate/{payment}', [PaymentController::class, 'downloadCertificate'])->name('payment.certificate');


Route::get('/reservation_vol/index', [ReservationVoles::class, 'index'])->name('reservation_vol.index');
Route::get('/reservation_hotel/index', [ReservationHotels::class, 'index'])->name('reservation_hotel.index');
Route::get('/reservation-voiture', [ReservationeVoiture::class, 'index'])->name('reservation_voiture.index');
Route::get('/historique-reservations', [ReservationeVoiture::class, 'historiqueReservations'])->name('historique_reservations');
Route::get('/historique_reservations_vols', [Reservationvoles::class, 'historiqueReservations'])->name('historique_reservations_vols');
Route::get('/historique-reservations-hotel', [ReservationHotels::class, 'historiqueReservations'])->name('historique_reservations_hotel');


Route::get('voituresreservation.index', [ReservationeVoiture::class, 'index'])->name('reservation_voiture');
Route::get('voituresreservation.info/{id}', [ReservationeVoiture::class, 'info']);
Route::post('voituresreservation.add_reservation/{id}', [ReservationeVoiture::class, 'add_reservation']);
Route::get('voituresreservation.mes_reservation', [ReservationeVoiture::class, 'mes_reservation'])->name('mes_reservation');
Route::delete('voituresreservation/{id}/suprimer', [ReservationeVoiture::class, 'suprimer'])->name('voituresreservation.destroy');
Route::get('voituresreservation.detaill/{id}', [ReservationeVoiture::class, 'detaill_reservation']);


Route::get('hotelsreservation.index', [ReservationHotels::class, 'index'])->name('res_hotel');
Route::get('hotelsreservation.info/{id}', [ReservationHotels::class, 'info']);
Route::post('hotelsreservation.add_reservation/{id}', [ReservationHotels::class, 'add_reservation']);
Route::get('hotelsreservation.mes_reservation', [ReservationHotels::class, 'mes_reservation'])->name('reservation_hotels');
Route::delete('hotelsreservation.suprimer/{id}', [ReservationHotels::class, 'suprimer'])->name('hotelsreservation.suprimer');
Route::get('hotelsreservation.detaill/{id}', [ReservationHotels::class, 'detaill_reservation']);


Route::get('volesreservation.index', [ReservationVoles::class, 'index'])->name('volesreservation');
Route::get('volesreservation.info/{id}', [ReservationVoles::class, 'info']);
Route::post('volesreservation.add_reservation/{id}', [ReservationVoles::class, 'add_reservation'])->name('volesreservation.add');
Route::get('volesreservation.mes_reservation', [ReservationVoles::class, 'mes_reservation'])->name('reservation_voles');
Route::delete('volesreservation.suprimer/{id}', [ReservationVoles::class, 'suprimer'])->name('volesreservation.suprimer');
Route::get('volesreservation.detaill/{id}', [ReservationVoles::class, 'detaill_reservation']);
Route::post('/reservations/pay', [PaymentController::class, 'processPayment'])->name('reservations.processPayment');




Route::get('/reservation/hotel/{id}/payment', [PaymentController::class, 'showHotelPaymentForm'])->name('hotel.payment');

Route::get('/reservation/voiture/{id}/payment', [PaymentController::class, 'showvoiturePaymentForm'])->name('voiture.payment');

Route::get('/reservation/vol/{id}/payment', [PaymentController::class, 'showvolsPaymentForm'])->name('vols.payment');

Route::get('/payments/multiple', [PaymentController::class, 'showMultiplePaymentForm'])->name('payments.multiple');
Route::post('/payments/store-multiple', [PaymentController::class, 'storeMultiple'])->name('payment.storeMultiple');

Route::get('/payment-summary', [PaymentController::class, 'showPaymentAll'])->name('payments.storeMultiple');

Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payments.processPayment');



Route::get('/payment', function () {
    return view('payment');
})->name('payments.create');

Route::post('/payment', [PaymentController::class, 'store'])->name('payments.store');
Route::get('/payment-confirmation/{amount}', [PaymentController::class, 'success'])->name('payments.success');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'statistics'])->middleware(['auth', 'verified'])->name('dashboard.statistics');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::PUT('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
