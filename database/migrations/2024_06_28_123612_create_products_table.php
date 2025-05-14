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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');     
            $table->bigInteger('price', 8, 2);
            $table->integer('quantity');
            $table->string('quantity_type')->nullable();
            $table->bigInteger('total', 8, 2)->default(0);
            $table->integer('stock')->nullable(); 
            $table->bigInteger('stock_amount', 8, 2)->default(0);
            $table->decimal('gst_rate', 5, 2)->default(0.00); // Add the GST rate field
            $table->bigInteger('gst_amount', 8, 2)->default(0.00); // Add the GST amount field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
