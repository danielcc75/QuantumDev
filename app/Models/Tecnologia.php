<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tecnologia extends Model
{
    protected $table      = 'tecnologias';
    protected $primaryKey = 'id_tecnologia';

    protected $fillable = [
        'nombre',
        'categoria',
    ];

    public function proyectos()
    {
        return $this->belongsToMany(
            Proyecto::class,
            'proyecto_tecnologia',
            'id_tecnologia',
            'id_proyecto'
        );
    }
}
