<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->text('moderation_note')->nullable()->after('visible');
        });

        Schema::table('habilidades', function (Blueprint $table) {
            $table->text('moderation_note')->nullable()->after('activa');
        });
    }

    public function down(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn('moderation_note');
        });

        Schema::table('habilidades', function (Blueprint $table) {
            $table->dropColumn('moderation_note');
        });
    }
};
