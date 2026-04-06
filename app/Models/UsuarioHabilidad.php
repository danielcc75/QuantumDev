<?php
// app/Models/UsuarioHabilidad.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioHabilidad extends Model
{
    protected $table = 'usuario_habilidades';  // ← Corregido

    protected $fillable = [
        'user_id',
        'nombre',
        'nivel',
        'orden'
    ];

    protected $casts = [
        'nivel' => 'string',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }
}