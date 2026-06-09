<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $table = 'categoria';
    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nombre',
        'imagen',
    ];

    public function habilidades()
    {
        return $this->hasMany(Habilidad::class, 'id_categoria');
    }
}
