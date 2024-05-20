<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Version;


class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $versions=Version::all();
        return view('version',compact('versions'));
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
    public function edit(Version $version)
    {
        return view('AjoutVersion', compact('version'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Version $version)
    {
        $version->update($request->all());

        $version->save();
        return redirect()->route('versions.index')->with('success', 'version a été modifié avec succée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $version = Version::findOrFail($id);

        // Supprimer toutes les voitures associées à cette version
        $version->voitures()->delete();
    
        // Supprimer la version
        $version->delete();
    
        return redirect()->route('versions.index')->with('success', 'Version et voitures associées supprimées avec succès');
    
    }
    public function getVersionByModele($modele_id)
    {
        try {
            $versions = Version::where('modele_id', $modele_id)->get();
            return response()->json($versions);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
  
    
}
