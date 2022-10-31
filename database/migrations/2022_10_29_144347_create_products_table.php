<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catagory_id'); 
            $table->foreign('catagory_id')->references('id')->on('catagories')->onDelete('cascade');
            $table->string('image');
            $table->string('name');
            $table->string('status');
            $table->text('description')->nullable();
            $table->string('price');
            $table->string('unit');
            $table->string('old_price');
            $table->string('barcode');
            $table->string('weight');
            $table->string('link')->nullable();
            $table->string('button')->nullable()->default(1);
            $table->string('coast');
            $table->text('note')->nullable();
            $table->string('store_place')->nullable();
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
        Schema::dropIfExists('products');
    }
}
