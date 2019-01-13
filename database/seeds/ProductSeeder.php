<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<11;$i++){

            $product = new App\Entities\Product;
            $product->name = "MEIA LISTRAS AZUL ROYAL ALTAI";
            $product->description = "Lorem ipsum dolor sit amet, ut nam detracto sapientem definitionem. Mel nostrum reformidans ad, ei quo imperdiet abhorreant referrentur, cum dicam voluptatibus eu. At quas quidam corrumpit mei, ex sea vituperata reformidans, laudem detracto ut nec. Autem ipsum ad sit. Quo ut illum albucius scriptorem, at his evertitur cotidieque, etiam summo no has. Perpetua scribentur sea ne.";
            $product->price = 34.99;
            $product->main_image = "meia-listras-azul-royal-altai.jpg";
            $product->url_id = "meia-listras-azul-royal-altai-$i";
            $product->type = 1;

            $product->save();
        }
    }
}
