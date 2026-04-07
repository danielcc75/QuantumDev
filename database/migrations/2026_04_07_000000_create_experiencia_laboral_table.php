<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea la tabla 'experiencia_laboral' que registra el historial laboral de un perfil.
 * Incluye empresa, cargo, descripción, fechas de inicio/fin y un indicador
 * de si es el trabajo actual. Un perfil puede tener múltiples experiencias (1:N).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experiencia_laboral', function (Blueprint $table) {
            $table->increments('id_experiencia');
            $table->unsignedInteger('id_perfil');
            $table->string('empresa', 150);
            $table->string('cargo', 100);
            $table->text('descripcion')->nullable();
            $table->date('fecha_ini');
            $table->date('fecha_fin')->nullable();
            $table->boolean('trabajo_actual')->default(false);
            $table->timestamps();

            $table->foreign('id_perfil')->references('id_perfil')->on('perfil')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiencia_laboral');
    }
};
