<?php

use App\Http\Controllers\UsuarioWebController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\HabilidadController;
use Illuminate\Support\Facades\Route;

// =========================
// HOME
// =========================
Route::get('/', function () {
    return view('home.welcome');
});

// =========================
// AUTH
// =========================
Route::post('/login', [UsuarioWebController::class, 'login'])->name('login.store');
Route::post('/register', [UsuarioWebController::class, 'store'])->name('register.store');
Route::post('/logout', [UsuarioWebController::class, 'logout'])->name('logout');
Route::get('/dashboard', [UsuarioWebController::class, 'dashboard'])->name('dashboard');

// =========================
// USUARIOS CRUD
// =========================
Route::get('/usuarios', [UsuarioWebController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuarioWebController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioWebController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id}', [UsuarioWebController::class, 'show'])->name('usuarios.show');
Route::get('/usuarios/{id}/edit', [UsuarioWebController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [UsuarioWebController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [UsuarioWebController::class, 'destroy'])->name('usuarios.destroy');

// =========================
// PROYECTOS CRUD
// =========================
Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');
Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
Route::put('/proyectos/{id}', [ProyectoController::class, 'update'])->name('proyectos.update');
Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');


// CRUD Proyectos (usado por AJAX desde el dashboard)
Route::get('/proyectos',         [ProyectoController::class, 'index'])->name('proyectos.index');
Route::get('/proyectos/{id}',    [ProyectoController::class, 'show'])->name('proyectos.show');
Route::post('/proyectos',        [ProyectoController::class, 'store'])->name('proyectos.store');
Route::put('/proyectos/{id}',    [ProyectoController::class, 'update'])->name('proyectos.update');
Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');

// Perfil 2
Route::get('/mi-perfil', [UsuarioWebController::class, 'verPerfil'])->name('perfil.ver');
Route::get('/mi-perfil/editar', [UsuarioWebController::class, 'editarPerfil'])->name('perfil.editar');
Route::put('/mi-perfil', [UsuarioWebController::class, 'actualizarPerfil'])->name('perfil.actualizar');

// Experiencia Laboral
Route::get('/perfil/experiencia/{id}', [App\Http\Controllers\ExperienciaController::class, 'show'])->name('perfil.experiencia.mostrar');
Route::post('/perfil/experiencia', [App\Http\Controllers\ExperienciaController::class, 'store'])->name('perfil.experiencia.guardar');
Route::put('/perfil/experiencia/{id}', [App\Http\Controllers\ExperienciaController::class, 'update'])->name('perfil.experiencia.actualizar');
Route::delete('/perfil/experiencia/{id}', [App\Http\Controllers\ExperienciaController::class, 'destroy'])->name('perfil.experiencia.eliminar');


// Formación Académica
Route::get('/perfil/educacion/{id}', [App\Http\Controllers\EducacionController::class, 'show']);  // ← NUEVA
Route::post('/perfil/educacion', [App\Http\Controllers\EducacionController::class, 'store']);
Route::put('/perfil/educacion/{id}', [App\Http\Controllers\EducacionController::class, 'update']);
Route::delete('/perfil/educacion/{id}', [App\Http\Controllers\EducacionController::class, 'destroy']);

// =========================
// HABILIDADES CRUD (CORREGIDO)
// =========================

// crear + listar formulario
Route::get('/habilidades', [HabilidadController::class, 'create'])
    ->name('habilidades.create');

// guardar nueva habilidad
Route::post('/habilidades', [HabilidadController::class, 'store'])
    ->name('habilidades.store');

// editar
Route::get('/habilidades/{id}/edit', [HabilidadController::class, 'edit'])
    ->name('habilidades.edit');

// actualizar
Route::put('/habilidades/{id}', [HabilidadController::class, 'update'])
    ->name('habilidades.update');

// eliminar
Route::delete('/habilidades/{id}', [HabilidadController::class, 'destroy'])
    ->name('habilidades.destroy');

