@extends('layouts.app')
  
@section('title')
  
@section('contents')
    <style>
       

        .table-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #62A1D9;
            color: #fff;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f2f2f2;
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
    </style>
</head>
<body>
    <div class="">
        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<body>
    <h1>Historique des Paiements</h1>
    <table>
        <thead>
            <tr>
                <th>ID de Paiement</th>
                <th>Réservation Type</th>
                <th>ID Réservation</th>
                <th>Montant</th>
                <th>Date de Paiement</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->reservation_type }}</td>
                    <td>
                        @php
                            $reservationIds = json_decode($payment->reservation_id, true);
                            if (is_array($reservationIds)) {
                                // echo '<ul>';
                                foreach ($reservationIds as $id) {
                                    echo '' . htmlspecialchars($id) . '';
                                }
                                // echo '</ul>';
                            } else {
                                echo 'Données non valides';
                            }
                        @endphp
                    </td>
                    <td>{{ $payment->amount }} DH</td>
                    <td>{{ $payment->paid_at }}</td>
                </tr>
            @endforeach
        </tbody>
     
    </table>
    <div class="mt-4">
        {{$payments->links()}}
    </div>
@endsection