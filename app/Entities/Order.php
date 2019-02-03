<?php

namespace App\Entities;

use App\Services\BrazilianMasks;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    const STATUS_PENDENTE = 0;
    const STATUS_PAGO = 1;
    const STATUS_ENVIADO = 2;
    const STATUS_CANCELADO = 3;


    const ORDER_STATUS = [
        self::STATUS_PENDENTE => "open",
        self::STATUS_PAGO => "payed",
        self::STATUS_ENVIADO => "delivered",
        self::STATUS_CANCELADO => "canceled"
    ];

    public static function getStatusCodeByName($status){
        return array_flip(self::ORDER_STATUS)[$status];
    }
    public function setStatusCodeByPagseguroStatus($pagseguroStatus){

        $statusPagseguroList = [
            2 =>  self::STATUS_PENDENTE,
            3 =>  self::STATUS_PAGO,
            7 =>  self::STATUS_CANCELADO,
        ];
        if(!in_array($pagseguroStatus, array_keys($statusPagseguroList)))
          throw new \Exception("Status Pagseguro Desconhecido - status $pagseguroStatus informado.", 1);
        $status = $statusPagseguroList[$pagseguroStatus];

        $this->status = $status;
    }

    public function items() {
        return $this->hasMany("App\Entities\OrderItem");
    }

    public function client() {
        return $this->hasOne("App\User", "id", "user_id");
    }

    public function getTotalPrice(){
        return $this->items->sum(function($item){
            return $item->getTotalPrice();
        });
    }

    public function getTotalQuantity(){
        return $this->items->sum(function($item){
            return $item->quantity;
        });
    }

    public function getOrderDate() {
        $value = $this->created_at;
        if(is_null($value))
            return "";
        $mutable = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        return $mutable->format("d/m/Y");
    }

    public function getPaymentDate() {
        $value = $this->payment_date;
        if(is_null($value))
            return "";
        $mutable = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        return $mutable->format("d/m/Y");
    }

    public function getPagseguroItems(){
        return $this->items->map(function ($item){
            return $item->toPagseguroItem();
        })->toArray();
    }

    public function fetchPagseguroOrderData(){
      $address = $this->client->address;
      return [
          'items' => $this->getPagseguroItems(),
          'shipping' => [
              'address' => [
                  'postalCode' => $address->zipcode,
                  'street' => $address->address,
                  'number' => $address->number,
                  'district' => $address->bairro,
                  'city' => $address->city,
                  'state' => $address->state,
                  'country' => $address->country,
              ],
              'type' => 2,
              'cost' => $this->frete,
          ],
          'reference' => $this->id
      ];
    }

    public function setZipcodeAttribute($value)
    {
        $this->attributes['zipcode'] = preg_replace('/[^0-9]/s', '', $value);
    }


    public function getZipcodeAttribute($value)
    {
        return BrazilianMasks::applyCEPMask($value);
    }

    public function isEmpty(){
        return (count($this->items) < 1);
    }



    protected $guarded = ['id'];
}
