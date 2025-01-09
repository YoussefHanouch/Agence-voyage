@extends('layouts.app')
  
@section('title')

    <title>Document</title>
    <style>
    .form-group {
        margin-bottom: 20px;
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
    label {
        font-weight: bold;
    }
    .img_size{
             width:80px;
        }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
    }

    button[type="submit"]  {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #62A1D9;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    a{
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
    .text-danger {
        color: red;
    }
</style>

@section('contents')

<div class="container">
    <h1>Créer un nouveau voiture</h1>
    <form action="{{url('/add_voiture')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="marque">Marque :</label>
            <input type="text" name="marque" id="marque" class="form-control" required>
            @error('marque')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="modèle">Modèle :</label>
            <input type="text" name="modèle" id="modèle" class="form-control" required>
            @error('modèle')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="année">Année :</label>
            <input type="number" name="année" id="année" class="form-control" required>
            @error('année')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="places_disponibles">Places disponibles :</label>
            <input type="number" name="places_disponibles" id="places_disponibles" class="form-control" required>
            @error('places_disponibles')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="prix_par_jour">Prix par jour :</label>
            <input type="number" name="prix_par_jour" id="prix_par_jour" class="form-control" required>
            @error('prix_par_jour')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="custom-file">
            <label for="image">Image :</label>
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
              <input type="file" class="custom-file-input"  id="image" name="image">
               <label class="custom-file-label" id="image" for="image">{{ __('Choisir une photo') }}</label>
         
      </div>

        <button style="margin-top:30px;" type="submit" class="btn btn-primary">Créer</button>
        <a  style="margin-top:30px;" href="{{url('/voitures')}}" class="btn btn-secondary">Annuler</a>
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