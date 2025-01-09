   

@extends('layouts.app')
  
@section('title',' liste des reservation Hôtel')

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
    background-color: #ffff;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #fff;
}

th {
    background-color: #007bff;
    color: white;
    text-transform: uppercase;
}

td {
    background-color: #fff;
}

tr:hover td {
    background-color: #fff;
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

    <div class="container">
        <div class="btn-container">
            <a class="btn-ajouter" href="{{ url('hotelsreservation.index') }}">Réserver un Hôtel!</a> &nbsp;&nbsp;
            <a class="btn-ajouter" href="{{ url('volesreservation.index') }}">Réserver un Vol!</a> &nbsp;&nbsp;
            <a class="btn-ajouter" href="{{ url('voituresreservation.index') }}">Réserver une Voiture!</a> &nbsp;&nbsp;
        </div>
        
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
                <table class="table">
                    <thead>
                        <tr class="th_color">
                           
                            <th> Id</th>
                            <th>Hotel Id</th>
                            <th>Date arrivee</th>
                            <th>date depart</th>
                            <th>Nombre de places</th>
                            <th>date de reservation</th>
                            <th>statu payments</th>

                            <th>Suprimer</th>
                            <th>Detaill</th>
                            <th>payments</th>

                        </tr>
                    </thead>
                    
                        
                    <tbody>
                        @foreach($reservation as $res)
                    <tr>
                       
                        <td>{{$res->id}}</td>
                        
                        <td>{{$res->hotel_id }}</td>
                        <td>{{$res->date_arrivee}}</td>
                        <td>{{$res->date_depart}}</td>
                        <td>{{$res->nombre_de_places}}</td>
                        <td>{{$res->status}}</td>
                        <td>{{$res->created_at}}</td>

                    <td>     <form action={{route('hotelsreservation.suprimer', $res->id)}} method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet reservation hotel ?')">Supprimer</button>
                        </form>
                      
                    </td>
                    <td>
                            <a  class="btn btn-info"   href="{{url('hotelsreservation.detaill', $res->id)}}">Détails</a>
                    </td>

<td>
    @if($res->status == 'pending')
    <a href="{{ route('hotel.payment', $res->id) }}" class="btn btn-primary btn-md">Pay now</a>
    @endif

</td>


                    </tr>
                    @endforeach
                    
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">
            {{$reservation->links()}}
        </div>
    </div>
@endsection






                 
     