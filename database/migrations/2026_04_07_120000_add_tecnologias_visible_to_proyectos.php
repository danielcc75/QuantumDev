<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Agrega 'tecnologias' (lista separada por comas) y 'visible' (visibilidad pública)
 * a la tabla proyectos para soportar etiquetas de stack y control de visibilidad.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->text('tecnologias')->nullable()->after('referencias');
            $table->boolean('visible')->default(true)->after('tecnologias');
        });
    }

    public function down(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn(['tecnologias', 'visible']);
        });
    }
};
