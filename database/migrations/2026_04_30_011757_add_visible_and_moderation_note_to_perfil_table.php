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
        Schema::table('perfil', function (Blueprint $table) {
            $table->boolean('visible')->default(true)->after('ubicacion');
            $table->text('moderation_note')->nullable()->after('visible');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perfil', function (Blueprint $table) {
            //
        });
    }
};
