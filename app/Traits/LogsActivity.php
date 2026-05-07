<?php

namespace App\Traits;

use App\Models\AdminLog;
use App\Models\SystemLog;

trait LogsActivity
{
    protected function logAdminAction($accion, $detalles = null)
    {
        AdminLog::create([
            'id_admin' => session('usuario_id'),
            'accion' => $accion,
            'detalles' => $detalles,
            'ip_address' => request()->ip()
        ]);
    }

    protected function logSecurity($accion, $detalles = null)
    {
        SystemLog::registrar([
            'tipo' => 'seguridad',
            'accion' => $accion,
            'detalles' => $detalles,
        ]);
    }
}