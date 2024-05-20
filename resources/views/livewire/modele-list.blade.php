<!-- resources/views/livewire/modele-list.blade.php -->

<div>
    <select wire:model="marque_id" class="select2 select marque" style="width: 100%">
        <option value="">aucune</option>
        @foreach($marques as $m)
            <option value="{{ $m->id }}">{{ $m->nomMarque }}</option> 
        @endforeach
    </select>

    <select class="select2 select modele" style="width: 100%">
        <option value="">aucune</option>
        @foreach($modeles as $modele)
            <option value="{{ $modele->id }}">{{ $modele->nomModel }}</option>
        @endforeach
    </select>
</div>

