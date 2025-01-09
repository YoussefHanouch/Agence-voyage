
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

.container {
    width: 100%;
    display: flex;
    justify-content: center;
}

.signup-container {
    width: 100%;
    max-width: 400px;
}

.signup-box {
    background-color: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.signup-box h2 {
    text-align: center;
    margin-top: 5px;
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
.signup-link {
    color: #3b82f6;
}


</style>
<div class="container">
    <div class="signup-container">
        <div class="signup-box">
            <h2 style="color:#3b82f6">Inscription</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
            
                <div class="textbox">
                    <input type="text" placeholder="Nom" name="name" value="{{ old('name') }}" required>
                </div>
                @error('name')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

                <div class="textbox">
                    <input type="text" placeholder="Prénom" name="prenom" value="{{ old('prenom') }}" required>
                </div>
                @error('prenom')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

                <div class="textbox">
                    <input type="email" placeholder="Adresse email" name="email" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

                <div class="textbox">
                    <input type="password" placeholder="Mot de passe" name="password" required>
                </div>
                @error('password')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

                <div class="textbox">
                    <input type="password" placeholder="Confirmer le mot de passe" name="password_confirmation" required>
                </div>
                @error('password_confirmation')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

                <input class="btn" type="submit" value="S'inscrire">
            </form>
            
            <p style="text-align: center; margin-top: 20px;">Déjà un compte ? <a class="signup-link" href="{{ route('login') }}">Connectez-vous</a></p>
        </div>
    </div>
</div>

