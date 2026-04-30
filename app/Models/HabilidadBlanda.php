<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HabilidadBlanda extends Model
{
    protected $table = 'habilidades_blandas';
    protected $primaryKey = 'id_habilidad_blanda';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'
    ];
}
