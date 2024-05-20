<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Voiture;
use App\Models\Enchere;

class VendeurNotificationFail extends Mailable
{
    use Queueable, SerializesModels;

    public $voiture;
    public $enchere;


    /**
     * Create a new message instance.
     */
    public function __construct(Voiture $voiture)
    {
        $this->voiture = $voiture;
        $this->enchere = $voiture->enchere;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Notification d\'enchère terminée')->view('emails.vendeur-notificationFail');
    }
}
