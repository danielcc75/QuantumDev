<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'password'
    ];

    // RELACIONES
    public function perfil() 
{
    return $this->hasOne(Perfil::class, 'user_id'); 
}

    public function proyectos() {
        return $this->hasMany(Proyecto::class);
    }

    public function educaciones() {
        return $this->hasMany(Educacion::class);
    }

    public function habilidades() {
        return $this->belongsToMany(Habilidad::class, 'usuario_habilidades')
                    ->withPivot('anios_experiencia');
    }
}
