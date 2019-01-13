<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{


    public function product() {
        return $this->hasOne("App\Entities\Product", "id", "product_id");
    }

    public function getTotalPrice(){
        return $this->product->price * $this->quantity;
    }

    public function toPagseguroItem(){
        return [
            'id' => $this->product->id,
            'description' => $this->product->name,
            'quantity' => $this->quantity,
            'amount' => $this->product->price,
        ];
    }

    protected $guarded = ['id'];
}
