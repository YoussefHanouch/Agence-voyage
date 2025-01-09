@extends('layouts.app')

@section('title', 'Réservation Vols et Hôtels avec Remise')

@section('contents')
<div class="container">
    <h2 class="text-center mb-4">Réserver Vols et Hôtels avec 20% de Remise</h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Vols</h4>
            @foreach($vols as $vol)
                <div class="card mb-3">
                    <div class="card-body">
                        <p>Vol: {{ $vol->vol->name }}</p>
                        <p>Prix Original: {{ $vol->vol->prix * $vol->nombre_de_places }} DH</p>
                        <p>Prix Remisé: {{ $vol->discounted_price }} DH</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-6">
            <h4>Hôtels</h4>
            @foreach($hotels as $hotel)
                <div class="card mb-3">
                    <div class="card-body">
                        <p>Hôtel: {{ $hotel->hotel->name }}</p>
                        <p>Prix Original: {{ $hotel->hotel->prix_par_nuit * $hotel->nombre_de_nuits }} DH</p>
                        <p>Prix Remisé: {{ $hotel->discounted_price }} DH</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
