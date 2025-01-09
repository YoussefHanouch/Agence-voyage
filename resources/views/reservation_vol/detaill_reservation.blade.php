@extends('layouts.app')
  
@section('title')

       
       <style>
.btn-discount {
    text-decoration: none;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #28a745; /* Vert pour Vols et Voitures */
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-discount:hover {
    background-color: #218838;
}

.btn-discount-alt {
    background-color: #ffc107; /* Jaune pour Vols et Hôtels */
}

.btn-discount-alt:hover {
    background-color: #e0a800;
}

.container {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 600px;
    width: 100%;
    text-align: left;
}

h2 {
    text-align: center;
    color: #007bff;
    font-family: 'Courier New', Courier, monospace;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

td:first-child {
    font-weight: bold;
    color: #555;
}

tr:nth-child(even) td {
    background-color: #f1f1f1;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-align: center;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s;
}
.img_size{
    width:360px;
  height:150px; /* Ajustez la taille de l'image selon vos besoins */
  margin-left: 25%;
  box-shadow: 0 30px 38px rgba(0, 0, 0, 0.228), 0 1px 10px rgba(0, 0, 0, 0.137);
        }

.btn:hover {
    background-color: #0056b3;
}
.img_size{
            width: 250px;
  height:150px; /* Ajustez la taille de l'image selon vos besoins */
  margin-left: 35%;
  box-shadow: 0 30px 38px rgba(0, 0, 0, 0.228), 0 1px 10px rgba(0, 0, 0, 0.137);
        }
        .message{
            background:#81f987;
            color:black;
            padding:5px;
            text-align:center;
            box-shadow: 0 30px 38px rgba(0, 0, 0, 0.228), 0 1px 10px rgba(0, 0, 0, 0.137);
        }
        .lg{
    width: 60px;
    height: 60px;
    transform: rotate(15deg);
    mix-blend-mode: darken;
}
.bc{
    background: #62A1D9;
}

    </style>
    @section('contents')

    <div class="container">
        <h2>Details Vole</h2>

        <table>
            @if ($message)
            <div class="alert alert-success">
                {{$message }}
            </div>
    @endif
           
            @if(!empty($vole->image))
            <img src="{{asset($vole->image)}}" alt="photo"  class="img_size" /> <br>
             @else
              <img src="{{asset('image/no-image.jpg')}}" alt="no-image"  class="img_size" /><br> 
        @endif
        
     
            <tr><td>Id :</td><td>{{$reservation->id}}</td></tr>
            <tr><td>compagnie_aerienne :</td><td>{{$vole->compagnie_aerienne}}</td></tr>
            <tr><td>numero_de_vol :</td><td>{{$vole->numero_de_vol}}</td></tr>
            <tr><td>date_depart :</td><td>{{$vole->date_depart}}</td></tr>
            <tr><td>date_arrivee :</td><td>{{$vole->date_arrivee}}</td></tr>
            <tr><td>lieu_depart :</td><td>{{$vole->lieu_depart}}</td></tr>
            <tr><td>lieu_arrivee :</td><td>{{$vole->lieu_arrivee}}</td></tr>
            <tr><td>places_disponibles :</td><td>{{$vole->places_disponibles}}</td></tr>
            <tr><td>prix :</td><td>{{$vole->prix}}</td></tr>
            <tr><td>nombre_de_places :</td><td>{{$reservation->nombre_de_places}}</td></tr>
           
            <tr><td>Date reservation :</td><td>{{$vole->created_at}}</td></tr>
        </table>
              <div class="btn-container">

        <button  class="btn btn-info btn-md" > <a style="text-decoration:none; color:white;" href="{{url('/volesreservation.mes_reservation')}}" >Voir Touts Les Reservation</a></button> 
            <a class="btn-discount" style="text-decoration:none; color:white;" href="{{ route('reservation_voiture') }}">Réserver Vols et Voitures (20% Remise)</a> &nbsp;&nbsp;
            <a style="text-decoration:none; color:white;" class="btn-discount btn-discount-alt btn-md" href="{{ route('res_hotel') }}">Réserver Vols et Hôtels (20% Remise)</a> &nbsp;&nbsp;
        </div>
        
    </div>
@endsection
