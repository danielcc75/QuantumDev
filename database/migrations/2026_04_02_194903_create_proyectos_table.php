<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea la tabla 'proyectos' que almacena los proyectos asociados al perfil de un usuario.
 * Cada proyecto pertenece a un perfil (relación N:1) e incluye nombre, descripción,
 * enlace, referencias, fechas de inicio/fin y un estado (pendiente, en_progreso,
 * completado, cancelado). Al eliminar un perfil, sus proyectos se eliminan en cascada.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->increments('id_proyecto');
            $table->unsignedInteger('id_perfil');
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->text('url_link')->nullable();
            $table->text('referencias')->nullable();
            $table->date('fecha_ini');
            $table->date('fecha_fin')->nullable();
            $table->enum('estado', ['pendiente', 'en_progreso', 'completado', 'cancelado'])->default('pendiente');
            $table->timestamps();

            $table->foreign('id_perfil')->references('id_perfil')->on('perfil')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
