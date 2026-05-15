<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NovedadVista extends Model
{
    protected $table = 'novedades_vistas';

    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'tipo',
        'id_entidad',
    ];

    public const TIPO_TECNOLOGIA = 'tecnologia';
    public const TIPO_CATEGORIA = 'categoria';
    public const TIPO_HABILIDAD_BLANDA = 'habilidad_blanda';
}
