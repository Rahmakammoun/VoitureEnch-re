<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Voiture;

class enchere extends Model
{
    use HasFactory;
    protected $fillable = [
        'voiture_id',
        'utilisateur_id',
        'prix_enchere',
        'temps_restant',
    ];

    /*public function voiture()
    {
        return $this->belongsTo(Voiture::class, 'voiture_id');
    }*/
    public function voiture()
{
    return $this->belongsTo(Voiture::class, 'voiture_id');
}
public function utilisateur()
{
    return $this->belongsTo(User::class, 'utilisateur_id');
}
}
