<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PerfilController;

/*
|--------------------------------------------------------------------------
| Rutas API deshabilitadas (riesgo de integridad / seguridad)
|--------------------------------------------------------------------------
| Estos apiResource exponían CRUD completo SIN autenticación. En concreto,
| DELETE /api/perfiles/{id} ejecutaba un borrado físico del perfil que, por
| las llaves foráneas onDelete('cascade'), eliminaba de forma permanente
| TODO el portafolio del usuario (proyectos, habilidades, experiencia,
| educación y enlaces). El frontend no utiliza ninguna de estas rutas: la
| aplicación opera a través de routes/web.php. Se dejan comentadas para
| evitar pérdidas de datos. Si en el futuro se necesita una API, debe
| protegerse con autenticación y reemplazar el borrado físico por
| desactivación lógica (soft delete), como en el resto del sistema.
|
| Route::apiResource('proyectos', ProyectoController::class)->names('api.proyectos');
| Route::apiResource('usuarios', UsuarioController::class)->names('api.usuarios');
| Route::apiResource('perfiles', PerfilController::class)->names('api.perfiles');
*/
