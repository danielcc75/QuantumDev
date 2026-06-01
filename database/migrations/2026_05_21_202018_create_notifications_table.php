<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id_notification');
            $table->unsignedBigInteger('id_usuario');
            $table->string('titulo', 200);
            $table->text('mensaje');
            $table->string('tipo', 50)->default('info'); // info, success, warning, error
            $table->string('icono', 50)->nullable(); // fas fa-bell, etc
            $table->string('url')->nullable(); // link al hacer clic
            $table->boolean('leido')->default(false);
            $table->timestamp('leido_at')->nullable();
            $table->timestamps();
            
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->onDelete('cascade');
            $table->index('leido');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};