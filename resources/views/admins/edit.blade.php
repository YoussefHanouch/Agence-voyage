@extends('layouts.app')

@section('title')

@section('contents')

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
</style>
<!-- resources/views/admin/edit.blade.php -->



<div class="container">
    <h1>Éditer l'administrateur</h1>
    <form action="{{ route('admin.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $admin->name }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $admin->prenom }}">
            @error('prenom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $admin->email }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="type">Type :</label>
            <select name="type" id="type" class="form-control">
                <option value="admin" {{ $admin->type == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="client" {{ $admin->type == 'client' ? 'selected' : '' }}>User</option>
            </select>
            @error('type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Autres champs à éditer selon vos besoins -->
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

@endsection


