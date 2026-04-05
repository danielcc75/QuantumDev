<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfiles';

    protected $fillable = [
        'user_id',
        'foto',
        'biografia',
        'links'
    ];

    // ✅ Agregar casting para JSON
    protected $casts = [
        'links' => 'array',  // Convierte automáticamente array <-> JSON
    ];

    public function usuario() 
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }
}