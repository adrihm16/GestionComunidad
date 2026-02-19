<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;

    protected $fillable = [
        'concepto',
        'monto',
        'categoria',
        'fecha',
        'descripcion',
        'adjunto_url',
        'registrado_por',
    ];

    protected $casts = [
        'fecha' => 'date',
        'monto' => 'decimal:2',
    ];

    public function registradoPor()
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }

    /**
     * Label helpers for categories
     */
    public static function categoriaLabel(string $cat): string
    {
        return match($cat) {
            'mantenimiento' => 'Mantenimiento',
            'limpieza'      => 'Limpieza',
            'suministros'   => 'Suministros',
            'obras'         => 'Obras',
            default         => 'Otro',
        };
    }

    public static function categoriaBadgeColor(string $cat): string
    {
        return match($cat) {
            'mantenimiento' => 'bg-blue-100 text-blue-700',
            'limpieza'      => 'bg-emerald-100 text-emerald-700',
            'suministros'   => 'bg-amber-100 text-amber-700',
            'obras'         => 'bg-red-100 text-red-700',
            default         => 'bg-gray-100 text-gray-600',
        };
    }
}
