<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Crear usuario administrador por defecto
        User::create([
            'nombre' => 'Admin',
            'apellidos' => 'Sistema',
            'email' => 'admin@comunidad.com',
            'password' => Hash::make('admin123'),
            'telefono' => '666777888',
            'rol_sistema' => 'admin',
            'cargo_comunidad' => 'Administrador',
            'fecha_registro' => now(),
        ]);

        $this->command->info('Usuario admin creado exitosamente');
        $this->command->info('Email: admin@comunidad.com');
        $this->command->info('Password: admin123');
    }
}
