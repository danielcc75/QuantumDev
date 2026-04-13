<?php

use App\Http\Controllers\UsuarioWebController;
use App\Http\Controllers\ProyectoController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('home.welcome');
});

// Rutas de autenticación
Route::post('/login', [UsuarioWebController::class, 'login'])->name('login.store');
Route::post('/register', [UsuarioWebController::class, 'store'])->name('register.store');
Route::post('/logout', [UsuarioWebController::class, 'logout'])->name('logout');
Route::get('/dashboard', [UsuarioWebController::class, 'dashboard'])->name('dashboard');

// ==========================================
// GESTIÓN DE USUARIOS - RUTAS WEB
// ==========================================

// Listar todos los usuarios (INDEX)
Route::get('/usuarios', [UsuarioWebController::class, 'index'])->name('usuarios.index');

// Mostrar formulario de creación (CREATE)
Route::get('/usuarios/create', [UsuarioWebController::class, 'create'])->name('usuarios.create');

// Guardar nuevo usuario (STORE)
Route::post('/usuarios', [UsuarioWebController::class, 'store'])->name('usuarios.store');

// Mostrar un usuario específico (SHOW)
Route::get('/usuarios/{id}', [UsuarioWebController::class, 'show'])->name('usuarios.show');

// Mostrar formulario de edición (EDIT)
Route::get('/usuarios/{id}/edit', [UsuarioWebController::class, 'edit'])->name('usuarios.edit');

// Actualizar usuario (UPDATE)
Route::put('/usuarios/{id}', [UsuarioWebController::class, 'update'])->name('usuarios.update');

// Eliminar usuario (DESTROY)
Route::delete('/usuarios/{id}', [UsuarioWebController::class, 'destroy'])->name('usuarios.destroy');

// Rutas para el perfil
Route::get('/usuarios/{id}/perfil', [UsuarioWebController::class, 'editPerfil'])->name('usuarios.perfil');
Route::put('/usuarios/{id}/perfil', [UsuarioWebController::class, 'updatePerfil'])->name('usuarios.updatePerfil');
Route::post('/usuarios/{id}/perfil', [UsuarioWebController::class, 'updatePerfil']);

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