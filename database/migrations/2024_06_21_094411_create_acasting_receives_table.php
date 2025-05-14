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
        Schema::create('acasting_receives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acasting_id')->constrained()->onDelete('cascade');
            $table->date('receive_date');
            $table->decimal('receive_weight', 10, 2);
            $table->bigInteger('rate', 10, 2);
            $table->bigInteger('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('acasting_receives');
    }
};
