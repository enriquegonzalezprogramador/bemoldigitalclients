<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;
    public $people;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($people)
    {
        $this->people = $people;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.registered')
                    ->subject('Usuario registrado');
    }
}
