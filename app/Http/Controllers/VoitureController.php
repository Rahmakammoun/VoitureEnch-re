<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voiture;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Version;
use App\Models\Enchere;
use App\Models\User;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Session;




class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*public function index()
    {
        $voitures = Voiture::all(); // Récupérez toutes les voitures

        return view('shop', ['voitures' => $voitures]); // Passez les voitures à la vue
    }*/
    public function index()
    {
        //$voitures = Voiture::all();
        //dd($voitures->all());
        $voitures = Voiture::whereHas('enchere', function ($query) {
            $query->whereRaw('encheres.created_at + INTERVAL encheres.temps_restant HOUR >= NOW()')
                    ->orWhereRaw('encheres.created_at + INTERVAL encheres.temps_restant HOUR >= NOW() - INTERVAL 1 HOUR');
        })->get();
    
        $voitures = $voitures->filter(function ($voiture) {
            return $voiture->tempsRestantEnchere() !== "Enchère terminée";
        });
    
        return view('shop', compact('voitures'));
    }
    

    

    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
   /* public function store(Request $request)
    {
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'idMarque' => 'required',
            'idModel' => 'required',
            'idVersion' => 'required',
        ]);
        
    
        $nb_jours = intval($request->nb_jours) * 24;
        $nb_heures = intval($request->nb_heures);
        $temps_restant = $nb_jours + $nb_heures;
    
        $image = $request->file('image');
        $reImage = time() . '.' . $image->getClientOriginalExtension();
        $dest = public_path('/img/cars/');
        $image->move($dest, $reImage);
        
        $voiture = new Voiture();
        $voiture->matricule = $request->matricule;
        $voiture->idMarque = $request->idMarque;
        $voiture->idModel = $request->idModel;
        $voiture->idVersion = $request->idVersion;
        $voiture->annee = $request->annee;
        $voiture->prix_initial = $request->prix;
        $voiture->description = $request->description;
        $voiture->status = 'disponible';
        $voiture->proprietaire_id = $request->user_id;
        $voiture->image = $reImage;
    
        $voiture->save();
    
        $enchere = new Enchere();
        $enchere->voiture_id = $voiture->matricule;
        $enchere->utilisateur_id = null;
        $enchere->prix_enchere = $request->prix;
        $enchere->temps_restant = $temps_restant;
    
        $enchere->save();
    
        return redirect()->back()->with('success', 'Voiture ajoutée avec succès.');
    }*/










   /* public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'idMarque' => 'required',
        'idModel' => 'required',
        'idVersion' => 'required',
    ]);

    $nb_jours = intval($request->nb_jours) * 24;
    $nb_heures = intval($request->nb_heures);
    $temps_restant = $nb_jours + $nb_heures;

    $image = $request->file('image');
    $reImage = time() . '.' . $image->getClientOriginalExtension();
    $dest = public_path('/img/cars/');
    $image->move($dest, $reImage);

    $voiture = Voiture::where('matricule', $request->matricule)->first();

    if ($voiture) {
        $voiture->update([
            'idMarque' => $request->idMarque,
            'idModel' => $request->idModel,
            'idVersion' => $request->idVersion,
            'annee' => $request->annee,
            'prix_initial' => $request->prix,
            'description' => $request->description,
            'status' => 'disponible',
            'proprietaire_id' => $request->user_id,
            'image' => $reImage,
        ]);

        $voiture->enchere->update([
            'prix_enchere' => $request->prix,
            'temps_restant' => $temps_restant,
        ]);
    } else {
        $voiture = Voiture::create([
            'matricule' => $request->matricule,
            'idMarque' => $request->idMarque,
            'idModel' => $request->idModel,
            'idVersion' => $request->idVersion,
            'annee' => $request->annee,
            'prix_initial' => $request->prix,
            'description' => $request->description,
            'status' => 'disponible',
            'proprietaire_id' => $request->user_id,
            'image' => $reImage,
        ]);

        Enchere::create([
            'voiture_id' => $request->matricule,
            'utilisateur_id' => null,
            'prix_enchere' => $request->prix,
            'temps_restant' => $temps_restant,
        ]);
    }

    return redirect()->back()->with('success', 'Voiture ajoutée avec succès.');
}*/







public function store(Request $request)
{
    $validatedData = $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'nb_jours' => 'required|numeric|min:0',
        'nb_heures' => 'required|numeric|min:0',
        'description'=>'required',
        'matricule'=>'required',
        'annee' => 'required|numeric|lte:' . date('Y')
    ], [
        'annee.lte' => 'L\'année doit être inférieure ou égale à l\'année actuelle.'
    ]);

    $nb_jours = intval($request->nb_jours) * 24;
    $nb_heures = intval($request->nb_heures);
    $temps_restant = $nb_jours + $nb_heures;

    $image = $request->file('image');
    $reImage = time() . '.' . $image->getClientOriginalExtension();
    $dest = public_path('/img/cars/');

    $image->move($dest, $reImage);


    if ($request->idMarque == "autre") {
        $marque = Marque::firstOrCreate(
            ['nomMarque' => strtoupper($request->marque_autre)],
            ['nomMarque' => strtoupper($request->marque_autre)]
        );
        $idMarque = $marque->id;
    } else {
        $idMarque = $request->idMarque;
    }
    
    if ($request->idModel == "autre" || $request->idModel == null) {
        $model = Modele::firstOrCreate(
            ['nomModel' => strtoupper($request->modele_autre), 'marque_id' => $idMarque],
            ['nomModel' => strtoupper($request->modele_autre), 'marque_id' => $idMarque]
        );
        $idModel = $model->id;
    } else {
        $idModel = $request->idModel;
    }
    
    if ($request->idVersion == "autre" || $request->idVersion == null) {
        $version = Version::firstOrCreate(
            ['nomVersion' => strtoupper($request->version_autre), 'modele_id' => $idModel],
            ['nomVersion' => strtoupper($request->version_autre), 'modele_id' => $idModel]
        );
        $idVersion = $version->id;
    } else {
        $idVersion = $request->idVersion;
    }
    

    $voiture = Voiture::where('matricule', $request->matricule)->first();

    if ($voiture) {
        $voiture->update([
            'idMarque' => $idMarque,
            'idModel' => $idModel,
            'idVersion' => $idVersion,
            'annee' => $request->annee,
            'prix_initial' => $request->prix,
            'description' => $request->description,
            'status' => 'disponible',
            'proprietaire_id' => $request->user_id,
            'image' => $reImage,
        ]);

        $voiture->enchere->update([
            'prix_enchere' => $request->prix,
            'temps_restant' => $temps_restant,
        ]);
    } else {
        

        $voiture = Voiture::create([
            'matricule' => $request->matricule,
            'idMarque' => $idMarque,
            'idModel' => $idModel,
            'idVersion' => $idVersion,
            'annee' => $request->annee,
            'prix_initial' => $request->prix,
            'description' => $request->description,
            'status' => 'disponible',
            'proprietaire_id' => $request->user_id,
            'image' => $reImage,
        ]);

        Enchere::create([
            'voiture_id' => $request->matricule,
            'utilisateur_id' => null,
            'prix_enchere' => $request->prix,
            'temps_restant' => $temps_restant,
        ]);
    }

    return redirect()->back()->with('success', 'Voiture ajoutée avec succès.')->withErrors($validatedData);
}



    

    /**
     * Display the specified resource.
     */
    public function show(string $matricule)
    {
       $voiture=Voiture::where('matricule',$matricule)->first();
       return view('detail', compact('voiture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Voiture $voiture)
{
    // Vérifier si une enchère est associée à la voiture
    if ($voiture->enchere) {
        // Supprimer l'enchère correspondante
        $voiture->enchere->delete();
    }

    // Supprimer la voiture
    $voiture->delete();

    return redirect()->route('voituresA.index')->with('success', 'Voiture supprimée avec succès.');
}


    /*public function updateEnchere(Request $request)
    { 
        $request->validate([
            'prix' => 'required|numeric',
           
        ]);
        //dd($request->matricule);
        // Trouver l'enchère associée à cette voiture
        $enchere = Enchere::where('voiture_id', $request->matricule)->first();
        
        //dd($enchere);
        
        if ($enchere) {
            // Mettre à jour l'enchère
            $enchere->update([
                'prix_enchere' => $request->prix,
                'utilisateur_id' => $request->utilisateur,
            ]);
        } else {
            // Si l'enchère n'est pas trouvée
            dd('Enchere introuvable');
        }
    
        return redirect()->back()->with('success', 'Enchère mise à jour avec succès.');
    }
    */
    public function updateEnchere(Request $request)
{ 
    $request->validate([
        'prix' => 'required|numeric',
        'utilisateur' => 'required|numeric',
    ]);

    // Trouver l'enchère associée à cette voiture
    $enchere = Enchere::where('voiture_id', $request->matricule)->first();
    
    if ($enchere) {
        // Mettre à jour l'enchère
        $enchere->update([
            'prix_enchere' => $request->prix,
            'utilisateur_id' => $request->utilisateur,
        ]);

        // Récupérer les informations de la voiture
        $voiture = Voiture::where('matricule', $request->matricule)->first();

        // Récupérer l'acheteur
        $acheteur = User::find($request->utilisateur);

        // Récupérer le vendeur
        $vendeur = $voiture->proprietaire;

        
    } else {
        // Si l'enchère n'est pas trouvée
        dd('Enchere introuvable');
    }

    return redirect()->back()->with('success', 'Enchère mise à jour avec succès.');
}





}

