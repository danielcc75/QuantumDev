<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $table = 'system_logs';
    protected $primaryKey = 'id_log';
    
    protected $fillable = [
        'id_usuario',
        'tipo',
        'accion',
        'entidad',
        'entidad_id',
        'valores_antes',
        'valores_despues',
        'detalles',
        'ip_address',
        'user_agent'
    ];
    
    protected $casts = [
        'valores_antes' => 'array',
        'valores_despues' => 'array',
    ];
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
    
    // Método estático para registrar logs fácilmente
    public static function registrar($data)
    {
        return self::create(array_merge([
            'id_usuario' => session('usuario_id'),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ], $data));
    }
}