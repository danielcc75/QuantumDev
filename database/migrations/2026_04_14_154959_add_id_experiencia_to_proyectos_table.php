<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega la columna opcional id_experiencia a proyectos,
     * permitiendo que un proyecto esté asociado a una experiencia laboral.
     */
    public function up(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->unsignedInteger('id_experiencia')->nullable()->after('id_perfil');

            $table->foreign('id_experiencia')
                  ->references('id_experiencia')
                  ->on('experiencia_laboral')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropForeign(['id_experiencia']);
            $table->dropColumn('id_experiencia');
        });
    }
};
