<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sugerencias', function (Blueprint $table) {
            $table->id('id_sugerencia');
            $table->unsignedBigInteger('id_usuario');
            $table->enum('tipo', ['categoria', 'habilidad_blanda', 'tecnologia']);
            $table->string('titulo');
            $table->text('descripcion');
            $table->boolean('leida')->default(false);
            $table->timestamps();

            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sugerencias');
    }
};