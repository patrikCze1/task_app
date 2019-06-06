<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobAnswer extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $mail;
    public $userMail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $request)
    {
        $this->message = $request[2];
        $this->mail = $request[1];
        $this->userMail = $request[3];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.mail');
    }
}
