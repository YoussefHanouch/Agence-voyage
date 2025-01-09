

@extends('layouts.app')
  
@section('title')
    <title>Vole Reservation</title>
    <style>
        .lg{
    width: 60px;
    height: 60px;
    transform: rotate(15deg);
    mix-blend-mode: darken;
}
.bc{
    background: #62A1D9;
}
        .container-scroller {
            width: 100%;
            max-width: 1200px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .h2_font {
            text-align: center;
            font-size: 32px;
            font-family: 'Courier New', Courier, monospace;
            color: #333;
            margin-bottom: 20px;
        }
        .btn-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-ajouter {
            text-decoration: none;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #69A1D2;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-ajouter:hover {
            background-color: #357ABD;
        }
        .detail-link {
            text-decoration: none;
            color: #007bff;
        }
        .btndetail:hover {
            background-color: darkblue;
        }
        .user-orders-container {
            padding: 20px;
            width: 100%;
        }
        .orders-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 10px;
            margin-right: 0%;
        }
        .order-card {
            display: flex;
            align-items: center;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 10px;
            box-shadow: 0 30px 38px rgba(0, 0, 0, 0.228), 0 1px 10px rgba(0, 0, 0, 0.137);
        }
        .order-info {
            flex-grow: 1; 
            width: 300%;
        }
        .image-produitdet {
            border-radius: 5px;
            width: 100%;
            height:130px;
            margin-right: 2px;
            box-shadow: 0 30px 38px rgba(255, 250, 255, 0.228), 0 0px 50px rgba(255, 255, 255, 0.137);
        }
        .img_size {
            width: 219px;
            height: 120px;
        }
    </style>

@section('contents')
    <div class="user-orders-container">
        <div class="main-panel">
            <div class="content-wrapper">
                <h2 class="h2_font">Voles Disponibles</h2>
                
                <!-- Filter Form -->
                <form action="{{ route('reservation_vol.index') }}" method="GET" class="mb-4">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="date_depart">Date de départ</label>
                            <input type="date" name="date_depart" id="date_depart" class="form-control" value="{{ request('date_depart') }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="lieu_depart">Lieu de départ</label>
                            <input type="text" name="lieu_depart" id="lieu_depart" class="form-control" value="{{ request('lieu_depart') }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="lieu_arrivee">Lieu d'arrivée</label>
                            <input type="text" name="lieu_arrivee" id="lieu_arrivee" class="form-control" value="{{ request('lieu_arrivee') }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="budget">Budget</label>
                            <input type="number" name="budget" id="budget" class="form-control" value="{{ request('budget') }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                </form>

                <div class="btn-container">
                    <a class="btn-ajouter" href="{{url('volesreservation.mes_reservation')}}">Mes reservation </a>
                </div>
               
               
                <div class="orders-list">
                    @csrf
                    @if($voles->count() > 0)

                    @foreach($voles as $vol)
                        <div class="order-card">
                            <a class="detail-link" href="{{url('volesreservation.info', $vol->id)}}">
                                <div className="product-infodet">
                                    @if(!empty($vol->image))
                                        <img src="{{asset($vol->image)}}" alt="photo" class="img_size" />
                                    @else
                                        <img src="{{asset('image/no-image.jpg')}}" alt="no-image" class="img_size" />
                                    @endif
                                </div>
                                <div class="order-info">
                                    <div><strong>Compagnie  :</strong> {{$vol->compagnie_aerienne}}</div>
                                    <div><strong>Numero de vol :</strong> {{$vol->numero_de_vol}}</div>
                                    <div><strong>Date depart :</strong> {{$vol->date_depart}}</div>
                                    <div><strong>Date arrivee :</strong> {{$vol->date_arrivee}}</div>
                                    <div><strong>Lieu depart :</strong> {{$vol->lieu_depart}}</div>
                                    <div><strong>Lieu arrivee :</strong> {{$vol->lieu_arrivee}}</div>
                                    <div><strong>Places disponibles :</strong> {{$vol->places_disponibles}}</div>
                                    <div><strong>Prix :</strong> {{$vol->prix}}</div>
                                </div> 
                            </a>                        
                        </div>
                    @endforeach
                    @else
                    
                    <h5>Aucun vols trouvé pour les critères de recherche spécifiés.</h5>
                   @endif
                    <br>
                </div>
                {{ $voles->links() }}
            </div>
        </div>
    </div>
@endsection
