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
        Schema::create('procedure_types', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->float('valor');
            $table->unsignedBigInteger('barber_id')->nullable();
            $table->timestamps();
            $table->foreign('barber_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedure_types');
    }
};
