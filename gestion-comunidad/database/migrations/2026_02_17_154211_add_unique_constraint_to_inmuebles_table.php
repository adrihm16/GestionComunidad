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
        Schema::table('inmuebles', function (Blueprint $table) {
            // Agregar índice único compuesto para prevenir inmuebles duplicados
            // La combinación de tipo, bloque, piso y puerta debe ser única
            $table->unique(['tipo', 'bloque', 'piso', 'puerta'], 'inmuebles_unique_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inmuebles', function (Blueprint $table) {
            // Eliminar el índice único
            $table->dropUnique('inmuebles_unique_location');
        });
    }
};
