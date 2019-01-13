<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Entities\Product;
use App\Entities\ProductType;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
  public function list()
  {
      $products = Product::all();
      return view("admin.product.list", [
          "products" => $products
      ]);
  }

  public function edit($id)
  {
      $product = Product::find($id);
      $productTypes = ProductType::all();
      return view("admin.product.edit", [
        "productTypes" => $productTypes,
        "product" => $product,
      ]);
  }


  public function create()
  {
      $productTypes = ProductType::all();
      return view("admin.product.create", [
        "productTypes" => $productTypes
      ]);
  }

  public function store(Request $request)
  {

    $data = $request->all();


    $newProduct = new Product([
        "name" =>  $data['name'],
        "price" =>  $data['price'],
        "url_id" =>  $data['url_id'],
        "type" =>  $data['type'],
        "description" =>  $data['description'],
    ]);


    $imagePath = "public/products/"  . $newProduct->type_r->type;
    $image = $request->file("main_image")->store($imagePath);

    $explodeImage = explode("/", $image);

    $imageName = array_pop( $explodeImage );

    $newProduct->main_image = $imageName;

    $newProduct->makeThumbImage();

    $newProduct->save();

    return redirect(route("admin.products"));
  }



  public function update(Request $request, $id) {
    $data = $request->all();

    $product = Product::find($id);
    $product->name = $data['name'];
    $product->price = $data['price'];
    $product->url_id = $data['url_id'];
    $product->type = $data['type'];
    $product->description = $data['description'];

    if($data["image_updated"] === "1"){

      $imagePath = "public/products/"  . $product->type_r->type;
      $image = $request->file("main_image")->store($imagePath);
      $explodeImage = explode("/", $image);
      $imageName = array_pop( $explodeImage );
      $product->main_image = $imageName;
      $product->makeThumbImage();
    }

    $product->save();

    return redirect(route("admin.products"));
  }


}
