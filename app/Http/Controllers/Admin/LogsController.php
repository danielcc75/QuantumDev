<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index(Request $request)
    {
        $query = AdminLog::with('admin')->orderBy('created_at', 'desc');
        
        if ($request->accion) {
            $query->where('accion', 'like', "%{$request->accion}%");
        }
        
        if ($request->fecha) {
            $query->whereDate('created_at', $request->fecha);
        }
        
        $logs = $query->paginate(30);
        
        $acciones = AdminLog::select('accion')->distinct()->pluck('accion');
        
        return view('admin.logs.index', compact('logs', 'acciones'));
    }
    
    public function export()
    {
        $logs = AdminLog::with('admin')->orderBy('created_at', 'desc')->get();
        
        $filename = "bitacora_" . date('Y-m-d_H-i-s') . ".csv";
        $handle = fopen('php://temp', 'w+');
        
        // Cabeceras
        fputcsv($handle, ['ID', 'ADMIN', 'ACCIÓN', 'DETALLES', 'IP', 'FECHA']);
        
        foreach ($logs as $log) {
            fputcsv($handle, [
                $log->id_log,
                $log->admin ? $log->admin->nombre . ' ' . $log->admin->apellido : 'N/A',
                $log->accion,
                $log->detalles,
                $log->ip_address,
                $log->created_at->format('d/m/Y H:i:s')
            ]);
        }
        
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);
        
        return response($content)
            ->withHeaders([
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ]);
    }
}