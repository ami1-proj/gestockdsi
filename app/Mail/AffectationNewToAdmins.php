<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AffectationNewToAdmins extends Mailable
{
    use Queueable, SerializesModels;

    public $ficheretour_url;
    public $affectation;
    public $beneficiaire;
    public $articles;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($affectation)
    {
        $this->affectation = $affectation;
        $this->articles = $affectation->articles();
        $this->beneficiaire = $affectation->beneficiaire;

        $this->ficheretour_url = route('affectations.ficheretour', $affectation->id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Affectation Matériels Informatique')
            ->markdown('emails.affectations.newtoadmins');
    }
}
