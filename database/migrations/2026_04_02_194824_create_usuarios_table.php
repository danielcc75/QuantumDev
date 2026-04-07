<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea la tabla 'usuario' que almacena las credenciales y datos personales
 * de los usuarios del sistema. Es la entidad raíz del modelo de datos;
 * todas las demás tablas (perfil, proyectos, etc.) dependen de ella.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->bigIncrements('id_usuario');
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('correo_electronico', 100)->unique();
            $table->string('telefono', 50)->nullable();
            $table->string('contrasenia', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
