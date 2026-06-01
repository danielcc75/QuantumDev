<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id_notification';
    
    protected $fillable = [
        'id_usuario',
        'titulo',
        'mensaje',
        'tipo',
        'icono',
        'url',
        'leido',
        'leido_at'
    ];
    
    protected $casts = [
        'leido' => 'boolean',
        'leido_at' => 'datetime',
        'created_at' => 'datetime',
    ];
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
    
    // Marcar como leído
    public function marcarComoLeido()
    {
        $this->leido = true;
        $this->leido_at = now();
        $this->save();
    }
    
    // Scope para no leídas
    public function scopeNoLeidas($query)
    {
        return $query->where('leido', false);
    }
    
    // Scope por tipo
    public function scopeTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }
}