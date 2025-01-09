@extends('layouts.app')
  
@section('title')

    <title>Détails Voiture</title>
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

.vt:hover {
    color:#ffffff;
    text-decoration: none;


}
.vt{
    color:#ffffff;

}
.img_size{
             width:80px;
        }

    </style>
@section('contents')

    <div class="container">
        <h2>Détails Voiture</h2>
        
        <table>
            <tr><td>Id :</td><td>{{$voiture->id}}</td></tr>
            <tr><td>Image :</td><td>                  
                @if(!empty($voiture->image))
                 <img src="{{asset($voiture->image)}}" alt="photo"  class="img_size" /> <br>
                  @else
                   <img src="{{asset('image/no-image.jpg')}}" alt="no-image"  class="img_size" /><br> 
             @endif
       
        </td></tr>
            <tr><td>Marque :</td><td>{{$voiture->marque}}</td></tr>
            <tr><td>Modèle :</td><td>{{$voiture->modèle}}</td></tr>
            <tr><td>Année :</td><td>{{$voiture->année}}</td></tr>
            <tr><td>Places disponibles :</td><td>{{$voiture->places_disponibles}}</td></tr>
            <tr><td>Prix par jour :</td><td>{{$voiture->prix_par_jour}}</td></tr>
            <tr><td>Date de création :</td><td>{{$voiture->created_at}}</td></tr>
            <tr><td>Date de modification :</td><td>{{$voiture->updated_at}}</td></tr>
        </table>
      <button class="btn btn-info">  <a href="{{url('/voitures')}}" class="vt" >Retour</a></button>
    </div>
@endsection
