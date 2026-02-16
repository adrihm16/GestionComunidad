<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recibo extends Model
{
    protected $table = 'recibos';

    protected $fillable = [
        'inmueble_id',
        'concepto',
        'monto',
        'fecha_emision',
        'fecha_vencimiento',
        'fecha_pago',
        'estado',
        'url_factura_pdf',
    ];

    protected function casts(): array
    {
        return [
            'monto' => 'decimal:2',
            'fecha_emision' => 'date',
            'fecha_vencimiento' => 'date',
            'fecha_pago' => 'datetime',
        ];
    }

    /**
     * Inmueble al que pertenece el recibo.
     */
    public function inmueble(): BelongsTo
    {
        return $this->belongsTo(Inmueble::class, 'inmueble_id');
    }
}
