<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

class Perfil extends Model
{
    protected $table = 'perfil';
    protected $primaryKey = 'id_perfil';

    protected $fillable = [
        'id_usuario',
        'foto_perfil',
        'biografia',
        'ubicacion',
        'visibilidad'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
    public function experienciasLaborales()
    {
        return $this->hasMany(ExperienciaLaboral::class, 'id_perfil');
    }
    public function habilidades()
    {
        return $this->hasMany(Habilidad::class, 'id_perfil');
    }
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'id_perfil');
    }

    public function formacionAcademica()
    {
        return $this->hasMany(Educacion::class, 'id_perfil');
    }
    public function links()
    {
        return $this->hasMany(PerfilLink::class, 'id_perfil');
    }
}
