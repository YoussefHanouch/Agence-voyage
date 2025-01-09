@extends('layouts.app')
  
@section('title','Voitures Disponibles')

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
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Utilisez auto-fill */
        gap: 10px;
        margin-right: 0%;
    }
    .order-card {
        display: flex; /* Utilisez flexbox pour aligner les éléments en ligne */
        align-items: center; /* Alignez les éléments sur l'axe vertical */
        background-color: rgb(255, 255, 255);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        padding: 12px;
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
        height:130px; /* Ajustez la taille de l'image selon vos besoins */
        margin-right: 2px; /* Ajoutez une marge à droite pour séparer les images des autres éléments */
        box-shadow: 0 30px 38px rgba(255, 250, 255, 0.228), 0 0px 50px rgba(255, 255, 255, 0.137);
    }
    .img_size {
        width: 210px;
        height: 150px;
    }
</style>
@section('contents')
<div class="user-orders-container">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="btn-container">
                <a class="btn-ajouter" href="{{ url('voituresreservation.mes_reservation') }}">Mes reservation</a>
            </div>
           
            <!-- Formulaire de filtrage -->
            <form action="{{ route('reservation_voiture.index') }}" method="GET" class="mb-4">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="marque">Marque</label>
                        <input type="text" name="marque" id="marque" class="form-control" value="{{ request('marque') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="modèle">Modèle</label>
                        <input type="text" name="modèle" id="modèle" class="form-control" value="{{ request('modèle') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="année">Année</label>
                        <input type="text" name="année" id="année" class="form-control" value="{{ request('année') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="places_disponibles">Places Disponibles</label>
                        <input type="number" name="places_disponibles" id="places_disponibles" class="form-control" value="{{ request('places_disponibles') }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </form>
           
            <div class="orders-list">
                @csrf
                @if($voitures->count() > 0)
                    @foreach($voitures as $voit)
                        <div class="order-card">
                            <a class="detail-link" href="{{ url('voituresreservation.info', $voit->id) }}">
                                <div class="product-infodet">
                                    @if(!empty($voit->image))
                                        <img src="{{ asset($voit->image) }}" alt="photo" class="img_size" /> <br>
                                    @else
                                        <img src="{{ asset('image/no-image.jpg') }}" alt="no-image" class="img_size" /><br> 
                                    @endif
                                </div>
                                <div class="order-info">
                                    <div><strong>Marque :</strong> {{ $voit->marque }}</div>
                                    <div><strong>Modèle :</strong> {{ $voit->modèle }}</div>
                                    <div><strong>Année :</strong> {{ $voit->année }}</div>
                                    <div><strong>Places Disponibles :</strong> {{ $voit->places_disponibles }}</div>
                                    <div><strong>Prix par Jour :</strong> {{ $voit->prix_par_jour }}</div>
                                </div> 
                            </a>     
                        </div>
                    @endforeach
                @else
                    <h5>Aucun voiture trouvé pour les critères de recherche spécifiés.</h5>
                @endif
            </div>
        </div>
    </div>
    <div class="mt-4">
        {{$voitures->links()}}
    </div>
</div>
@endsection