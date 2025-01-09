<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vol;

class VolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voles = Vol::simplePaginate(4);
        return view('voles.index', compact('voles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('voles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'compagnie_aerienne' => 'required|string|max:255',
            'numero_de_vol' => 'required|string|max:255',
            'date_depart' => 'required|date',
            'date_arrivee' => 'required|date',
            'lieu_depart' => 'required|string|max:255',
            'lieu_arrivee' => 'required|string|max:255',
            'places_disponibles' => 'required|numeric',
            'prix' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

       
        $image=$req->image;
        $imagename= $image->store("images");



        Vol::create([
            'compagnie_aerienne' => $req->input('compagnie_aerienne'),
            'numero_de_vol' => $req->input('numero_de_vol'),
            'date_depart' => $req->input('date_depart'),
            'date_arrivee' => $req->input('date_arrivee'),
            'lieu_depart' => $req->input('lieu_depart'),
            'lieu_arrivee' => $req->input('lieu_arrivee'),
            'places_disponibles' => $req->input('places_disponibles'),
            'prix' => $req->input('prix'),
            'image' => $imagename,
        ]);


        return redirect()->route('voles.index')->with('message','Vole A Ajouter Avec Succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vole = Vol::findOrFail($id);
        return view('voles.show', compact('vole'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vole = Vol::findOrFail($id);
        return view('voles.edit', compact('vole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        // Validate request data if necessary
        $data = $req->all();

    
        // Find the vol by id
        $vole = Vol::findOrFail($id);
    
        // Check if a new image is uploaded
        if ($req->hasFile('image')) {
            $file = $req->file('image');
            $imagePath = $file->store("images");
            // Update the image path in the data array
            $data['image'] = $imagePath;
        } else {
            // Use the existing image path if no new image is uploaded
            $data['image'] = $vole->image;
        }
    
        // Update the vol with the validated data
        $vole->update($data);
    
        // Redirect with a success message
        return redirect()->route('voles.index')->with('message', 'Vole modifié avec succès');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $vole = Vol::findOrFail($id);
         $vole->delete();

        return redirect()->back()->with('message','Vole A Supprimer Avec Succes');
    }
}
