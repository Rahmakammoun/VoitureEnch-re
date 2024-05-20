<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marque extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nomMarque',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public function modeles()
    {
        return $this->hasMany(Modele::class);
    }
}
