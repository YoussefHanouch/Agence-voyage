<!DOCTYPE html>
<html>
<head>
    <title>Certificat de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 80%;
            max-width: 800px;
            padding: 40px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }
        .header {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }
        .content {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #333;
        }
        .footer {
            margin-top: 20px;
            font-size: 16px;
            color: #777;
            text-align: center;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 200px;
        }
        .logo img {
            max-width: 100%;
            height: auto;
        }
        .details {
            text-align: left;
            margin: 20px 0;
        }
        .details p {
            margin: 5px 0;
            font-weight: bold;
        }
        .details p span {
            font-weight: normal;
        }
        @media (max-width: 600px) {
            .container {
                width: 90%;
            }
            .header {
                font-size: 24px;
            }
            .content {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Certificat de Paiement</div>
        <div class="logo">
            {{-- <img src="{{asset('/imgs/logo.png')}}"  class="lg">  --}}
        </div>
        <div class="content">
            <div class="details">
                <p><span>Numéro de paiement:</span> {{ $payment->id }}</p>
                <p><span>Nom du titulaire de la carte:</span> {{ $payment->card_holder_name }}</p>
                <p><span>Date de paiement:</span> {{ $payment->paid_at }}</p>
                <p><span>Montant payé:</span> {{ $payment->amount }} DH</p>
            </div>
        </div>
        <div class="footer">
            <p>Merci pour votre paiement !</p>
            <p>Hafsa Travel Agency - Votre partenaire de voyage.</p>
        </div>
    </div>
</body>
</html>
