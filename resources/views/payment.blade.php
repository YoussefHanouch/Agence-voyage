<!-- resources/views/payments/create.blade.php -->
@extends('layouts.app')

<style>
    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
    }

    button[type="submit"] {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #62A1D9;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #62A1D9; /* couleur vert foncé */
    }
    .btn-secondary {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #6c757d;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    .text-danger {
        color: red;
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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h2>Complete Your Payment</h2>
    <form action="{{ route('payment.storeMultiple') }}" method="POST">
        @csrf   
        <input type="hidden" name="reservation_ids[]" value="{{ json_encode([$reservation->id]) }}">
        <input type="hidden" name="reservation_type" value="{{ $type }}">
        @error('reservation_type')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    @error('reservation_ids')
        <span class="text-danger">{{ $message }}</span>
    @enderror
        <div class="form-group">
            <label for="card_number">Numéro de carte</label>
            <input type="text" class="form-control" id="card_number" name="card_number" required>
            @error('card_number')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        
        <div class="form-group">
            <label for="card_holder_name">Nom du titulaire de la carte</label>
            <input type="text" class="form-control" id="card_holder_name" name="card_holder_name" required>
            @error('card_holder_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="card_expiry">Date d'expiration</label>
            <input type="text" class="form-control" id="card_expiry" name="card_expiry" placeholder="MM/YY" required>
            @error('card_expiry')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="card_cvc">CVC</label>
            <input type="text" class="form-control" id="card_cvc" name="card_cvc" required>
            @error('card_cvc')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="hidden" class="form-control" id="amount" name="amount" value="{{ $totalAmount }}" >

            <input type="text" class="form-control" id="amount" name="ss" value="{{ $totalAmount }} DH" readonly>
            @error('amount')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
</div>
@endsection
