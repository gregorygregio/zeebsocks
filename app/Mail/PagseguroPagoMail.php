<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Entities\Order;

class PagseguroPagoMail extends Mailable
{
    use Queueable, SerializesModels;
    private $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(Order $order)
     {
         $this->order = $order;
     }

     /**
      * Build the message.
      *
      * @return $this
      */
     public function build()
     {
         return $this->from('contato@zeebsocks.com','Contato Zeeb')
         ->subject('Notificacao Zeeb - Pagamento de pedido aceito !')
         ->view('mails.pagseguro.statusPago', [ "order" => $this->order ]);
     }
}
