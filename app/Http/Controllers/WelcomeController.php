<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Voiture;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Version;
use App\Models\User;

class WelcomeController extends Controller
{
    public function index()
    {
        $voitures = Voiture::all(); 
        $modeles=Modele::all();
        $marques=Marque::all();
        $versions=Version::all();
        return view('welcome',compact('voitures','modeles','marques','versions'));
    }
}
