<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilHabilidadBlanda extends Model
{
    protected $table = 'perfil_habilidad_blanda';
    protected $primaryKey = 'id_perfil_habilidad_blanda';

    protected $fillable = [
        'id_perfil',
        'id_habilidad_blanda',
        'publicado',
    ];

    protected $casts = [
        'publicado' => 'boolean',
    ];
}