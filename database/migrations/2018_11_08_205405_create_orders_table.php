<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->unsigned();
            $table->string("zipcode", 10);
            $table->double("frete");
            $table->double("items_total");
            $table->double("order_total");

            $table->date("payment_date")->nullable();
            $table->date("delivered_date")->nullable();
            $table->char("status", 1);


            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });


        Schema::table('order_items', function (Blueprint $table) {

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign("orders_user_id_foreign");
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign("order_items_order_id_foreign");
        });

        Schema::dropIfExists('orders');
    }
}
