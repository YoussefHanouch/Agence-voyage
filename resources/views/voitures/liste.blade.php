@extends('layouts.app')
  
@section('title', 'list des Voitures ')

    <title></title>
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
    margin-bottom: 20px;
    background-color: #f8f8f8;
}

th, td {
    padding: 9px;
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

.btndetail:hover {
    background-color: darkblue;
}
.actions a, .actions button {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 5px;
            background-color: #62A1D9;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .actions button {
            background-color: #dc3545; /* couleur rouge */
        }

        .actions a:hover, .actions button:hover {
            background-color: #62A1D9; /* couleur vert foncé */
        }
        .img_size{
             width:80px;
        }
    </style>
@section('contents')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
              
               
             <div class="">
                    <table class="table">
                    @csrf
                    <thead>
                        <tr class="th_color">
                            <th>image</th>
                            <th>Marque</th>
                            <th>Modèle</th>
                            <th>Année</th>
                            <th>Places Disponibles</th>
                            <th>Prix par Jour</th>
                            <th>Modification</th>
                            <th>Suppression</th>
                            <th>Détails</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($voiture as $voit)
                        <tr>
                          <td>
                                                           
                            <img src="{{ asset($voit->image ? $voit->image : 'imgs/1.png') }}" alt="{{ $voit->image ? 'photo' : 'no-image' }}" class="img_size" /><br>
 
                                    </td>
                                    <td>{{$voit->marque}}</td>
                                    <td>{{$voit->modèle}}</td>
                                    <td>{{$voit->année}}</td>
                                    <td>{{$voit->places_disponibles}}</td>
                                    <td>{{$voit->prix_par_jour}}</td>

                            <td>
                                <a href="{{ route('voitures.edit', $voit->id) }}" class="btn btn-primary">Éditer</a>
                            </td>
                            <td>  <form action="{{ route('voitures.destory', $voit->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utlisateuristrateur ?')">Supprimer</button>
                                </form>
                            </td>
                            <td>
                                    <a  class="btn btn-info"  href="{{url('detaill_voiture', $voit->id)}}">Détails</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{$voiture->links()}}
                </div>
    </div>
@endsection
