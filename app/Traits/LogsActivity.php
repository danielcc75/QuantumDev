<?php

namespace App\Traits;

use App\Models\AdminLog;

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
}