<?php

namespace App\Http\Controllers;

use App\Entities\Order;
use App\Entities\Cart;
use App\Entities\OrderItem;
use App\Entities\Product;
use App\Services\FreteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{


    public function index() {
        $cart = Cart::getCart();

        $viewItems = [ "cart" => $cart ];

        if(Auth::check()){
            $address = Auth::user()->address;
            if(!is_null($address)){
                $frete = FreteService::calcularFrete($address->zipcode);
                $viewItems["frete"] = $frete["valor"];
            }
        }

        return view('cart.list', $viewItems);
    }

    public function addItem(Request $request, $id) {
        $product = Product::find($id);
        $quantity = $request->input('quantity');

        if($quantity < 1){
            return redirect()->back()->with('error', 'Por favor, defina uma quantidade !');
        }



        $cart = Cart::getCart();

        foreach ($cart->items as $item){
            if($item->product_id === $product->id)
                return redirect()->back()->with('error', 'Este produto já está no seu carrinho !');
        }


        $newItem = new OrderItem([ "product_id" => $product->id, "quantity" => $quantity ]);

        $cart->items[] = $newItem;

        session(['cart' => $cart]);

        Session::save();

        return redirect()->back()->with('success', 'Produto Adicionado ao carrinho com sucesso !');
    }


    public function removeItem($id){
        $cart = Cart::getCart();

        $foundItemKey = $cart->items->search(function($item) use($id){
            return $item->product_id == $id;
        });

        if($foundItemKey === false) {
            return redirect()->back()->with('error', 'Este item já não está em seu carrinho !');
        }

        $cart->items->pull($foundItemKey);
        return redirect()->back()->with('success', 'Item removido do carrinho !');

    }

}
