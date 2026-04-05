<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PerfilController;



Route::apiResource('proyectos', ProyectoController::class);
Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('perfiles', PerfilController::class);