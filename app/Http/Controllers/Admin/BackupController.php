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
    public function index(Request $request)
    {
        $backupPath = storage_path('app/backups');

        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        $files = glob($backupPath . '/*.sql');
        $backups = [];

        foreach ($files as $file) {
            $backups[] = [
                'name' => basename($file),
                'path' => $file,
                'size' => filesize($file),
                'date' => filemtime($file),
                'type' => pathinfo($file, PATHINFO_EXTENSION),
            ];
        }

        usort($backups, fn($a, $b) => $b['date'] - $a['date']);

        // Filtro por rango de fechas del archivo
        $filtroDesde = $request->input('filtro_desde');
        $filtroHasta = $request->input('filtro_hasta');

        if ($filtroDesde) {
            $backups = array_filter($backups, fn($b) => $b['date'] >= strtotime($filtroDesde . ' 00:00:00'));
        }
        if ($filtroHasta) {
            $backups = array_filter($backups, fn($b) => $b['date'] <= strtotime($filtroHasta . ' 23:59:59'));
        }

        $backups = array_values($backups);

        return view('admin.backup.index', compact('backups', 'filtroDesde', 'filtroHasta'));
    }
    
    // Crear backup completo de la base de datos (todas las tablas, sin filtro de fechas)
    public function create(Request $request)
    {
        try {
            $filename   = 'backup_completo_' . date('Y-m-d_H-i-s') . '.sql';
            $backupPath = storage_path('app/backups');

            if (!is_dir($backupPath)) {
                mkdir($backupPath, 0755, true);
            }

            $path = $backupPath . '/' . $filename;

            // Todas las tablas del schema público (excluye tablas internas de Laravel)
            $tables = DB::select("
                SELECT table_name
                FROM information_schema.tables
                WHERE table_schema = 'public'
                  AND table_type = 'BASE TABLE'
                  AND table_name NOT IN (
                      'migrations','password_reset_tokens','personal_access_tokens',
                      'sessions','jobs','failed_jobs','cache','cache_locks',
                      'job_batches','telescope_entries','telescope_entries_tags','telescope_monitoring'
                  )
                ORDER BY table_name
            ");

            $sql  = "-- QuantumDev · Backup completo\n";
            $sql .= "-- Generado: " . date('Y-m-d H:i:s') . "\n";
            $sql .= "-- Base de datos: " . config('database.connections.pgsql.database') . "\n\n";

            $totalRows = 0;

            foreach ($tables as $t) {
                $tableName = $t->table_name;

                try {
                    $rows  = DB::table($tableName)->get();
                    $count = $rows->count();
                    $sql  .= "-- Tabla: {$tableName} ({$count} registros)\n";

                    foreach ($rows as $row) {
                        $data    = (array) $row;
                        $columns = implode(', ', array_map(fn($c) => '"' . $c . '"', array_keys($data)));
                        $values  = implode(', ', array_map(function ($v) {
                            if ($v === null) {
                                return 'NULL';
                            }
                            return "'" . str_replace("'", "''", (string) $v) . "'";
                        }, array_values($data)));

                        $sql .= "INSERT INTO \"{$tableName}\" ({$columns}) VALUES ({$values});\n";
                    }

                    $totalRows += $count;
                    $sql .= "\n";
                } catch (\Exception $e) {
                    $sql .= "-- OMITIDA {$tableName}: " . $e->getMessage() . "\n\n";
                }
            }

            $sql .= "-- Total registros exportados: {$totalRows}\n";

            file_put_contents($path, $sql);

            $this->logAdminAction('backup_creado', "Backup completo: {$filename} ({$totalRows} registros)");

            return back()->with('success', "Backup creado correctamente: {$filename} ({$totalRows} registros). Puedes descargarlo desde la lista.");

        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear backup: ' . $e->getMessage());
        }
    }
    
    // Crear backup filtrado por rango de fechas (genera INSERTs por tabla)
    public function createByDates(Request $request)
    {
        $request->validate([
            'fecha_desde' => 'required|date',
            'fecha_hasta' => 'required|date|after_or_equal:fecha_desde',
        ], [
            'fecha_desde.required' => 'La fecha de inicio es obligatoria.',
            'fecha_hasta.required' => 'La fecha de fin es obligatoria.',
            'fecha_hasta.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la de inicio.',
        ]);

        try {
            $desde = $request->fecha_desde . ' 00:00:00';
            $hasta  = $request->fecha_hasta . ' 23:59:59';

            $label    = $request->fecha_desde . '_al_' . $request->fecha_hasta;
            $filename = 'backup_fechas_' . $label . '_gen_' . date('H-i-s') . '.sql';
            $backupPath = storage_path('app/backups');

            if (!is_dir($backupPath)) {
                mkdir($backupPath, 0755, true);
            }

            $path = $backupPath . '/' . $filename;

            // Tablas del schema público que tienen columna created_at
            $tablesWithDate = DB::select("
                SELECT c.table_name
                FROM information_schema.columns c
                JOIN information_schema.tables t
                    ON t.table_name = c.table_name AND t.table_schema = 'public' AND t.table_type = 'BASE TABLE'
                WHERE c.table_schema = 'public'
                  AND c.column_name = 'created_at'
                  AND c.table_name NOT IN (
                      'migrations','password_reset_tokens','personal_access_tokens',
                      'sessions','jobs','failed_jobs','cache','cache_locks',
                      'job_batches','telescope_entries','telescope_entries_tags','telescope_monitoring'
                  )
                ORDER BY c.table_name
            ");

            $sql  = "-- QuantumDev · Backup por rango de fechas\n";
            $sql .= "-- Desde : {$request->fecha_desde}\n";
            $sql .= "-- Hasta : {$request->fecha_hasta}\n";
            $sql .= "-- Generado: " . date('Y-m-d H:i:s') . "\n\n";

            $totalRows = 0;

            foreach ($tablesWithDate as $t) {
                $tableName = $t->table_name;

                $rows = DB::table($tableName)
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();

                if ($rows->isEmpty()) {
                    continue;
                }

                $count      = $rows->count();
                $totalRows += $count;
                $sql .= "-- Tabla: {$tableName} ({$count} registros)\n";

                foreach ($rows as $row) {
                    $data    = (array) $row;
                    $columns = implode(', ', array_map(fn($c) => '"' . $c . '"', array_keys($data)));
                    $values  = implode(', ', array_map(function ($v) {
                        if ($v === null) {
                            return 'NULL';
                        }
                        return "'" . str_replace("'", "''", (string) $v) . "'";
                    }, array_values($data)));

                    $sql .= "INSERT INTO \"{$tableName}\" ({$columns}) VALUES ({$values});\n";
                }

                $sql .= "\n";
            }

            if ($totalRows === 0) {
                return back()->with('error', "No se encontraron registros entre el {$request->fecha_desde} y el {$request->fecha_hasta}.");
            }

            $sql .= "-- Total registros exportados: {$totalRows}\n";

            file_put_contents($path, $sql);

            $this->logAdminAction(
                'backup_por_fechas',
                "Backup {$request->fecha_desde} al {$request->fecha_hasta}: {$filename} ({$totalRows} registros)"
            );

            return back()->with('success', "Backup creado correctamente: {$filename} ({$totalRows} registros). Puedes descargarlo desde la lista.");

        } catch (\Exception $e) {
            return back()->with('error', 'Error al generar el backup: ' . $e->getMessage());
        }
    }

    // Descargar backup existente
    public function download(Request $request)
    {
        $filename = $request->query('file', '');

        if (!preg_match('/^[A-Za-z0-9._-]+\.sql$/', $filename) || str_contains($filename, '..')) {
            return back()->with('error', 'Nombre de backup inválido');
        }

        $path = storage_path('app/backups/' . $filename);

        if (file_exists($path)) {
            $this->logAdminAction('backup_descargado', "Backup descargado: {$filename}");
            return response()->download($path, $filename, [
                'Content-Type' => 'application/octet-stream',
            ]);
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