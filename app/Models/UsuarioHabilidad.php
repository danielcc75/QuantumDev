<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioHabilidad extends Model
{
    protected $table = 'habilidades';
    protected $primaryKey = 'id_habilidad';

    protected $fillable = [
        'id_perfil',
        'id_categoria',
        'nombre',
        'anios_experiencia',
        'descripcion'
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }
}
