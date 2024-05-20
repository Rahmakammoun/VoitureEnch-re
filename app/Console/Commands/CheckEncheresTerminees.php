<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Enchere;
use App\Mail\AcheteurNotification;
use App\Mail\VendeurNotification;
use App\Mail\VendeurNotificationFail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class CheckEncheresTerminees extends Command
{
    protected $signature = 'encheres:check';
    protected $description = 'Vérifie les enchères terminées et envoie des e-mails aux acheteurs et aux vendeurs';

    public function handle()
{
    $encheresEnCours = Enchere::join('voitures', 'encheres.voiture_id', '=', 'voitures.matricule')
    ->whereNotNull('encheres.utilisateur_id')
    ->where('voitures.status', 'disponible')
    ->where(DB::raw("DATE_ADD(encheres.created_at, INTERVAL encheres.temps_restant HOUR)"), '<=', Carbon::now())
    ->select('encheres.*')
    ->get();

    foreach ($encheresEnCours as $enchere) {
        // Vérifier si l'enchère a une voiture associée
        if ($enchere->voiture) {
            $voiture = $enchere->voiture;

            // Calculer la date limite de l'enchère
            $dateFinEnchere = $enchere->created_at->addHours($enchere->temps_restant);
            
            // Vérifier si l'enchère est terminée
            if (Carbon::now()->gte($dateFinEnchere)) {
                // Envoyer un e-mail à l'acheteur
                Mail::to($enchere->utilisateur->email)->send(new AcheteurNotification($voiture));
                // Envoyer un e-mail au vendeur
                Mail::to($voiture->proprietaire->email)->send(new VendeurNotification($voiture));
                
                // Mettre à jour le statut de la voiture associée à l'enchère
                $voiture->update(['status' => 'vendue']);
            }
        }
    }

     // Envoyer un e-mail au vendeur si une durée d'enchère est terminée et aucune participation n'a eu lieu
     $encheresEchouees = Enchere::join('voitures', 'encheres.voiture_id', '=', 'voitures.matricule')
     ->whereNull('encheres.utilisateur_id')
     ->where('voitures.status', 'disponible')
     ->where(DB::raw("DATE_ADD(encheres.created_at, INTERVAL encheres.temps_restant HOUR)"), '<=', Carbon::now())
     ->select('encheres.*')
     ->get();

 foreach ($encheresEchouees as $enchere) {
     // Vérifier si l'enchère a une voiture associée
     if ($enchere->voiture) {
         $voiture = $enchere->voiture;

         // Envoyer un e-mail au vendeur
         Mail::to($voiture->proprietaire->email)->send(new VendeurNotificationFail($voiture));
     }
 }


    $this->info('Vérification des enchères terminées effectuée avec succès.');
}

}
