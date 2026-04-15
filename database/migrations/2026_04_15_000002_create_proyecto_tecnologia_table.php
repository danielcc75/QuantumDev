<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabla pivote que relaciona proyectos con tecnologías (N:M).
 * Un proyecto puede usar muchas tecnologías y una tecnología
 * puede aparecer en muchos proyectos.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyecto_tecnologia', function (Blueprint $table) {
            $table->unsignedInteger('id_proyecto');
            $table->unsignedInteger('id_tecnologia');

            $table->primary(['id_proyecto', 'id_tecnologia']);

            $table->foreign('id_proyecto')
                  ->references('id_proyecto')
                  ->on('proyectos')
                  ->onDelete('cascade');

            $table->foreign('id_tecnologia')
                  ->references('id_tecnologia')
                  ->on('tecnologias')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyecto_tecnologia');
    }
};
