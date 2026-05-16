<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configuracion_sitio', function (Blueprint $table) {
            $table->increments('id_configuracion');
            $table->string('nombre_empresa', 100);
            $table->text('descripcion');
            $table->string('email_contacto', 150);
            $table->string('telefono', 30);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuracion_sitio');
    }
};
