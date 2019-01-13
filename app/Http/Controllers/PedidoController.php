<?php

namespace App\Http\Controllers;

use App\Services\FreteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use laravel\pagseguro\Platform\Laravel5\PagSeguro;
use App\Entities\Order;

class PedidoController extends Controller
{


    private function getCart(){
        return session()->has('cart') ? session()->get('cart') : new Order;
    }


    public function confirmAddress(){
        $user = Auth::user();
        $address = $user->address;


        if( $this->getCart()->isEmpty() ) {
            return redirect()->route("cart");
        }

        return view('pedido.address', [ "address" => $address, "hasAddress" => !is_null($address) ]);
    }


    public function sumPedido() {
        $user = Auth::user();
        $address = $user->address;

        if(is_null($address)){
            return redirect()->route("pedido.address");
        }

        $cart = $this->getCart();

        if( $cart->isEmpty() ) {
            return redirect()->route("cart");
        }


        $frete = FreteService::calcularFrete($address->zipcode);

        return view("pedido.summary", [
            "address" => $address,
            "cart" => $cart,
            "frete" => $frete,
        ]);
    }



    public function endPedido(){
        $user = Auth::user();
        $address = $user->address;

        $cart = $this->getCart();
        $frete = FreteService::calcularFrete($address->zipcode);

        $pagseguroItems = $cart->getPagseguroItems();

        $valorDoFrete = $frete["valor"];

        $data = [
            'items' => $pagseguroItems,
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
                'cost' => $valorDoFrete,
            ],
            'reference' => '123'
        ];


        $checkout = PagSeguro::checkout()->createFromArray($data);
        //dd($checkout);

        $credentials = PagSeguro::credentials()->get();
        $information = $checkout->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information
        if ($information) {
            $items_total = $cart->getTotalPrice();

            $cart->user_id = $user->id;
            $cart->zipcode = $address->zipcode;
            $cart->frete = $valorDoFrete;
            $cart->items_total = $items_total;
            $cart->order_total = $items_total + $valorDoFrete;
            $cart->status = 0;


            $cart->save();

            $cart->items->each(function ($item) use ($cart) {
                $item->total_amount = $item->getTotalPrice();
                $item->order_id = $cart->id;
                $item->save();
            });

            session()->remove("cart");

            return Redirect::to($information->getLink());

        }
    }

    public function listOrders($orderStatus = Order::STATUS_PENDENTE) {
        $user = Auth::user();

        if(!in_array($orderStatus, array_keys(Order::ORDER_STATUS)))
            $orders = [];
        else
            $orders = $user->orders()->where("status", $orderStatus)->get();

        return view('pedido.list', [ "orders" => $orders, "orderStatus" => (int)$orderStatus ]);
    }

    public function redirectPagSeguro (){
            return view("pedido.redirect");
    }


}
