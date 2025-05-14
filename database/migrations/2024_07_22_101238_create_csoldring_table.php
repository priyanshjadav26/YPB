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
        Schema::create('csoldrings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('worker_id'); 
            $table->date('givendate');
            $table->text('details');
            $table->float('casting_weight');
            $table->float('lasiya_weight');
            $table->float('givenweight');
            $table->date('receivedate')->nullable();
            $table->float('receiveweight')->nullable();
            $table->float('difference')->default(0); 
            $table->bigInteger('rate')->nullable();
            $table->float('piece')->nullable();
            $table->bigInteger('total')->nullable();
            $table->timestamps();
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csoldrings');
    }
};
