@extends('layouts.app')
  
@section('title','Voles Disponibles')

    <style>
   



.h2_font {
    text-align: center;
    font-size: 32px;
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
    background-color: #62A1D9;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-ajouter:hover {
    background-color: #357ABD;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 10px;
    background-color: #f8f8f8;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #007bff;
    color: white;
    text-transform: uppercase;
}

td {
    background-color: #ebe7e7;
}

tr:hover td {
    background-color: #f1f1f1;
}

.sup, .edit, .detail {
    text-align: center;
    padding: 8px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btnsup {
    text-decoration: none;
    color: white;
    background-color: red;
    padding: 5px 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btnsup:hover {
    background-color: darkred;
}

.btnedit {
    text-decoration: none;
    color: white;
    background-color: green;
    padding: 5px 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btnedit:hover {
    background-color: darkgreen;
}

.btndetail {
    text-decoration: none;
    color: white;
    background-color: blue;
    padding: 5px 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
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

.btndetail:hover {
    background-color: darkblue;
}
.img_size{
    width:60px;
}

    </style>

    @section('contents')

    <div class="container">
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
                <table class="cnter">
                    @csrf
                    <thead>
                        <tr class="th_color">
                            <th>Image</th>
                            <th>Compagnie Aérienne</th>
                            <th>numéro de vol</th>
                            <th>date départ</th>
                            <th>date arrivée</th>
                            <th>lieu départ</th>
                            <th>lieu arrivée</th>
                            <th>places disponibles</th>
                            <th>Prix</th>
                            <th>Supprimer</th>
                            <th>Modifier</th>
                            <th>Détails</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($voles as $vol)
                        <tr>
                            <td>
                                @if(!empty($vol->image))
                                <img src="{{asset($vol->image)}}" alt="photo"  class="img_size" /> <br>
                                  @else
                                   <img src="{{asset('photo_annonce/no-image.jpg')}}" alt="no-image"  class="img_size" /><br> 
                                 @endif                </td>
                            <td>{{$vol->compagnie_aerienne}}</td>
                            <td>{{$vol->numero_de_vol}}</td>
                            <td>{{$vol->date_depart}}</td>
                            <td>{{$vol->date_arrivee}}</td>
                            <td>{{$vol->lieu_depart}}</td>
                            <td>{{$vol->lieu_arrivee}}</td>
                            <td>{{$vol->places_disponibles}}</td>
                            <td>{{$vol->prix}}</td>
                    

                            <td>
                                <a href="{{ route('voles.edit', $vol->id) }}" class="btn btn-primary">Éditer</a>
                            </td>
                            <td>  <form action="{{ route('voles.destroy', $vol->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utlisateuristrateur ?')">Supprimer</button>
                                </form>
                            </td>
                            <td>
                                    <a  class="btn btn-info"  href="{{route('voles.show', $vol->id)}}">Détails</a>
                            </td>







                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="mt-4">
                    {{$voles->links()}}
                </div>
            </div>
      

@endsection