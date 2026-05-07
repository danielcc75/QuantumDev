<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_logs', function (Blueprint $table) {
            $table->increments('id_log');
            $table->unsignedBigInteger('id_admin');
            $table->string('accion', 100);
            $table->text('detalles')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
            
            $table->foreign('id_admin')->references('id_usuario')->on('usuario')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_logs');
    }
};