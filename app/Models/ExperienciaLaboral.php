<?php
// app/Models/ExperienciaLaboral.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperienciaLaboral extends Model
{
    protected $table = 'experiencias_laborales';

    protected $fillable = [
        'user_id',
        'posicion',
        'empresa',
        'fecha_inicio',
        'fecha_fin',
        'es_trabajo_actual',
        'descripcion',
        'orden'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'es_trabajo_actual' => 'boolean',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }
}