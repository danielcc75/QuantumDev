<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_logs', function (Blueprint $table) {
            $table->increments('id_log');
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->string('tipo', 50); // admin_action, user_action, system_error, security
            $table->string('accion', 100); // login, logout, create, update, delete, suspend, restore
            $table->string('entidad', 50)->nullable(); // usuario, proyecto, habilidad, perfil
            $table->unsignedInteger('entidad_id')->nullable();
            $table->json('valores_antes')->nullable();
            $table->json('valores_despues')->nullable();
            $table->text('detalles')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
            
            // Índices
            $table->index('tipo');
            $table->index('accion');
            $table->index('created_at');
            $table->index('id_usuario');
            $table->index(['entidad', 'entidad_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_logs');
    }
};