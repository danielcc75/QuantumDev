<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AutoTranslateViews extends Command
{
    protected $signature = 'translate:views';
    protected $description = 'Reemplaza textos por __() en todas las vistas';

    public function handle()
    {
        $this->info("🔍 Escaneando vistas...");
        
        $files = File::allFiles(resource_path('views'));
        $count = 0;
        
        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $path = $file->getPathname();
                $content = File::get($path);
                $newContent = $content;
                
                // Reemplazar textos
                $newContent = preg_replace_callback('/>([^<{]+)</', function($m) {
                    $text = trim($m[1]);
                    if (strlen($text) > 2 && $text[0] !== '{{' && $text[0] !== '@') {
                        return '>{{ __("' . addslashes($text) . '") }}<';
                    }
                    return $m[0];
                }, $newContent);
                
                if ($newContent !== $content) {
                    File::put($path, $newContent);
                    $count++;
                    $this->info("✅ Modificado: " . $file->getFilename());
                }
            }
        }
        
        $this->info("🎉 Se modificaron {$count} archivos");
    }
}