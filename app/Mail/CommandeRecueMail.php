<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommandeRecueMail extends Mailable
{
    use Queueable, SerializesModels;

    private $title;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->title=$request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.commandeRecue')
                    ->subject('Commande Reçue')
                    ->with([
                      'title' => $this->title,
                    ]);
    }
}
