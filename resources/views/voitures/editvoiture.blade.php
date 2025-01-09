@extends('layouts.app')
  
@section('title')

    <title>Modifier Voiture</title>
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
        .img_size{
             width:80px;
        }
    </style>
@section('contents')

    <div class="container">
        <h1>Modifier Voiture</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('/update_voiture', $voiture->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="marque">Marque :</label>
                <input type="text" name="marque" id="marque" value="{{ old('marque', $voiture->marque) }}" class="form-control">
                @error('marque')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="modèle">Modèle :</label>
                <input type="text" name="modèle" id="modèle" value="{{ old('modèle', $voiture->modèle) }}" class="form-control">
                @error('modèle')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="année">Année :</label>
                <input type="number" name="année" id="année" value="{{ old('année', $voiture->année) }}" class="form-control">
                @error('année')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="places_disponibles">Places disponibles :</label>
                <input type="number" name="places_disponibles" id="places_disponibles" value="{{ old('places_disponibles', $voiture->places_disponibles) }}" class="form-control">
                @error('places_disponibles')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="prix_par_jour">Prix par jour :</label>
                <input type="number" name="prix_par_jour" id="prix_par_jour" value="{{ old('prix_par_jour', $voiture->prix_par_jour) }}" class="form-control">
                @error('prix_par_jour')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <td>
                                
                    @if(!empty($voiture->image))
                    <img src="{{asset($voiture->image)}}" alt="photo"  class="img_size" /> <br>
                      @else
                       <img src="{{asset('photo_annonce/no-image.jpg')}}" alt="no-image"  class="img_size" /><br> 
                     @endif
                           
          
                </td>
        </br>
        <div class="custom-file">
            <label for="image">Image :</label>
          
              <input type="file" class="custom-file-input"  id="image" name="image">
               <label class="custom-file-label" id="image" for="image">{{ __('Choisir une photo') }}</label>
         
          @error('image')
          <div class="text-danger">{{ $message }}</div>
          @enderror
      </div>
      
            <button style="margin-top:30px;" type="submit" class="btn btn-primary">Modifier</button>
            <a style="margin-top:30px;" href="{{ url('/voitures') }}" class="btn btn-secondary">Annuler</a>
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