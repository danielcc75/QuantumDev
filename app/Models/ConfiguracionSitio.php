<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionSitio extends Model
{
    protected $table = 'configuracion_sitio';
    protected $primaryKey = 'id_configuracion';

    protected $fillable = [
        'nombre_empresa',
        'descripcion',
        'email_contacto',
        'telefono',
    ];

    public static function actual(): self
    {
        return static::query()->orderBy('id_configuracion')->firstOrCreate([], [
            'nombre_empresa' => 'QuantumDev',
            'descripcion'    => 'Construyendo espacios digitales donde estudiantes y desarrolladores puedan mostrar su talento de forma clara y profesional.',
            'email_contacto' => 'contacto@quantumdev.dev',
            'telefono'       => '+591 700 123 456',
        ]);
    }
}
