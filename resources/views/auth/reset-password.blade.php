
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
       
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<div class="login-container">
    <div class="login-box">
 
        <h2 style="color:#3b82f6">Réinitialisation de mot de passe</h2>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="textbox">
                <input type="email" name="email" id="email" placeholder="Adresse e-mail" value="{{ $request->email ?? old('email') }}" required autofocus autocomplete="username" class="block mt-1 w-full">
            </div>
            @error('email')
            <p  style="color: red">{{ $message }}</p>
            @enderror

            <!-- Password -->
            <div class="textbox mt-4">
                <input type="password" name="password" id="password" placeholder="Mot de passe" required autocomplete="new-password" class="block mt-1 w-full">
            </div>

            <!-- Confirm Password -->
            @error('password')
            <p  style="color: red">{{ $message }}</p>
            @enderror
            <div class="textbox mt-4">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmer le mot de passe" required autocomplete="new-password" class="block mt-1 w-full">
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="btn">
                    Réinitialiser le mot de passe
                </button>
            </div>
          
        </form>
    </div>
</div>

