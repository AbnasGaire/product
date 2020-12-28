<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("product_id")->unsigned();
            $table->integer("quantityin");
            $table->foreign('product_id')->references('id')->on('products');
            $table->date("added_date");
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
        Schema::dropIfExists('productin');
    }
}
