@extends('layouts.app')

@section('title')
    <title>Hotels Reservation</title>
@endsection
<style>


.container-scroller {
    max-width: 1200px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    overflow: hidden;
}

.h2_font {
    text-align: center;
    font-size: 36px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
}

.btn-container {
    text-align: center;
    margin-bottom: 20px;
}

.btn-ajouter {
    text-decoration: none;
    display: inline-block;
    padding: 12px 24px;
    border-radius: 5px;
    background-color: #62A1D9;
    color: #fff;
    font-weight: bold;
    text-align: center;
    transition: background-color 0.3s ease;
}

.btn-ajouter:hover {
    background-color: #357ABD;
}

.orders-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.order-card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.order-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 20px rgba(0, 0, 0, 0.2);
}

.product-infodet img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.order-info {
    padding: 20px;
}

.order-info div {
    margin-bottom: 10px;
}

.order-info div strong {
    color: #555;
}

.detail-link {
    display: block;
    text-decoration: none;
    color: inherit;
}

.detail-link:hover {
    text-decoration: none;
    color: #007bff;
}

.order-card:hover .detail-link {
    color: #0056b3;
}

.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination a {
    color: #007bff;
    padding: 10px 15px;
    border: 1px solid #007bff;
    border-radius: 5px;
    margin: 0 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.pagination a:hover {
    background-color: #007bff;
    color: #fff;
}

.no-results {
    text-align: center;
    padding: 20px;
    color: #888;
    font-size: 18px;
}

</style>
@section('contents')
    <div class="container-scroller">
        <h2 class="h2_font">Hôtels Disponibles</h2>
        
        <!-- Filter Form -->
        <form action="{{ route('reservation_hotel.index') }}" method="GET" class="mb-4">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="ville">Ville</label>
                    <input type="text" name="ville" id="ville" class="form-control" value="{{ request('ville') }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="étoiles">Étoiles</label>
                    <input type="number" name="étoiles" id="étoiles" class="form-control" value="{{ request('étoiles') }}" min="1" max="11">
                </div>
                <div class="form-group col-md-3">
                    <label for="prix_max">Prix Max</label>
                    <input type="number" name="prix_max" id="prix_max" class="form-control" value="{{ request('prix_max') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </form>

        <div class="btn-container">
            <a class="btn-ajouter" href="{{url('hotelsreservation.mes_reservation')}}">Mes réservations</a>
        </div>

        <div class="orders-list">
            @if($hotels->count() > 0)
                @foreach($hotels as $hotel)
                    <div class="order-card">
                        <a class="detail-link" href="{{url('hotelsreservation.info', $hotel->id)}}">
                            <div class="product-infodet">
                                @if(!empty($hotel->image))
                                    <img src="{{asset($hotel->image)}}" alt="{{ $hotel->nom }}" />
                                @else
                                    <img src="{{asset('image/no-image.jpg')}}" alt="No Image Available" />
                                @endif
                            </div>
                            <div class="order-info">
                                <div><strong>Nom :</strong> {{$hotel->nom}}</div>
                                <div><strong>Ville :</strong> {{$hotel->ville}}</div>
                                <div><strong>Adresse :</strong> {{$hotel->adresse}}</div>
                                <div><strong>Étoiles :</strong> {{$hotel->étoiles}}</div>
                                <div><strong>Prix Par Nuit :</strong> {{$hotel->prix_par_nuit}} DH</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="no-results">
                    <h5>Aucun hôtel trouvé pour les critères de recherche spécifiés.</h5>
                </div>
            @endif
        </div>
        {{ $hotels->links() }}
    </div>
@endsection
