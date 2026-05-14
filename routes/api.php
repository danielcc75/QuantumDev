<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PerfilController;



Route::apiResource('proyectos', ProyectoController::class)->names('api.proyectos');
Route::apiResource('usuarios', UsuarioController::class)->names('api.usuarios');
Route::apiResource('perfiles', PerfilController::class)->names('api.perfiles');