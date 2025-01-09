<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('type', 'admin')->simplePaginate(3);
        return view('admins.index', ['admins' => $admins]);
    }

    public function create()
    {
        return view('admins.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|max:255',
            'type' => 'required|in:admin,user', // Vérifie si le type est 'admin' ou 'user'
            // Ajoutez d'autres règles de validation selon vos besoins
        ]);
    
        // Crée un nouvel administrateur
        $admin = new User();
        $admin->name = $request->input('name');
        $admin->prenom = $request->input('prenom');
        $admin->email = $request->input('email');
        $admin->type = $request->input('type'); // Par défaut, nouvel admin est de type 'user'
        $admin->password = bcrypt($request->input('password'));
    
        // Autres champs à mettre à jour selon les besoins
    
        // Enregistre l'administrateur
        $admin->save();
    
        // Redirige avec un message de succès
        return redirect()->route('admin.index')->with('success', 'Admin créé avec succès !');
    }
    
    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('admins.edit', ['admin' => $admin]);
    }

    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        $request->validate([
            'name' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'type' => 'required', // Vérifie si le type est 'admin' ou 'user'
            // Vous pouvez ajouter d'autres règles de validation selon vos besoins
        ]);
    
        // Récupération de l'admin à mettre à jour
        $admin = User::findOrFail($id);
        $admin->name = $request->input('name');
        $admin->prenom = $request->input('prenom');
        $admin->email = $request->input('email');
        $admin->type = $request->input('type');
        // Vous pouvez mettre à jour d'autres champs selon vos besoins
    
        // Sauvegarde des modifications
        $admin->save();
    
        // Redirection vers la liste des admins avec un message de succès
        return redirect()->route('admin.index')->with('success', 'Admin mis à jour avec succès !');
    }
    

 
    public function destroy($userId)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to perform this action.');
        }
    
        // Attempt to find the user by ID
        $user = User::find($userId);
    
        // If the user is not found, redirect to the login page
        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found. Please log in.');
        }
    
        // Check if the user has related records in the demande_cartes table and delete them
       
    
        $user->delete();
    
        return redirect()->route('admin.index')->with('success', 'Admin supprimé avec succès !');
    }
}
