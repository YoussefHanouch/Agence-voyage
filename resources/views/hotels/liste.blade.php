@extends('layouts.app')
  
@section('title',' liste  des Hotels')

    <style>
  

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
    color:white;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 10px;
    background-color: #f8f8f8;
}

th, td {
    padding: 12px;
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


   
.lg{
    width: 60px;
    height: 60px;
    transform: rotate(15deg);
    mix-blend-mode: darken;
}
.bc{
    background: #62A1D9;
}

.img_size{
    width:90px;
}


    </style>
@section('contents')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container">
  
               
                <table class="table">
                    @csrf
                    <thead>
                        <tr class="th_color">
                            <th>image</th>
                            <th>nom</th>
                            <th>ville</th>
                            <th>adresse</th>
                            <th>étoiles</th>
                            <th>prix_par_nuit</th>
    
                            <th>Supprimer</th>
                            <th>Modifier</th>
                            <th>Détails</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hotels as $hot)
                        <tr>
                            <td>
                                
                                @if(!empty($hot->image))
                                <img src="{{asset($hot->image)}}" alt="photo"  class="img_size" /> <br>
                                  @else
                                   <img src="{{asset('photo_annonce/no-image.jpg')}}" alt="no-image"  class="img_size" /><br> 
                                 @endif
                                       
                      
                            </td>
                            <td>{{$hot->nom}}</td>
                            <td>{{$hot->ville}}</td>
                            <td>{{$hot->adresse}}</td>
                            <td>{{$hot->étoiles}}</td>
                            <td>{{$hot->prix_par_nuit}}</td>
                       
                        
                   


                        <td>
                            <a href="{{ route('hotels.edit', $hot->id) }}" class="btn btn-primary">Éditer</a>
                        </td>
                        <td>  <form action="{{ route('hotels.destroy', $hot->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utlisateuristrateur ?')">Supprimer</button>
                            </form>
                        </td>
                        <td>
                                <a  class="btn btn-info"  href="{{route('hotels.show', $hot->id)}}">Détails</a>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">
            {{$hotels->links()}}
        </div>
    </div>
@endsection
