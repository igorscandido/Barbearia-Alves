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
        Schema::create('procedures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tipo');
            $table->timestamp('agendado_em')->nullable();
            $table->timestamp('data')->nullable();
            $table->string('status');
            $table->float('valor');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('barber_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('barber_id')->references('id')->on('barbers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedures');
    }
};
