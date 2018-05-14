<?php

namespace App\Mail;

use App\User;
use App\Commande;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DemandeEnvoye extends Mailable
{
    use Queueable, SerializesModels;

    private $commande;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->view('mails.demandeEnvoye')
                  ->subject('Demande envoyé')
                  ->with([
                      'commande' => $this->commande,
                  ]);
    }
}
