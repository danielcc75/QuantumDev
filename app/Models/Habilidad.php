<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Habilidad extends Model
{
    use SoftDeletes;

    protected $table = 'habilidades';
    protected $primaryKey = 'id_habilidad';

    protected $fillable = [
        'id_perfil',
        'id_categoria',
        'nombre',
        'anios_experiencia',
        'descripcion',
        'publicado',
        'deleted_by',
        'delete_reason',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
        'publicado'  => 'boolean',
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil', 'id_perfil');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function deletedBy()
    {
        return $this->belongsTo(Usuario::class, 'deleted_by');
    }
}