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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->constrained('workers')->onDelete('cascade');
            $table->string('department')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->bigInteger('given_salary');
            $table->date('givendate')->nullable();
            $table->float('weight');
            $table->text('details');
            $table->date('receivedate')->nullable();
            $table->float('receiveweight')->nullable();
            $table->float('difference')->default(0);
            $table->integer('quantity');
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
        Schema::dropIfExists('salaries');
    }
};
