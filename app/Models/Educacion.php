<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Educacion extends Model
{
    use SoftDeletes;

    protected $table = 'formacion_academica';
    protected $primaryKey = 'id_formacion';

    protected $fillable = [
        'id_perfil',
        'titulo',
        'institucion',
        'nivel',
        'descripcion',
        'fecha_ini',
        'fecha_fin',
        'deleted_by',
        'delete_reason',
    ];

    protected $casts = [
        'fecha_ini' => 'date',
        'fecha_fin' => 'date',
        'deleted_at' => 'datetime',
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }

    public function deletedBy()
    {
        return $this->belongsTo(Usuario::class, 'deleted_by');
    }
}
