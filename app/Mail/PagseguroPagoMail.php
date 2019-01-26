<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PagseguroPagoMail extends Mailable
{
    use Queueable, SerializesModels;
    private $information;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($information)
     {
         $this->information = $information;
     }

     /**
      * Build the message.
      *
      * @return $this
      */
     public function build()
     {
         return $this->from('contato@zeebsocks.com','Virat Gandhi')
         ->subject('Notificacao Zeeb')
         ->view('mails.testEmail', [ "info" => json_encode($this->information) ]);
     }
}
