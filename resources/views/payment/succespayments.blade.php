@extends('layouts.app')
<style>
    .lg {
        width: 60px;
        height: 60px;
        transform: rotate(15deg);
        mix-blend-mode: darken;
    }
    .bc {
        background: #62A1D9;
    }
</style>
@section('contents')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div style="background-color: #62A1D9" class="card-header text-white">Confirmation du Paiement</div>
                <div class="card-body">
                    <h3 class="text-center mb-4">Merci pour votre Paiement</h3>
                    <p class="text-center">Votre paiement de <strong>{{ $amount }} DH</strong> a été traité avec succès.</p>
                    <div class="form-group text-center mt-4">
                        <a href="{{ route('dashboard.statistics') }}" class="btn btn-primary btn-lg">Retour à l'Accueil</a>
                        <a href="{{ route('payment.certificate', ['payment' => $paymentId]) }}" class="btn btn-secondary btn-lg">Télécharger le Certificat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
