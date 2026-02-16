<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComentarioIncidencia extends Model
{
    protected $table = 'comentarios_incidencia';

    protected $fillable = [
        'incidencia_id',
        'user_id',
        'contenido',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function incidencia(): BelongsTo
    {
        return $this->belongsTo(Incidencia::class);
    }
}
