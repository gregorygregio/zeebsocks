<?php

namespace App\Http\Controllers;


use App\Entities\Product;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('home', [ "products" => Product::all() ]);
    }


    public function showProduct(Product $product){
        $relatedProducts = $product->getRelatedProducts(4);
        return view('product.show', [ 'product' => $product, 'relatedProducts' => $relatedProducts ]);
    }
}
