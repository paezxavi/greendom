<?php

namespace App\Mail;

use App\User;
use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FournisseurMail extends Mailable
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
        return $this->view('mails.fournisseurMail')
                    ->subject($this->title)
                    ->attach(storage_path('app/public/pdf/Commande.pdf'))
                    ->with([
                      'title' => $this->title,
                    ]);
    }
}
