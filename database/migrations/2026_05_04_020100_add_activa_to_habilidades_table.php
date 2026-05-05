<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('habilidades', function (Blueprint $table) {
            $table->boolean('activa')->default(true)->after('nombre');
        });
    }

    public function down(): void
    {
        Schema::table('habilidades', function (Blueprint $table) {
            $table->dropColumn('activa');
        });
    }
};