@extends('layouts.app')
  
@section('title')
    <style>
      

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
.text-danger {
            color: red;
        }
        .img_size{
            width: 250px;
  height:150px; /* Ajustez la taille de l'image selon vos besoins */
  margin-left: 30%;
  box-shadow: 0 30px 38px rgba(0, 0, 0, 0.228), 0 1px 10px rgba(0, 0, 0, 0.137);
  border-radius: 8px;
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
        <h2>Reserver Vole</h2>
        <form action="{{url('volesreservation.add_reservation', $vole->id)}}" method="POST">
            @csrf
        <table> 
            @if(!empty($vole->image))
            <img src="{{asset($vole->image)}}" alt="photo"  class="img_size" /> <br>
             @else
              <img src="{{asset('image/no-image.jpg')}}" alt="no-image"  class="img_size" /><br> 
        @endif 
            <tr><td>Compagnie aerienne :</td><td>{{$vole->compagnie_aerienne}}</td></tr>
            <tr><td>Numero de vol :</td><td>{{$vole->numero_de_vol}}</td></tr>
            <tr><td>Date depart :</td><td>{{$vole->date_depart}}</td></tr>
            <tr><td>Date arrivee :</td><td>{{$vole->date_arrivee}}</td></tr>
            <tr><td>Lieu depart :</td><td>{{$vole->lieu_depart}}</td></tr>
            <tr><td>Lieu arrivee :</td><td>{{$vole->lieu_arrivee}}</td></tr>
            <tr><td>Places disponibles :</td><td>{{$vole->places_disponibles}}</td></tr>
            <tr><td>Prix :</td><td>{{$vole->prix}}</td></tr>
            <tr><td><div class="form-group">
            <label for="nombre_de_places">Nombre de places :</label></td>
            <td><input type="number" name="nombre_de_places" id="nombre_de_places" class="form-control" >
            </td>
        </div>
    </td></tr>
    <tr><td> 
        @error('nombre_de_places')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            </td></tr>
       
        </table>

<button type="submit" class="btn btn-primary">Confirmer La Reservation</button>
            <a href="{{ url('/volesreservation.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
    </div>
@endsection
