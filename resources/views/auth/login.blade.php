
<style>
    body {
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f0f0f0;
}

.login-container {
    width: 100%;
    display: flex;
    justify-content: center;
}

.login-box {
    background-color: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.login-box h2 {
    text-align: center;
    margin-top: 2px;
    color: #333;
}

.textbox {
    position: relative;
    margin-bottom: 20px;
}

.textbox input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
}

.btn {
    width: 100%;
    padding: 10px;
    margin-bottom: -24px;
    border: none;
    border-radius: 5px;
    background-color: #3b82f6;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #3b82f6;
}

</style>
{{-- @extends('layouts.dash')
@section('content') --}}
<div class="login-container">
    <div class="login-box">
        <h2 style="color:#3b82f6">Connectez-vous</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="textbox">
                <input type="email" name="email" id="email" placeholder="Adresse e-mail" required autofocus>
                @error('email')
                    <p  style="color: red">{{ $message }}</p>
                @enderror
            </div>

            <div class="textbox">
                <input type="password" name="password" id="password" placeholder="Mot de passe" required autocomplete="current-password">
                @error('password')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a style="color: #3b82f6;" class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                       Mot de passe oublié ? 
                    </a>
                @endif

                <button type="submit" style="margin-top: 20px" class="btn ml-4">
                   Se connecter
                </button>

            </div>
            
            <br>
            <p style="text-align: center; margin-bottom: -30px;">Pas encore de compte ? <a  style ="color:#3b82f6" href="{{ route('register') }}">Inscrivez-vous</a></p>
{{--             
            @if ($errors->any())
                <div class="mt-4">
                    @foreach ($errors->all() as $error)
                        <p class="text-red-500 text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif --}}

        </form>
    </div>
</div>
