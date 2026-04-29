<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perfil_habilidad_blanda', function (Blueprint $table) {
            $table->bigIncrements('id_perfil_habilidad_blanda');

            $table->unsignedBigInteger('id_perfil');
            $table->unsignedBigInteger('id_habilidad_blanda');

            $table->timestamps();

            // relaciones
            $table->foreign('id_perfil')
                  ->references('id_perfil')
                  ->on('perfil')
                  ->onDelete('cascade');

            $table->foreign('id_habilidad_blanda')
                  ->references('id_habilidad_blanda')
                  ->on('habilidades_blandas')
                  ->onDelete('cascade');

            // evitar duplicados
            $table->unique(['id_perfil', 'id_habilidad_blanda']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfil_habilidad_blanda');
    }
};