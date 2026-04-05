<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [
        'user_id',
        'titulo',
        'institucion',
        'nivel',
        'descripcion',
        'fecha_inicio',
        'fecha_fin'
    ];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'user_id');
    }
}
