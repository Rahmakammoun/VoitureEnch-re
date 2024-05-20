<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modele;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modeles=Modele::all();
        return view('modele', compact('modeles'));
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
    public function edit(Modele $modele)
    {
        return view('AjoutModele', compact('modele'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modele $modele)
    {
        $modele->update($request->all());

        $modele->save();
        return redirect()->route('modeles.index')->with('success', 'modèle a été modifié avec succé');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $modele = Modele::findOrFail($id);

    // Supprimer toutes les versions et voitures associées à ce modèle
    foreach ($modele->versions as $version) {
        $version->voitures()->delete();
        $version->delete();
    }

    // Supprimer le modèle
    $modele->delete();

    return redirect()->route('modeles.index')->with('success', 'Modèles, versions et voitures associées supprimées avec succès');
    }
    

   /* public function getModeleByMarque($marque_id)
    {
        $modeles = Modele::with('marque')->where('marque_id', $marque_id)->get();
        dd($modeles); // Vérifiez les données ici
        return response()->json($modeles);
    }*/
    /*public function getModeleByMarque($marque_id)
{
    $modeles = Modele::where('marque_id', $marque_id)->get();
    return response()->json($modeles);
}*/
public function getModeleByMarque($marque_id)
{
    try {
        $query = Modele::where('marque_id', $marque_id);
        \Log::info($query->toSql()); // Ajoutez cette ligne pour afficher la requête SQL dans les logs
        $modeles = $query->get();
        return response()->json($modeles);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    
    
}
