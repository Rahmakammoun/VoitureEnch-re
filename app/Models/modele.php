<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Marque;

class modele extends Model
{
    use HasFactory;
    protected $table = 'models'; 
    protected $fillable = [
        'id',
        'nomModel',
        'marque_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function marque()
    {
        return $this->belongsTo(Marque::class, 'marque_id');
    }
    public function versions()
    {
        return $this->hasMany(Version::class);
    }
    public function voitures()
    {
        return $this->hasMany(Voiture::class,'idVersion');
    }

}
