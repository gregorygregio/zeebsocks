<?php

namespace App\Entities;


class Cart {
    public static function getCart(){
        return session()->has('cart') ? session()->get('cart') : new Order;
    }

    public static function countItems(){
        $cart = self::getCart();

        return $cart->items->sum(function($item){
            return $item->quantity;
        });
    }
}