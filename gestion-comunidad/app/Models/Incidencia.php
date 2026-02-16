<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Incidencia extends Model
{
    protected $table = 'incidencias';

    protected $fillable = [
        'creador_id',
        'titulo',
        'descripcion',
        'estado',
        'prioridad',
        'foto_url',
        'fecha_creacion',
        'fecha_actualizacion',
    ];

    protected function casts(): array
    {
        return [
            'fecha_creacion' => 'datetime',
            'fecha_actualizacion' => 'datetime',
        ];
    }

    /**
     * Usuario que reportó la incidencia.
     */
    public function creador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creador_id');
    }

    /**
     * Comentarios de la incidencia.
     */
    public function comentarios(): HasMany
    {
        return $this->hasMany(ComentarioIncidencia::class);
    }
}
