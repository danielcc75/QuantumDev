<?php
// app/Models/Usuario.php

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

    public function proyectos() 
    {
        return $this->hasMany(Proyecto::class);
    }

    public function educaciones() 
    {
        return $this->hasMany(Educacion::class);
    }

    // ✅ CORREGIDA - Relación con habilidades del usuario
    public function habilidades()
    {
        return $this->hasMany(UsuarioHabilidad::class, 'user_id')->orderBy('orden');
    }

    // ✅ NUEVA - Relación con experiencias laborales
    public function experienciasLaborales()
    {
        return $this->hasMany(ExperienciaLaboral::class, 'user_id')->orderBy('orden');
    }
}