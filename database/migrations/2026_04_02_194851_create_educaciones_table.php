<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea la tabla 'formacion_academica' que registra los estudios de un perfil.
 * Incluye título obtenido, institución, nivel educativo (grado, posgrado, etc.),
 * descripción y fechas de inicio/fin. Un perfil puede tener múltiples entradas (1:N).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formacion_academica', function (Blueprint $table) {
            $table->increments('id_formacion');
            $table->unsignedInteger('id_perfil');
            $table->string('titulo', 150);
            $table->string('institucion', 150);
            $table->string('nivel', 50);
            $table->text('descripcion')->nullable();
            $table->date('fecha_ini');
            $table->date('fecha_fin')->nullable();
            $table->timestamps();

            $table->foreign('id_perfil')->references('id_perfil')->on('perfil')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formacion_academica');
    }
};
