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
        Schema::create('blasiyas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('worker_id'); 
            $table->date('givendate');
            $table->float('weight');
            $table->string('type')->nullable();
            $table->bigInteger('rate')->nullable();
            $table->bigInteger('total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blasiyas');
    }
};
