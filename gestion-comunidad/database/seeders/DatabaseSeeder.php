<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Inmueble;
use App\Models\Noticia;
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

        // Noticias
        $noticias = [
            [
                'titulo' => 'Corte de agua programado para el 20 de febrero',
                'contenido' => 'Se informa a todos los vecinos que el próximo jueves 20 de febrero habrá un corte de agua desde las 9:00 hasta las 14:00 por trabajos de mantenimiento en la red general.',
                'adjunto_url' => 'https://picsum.photos/seed/water/800/400',
            ],
            [
                'titulo' => 'Nueva normativa de reciclaje en la comunidad',
                'contenido' => 'A partir del 1 de marzo se implementará un nuevo sistema de reciclaje. Se instalarán contenedores adicionales en el garaje.',
                'adjunto_url' => 'https://picsum.photos/seed/recycle/800/400',
            ],
            [
                'titulo' => 'Acta de la junta ordinaria de enero 2026',
                'contenido' => 'Se adjunta el acta de la última junta ordinaria celebrada el 15 de enero de 2026. Se aprobaron los presupuestos para el nuevo año.',
                'adjunto_url' => null,
            ],
            [
                'titulo' => 'Obras en la fachada: inicio previsto en marzo',
                'contenido' => 'Las obras de rehabilitación de la fachada principal comenzarán a mediados de marzo. Se colocará andamiaje en la zona este del edificio.',
                'adjunto_url' => 'https://picsum.photos/seed/building/800/400',
            ],
        ];

        foreach ($noticias as $i => $n) {
            Noticia::create([
                'autor_id' => $admin->id,
                'titulo' => $n['titulo'],
                'contenido' => $n['contenido'],
                'adjunto_url' => $n['adjunto_url'],
                'fecha_publicacion' => now()->subDays(count($noticias) - $i),
            ]);
        }
    }
}
