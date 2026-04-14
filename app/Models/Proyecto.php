<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';
    protected $primaryKey = 'id_proyecto';

    protected $fillable = [
        'id_perfil',
        'id_experiencia',
        'nombre',
        'descripcion',
        'url_link',
        'referencias',
        'fecha_ini',
        'fecha_fin',
        'estado',
        'tecnologias',
        'visible'
    ];

    protected $casts = [
        'fecha_ini' => 'date',
        'fecha_fin' => 'date',
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }

    public function experienciaLaboral()
    {
        return $this->belongsTo(ExperienciaLaboral::class, 'id_experiencia');
    }
}
