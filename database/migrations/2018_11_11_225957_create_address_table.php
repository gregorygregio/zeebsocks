<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('address', 60);
            $table->smallInteger('number');
            $table->string('complement', 60)->nullable();
            $table->string('bairro', 60);
            $table->string('city', 30);
            $table->char('state', 2);
            $table->char('country', 3);
            $table->string('zipcode', 10);

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('address', function (Blueprint $table) {
            $table->dropForeign("address_user_id_foreign");
        });

        Schema::dropIfExists('address');
    }
}
