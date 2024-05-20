<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Voiture;

class VendeurNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $voiture;
    public $enchere;
    public $acheteur;

    public function __construct(Voiture $voiture)
    {
        $this->voiture = $voiture;
        $this->enchere = $voiture->enchere;
        $this->acheteur = $voiture->enchere->utilisateur;
    }

    public function build()
    {
        return $this->subject('Notification d\'enchère terminée')->view('emails.vendeur-notification');
    }
}


