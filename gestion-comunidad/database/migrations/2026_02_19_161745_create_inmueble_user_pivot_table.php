<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('inmueble_user');
        
        Schema::create('inmueble_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('inmueble_id')->constrained('inmuebles')->onDelete('cascade');
            $table->unique(['user_id', 'inmueble_id']);
            $table->timestamps();
        });

        // Migrate existing data
        $inmuebles = DB::table('inmuebles')->whereNotNull('propietario_id')->get();
        foreach ($inmuebles as $inmueble) {
            DB::table('inmueble_user')->insert([
                'user_id' => $inmueble->propietario_id,
                'inmueble_id' => $inmueble->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Drop the old column - Commented out for SQLite compatibility
        /*
        Schema::table('inmuebles', function (Blueprint $table) {
            $table->dropColumn('propietario_id');
        });
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inmuebles', function (Blueprint $table) {
            $table->unsignedBigInteger('propietario_id')->nullable()->after('id');
        });

        // Restore data if possible (at least one owner)
        $pivots = DB::table('inmueble_user')->get();
        foreach ($pivots as $pivot) {
            DB::table('inmuebles')
                ->where('id', $pivot->inmueble_id)
                ->update(['propietario_id' => $pivot->user_id]);
        }

        Schema::dropIfExists('inmueble_user');
    }
};
