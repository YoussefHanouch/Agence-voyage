@extends('layouts.app')

@section('contents')
<style>
    .lg {
        width: 60px;
        height: 60px;
        transform: rotate(15deg);
        mix-blend-mode: darken;
    }
    .bc {
        background: #62A1D9;
    }
    .progress {
        height: 20px;
        border-radius: 10px;
        background-color: #ddd;
        margin: 20px 0;
    }
    .progress-bar {
        height: 100%;
        border-radius: 10px;
        text-align: center;
        color: white;
    }
</style>
@php
$totalAmount = $reservationsWithAmounts->sum('totalAmount');
$discountRate = 0.20; // 20% de remise
$discount = $totalAmount * $discountRate;
$totalWithDiscount = $totalAmount - $discount;

@endphp
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">Résumé du Paiement</div>
                <div class="card-body">

                    <h3 class="text-center mb-4">Vérifiez vos Réservations</h3>

                    <div class="list-group">
                        @foreach($reservationsWithAmounts as $reservation)
                            <div class="list-group-item">
                                <h5 class="mb-1">
                                    Type: <span class="badge badge-info">{{ ucfirst(class_basename($reservation)) }}</span>
                                </h5>
                                <p class="mb-1"><strong>Montant:</strong> <span class="text-success">{{ $reservation->totalAmount }} DH</span></p>
                                <p class="mb-1"><strong>Client:{{ $reservation->user->name }} {{ $reservation->user->prenom }}</strong></p>
                                <p class="mb-1"><strong>Détails:</strong></p>
                                <ul>
                                    @if($reservation instanceof \App\Models\ReservationVol)
                                        <li><strong>Vol:</strong> {{ $reservation->vol->compagnie_aerienne }}</li>
                                        <li><strong>Départ:</strong> {{ $reservation->vol->date_depart }}</li>
                                        <li><strong>Arrivée:</strong> {{ $reservation->vol->date_arrivee }}</li>
                                    @elseif($reservation instanceof \App\Models\ReservationVoiture)
                                        <li><strong>Modèle de Voiture:</strong> {{ $reservation->voiture->modèle }}</li>
                                        <li><strong>Date de Début:</strong> {{ $reservation->date_debut }}</li>
                                        <li><strong>Date de Fin:</strong> {{ $reservation->date_fin }}</li>
                                    @elseif($reservation instanceof \App\Models\ReservationHotel)
                                        <li><strong>Nom de l'Hôtel:</strong> {{ $reservation->hotel->nom }}</li>
                                        <li><strong>Arrivée:</strong> {{ $reservation->date_arrivee }}</li>
                                        <li><strong>Départ:</strong> {{ $reservation->date_depart }}</li>
                                    @endif
                                </ul>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-4">
                        <h5>Montant Sans Remise: <strong>{{ $totalAmount }} DH</strong></h5>
                        <h5>Remise Appliquée (20%): <strong>{{ $discount }} DH</strong></h5>
                        <h5>Montant Avec Remise: <strong>{{ $totalWithDiscount }} DH</strong></h5>
                    </div>

                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ ($totalWithDiscount / $totalAmount) * 100 }}%; background-color: #28a745;">
                            {{ number_format(($totalWithDiscount / $totalAmount) * 100, 2) }}%
                        </div>
                    </div>

                    <div class="form-group text-center mt-4">
                        <a href="{{ route('payments.storeMultiple') }}" class="btn btn-primary btn-lg">Payer Maintenant</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
