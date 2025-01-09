

@extends('layouts.app')
  
@section('title',' liste des reservation vols')

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
        
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
                <table class="table">
                    @csrf
                    <thead>
                        <tr class="th_color">
                           
                            <th> Id</th>
                            <th>Vole Id</th>
                            <th>Nombre de places</th>
                          
                            <th>date de reservation</th>
                           
                            <th>Suprimer</th>
                            <th>Detaill</th>
                            <th>payments</th>

                        </tr>
                    </thead>
                        
                    <tbody>
                        @foreach($reservation as $res)
                        <tr>
                           
                            <td>{{$res->id}}</td>
                            
                            <td>{{$res->vol_id}}</td>
                            <td>{{$res->nombre_de_places}}</td>
                           
                            <td>{{$res->created_at}}</td>
                           


                            <td> <form action="{{ route('volesreservation.suprimer', $res->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette vole ?')">Supprimer</button>
                            </form>
                        </td>
                        <td>
                                <a  class="btn btn-info"  h href="{{url('volesreservation.detaill', $res->id)}}" >Détails</a>
                        </td>





                        <td>
                            @if($res->status == 'pending')
                            <a href="{{ route('vols.payment', $res->id) }}" class="btn btn-primary btn-md">Pay now</a>
                            @else($payment->status == 'paid')
                            <span class="btn btn-success btn-md">Deja pay</span>
                        
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























































