<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->timestamp('ultimo_acceso')->nullable()->after('estado');
            $table->text('motivo_suspension')->nullable()->after('ultimo_acceso');
        });
    }

    public function down(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropColumn(['ultimo_acceso', 'motivo_suspension']);
        });
    }
};