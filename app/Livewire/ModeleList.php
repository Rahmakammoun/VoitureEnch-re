<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Marque;
use App\Models\Modele;

class ModeleList extends Component
{
    public $marque_id;
    public $modeles;

    public function updatedMarqueId($value)
    {
        $this->modeles = Modele::where('marque_id', $value)->get();
    }

    public function render()
    {
        $marques = Marque::all();
        return view('livewire.modele-list', compact('marques'));
    }
}
