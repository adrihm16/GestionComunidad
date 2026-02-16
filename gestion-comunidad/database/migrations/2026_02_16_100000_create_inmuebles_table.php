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
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propietario_id')->constrained('users')->onDelete('cascade');
            $table->enum('tipo', ['piso', 'local', 'garaje', 'trastero']);
            $table->string('bloque', 10)->nullable();
            $table->string('piso', 10);
            $table->string('puerta', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inmuebles');
    }
};
