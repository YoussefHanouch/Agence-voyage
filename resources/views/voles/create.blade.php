@extends('layouts.app')
  
@section('title')


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

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('contents')
<div class="container">
    <h1>Créer un nouveau vole</h1>
    <form action="{{route('voles.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="voiture">Compagnie Aérienne :</label>
            <input type="text" name="compagnie_aerienne" id="voiture" class="form-control" required>
            @error('compagnie_aerienne')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="numero_de_vol">Numéro de vol :</label>
            <input type="text" name="numero_de_vol" id="numero_de_vol" class="form-control" required>
            @error('numero_de_vol')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="date_depart">Date Départ :</label>
            <input type="date" name="date_depart" id="date_depart" class="form-control" required>
            @error('date_depart')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="date_arrivee">Date Arrivée :</label>
            <input type="date" name="date_arrivee" id="date_arrivee" class="form-control" required>
            @error('date_arrivee')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="lieu_depart">Lieu Départ :</label>
            <input type="text" name="lieu_depart" id="lieu_depart" class="form-control" required>
            @error('lieu_depart')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="lieu_arrivee">Lieu Arrivée :</label>
            <input type="text" name="lieu_arrivee" id="lieu_arrivee" class="form-control" required>
            @error('lieu_arrivee')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="places_disponibles">Places Disponibles :</label>
            <input type="number" name="places_disponibles" id="places_disponibles" class="form-control" required>
            @error('places_disponibles')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="prix">Prix :</label>
            <input type="number" name="prix" id="prix" class="form-control" required>
            @error('prix')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
                
                    </br>
                    <div class="custom-file">
                        <label for="image">Image :</label>
                      
                          <input type="file" class="custom-file-input"  id="image" name="image">
                           <label class="custom-file-label" id="image" for="image">{{ __('Choisir une photo') }}</label>
                     
                      @error('image')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
           
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="{{url('/vole.index')}}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the file input and label elements
        const fileInput = document.getElementById('image');
        const fileInputLabel = fileInput.nextElementSibling;

        // Add an event listener for the change event
        fileInput.addEventListener('change', function(event) {
            // Get the name of the selected file
            const fileName = event.target.files[0].name;
            // Update the label with the file name
            fileInputLabel.textContent = fileName;
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
@endsection
