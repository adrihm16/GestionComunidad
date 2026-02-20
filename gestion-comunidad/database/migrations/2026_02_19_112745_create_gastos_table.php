<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->string('concepto', 150);
            $table->decimal('monto', 10, 2);
            $table->enum('categoria', ['mantenimiento', 'limpieza', 'suministros', 'obras', 'otro'])->default('otro');
            $table->date('fecha');
            $table->text('descripcion')->nullable();
            $table->string('adjunto_url', 255)->nullable();
            $table->foreignId('registrado_por')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gastos');
    }
};
