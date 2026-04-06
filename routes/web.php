<?php

use App\Http\Controllers\UsuarioWebController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

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
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');