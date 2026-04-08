<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
    protected $table      = 'habilidades';
    protected $primaryKey = 'id_habilidad';

    protected $fillable = [
        'id_perfil',
        'id_categoria',
        'nombre',
        'anios_experiencia',
        'descripcion',
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
