<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inmueble extends Model
{
    protected $table = 'inmuebles';

    protected $fillable = [
        'propietario_id',
        'tipo',
        'bloque',
        'piso',
        'puerta',
    ];

    /**
     * Propietario del inmueble.
     */
    public function propietario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'propietario_id');
    }

    /**
     * Recibos generados por este inmueble.
     */
    public function recibos(): HasMany
    {
        return $this->hasMany(Recibo::class, 'inmueble_id');
    }
}
