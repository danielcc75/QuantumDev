<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    protected $table = 'admin_logs';
    protected $primaryKey = 'id_log';
    
    protected $fillable = [
        'id_admin',
        'accion',
        'detalles',
        'ip_address'
    ];
    
    public function admin()
    {
        return $this->belongsTo(Usuario::class, 'id_admin');
    }
}