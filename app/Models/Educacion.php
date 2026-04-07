<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Educacion extends Model
{
    protected $table = 'formacion_academica';
    protected $primaryKey = 'id_formacion';

    protected $fillable = [
        'id_perfil',
        'titulo',
        'institucion',
        'nivel',
        'descripcion',
        'fecha_ini',
        'fecha_fin'
    ];

    protected $casts = [
        'fecha_ini' => 'date',
        'fecha_fin' => 'date',
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }
}
