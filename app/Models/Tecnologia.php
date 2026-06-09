<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tecnologia extends Model
{
    use SoftDeletes;

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
