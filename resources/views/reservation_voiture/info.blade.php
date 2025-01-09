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
  margin-left: 25%;
  box-shadow: 0 30px 38px rgba(0, 0, 0, 0.228), 0 1px 10px rgba(0, 0, 0, 0.137);
  border-radius: 8px;
        }
        .img_size{
             width:360px;
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
        <h2>Réserver Voiture</h2>
        <form action="{{url('voituresreservation.add_reservation', $voiture->id)}}" method="POST">
            @csrf
        <table> 
            @if(!empty($voiture->image))
            <img src="{{asset($voiture->image)}}" alt="photo"  class="img_size" /> <br>
             @else
              <img src="{{asset('image/no-image.jpg')}}" alt="no-image"  class="img_size" /><br> 
        @endif  
            <tr><td>Marque :</td><td>{{$voiture->marque}}</td></tr>
            <tr><td>Modèle :</td><td>{{$voiture->modèle}}</td></tr>
            <tr><td>Année :</td><td>{{$voiture->année}}</td></tr>
            <tr><td>Places disponibles :</td><td>{{$voiture->places_disponibles}}</td></tr>
            <tr><td>Prix par jour :</td><td>{{$voiture->prix_par_jour}}</td></tr>
            <tr><td><div class="form-group">
            <label for="date_debut">Date Debut :</label></td>
            <td><input type="date" name="date_debut" id="date_debut" class="form-control" >
          
        </div>
    </td></tr>
    <tr><td> 
        @error('date_debut')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            </td></tr>
        <tr><td><div class="form-group">
            <label for="date_fin">Date Fin :</label></td>
            <td><input type="date" name="date_fin" id="date_fin" class="form-control" >
           
        </div></td></tr>
        <tr><td>
        @error('date_fin')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            </td></tr>
        </table>

<button type="submit" class="btn btn-primary">Confirmer La Reservation</button>
            <a href="{{ url('/voituresreservation.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
    </div>
@endsection