<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelsController extends Controller
{
    public function index(){
        $hotels = Hotel::simplePaginate(4);
        return view('hotels.liste', compact('hotels'));
    }

    public function detaill_hotel($id){
        $hotel = Hotel::findOrFail($id);
        return view('hotels.detaill', compact('hotel'));
    }

    public function ajouter(){
        return view('hotels.form');
    }

    public function add_hotel(Request $req){
        $req->validate([
            'nom' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'étoiles' => 'required|numeric|max:11',
            'prix_par_nuit' => 'required|numeric',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
     
        $image=$req->image;
        $imagename= $image->store("images");



        Hotel::create([
            'nom' => $req->input('nom'),
            'ville' => $req->input('ville'),
            'adresse' => $req->input('adresse'),
            'étoiles' => $req->input('étoiles'),
            'prix_par_nuit' => $req->input('prix_par_nuit'),
            'image' => $imagename,
        ]);

        return redirect()->route('hotels.index')->with('success', 'Hôtel ajouté avec succès!');
    }

    public function edite_hotel($id){
        $hotel = Hotel::findOrFail($id);
        return view('hotels.edithotel', compact('hotel'));
    }

    public function update_hotel(Request $req, $id)
    {
        // Validate request data
        $data = $req->all();
        // Find the hotel by id
        $hotel = Hotel::findOrFail($id);
    
        // Check if a new image is uploaded
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imagePath = $image->store('images');
            $data['image'] = $imagePath;
        } else {
            // Use the existing image path if no new image is uploaded
            $data['image'] = $hotel->image;
        }
    
        // Update the hotel with the validated data
        $hotel->update($data);
    
        // Redirect with a success message
        return redirect()->route('hotels.index')->with('success', 'Hôtel mis à jour avec succès!');
    }
    


    public function suprimer($id){
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect()->route('hotels.index')->with('success', 'Hôtel supprimé avec succès!');
    }
}
