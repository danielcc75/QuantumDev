<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{
    use SoftDeletes;

    protected $table = 'proyectos';
    protected $primaryKey = 'id_proyecto';

    protected $fillable = [
        'id_perfil',
        'id_experiencia',
        'nombre',
        'descripcion',
        'url_link',
        'referencias',
        'fecha_ini',
        'fecha_fin',
        'estado',
        'tecnologias',
        'visible',
        'destacado',
        'moderation_note',
        'deleted_by',
        'delete_reason'
    ];

    protected $casts = [
        'fecha_ini' => 'date',
        'fecha_fin' => 'date',
        'visible' => 'boolean',
        'destacado' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    // Relación con el perfil del usuario
    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }

    // Relación con experiencia laboral (opcional)
    public function experienciaLaboral()
    {
        return $this->belongsTo(ExperienciaLaboral::class, 'id_experiencia');
    }

    // Relación con tecnologías (muchos a muchos)
    public function tecnologias()
    {
        return $this->belongsToMany(
            Tecnologia::class,
            'proyecto_tecnologia',
            'id_proyecto',
            'id_tecnologia'
        );
    }

    // Relación con quién eliminó el proyecto (soft delete)
    public function deletedBy()
    {
        return $this->belongsTo(Usuario::class, 'deleted_by');
    }

    // Scopes para consultas comunes
    public function scopePublicos($query)
    {
        return $query->where('visible', true);
    }

    public function scopePrivados($query)
    {
        return $query->where('visible', false);
    }

    public function scopeDestacados($query)
    {
        return $query->where('destacado', true);
    }

    public function scopeCompletados($query)
    {
        return $query->where('estado', 'completado');
    }

    public function scopeEnProgreso($query)
    {
        return $query->where('estado', 'en_progreso');
    }

    // Métodos helpers
    public function isPublic()
    {
        return $this->visible == true;
    }

    public function isPrivate()
    {
        return $this->visible == false;
    }

    public function isDestacado()
    {
        return $this->destacado == true;
    }

    public function isCompletado()
    {
        return $this->estado == 'completado';
    }

    public function isEnProgreso()
    {
        return $this->estado == 'en_progreso';
    }

    // Obtener nombre con límite de caracteres
    public function getNombreCortoAttribute()
    {
        return strlen($this->nombre) > 50 ? substr($this->nombre, 0, 47) . '...' : $this->nombre;
    }
}