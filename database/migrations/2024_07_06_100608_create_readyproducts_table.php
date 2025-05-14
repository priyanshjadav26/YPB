<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('readyproducts', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('name');     
            $table->bigInteger('price', 8, 2);
            $table->integer('quantity');
            $table->string('quantity_type')->nullable();
            $table->bigInteger('total', 8, 2)->default(0);
            $table->integer('stock')->nullable(); 
            $table->bigInteger('stock_amount', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('readyproducts');
    }
};
