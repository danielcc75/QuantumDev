<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sugerencia extends Model
{
    use HasFactory;

    protected $table = 'sugerencias';
    protected $primaryKey = 'id_sugerencia';

    protected $fillable = [
        'id_usuario',
        'tipo',
        'titulo',
        'descripcion',
        'leida',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}