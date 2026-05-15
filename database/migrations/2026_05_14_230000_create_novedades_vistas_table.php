<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('novedades_vistas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_usuario');
            $table->string('tipo', 30); // 'tecnologia' | 'categoria' | 'habilidad_blanda'
            $table->unsignedBigInteger('id_entidad');
            $table->timestamp('created_at')->useCurrent();

            $table->unique(['id_usuario', 'tipo', 'id_entidad'], 'novedades_vistas_unicas');
            $table->index(['id_usuario', 'tipo']);

            $table->foreign('id_usuario')
                ->references('id_usuario')->on('usuario')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('novedades_vistas');
    }
};
