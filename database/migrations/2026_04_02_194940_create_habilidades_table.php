<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea la tabla 'habilidades' que registra las competencias técnicas de un perfil.
 * Cada habilidad pertenece a un perfil (N:1) y a una categoría (N:1), e incluye
 * el nombre, años de experiencia y una descripción opcional.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('habilidades', function (Blueprint $table) {
            $table->increments('id_habilidad');
            $table->unsignedInteger('id_perfil');
            $table->unsignedInteger('id_categoria');
            $table->string('nombre', 100);
            $table->smallInteger('anios_experiencia')->unsigned();
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->foreign('id_perfil')->references('id_perfil')->on('perfil')->onDelete('cascade');
            $table->foreign('id_categoria')->references('id_categoria')->on('categoria')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('habilidades');
    }
};
