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
        Schema::create('user_favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('productId');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('userId')->references('userId')->on('users')->onDelete('cascade');
            $table->foreign('productId')->references('productId')->on('products')->onDelete('cascade');

            // Ensure that each combination of user_id and product_id is unique
            $table->unique(['userId', 'productId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_favorites');
    }
};
