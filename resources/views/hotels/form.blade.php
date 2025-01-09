@extends('layouts.app')
  
@section('title')

<style>
    .lg{
    width: 60px;
    height: 60px;
    transform: rotate(15deg);
    mix-blend-mode: darken;
}
.bc{
    background: #62A1D9;
}
    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
    }

    button[type="submit"]  {
        padding: 10px 20px;
        margin-top:19px;
        border: none;
        border-radius: 5px;
        background-color: #62A1D9;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    a{
        padding: 10px 20px;
        margin-top:19px;
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
    .img_size{
             width:30px;
        }
    </style>

@section('contents')

<div class="container">
    <h1>Créer un nouveau hotel</h1>
    <form action="{{url('/add_hotel')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="name" class="form-control" required>
            @error('nom')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="ville">Ville :</label>
            <input type="text" name="ville" id="ville" class="form-control" required>
            @error('ville')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" class="form-control" required>
            @error('adresse')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="étoiles">Etoiles :</label>
            <input type="number" name="étoiles" id="étoiles" class="form-control" required>
            @error('étoiles')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="prix_par_nuit">Prix par nuit :</label>
            <input type="number" name="prix_par_nuit" id="prix_par_nuit" class="form-control" required>
            @error('prix_par_nuit')
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
       

        <button type="submit" class="btn btn-primary">Créer</button> 
        <a  href="{{url('/hotels')}}" class="btn btn-secondary">Annuler</a>
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