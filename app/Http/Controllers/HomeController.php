<?php

namespace App\Http\Controllers;


use App\Entities\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactMail;

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

    public function sendContactMail(Request $request) {
        $name = $request->get("name");
        $email = $request->get("email");
        $message = $request->get("message");

        Mail::send(new ContactMail($email, $name, $message));

        return redirect()->back()->with('success', 'Mensagem enviada com sucesso !');
    }

}
