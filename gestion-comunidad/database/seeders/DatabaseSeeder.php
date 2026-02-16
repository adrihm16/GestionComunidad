<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Inmueble;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin / Presidente
        $admin = User::create([
            'nombre' => 'Carlos',
            'apellidos' => 'García López',
            'email' => 'carlos@comunidad.com',
            'password' => Hash::make('password'),
            'telefono' => '612345678',
            'rol_sistema' => 'admin',
            'cargo_comunidad' => 'Presidente',
            'fecha_registro' => now(),
        ]);
        Inmueble::create([
            'propietario_id' => $admin->id,
            'tipo' => 'piso',
            'bloque' => 'A',
            'piso' => '1',
            'puerta' => 'A',
        ]);

        // Vecinos
        $vecinos = [
            ['nombre' => 'María', 'apellidos' => 'Fernández Ruiz', 'email' => 'maria@comunidad.com', 'piso' => '1', 'puerta' => 'B'],
            ['nombre' => 'Antonio', 'apellidos' => 'Martínez Sánchez', 'email' => 'antonio@comunidad.com', 'piso' => '2', 'puerta' => 'A', 'cargo' => 'Vicepresidente'],
            ['nombre' => 'Laura', 'apellidos' => 'López Díaz', 'email' => 'laura@comunidad.com', 'piso' => '2', 'puerta' => 'B'],
            ['nombre' => 'Javier', 'apellidos' => 'Rodríguez Pérez', 'email' => 'javier@comunidad.com', 'piso' => '3', 'puerta' => 'A', 'cargo' => 'Secretario'],
            ['nombre' => 'Elena', 'apellidos' => 'Sánchez Moreno', 'email' => 'elena@comunidad.com', 'piso' => '3', 'puerta' => 'B'],
            ['nombre' => 'Pablo', 'apellidos' => 'Hernández Gil', 'email' => 'pablo@comunidad.com', 'piso' => '4', 'puerta' => 'A'],
            ['nombre' => 'Ana', 'apellidos' => 'Jiménez Torres', 'email' => 'ana@comunidad.com', 'piso' => '4', 'puerta' => 'B'],
            ['nombre' => 'Diego', 'apellidos' => 'Álvarez Romero', 'email' => 'diego@comunidad.com', 'piso' => '5', 'puerta' => 'A'],
        ];

        foreach ($vecinos as $v) {
            $user = User::create([
                'nombre' => $v['nombre'],
                'apellidos' => $v['apellidos'],
                'email' => $v['email'],
                'password' => Hash::make('password'),
                'telefono' => '6' . rand(10000000, 99999999),
                'rol_sistema' => 'vecino',
                'cargo_comunidad' => $v['cargo'] ?? null,
                'fecha_registro' => now(),
            ]);

            Inmueble::create([
                'propietario_id' => $user->id,
                'tipo' => 'piso',
                'bloque' => 'A',
                'piso' => $v['piso'],
                'puerta' => $v['puerta'],
            ]);
        }
    }
}
