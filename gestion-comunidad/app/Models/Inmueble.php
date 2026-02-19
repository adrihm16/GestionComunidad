<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inmueble extends Model
{
    protected $table = 'inmuebles';

    protected $fillable = [
        'tipo',
        'bloque',
        'piso',
        'puerta',
    ];

    /**
     * Propietarios del inmueble.
     */
    public function propietarios()
    {
        return $this->belongsToMany(User::class, 'inmueble_user', 'inmueble_id', 'user_id');
    }

    /**
     * Recibos generados por este inmueble.
     */
    public function recibos(): HasMany
    {
        return $this->hasMany(Recibo::class, 'inmueble_id');
    }
}
