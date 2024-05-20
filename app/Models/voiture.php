<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Marque;
use App\Models\Version;
use App\Models\User;
use App\Models\Modele;
use App\Models\Enchere; // Ajoutez ceci


class Voiture extends Model
{
    use HasFactory;
    protected $primaryKey = 'matricule'; // Spécifiez la clé primaire
    protected $keyType = 'string';

    protected $fillable = [
        'matricule',
        'idMarque',
        'idModel',
        'idVersion',
        'annee',
        'prix_initial',
        'description',
        'proprietaire_id',
        'image',
        'status',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function marque()
    {
        return $this->belongsTo(Marque::class, 'idMarque');
    }

    public function model()
    {
        return $this->belongsTo(Modele::class, 'idModel');
    }

    public function version()
    {
        return $this->belongsTo(Version::class, 'idVersion');
    }
    

    public function proprietaire()
    {
        return $this->belongsTo(User::class, 'proprietaire_id');
    }

    public function getImageAttribute($value)
    {
        return asset('img/cars/' . $value); // Assurez-vous que vos images sont stockées dans le dossier "storage"
    }
    
    /*public function enchere()
    {
        return $this->hasOne(Enchere::class, 'voiture_id');
    }*/

    public function enchere()
{
    return $this->hasOne(Enchere::class, 'voiture_id', 'matricule');
}


public function tempsRestantEnchere()
{
    $enchere = Enchere::where('voiture_id', $this->matricule)->first(); // Récupérer l'enchère associée à cette voiture
    if ($enchere) {
        $temps_restant = $enchere->temps_restant;
        $temps_ecoule = now()->diffInMinutes($enchere->created_at); // Temps écoulé en minutes
        $temps_restant_minutes = $temps_restant * 60 - $temps_ecoule; // Convertir le temps restant en minutes
        $jours = floor($temps_restant_minutes / (24 * 60)); // Calculer les jours restants
        $heures = floor(($temps_restant_minutes % (24 * 60)) / 60); // Calculer les heures restantes
        $minutes = $temps_restant_minutes % 60; // Calculer les minutes restantes

        if ($temps_restant_minutes > 0) {
            return "$jours jours $heures heures $minutes minutes";
        } else {
            return "Enchère terminée";
        }
    } else {
        return "Pas d'enchère en cours";
    }
}


    public function prixEnchere()
{
    $enchere = Enchere::where('voiture_id', $this->matricule)->first();
    if ($enchere) {
        return $enchere->prix_enchere;
    } else {
        return "Pas d'enchère en cours";
    }
}

}



    



