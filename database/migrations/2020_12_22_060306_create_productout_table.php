<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productout', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("product_id")->unsigned();
            $table->integer("quantityout");
            $table->foreign('product_id')->references('id')->on('products');
            $table->date("out_date");
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
        Schema::dropIfExists('productout');
    }
}
