<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Inmueble;
use App\Models\Noticia;
use App\Models\Evento;
use App\Models\Incidencia;
use App\Models\ComentarioIncidencia;
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
        $inmuebleAdmin = Inmueble::create([
            'tipo' => 'piso',
            'bloque' => 'A',
            'piso' => '1',
            'puerta' => 'A',
        ]);
        $admin->inmuebles()->attach($inmuebleAdmin->id);

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

        $vecinoUsers = [];
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

            $inmuebleVecino = Inmueble::create([
                'tipo' => 'piso',
                'bloque' => 'A',
                'piso' => $v['piso'],
                'puerta' => $v['puerta'],
            ]);
            $user->inmuebles()->attach($inmuebleVecino->id);

            $vecinoUsers[] = $user;
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

        // Eventos
        $eventos = [
            [
                'titulo' => 'Revisión extintores',
                'descripcion' => 'Revisión anual de los extintores del edificio por empresa homologada.',
                'fecha_inicio' => '2026-02-10 10:00:00',
                'fecha_fin' => '2026-02-10 12:00:00',
                'tipo' => 'mantenimiento',
            ],
            [
                'titulo' => 'Mantenimiento ascensor',
                'descripcion' => 'Mantenimiento preventivo del ascensor principal.',
                'fecha_inicio' => '2026-02-20 09:00:00',
                'fecha_fin' => '2026-02-20 11:00:00',
                'tipo' => 'mantenimiento',
            ],
            [
                'titulo' => 'Junta ordinaria de vecinos',
                'descripcion' => 'Junta ordinaria para revisión de presupuestos y aprobación de obras.',
                'fecha_inicio' => '2026-02-28 18:00:00',
                'fecha_fin' => '2026-02-28 20:00:00',
                'tipo' => 'junta',
            ],
            [
                'titulo' => 'Reunión junta directiva',
                'descripcion' => 'Reunión de la junta directiva para planificación trimestral.',
                'fecha_inicio' => '2026-03-05 17:00:00',
                'fecha_fin' => '2026-03-05 19:00:00',
                'tipo' => 'junta',
            ],
            [
                'titulo' => 'Inicio obras fachada',
                'descripcion' => 'Comienzo de las obras de rehabilitación de la fachada principal.',
                'fecha_inicio' => '2026-03-15 08:00:00',
                'fecha_fin' => '2026-03-20 18:00:00',
                'tipo' => 'obra',
            ],
        ];

        foreach ($eventos as $e) {
            Evento::create([
                'creador_id' => $admin->id,
                'titulo' => $e['titulo'],
                'descripcion' => $e['descripcion'],
                'fecha_inicio' => $e['fecha_inicio'],
                'fecha_fin' => $e['fecha_fin'],
                'tipo' => $e['tipo'],
            ]);
        }

        // Incidencias
        $incidencias = [
            [
                'creador_id' => $vecinoUsers[0]->id,
                'titulo' => 'Fuga de agua en el garaje',
                'descripcion' => 'Se ha detectado una fuga de agua en la plaza nº 5 del garaje. El agua parece provenir de una tubería del techo. Es necesario reparar urgentemente para evitar daños.',
                'estado' => 'pendiente',
                'prioridad' => 'alta',
                'foto_url' => 'https://picsum.photos/seed/leak/800/400',
            ],
            [
                'creador_id' => $vecinoUsers[2]->id,
                'titulo' => 'Bombilla fundida en el portal',
                'descripcion' => 'La bombilla del segundo tramo de escaleras entre la planta 2 y 3 está fundida. La zona queda muy oscura por la noche.',
                'estado' => 'en_proceso',
                'prioridad' => 'baja',
                'foto_url' => null,
            ],
            [
                'creador_id' => $vecinoUsers[4]->id,
                'titulo' => 'Puerta del portal no cierra correctamente',
                'descripcion' => 'La puerta principal del portal no cierra bien desde hace varios días. El mecanismo de cierre automático parece estar averiado, lo que supone un riesgo de seguridad.',
                'estado' => 'resuelta',
                'prioridad' => 'media',
                'foto_url' => 'https://picsum.photos/seed/door/800/400',
            ],
            [
                'creador_id' => $vecinoUsers[1]->id,
                'titulo' => 'Ruido excesivo en horario nocturno',
                'descripcion' => 'Durante las últimas semanas se producen ruidos excesivos en el piso 4º A entre las 23:00 y las 2:00. Solicito que se tome alguna medida.',
                'estado' => 'pendiente',
                'prioridad' => 'media',
                'foto_url' => null,
            ],
        ];

        $incidenciaModels = [];
        foreach ($incidencias as $i => $inc) {
            $incidenciaModels[] = Incidencia::create([
                'creador_id' => $inc['creador_id'],
                'titulo' => $inc['titulo'],
                'descripcion' => $inc['descripcion'],
                'estado' => $inc['estado'],
                'prioridad' => $inc['prioridad'],
                'foto_url' => $inc['foto_url'],
                'fecha_creacion' => now()->subDays(count($incidencias) - $i),
                'fecha_actualizacion' => now()->subDays(count($incidencias) - $i),
            ]);
        }

        // Comentarios en incidencias
        ComentarioIncidencia::create([
            'incidencia_id' => $incidenciaModels[0]->id,
            'user_id' => $admin->id,
            'contenido' => 'Ya hemos contactado con el fontanero. Vendrá mañana a revisar la tubería.',
        ]);
        ComentarioIncidencia::create([
            'incidencia_id' => $incidenciaModels[0]->id,
            'user_id' => $vecinoUsers[0]->id,
            'contenido' => 'Perfecto, muchas gracias por la rapidez. La fuga es en la zona derecha del techo.',
        ]);
        ComentarioIncidencia::create([
            'incidencia_id' => $incidenciaModels[1]->id,
            'user_id' => $vecinoUsers[3]->id,
            'contenido' => 'Yo también he notado que falta luz en esa zona. Podrían revisar también la del piso 4.',
        ]);
    }
}
