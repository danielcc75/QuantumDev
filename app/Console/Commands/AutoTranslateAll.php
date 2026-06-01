<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AutoReplaceViews extends Command
{
    protected $signature = 'views:replace';
    protected $description = 'Reemplaza automáticamente textos por __() en todas las vistas';

    public function handle()
    {
        $viewsPath = resource_path('views');
        $files = File::allFiles($viewsPath);
        $count = 0;
        $totalReemplazos = 0;
        
        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $content = File::get($file);
                $original = $content;
                $reemplazosEnArchivo = 0;
                
                // Buscar textos entre > <
                $content = preg_replace_callback('/>([^<{]+)</', function($matches) use (&$reemplazosEnArchivo) {
                    $text = trim($matches[1]);
                    // Solo reemplazar si tiene más de 2 caracteres y no es código PHP
                    if (strlen($text) > 2 && !str_starts_with($text, '{{') && !str_starts_with($text, '@') && !str_starts_with($text, '<?')) {
                        $reemplazosEnArchivo++;
                        return '>{{ __("' . addslashes($text) . '") }}<';
                    }
                    return $matches[0];
                }, $content);
                
                // Buscar placeholders
                $content = preg_replace_callback('/placeholder="([^"]+)"/', function($matches) use (&$reemplazosEnArchivo) {
                    $text = trim($matches[1]);
                    if (strlen($text) > 2) {
                        $reemplazosEnArchivo++;
                        return 'placeholder="{{ __("' . addslashes($text) . '") }}"';
                    }
                    return $matches[0];
                }, $content);
                
                // Buscar títulos y alt texts
                $content = preg_replace_callback('/(title|alt)="([^"]+)"/', function($matches) use (&$reemplazosEnArchivo) {
                    $text = trim($matches[2]);
                    if (strlen($text) > 2 && !str_starts_with($text, '{{')) {
                        $reemplazosEnArchivo++;
                        return $matches[1] . '="{{ __("' . addslashes($text) . '") }}"';
                    }
                    return $matches[0];
                }, $content);
                
                if ($content !== $original && $reemplazosEnArchivo > 0) {
                    File::put($file->getPathname(), $content);
                    $count++;
                    $totalReemplazos += $reemplazosEnArchivo;
                    $this->info("✅ {$file->getFilename()} - {$reemplazosEnArchivo} reemplazos");
                }
            }
        }
        
        $this->newLine();
        $this->info("🎉 Se modificaron {$count} archivos con {$totalReemplazos} reemplazos totales");
        $this->warn("⚠️ Revisa tus vistas para asegurarte que todo quedó bien");
    }
}