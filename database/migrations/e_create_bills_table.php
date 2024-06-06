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
        Schema::create('bills', function (Blueprint $table) {
            $table->id('billId');
            $table->unsignedBigInteger('productId');
            $table->unsignedBigInteger('userId');
            $table->integer('quantityPurchased');
            $table->date('DatePurchase');
            $table->string('Purchased');
            $table->timestamps();

            $table->foreign('productId')->references('productId')->on('products')->onDelete('cascade');
            $table->foreign('userId')->references('userId')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
};
