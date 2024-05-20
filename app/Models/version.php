<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class version extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nomVersion',
        'modele_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public function modele()
    {
        return $this->belongsTo(Modele::class, 'modele_id');
    }
    public function voitures()
    {
        return $this->hasMany(Voiture::class,'idVersion');
    }
}
