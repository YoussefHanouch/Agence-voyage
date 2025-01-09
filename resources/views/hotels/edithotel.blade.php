@extends('layouts.app')
  
@section('title')

    <title>Modifier Hotel</title>
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
            background-color: #357ABD;
        }

        .text-danger {
            color: red;
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
           
    .lg{
    width: 60px;
    height: 60px;
    transform: rotate(15deg);
    mix-blend-mode: darken;
}
.bc{
    background: #62A1D9;
}
.img_size{
             width:80px;
        }
    </style>

    @section('contents')

    <div class="container">
        <h1>Modifier Hotel</h1>
       
        <form action="{{ url('/update_hotel', $hotel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom', $hotel->nom) }}" class="form-control">
                @error('nom')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ville">Ville :</label>
                <input type="text" name="ville" id="ville" value="{{ old('ville', $hotel->ville) }}" class="form-control">
                @error('ville')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="adresse">Adresse :</label>
                <input type="text" name="adresse" id="adresse" value="{{ old('adresse', $hotel->adresse) }}" class="form-control">
                @error('adresse')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="étoiles">Etoiles :</label>
                <input type="number" name="étoiles" id="étoiles" value="{{ old('étoiles', $hotel->étoiles) }}" class="form-control">
                @error('étoiles')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <td>
                                
                    @if(!empty($hotel->image))
                    <img src="{{asset($hotel->image)}}" alt="photo"  class="img_size" /> <br>
                      @else
                       <img src="{{asset('photo_annonce/no-image.jpg')}}" alt="no-image"  class="img_size" /><br> 
                     @endif
                           
          
                </td>
        </br>
        <div class="custom-file">
            <label for="image">Image :</label>

              <input type="file" class="custom-file-input"  alue="{{ old('image', $hotel->image) }}" id="image" name="image">
               <label class="custom-file-label" id="image" for="image">{{ __('Choisir une photo') }}</label>
         
          @error('image')
          <div class="text-danger">{{ $message }}</div>
          @enderror
      </div>
               
            </div>

            <div class="form-group">
                <label for="prix_par_nuit">Prix par nuit :</label>
                <input type="number" name="prix_par_nuit" id="prix_par_nuit" value="{{ old('prix_par_nuit', $hotel->prix_par_nuit) }}" class="form-control">
                @error('prix_par_nuit')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="{{ url('/hotels') }}" class="btn btn-secondary">Annuler</a>
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
