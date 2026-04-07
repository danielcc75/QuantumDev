<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea la tabla 'perfil_links' que almacena los enlaces externos de un perfil
 * (GitHub, LinkedIn, portafolio web, etc.). Un perfil puede tener múltiples
 * links (relación 1:N). Al eliminar el perfil, sus links se eliminan en cascada.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perfil_links', function (Blueprint $table) {
            $table->increments('id_link');
            $table->unsignedInteger('id_perfil');
            $table->string('tipo', 50);
            $table->text('url');
            $table->timestamps();

            $table->foreign('id_perfil')->references('id_perfil')->on('perfil')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfil_links');
    }
};
