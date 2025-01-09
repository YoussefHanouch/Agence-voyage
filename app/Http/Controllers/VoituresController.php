<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Voiture;

class VoituresController extends Controller
{
    public function index(){
        $voiture = Voiture::simplePaginate(5);
        return view('voitures.liste', compact('voiture'));
    }

    public function detaill_voiture($id){
        $voiture = Voiture::findOrFail($id);
        return view('voitures.detaill', compact('voiture'));
    }

    public function ajouter(){
        return view('voitures.form');
    }

    public function add_voiture(Request $req){
        $req->validate([
            'marque' => 'required|string|max:255',
            'modèle' => 'required|string|max:255',
            'année' => 'required|numeric',
            'places_disponibles' => 'required|numeric',
            'prix_par_jour' => 'required|numeric',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image=$req->image;
        $imagename= $image->store("images");

        Voiture::create([
            'marque' => $req->input('marque'),
            'modèle' => $req->input('modèle'),
            'année' => $req->input('année'),
            'places_disponibles' => $req->input('places_disponibles'),
            'prix_par_jour' => $req->input('prix_par_jour'),
            'image' => $imagename,
        ]);

        return redirect()->route('voitures.index')->with('success', 'Voiture ajoutée avec succès!');
    }

    public function edite_voiture($id){
        $voiture = Voiture::findOrFail($id);
        return view('voitures.editvoiture', compact('voiture'));
    }

    public function update_voiture(Request $req, $id)
    {
        // Validate request data if necessary
        $data = $req->all();
    
        // Find the voiture by id
        $voiture = Voiture::findOrFail($id);
    
        // Check if a new image is uploaded
        if ($req->hasFile('image')) {
            $file = $req->file('image');
            $imagePath = $file->store("images");
            // Update the image path in the data array
            $data['image'] = $imagePath;
        } else {
            // Use the existing image path if no new image is uploaded
            $data['image'] = $voiture->image;
        }
    
        // Update the voiture with the validated data
        $voiture->update($data);
    
        // Redirect with a success message
        return redirect()->route('voitures.index')->with('success', 'Voiture mise à jour avec succès!');
    }
    

    public function suprimer($id){
        $voiture = Voiture::findOrFail($id);
        $voiture->delete();

        return redirect()->route('voitures.index')->with('success', 'Voiture supprimée avec succès!');
    }
}
