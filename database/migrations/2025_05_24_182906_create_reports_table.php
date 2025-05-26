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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('data_da')->nullable();
            $table->string('semana')->nullable();
            $table->string('nome')->nullable();
            $table->integer('total_procedimentos')->nullable();
            $table->integer('total_procedimentos_pagos')->nullable();
            $table->integer('proceds_n_pagos')->nullable();
            $table->float('valor_total_pago')->nullable();
            $table->float('valor_medio_pago')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
