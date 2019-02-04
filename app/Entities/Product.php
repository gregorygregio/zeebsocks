<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use Intervention\Image\Facades\Image;

class Product extends Model
{

    protected $guarded = ['id', 'main_image'];


    public function getCreationData() {
        $value = $this->created_at;
        if(is_null($value))
            return "";
        $mutable = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        return $mutable->format("d/m/Y");

    }

    public function type_r() {
        return $this->hasOne("App\Entities\ProductType", "id", "type");
    }

    public function getRouteKeyName()
    {
        return 'url_id';
    }

    public function getRelatedProducts($quantity=3) {
        return self::where([ "type" => $this->type ])
                    ->where("id", "!=", $this->id)
                    ->inRandomOrder()
                    ->limit($quantity)
                    ->get();
    }

    public function makeThumbImage($realPath) {
      $imageName = $this->main_image;
      $explodedImageName = explode(".", $imageName);
      $extension = array_pop($explodedImageName);
      $img = Image::make($realPath);
      $img->resize(320, 320);
      // $img->insert('images/logo.jpeg');
      \Illuminate\Support\Facades\Storage::put('public/products/thumbs/' . $this->type_r->type . "/" . $imageName, $img->fit(200)->stream($extension));
      //$img->save('storage/products/thumbs/' . $this->type_r->type . "/" . $imageName);
    }

    public function getProductImagesPath(){
        return asset("/storage/products/" . $this->type_r->type . "/"  . $this->main_image);
    }

    public function getProductThumbPath(){
        return asset("/storage/products/thumbs/" . $this->type_r->type . "/"  . $this->main_image);
    }
}
