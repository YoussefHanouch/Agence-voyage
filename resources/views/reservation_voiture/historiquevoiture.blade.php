<!-- historique.blade.php -->

@extends('layouts.app')

@section('title', 'Historique des Réservations')
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

        @if ($reservations->isEmpty())
            <p>Aucune réservation trouvée.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>nom complet utlisateur</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->id }}</td>
                            <td>{{ $reservation->user->name }}&nbsp; {{ $reservation->user->name }}</td>
                            <td>{{ $reservation->date_debut }}</td>
                            <td>{{ $reservation->date_fin }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $reservations->links() }} <!-- Pagination -->
        @endif
    </div>
@endsection
