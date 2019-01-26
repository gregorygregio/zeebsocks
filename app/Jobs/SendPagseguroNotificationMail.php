<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use laravel\pagseguro\Transaction\Information\Information;
use App\Mail\PagseguroPagoMail;
use Mail;
use App\Entities\Order;

class SendPagseguroNotificationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $information;
     /**
      * Create a new message instance.
      *
      * @return void
      */
      public function __construct(Information $information)
      {
        Mail::to("gregorygregio@hotmail.com", "Zeeb")
        ->send(new PagseguroPagoMail($information));
          $this->information = $information;
      }

      /**
       * Execute the job.
       *
       * @return void
       */
       public function handle()
      {
          try{
            echo "Iniciando handle";
            $information = $this->information;
            var_dump($information);
            echo "__________________";
            $orderId = $information->getReference();
            var_dump($orderId);
            echo "__________________";
            $order = Order::find($orderId);
            if(is_null($order))
              throw new \Exception("Não existe pedido com id $orderId !");

            var_dump($order);
            echo "__________________";
            $order->status = $information->getStatus();
            $client = $order->client;
            var_dump($client);
            echo "__________________";

            // Mail::to($client->email, $client->name)
            Mail::to("gregorygregio@hotmail.com", "Zeeb")
            ->send(new PagseguroPagoMail($this->information));
          } catch(\Exception $e){
            Mail::to("suporte@zeebsocks.com", "ZeebError")
            ->send(new PagseguroPagoMail("Error: " . $e->getMessage()));
          }
      }
}
