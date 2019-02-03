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
            $information = $this->information;
            if(is_null($information))
              throw new \Exception("Pagseguro information não definida");

            $orderId=10;//temporario
            $order = Order::find($orderId);
            var_dump($order->status);
            if(is_null($order))
              throw new \Exception("Não existe pedido com id $orderId !");


            try {
              var_dump("inicio try");
                var_dump($information);
              $order->setStatusCodeByPagseguroStatus($information->getStatus());
              var_dump("status devidadmente setado");
              $order->save();
              var_dump("salvo");
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage() . "<br>" . json_encode($information));
            }


            $client = $order->client;


            $datePayment = $information->getDate();

            Mail::to($client->email, $client->name)
            ->send(new PagseguroPagoMail($order));
          } catch(\Exception $e){
            Mail::send(new App\Mail\ErrorMail("Error: " . $e->getMessage()));
          }
      }
}
