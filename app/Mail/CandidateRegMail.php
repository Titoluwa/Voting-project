<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidateRegMail extends Mailable
{
    use Queueable, SerializesModels;

    public $matricno;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($matricno)
    {
        $this->matricno = $matricno;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.registration.candidate');
    }
}
