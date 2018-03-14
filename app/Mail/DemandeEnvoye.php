<?php

namespace App\Mail;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DemandeEnvoye extends Mailable
{
    use Queueable, SerializesModels;

    private $var;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->var = $request;
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
                      'var' => $this->var,
                  ]);
    }
}
