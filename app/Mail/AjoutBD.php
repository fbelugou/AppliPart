<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AjoutBD extends Mailable
{
    use Queueable, SerializesModels;

    private $interlocuteur;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($interlocuteur)
    {
      $this->interlocuteur=$interlocuteur;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
                    //objet du mail
        return $this->subject('Ajout de vos données à AMIO')
                    //envoyeur du mail (doit correspondre aux informations dans le fichier .env)
                    //from(<adresse>,<nom(facultatif)>)
                    ->from('appligestionpartenariats@gmail.com','Application de gestion de partenariats AMIO')
                    //vue à utiliser et données transférées
                    ->view('mail',['interlocuteur'=>$this->interlocuteur]);
    }
}
