<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perfiles', function (Blueprint $table) {
            $table->id();
            // ✅ Especificar la tabla correcta 'usuarios'
            $table->foreignId('user_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('foto', 255)->nullable();
            $table->text('biografia')->nullable();
            $table->json('links')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfiles');
    }
};
