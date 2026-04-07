<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'apellido',
        'correo_electronico',
        'telefono',
        'contrasenia'
    ];

    public function perfil()
    {
        return $this->hasOne(Perfil::class, 'id_usuario');
    }

    public function proyectos()
    {
        return $this->hasManyThrough(Proyecto::class, Perfil::class, 'id_usuario', 'id_perfil', 'id_usuario', 'id_perfil');
    }

    public function formacionAcademica()
    {
        return $this->hasManyThrough(Educacion::class, Perfil::class, 'id_usuario', 'id_perfil', 'id_usuario', 'id_perfil');
    }

    public function habilidades()
    {
        return $this->hasManyThrough(UsuarioHabilidad::class, Perfil::class, 'id_usuario', 'id_perfil', 'id_usuario', 'id_perfil');
    }

    public function experienciasLaborales()
    {
        return $this->hasManyThrough(ExperienciaLaboral::class, Perfil::class, 'id_usuario', 'id_perfil', 'id_usuario', 'id_perfil');
    }
}
