<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackupController extends Controller
{
    use LogsActivity;
    
    // Listar backups disponibles
    public function index()
    {
        $backups = [];
        
        // 👈 RUTA CORRECTA (está en app/backups, no en private)
        $backupPath = storage_path('app/backups');
        
        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0755, true);
        }
        
        $files = glob($backupPath . '/*.sql');
        
        foreach ($files as $file) {
            $backups[] = [
                'name' => basename($file),
                'path' => $file,
                'size' => filesize($file),
                'date' => filemtime($file),
                'type' => pathinfo($file, PATHINFO_EXTENSION)
            ];
        }
        
        // Ordenar por fecha descendente (más reciente primero)
        usort($backups, function($a, $b) {
            return $b['date'] - $a['date'];
        });
        
        return view('admin.backup.index', compact('backups'));
    }
    
    // Crear backup de la base de datos
    public function create(Request $request)
    {
        try {
            $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
            
            // 👈 RUTA CORRECTA
            $backupPath = storage_path('app/backups');
            
            if (!is_dir($backupPath)) {
                mkdir($backupPath, 0755, true);
            }
            
            $path = $backupPath . '/' . $filename;
            
            // Obtener configuración de BD
            $dbName = config('database.connections.pgsql.database');
            $dbUser = config('database.connections.pgsql.username');
            $dbHost = config('database.connections.pgsql.host');
            $dbPassword = config('database.connections.pgsql.password');
            
            // Comando pg_dump
            $command = "PGPASSWORD='{$dbPassword}' pg_dump -h {$dbHost} -U {$dbUser} -d {$dbName} > {$path} 2>&1";
            
            exec($command, $output, $returnCode);
            
            if ($returnCode === 0 && file_exists($path) && filesize($path) > 0) {
                $this->logAdminAction('backup_creado', "Backup: {$filename}");
                return response()->download($path)->deleteFileAfterSend(true);
            } else {
                $error = implode("\n", $output);
                throw new \Exception("Error: {$error}");
            }
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear backup: ' . $e->getMessage());
        }
    }
    
    // Descargar backup existente
    public function download($filename)
    {
        $path = storage_path('app/backups/' . $filename);
        
        if (file_exists($path)) {
            $this->logAdminAction('backup_descargado', "Backup descargado: {$filename}");
            return response()->download($path);
        }
        
        return back()->with('error', 'Backup no encontrado');
    }
    
    // Eliminar backup
    public function destroy($filename)
    {
        $path = storage_path('app/backups/' . $filename);
        
        if (file_exists($path)) {
            unlink($path);
            $this->logAdminAction('backup_eliminado', "Backup eliminado: {$filename}");
            return back()->with('success', 'Backup eliminado correctamente');
        }
        
        return back()->with('error', 'Backup no encontrado');
    }
}