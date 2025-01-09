<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class Userlisecontroller extends Controller
{
   
    public function index()
    {
        $utilisateurs = User::where('type', 'client')->simplePaginate(4);
        return view('utilisateur.index', ['utilisateurs' => $utilisateurs]);
    }

    public function edit($id)
    {
        $utilisateur = User::findOrFail($id);
        return view('utilisateur.edit', ['utilisateur' => $utilisateur]);
    }
    
    public function create()
    {
        return view('utilisateur.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|max:255',
            'type' => 'required|in:user,admin',
            // Ajoutez d'autres règles de validation selon vos besoins
        ]);
        $utilisateur = new User();
        $utilisateur->name = $request->input('name');
        $utilisateur->prenom = $request->input('prenom');
        $utilisateur->email = $request->input('email');
        $utilisateur->type = $request->input('type'); // Par défaut, nouvel utilisateur est de type 'user'
        $utilisateur->password = bcrypt($request->input('password'));

        // Autres champs à mettre à jour selon les besoins

        $utilisateur->save();

        return redirect()->route('utilisateur.index')->with('success', 'Utilisateur créé avec succès !');
    }

    public function update(Request $request, $id)
    {  $request->validate([
        'name' => 'required',
        'prenom' => 'required',
        'email' => 'required',
        'type' => 'required|in:user,admin',
        // Ajoutez d'autres règles de validation selon vos besoins
    ]);
        $utilisateur = User::findOrFail($id);
        $utilisateur->name = $request->input('name');
        $utilisateur->prenom = $request->input('prenom');
        $utilisateur->email = $request->input('email');
        $utilisateur->type = $request->input('type');

        // Autres champs à mettre à jour selon les besoins

        $utilisateur->save();

        return redirect()->route('utilisateur.index')->with('success', 'utilisateur mis à jour avec succès !');
    }

    public function destroy($id)
    {
        $utilisateur = User::findOrFail($id);
        $utilisateur->delete();

        return redirect()->route('utilisateur.index')->with('success', 'utilisateur supprimé avec succès !');
    }
}
