<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperienciaLaboral extends Model
{
    protected $table = 'experiencia_laboral';
    protected $primaryKey = 'id_experiencia';

    protected $fillable = [
        'id_perfil',
        'empresa',
        'cargo',
        'descripcion',
        'referencias',
        'fecha_ini',
        'fecha_fin',
        'trabajo_actual'
    ];

    protected $casts = [
        'fecha_ini' => 'date',
        'fecha_fin' => 'date',
        'trabajo_actual' => 'boolean',
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'id_experiencia');
    }
}
