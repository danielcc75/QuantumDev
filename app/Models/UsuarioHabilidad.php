<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioHabilidad extends Model
{
    protected $table = 'habilidades';

    protected $fillable = [
        'nombre',
        'categoria',
        'descripcion'
    ];

    public function usuarios() {
        return $this->belongsToMany(Usuario::class, 'usuario_habilidades')
                    ->withPivot('anios_experiencia');
    }
}
