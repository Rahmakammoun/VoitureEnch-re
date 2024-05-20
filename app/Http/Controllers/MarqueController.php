<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\marque;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marques = Marque::all();
        return view('marque', compact('marques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marque $marque)
    {
        return view('AjoutMarque', compact('marque'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marque $marque)
    {
        $marque->update($request->all());

        $marque->save();
        return redirect()->route('marques.index')->with('success', 'marque a été modifié avec succée');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marque $marque)
    {
        $marque->load('modeles.versions.voitures');

        $marque->modeles->each(function ($modele) {
            if ($modele->versions) {
                $modele->versions->each(function ($version) {
                    if ($version->voitures) {
                        $version->voitures->each(function ($voiture) {
                            $voiture->delete();
                        });
                    }
                    $version->delete();
                });
            }
            $modele->delete();
        });

        $marque->delete();

        return redirect()->route('marques.index')->with('success', 'marques,modèles,versions et voitures associées supprimées avec succès');
    }
}
