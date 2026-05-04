<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('experiencia_laboral', function (Blueprint $table) {
            $table->text('referencias')->nullable()->after('descripcion');
        });
    }

    public function down(): void
    {
        Schema::table('experiencia_laboral', function (Blueprint $table) {
            $table->dropColumn('referencias');
        });
    }
};
