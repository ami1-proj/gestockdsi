<?php

namespace App\Mail;

use App\Affectation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AffectationNew extends Mailable
{
    use Queueable, SerializesModels;

    public $affectation;
    public $articles;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Affectation $affectation)
    {
        $this->affectation = $affectation;
        $this->articles = $affectation->articles();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Affectation Matériels Informatique')
            ->markdown('emails.affectations.new');
    }
}
