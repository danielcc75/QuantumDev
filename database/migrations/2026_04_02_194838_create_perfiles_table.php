<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea la tabla 'perfil' que extiende la información pública de un usuario.
 * Tiene una relación 1:1 con 'usuario' y actúa como eje central del portafolio:
 * habilidades, proyectos, formación académica y links se vinculan a esta tabla.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perfil', function (Blueprint $table) {
            $table->increments('id_perfil');
            $table->unsignedBigInteger('id_usuario');
            $table->string('foto_perfil', 255)->nullable();
            $table->text('biografia')->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfil');
    }
};
