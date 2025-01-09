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

.btn:hover {
    background-color: #0056b3;
}
.img_size{
    width:360px;
  height:150px; /* Ajustez la taille de l'image selon vos besoins */
  margin-left: 25%;
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
        <h2>Détails Voiture</h2>
      
        <table>
            @if(!empty($voiture->image))
            <img src="{{asset($voiture->image)}}" alt="photo"  class="img_size" /> <br>
             @else
              <img src="{{asset('image/no-image.jpg')}}" alt="no-image"  class="img_size" /><br> 
        @endif      
        <br>
        @if ($message)
        <div class="alert alert-success">
            {{$message }}
        </div>
    @endif


        <tr><td>Id :</td><td>{{$reservation->id}}</td></tr>
            <tr><td>Marque :</td><td>{{$voiture->marque}}</td></tr>
            <tr><td>Modèle :</td><td>{{$voiture->modèle}}</td></tr>
            <tr><td>Année :</td><td>{{$voiture->année}}</td></tr>
            <tr><td>Places disponibles :</td><td>{{$voiture->places_disponibles}}</td></tr>
            <tr><td>Prix par jour :</td><td>{{$voiture->prix_par_jour}}</td></tr>
            <tr><td>Date debut :</td><td>{{$reservation->date_debut}}</td></tr>
            <tr><td>Date fin :</td><td>{{$reservation->date_fin}}</td></tr>
            <tr><td>Date reservation :</td><td>{{$voiture->created_at}}</td></tr>
        </table>
  <button  class="btn btn-info">  <a style="text-decoration:none; color:white;" href="{{url('/voituresreservation.mes_reservation')}}" >Voir Touts Les Reservation</a></button>
  <a href="{{ route('payments.multiple') }}" class="btn btn-primary btn-md">Payer Maintenant</a>

</div>
@endsection
