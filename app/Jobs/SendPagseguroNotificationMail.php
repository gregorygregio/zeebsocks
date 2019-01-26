<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use laravel\pagseguro\Transaction\Information\Information;
use App\Mail\PagseguroPagoMail

class SendPagseguroNotificationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
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
            echo "Iniciando handle";
            $information = $this->information;
            $orderId = $information->getReference();
            var_dump($orderId);
            echo "__________________";
            $order = Order::find($orderId);
            var_dump($order);
            echo "__________________";
            $order->status = $information->getStatus();
            $client = $order->client;
            var_dump($client);
            echo "__________________";

            Mail::to($client->email, $client->name)
            ->send(new PagseguroPagoMail($this->information));
          }catch(\Exception $e){
            Mail::to("gregorygregio27@gmail.com", "Zeeb")
            ->send(new PagseguroPagoMail($e->getMessage()));
          }
      }
}
