<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Educacion extends Model
{
    protected $table = 'educaciones';

    protected $fillable = [
        'usuario_id',
        'titulo',
        'institucion',
        'nivel',
        'descripcion',
        'fecha_inicio',
        'fecha_fin'
    ];

    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }
}
