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
            // In SQLite, dropping columns is tricky. Making it nullable is a safe workaround.
            // native SQLite change is supported in Laravel 10+
            $table->unsignedBigInteger('propietario_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inmuebles', function (Blueprint $table) {
            $table->unsignedBigInteger('propietario_id')->nullable(false)->change();
        });
    }
};
