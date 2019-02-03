<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ErrorMail extends Mailable
{
    use Queueable, SerializesModels;

    private $errorMessage;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->to('suporte@zeebsocks.com','Suporte Zeeb')
        ->from("suporte@zeebsocks.com", "ZeebError")
        ->subject('Erro !')
        ->view('mails.contact', [ "clientMessage" => $this->errorMessage ]);
    }
}
