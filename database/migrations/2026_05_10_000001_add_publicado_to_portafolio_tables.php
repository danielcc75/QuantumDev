<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('habilidades', function (Blueprint $table) {
            $table->boolean('publicado')->default(false);
        });

        Schema::table('perfil_habilidad_blanda', function (Blueprint $table) {
            $table->boolean('publicado')->default(false);
        });

        Schema::table('experiencia_laboral', function (Blueprint $table) {
            $table->boolean('publicado')->default(false);
        });

        Schema::table('formacion_academica', function (Blueprint $table) {
            $table->boolean('publicado')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('habilidades', function (Blueprint $table) {
            $table->dropColumn('publicado');
        });

        Schema::table('perfil_habilidad_blanda', function (Blueprint $table) {
            $table->dropColumn('publicado');
        });

        Schema::table('experiencia_laboral', function (Blueprint $table) {
            $table->dropColumn('publicado');
        });

        Schema::table('formacion_academica', function (Blueprint $table) {
            $table->dropColumn('publicado');
        });
    }
};
