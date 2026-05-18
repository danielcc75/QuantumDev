<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use SoftDeletes;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'apellido',
        'correo_electronico',
        'telefono',
        'contrasenia',
        'estado',
        'motivo_suspension',
        'ultimo_acceso',
        'is_admin',
        'deleted_by',
        'delete_reason',
        'github_id'
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'ultimo_acceso' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = [
        'contrasenia',
    ];

    // Relación con el perfil
    public function perfil()
    {
        return $this->hasOne(Perfil::class, 'id_usuario');
    }

    // Relación con proyectos a través del perfil
    public function proyectos()
    {
        return $this->hasManyThrough(Proyecto::class, Perfil::class, 'id_usuario', 'id_perfil', 'id_usuario', 'id_perfil');
    }

    // Relación con formación académica a través del perfil
    public function formacionAcademica()
    {
        return $this->hasManyThrough(Educacion::class, Perfil::class, 'id_usuario', 'id_perfil', 'id_usuario', 'id_perfil');
    }

    // Relación con habilidades a través del perfil
    public function habilidades()
    {
        return $this->hasManyThrough(Habilidad::class, Perfil::class, 'id_usuario', 'id_perfil', 'id_usuario', 'id_perfil');
    }

    // Relación con experiencias laborales a través del perfil
    public function experienciasLaborales()
    {
        return $this->hasManyThrough(ExperienciaLaboral::class, Perfil::class, 'id_usuario', 'id_perfil', 'id_usuario', 'id_perfil');
    }

    // Relación con quién eliminó el usuario (soft delete)
    public function deletedBy()
    {
        return $this->belongsTo(Usuario::class, 'deleted_by');
    }

    // Verificar si es administrador
    public function isAdmin()
    {
        return $this->is_admin == true;
    }

    // Verificar si la cuenta está activa
    public function isActive()
    {
        return $this->estado == 'activo';
    }

    // Verificar si la cuenta está suspendida
    public function isSuspended()
    {
        return $this->estado == 'suspendido';
    }

    // Obtener nombre completo
    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }
}