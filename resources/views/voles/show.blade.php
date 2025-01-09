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
.lg{
    width: 60px;
    height: 60px;
    transform: rotate(15deg);
    mix-blend-mode: darken;
}
.bc{
    background: #62A1D9;
}
.btn:hover {
    background-color: #0056b3;
}
.img_size{
             width:80px;
        }
        .vt:hover {
    color:#ffffff;
    text-decoration: none;


}
.vt{
    color:#ffffff;

}

    </style>
@section('contents')
    <div class="container">
        <h2>Détails Vole</h2>
        
        <table>
            <tr><td>Id :</td><td>{{$vole->id}}</td></tr>
            <tr><td>Image :</td><td>
                @if(!empty($vole->image))
                <img src="{{asset($vole->image)}}" alt="photo"  class="img_size" /> <br>
                  @else
                   <img src="{{asset('photo_annonce/no-image.jpg')}}" alt="no-image"  class="img_size" /><br> 
                 @endif 
                
            </td></tr>
            <tr><td>Compagnie Aérienne :</td><td>{{$vole->compagnie_aerienne}}</td></tr>
            <tr><td>Numéro De Vol :</td><td>{{$vole->numero_de_vol}}</td></tr>
            <tr><td>Date Départ :</td><td>{{$vole->date_depart}}</td></tr>
            <tr><td>Date Arrivée :</td><td>{{$vole->date_arrivee}}</td></tr>
            <tr><td>Lieu Départ :</td><td>{{$vole->lieu_depart}}</td></tr>
            <tr><td>Lieu Arrivée :</td><td>{{$vole->lieu_arrivee}}</td></tr>
            <tr><td>Places Disponibles :</td><td>{{$vole->places_disponibles}}</td></tr>
            <tr><td>Prix :</td><td>{{$vole->prix}}</td></tr>
            <tr><td>Date de création :</td><td>{{$vole->created_at}}</td></tr>
            <tr><td>Date de modification :</td><td>{{$vole->updated_at}}</td></tr>
        </table>
      <button class="btn btn-info">  <a href="{{route('voles.edit', $vole->id)}}" class="vt">Modifier</a></button> 
    <button class="btn btn-info">     <a href="{{url('/vole.index')}}" class="vt">Acceile</a></button> 
    </div>
    @endsection
