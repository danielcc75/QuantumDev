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