<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param $confirmation_link
     */
    public function __construct($confirmation_link)
    {
        $this->confirmation_link = $confirmation_link;
    }

    private $confirmation_link;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $confirmation_link = $this->confirmation_link;
        return $this->view('mail.token', compact('confirmation_link'));
    }
}
