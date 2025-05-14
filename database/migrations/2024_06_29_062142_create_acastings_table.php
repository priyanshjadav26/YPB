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
        Schema::create('acastings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('worker_id');  
            $table->date('givendate');
            $table->float('weight');
            $table->text('details');
            $table->date('receivedate')->nullable();
            $table->float('receiveweight')->nullable()->default(0); 
            $table->bigInteger('rate')->nullable()->default(0); 
            $table->bigInteger('total')->nullable()->default(0); 
            $table->float('difference')->default(0); 
            $table->timestamps();
            // Define the foreign key constraint
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade');
        });
    }

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acastings');
    }
};
