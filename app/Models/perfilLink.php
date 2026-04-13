<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilLink extends Model
{
    protected $table = 'perfil_links';
    protected $primaryKey = 'id_link';

    protected $fillable = [
        'id_perfil',
        'tipo',
        'url'
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }
}