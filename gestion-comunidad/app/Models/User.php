<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'password',
        'telefono',
        'rol_sistema',
        'cargo_comunidad',
        'iban',
        'avatar_url',
        'fecha_registro',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'fecha_registro' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Inmuebles que posee el usuario.
     */
    public function inmuebles(): HasMany
    {
        return $this->hasMany(Inmueble::class, 'propietario_id');
    }

    /**
     * Incidencias reportadas por el usuario.
     */
    public function incidencias(): HasMany
    {
        return $this->hasMany(Incidencia::class, 'creador_id');
    }

    /**
     * Noticias publicadas por el usuario (admin).
     */
    public function noticias(): HasMany
    {
        return $this->hasMany(Noticia::class, 'autor_id');
    }

    /**
     * Eventos organizados por el usuario.
     */
    public function eventos(): HasMany
    {
        return $this->hasMany(Evento::class, 'creador_id');
    }
}
