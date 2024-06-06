<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('productId');
            $table->string('productTmName', 255);
            $table->unsignedBigInteger('styleId');
            $table->string('productName', 255);
            $table->text('productImage');
            $table->boolean('productStatus');
            $table->decimal('productPrice', 10, 0);
            $table->integer('productQuantity');
            $table->integer('productSoldQt');
            $table->text('productInfor');
            $table->text('productIntro');
            $table->integer('productDiscount');
            $table->foreign('styleId')->references('styleId')->on('product_style')->onDelete('cascade');
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
};
