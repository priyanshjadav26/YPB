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
        Schema::create('dbiddings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('worker_id'); // Foreign key to workers table
            $table->date('givendate');
            $table->float('weight');
            $table->text('details');
            $table->date('receivedate')->nullable();
            $table->float('receiveweight')->nullable();
            $table->float('difference')->default(0); 
            $table->bigInteger('rate')->nullable();
            $table->bigInteger('total')->nullable();
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
        Schema::dropIfExists('dbiddings');
    }
};
