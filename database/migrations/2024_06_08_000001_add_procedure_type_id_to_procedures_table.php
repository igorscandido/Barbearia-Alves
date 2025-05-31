<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('procedures', function (Blueprint $table) {
            $table->unsignedBigInteger('procedure_type_id')->nullable()->after('barber_id');
            $table->foreign('procedure_type_id')->references('id')->on('procedure_types')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('procedures', function (Blueprint $table) {
            $table->dropForeign(['procedure_type_id']);
            $table->dropColumn('procedure_type_id');
        });
    }
}; 