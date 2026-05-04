<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE perfil ALTER COLUMN visibilidad SET DEFAULT 'privado'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE perfil ALTER COLUMN visibilidad SET DEFAULT 'publico'");
    }
};
