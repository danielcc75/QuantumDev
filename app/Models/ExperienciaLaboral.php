<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExperienciaLaboral extends Model
{
    use SoftDeletes;

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
        'trabajo_actual',
        'publicado',
        'deleted_by',
        'delete_reason',
    ];

    protected $casts = [
        'fecha_ini' => 'date',
        'fecha_fin' => 'date',
        'trabajo_actual' => 'boolean',
        'publicado' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'id_experiencia');
    }

    public function deletedBy()
    {
        return $this->belongsTo(Usuario::class, 'deleted_by');
    }
}
