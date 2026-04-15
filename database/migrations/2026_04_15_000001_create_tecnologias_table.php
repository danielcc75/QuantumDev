<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea la tabla 'tecnologias' que actúa como catálogo centralizado de tecnologías.
 * Cada tecnología pertenece a una categoría y tiene un nombre único dentro de ella.
 * Permite gestionar el catálogo desde el panel de administración en el futuro.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tecnologias', function (Blueprint $table) {
            $table->increments('id_tecnologia');
            $table->string('nombre', 100);
            $table->string('categoria', 100);
            $table->timestamps();

            $table->unique(['nombre', 'categoria']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tecnologias');
    }
};
