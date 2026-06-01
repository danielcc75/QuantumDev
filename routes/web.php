<?php

use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\HabilidadController;
use App\Http\Controllers\HabilidadBlandaController;
use App\Http\Controllers\PortafolioController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\PerfilWebController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\NovedadesController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\PortafolioBuscadorController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController; 

// =========================
// LOCALE SWITCHER (MULTILINGUALIDAD)
// =========================
Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');
Route::get('/api/locales', [LocaleController::class, 'getAvailableLocales']);

// =========================
// HOME
// =========================
Route::get('/', function () {
    return view('home.welcome');
});

// =========================
// AUTH
// =========================
Route::post('/login', [AuthWebController::class, 'login'])->name('login.store');
Route::post('/register', [AuthWebController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthWebController::class, 'dashboard'])->name('dashboard');

// Novedades (panel lateral del dashboard)
Route::post('/novedades/marcar-vistas', [NovedadesController::class, 'marcarVistas'])->name('novedades.marcar-vistas');

// Calendario (eventos en rango)
Route::get('/calendario/eventos', [CalendarioController::class, 'eventos'])->name('calendario.eventos');

// Buscador público de portafolios (home)
Route::get('/portafolios/buscar', [PortafolioBuscadorController::class, 'buscar'])->name('portafolios.buscar');



// =========================
// PROYECTOS CRUD (usado por AJAX desde el dashboard)
// =========================
Route::get('/proyectos',         [ProyectoController::class, 'index'])->name('proyectos.index');
Route::get('/proyectos/{id}',    [ProyectoController::class, 'show'])->name('proyectos.show');
Route::post('/proyectos',        [ProyectoController::class, 'store'])->name('proyectos.store');
Route::put('/proyectos/{id}',    [ProyectoController::class, 'update'])->name('proyectos.update');
Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');

// Perfil 2
Route::get('/mi-perfil', [PerfilWebController::class, 'ver'])->name('perfil.ver');
Route::get('/mi-perfil/editar', [PerfilWebController::class, 'editar'])->name('perfil.editar');
Route::put('/mi-perfil', [PerfilWebController::class, 'actualizar'])->name('perfil.actualizar');

Route::post('/perfil/actualizar-foto', [App\Http\Controllers\PerfilWebController::class, 'actualizarFoto'])->name('perfil.actualizar-foto');
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


//Rutas Habilidades blandas
Route::post('/admin/habilidades-blandas', [HabilidadBlandaController::class, 'store'])
    ->name('habilidades-blandas.store');

Route::post('/admin/habilidades-blandas/{id}/toggle', [HabilidadBlandaController::class, 'toggleEstado'])
    ->name('habilidades-blandas.toggle');

Route::put('/admin/habilidades-blandas/{id}', [HabilidadBlandaController::class, 'update'])
    ->name('habilidades-blandas.update');

Route::delete('/admin/habilidades-blandas/{id}', [HabilidadBlandaController::class, 'destroy'])
    ->name('habilidades-blandas.destroy');

Route::post('/habilidades-blandas/guardar', [HabilidadBlandaController::class, 'guardarSeleccionUsuario'])
    ->name('habilidades-blandas.guardar');

// =========================
// CONFIGURACIÓN DE CUENTA
// =========================
Route::put('/cuenta/datos',       [CuentaController::class, 'actualizarDatos'])->name('cuenta.datos');
Route::put('/cuenta/contrasenia', [CuentaController::class, 'cambiarContrasenia'])->name('cuenta.contrasenia');
Route::put('/cuenta/visibilidad', [CuentaController::class, 'cambiarVisibilidad'])->name('cuenta.visibilidad');
Route::get('/cuenta/portafolio/datos', [PortafolioController::class, 'datos'])->name('cuenta.portafolio.datos');
Route::put('/cuenta/portafolio/publicar', [PortafolioController::class, 'publicar'])->name('cuenta.portafolio.publicar');
Route::post('/cuenta/portafolio/preview', [PortafolioController::class, 'preview'])->name('cuenta.portafolio.preview');
Route::put('/cuenta/desactivar',  [CuentaController::class, 'desactivar'])->name('cuenta.desactivar');

// =========================
// SUGERENCIAS
// =========================
Route::post('/sugerencias', [\App\Http\Controllers\SugerenciaController::class, 'store'])->name('sugerencias.store');

// ============================================================
// PANEL DE ADMINISTRADOR (todas las funcionalidades)
// ============================================================
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsuarioAdminController;
use App\Http\Controllers\Admin\CategoriaAdminController;
use App\Http\Controllers\Admin\TecnologiaAdminController;
use App\Http\Controllers\Admin\HabilidadAdminController;
use App\Http\Controllers\Admin\ProyectoAdminController;
use App\Http\Controllers\Admin\ModeracionController;
use App\Http\Controllers\Admin\LogsController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\PapeleraController;
use App\Http\Controllers\Admin\ConfiguracionSitioController;

Route::prefix('admin')->middleware(['admin'])->group(function () {
    
    // Dashboard principal
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/sugerencias/{tipo}', [\App\Http\Controllers\SugerenciaController::class, 'verSugerenciasAdmin'])->name('admin.sugerencias.ver');
    
    // ========================================
    // 1. GESTIÓN DE USUARIOS
    // ========================================
    Route::get('/usuarios', [UsuarioAdminController::class, 'index'])->name('admin.usuarios');
    Route::get('/usuarios/crear', [UsuarioAdminController::class, 'create'])->name('admin.usuarios.create');
    Route::get('/usuarios/listado-simple', [UsuarioAdminController::class, 'listadoSimple'])->name('admin.usuarios.listado-simple');
    Route::post('/usuarios', [UsuarioAdminController::class, 'store'])->name('admin.usuarios.store');
   
    Route::get('/usuarios/{id}', [UsuarioAdminController::class, 'show'])->name('admin.usuarios.show');
    Route::get('/usuarios/{id}/editar', [UsuarioAdminController::class, 'edit'])->name('admin.usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioAdminController::class, 'update'])->name('admin.usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioAdminController::class, 'destroy'])->name('admin.usuarios.destroy');
    Route::post('/usuarios/{id}/toggle-estado', [UsuarioAdminController::class, 'toggleEstado'])->name('admin.usuarios.toggle-estado');
    Route::post('/usuarios/{id}/toggle-rol', [UsuarioAdminController::class, 'toggleRol'])->name('admin.usuarios.toggle-rol');
    
    // ========================================
    // 2. GESTIÓN DE CATEGORÍAS
    // ========================================
    Route::get('/categorias', [CategoriaAdminController::class, 'index'])->name('admin.categorias');
    Route::post('/categorias', [CategoriaAdminController::class, 'store'])->name('admin.categorias.store');
    Route::put('/categorias/{id}', [CategoriaAdminController::class, 'update'])->name('admin.categorias.update');
    Route::delete('/categorias/{id}', [CategoriaAdminController::class, 'destroy'])->name('admin.categorias.destroy');
    
    // ========================================
    // 3. GESTIÓN DE TECNOLOGÍAS
    // ========================================
    Route::get('/tecnologias', [TecnologiaAdminController::class, 'index'])->name('admin.tecnologias');
    Route::post('/tecnologias', [TecnologiaAdminController::class, 'store'])->name('admin.tecnologias.store');
    Route::put('/tecnologias/{id}', [TecnologiaAdminController::class, 'update'])->name('admin.tecnologias.update');
    Route::delete('/tecnologias/{id}', [TecnologiaAdminController::class, 'destroy'])->name('admin.tecnologias.destroy');
    
    // ========================================
    // 4. MODERACIÓN DE PERFILES
    // ========================================
    Route::get('/moderacion/perfiles', [ModeracionController::class, 'perfiles'])->name('admin.perfiles');
    Route::get('/moderacion/perfiles/{id}', [ModeracionController::class, 'verPerfil'])->name('admin.moderacion.ver-perfil');
    Route::get('/moderacion/perfiles/{id}/portafolio-json', [ModeracionController::class, 'portafolioJson'])->name('admin.moderacion.portafolio-json');
    Route::post('/moderacion/perfiles/{id}/toggle-visibilidad', [ModeracionController::class, 'toggleVisibilidad'])->name('admin.moderacion.toggle-visibilidad');
    Route::post('/moderacion/perfiles/{id}/nota', [ModeracionController::class, 'agregarNota'])->name('admin.moderacion.agregar-nota');


    // Gestión de Habilidades (Catálogo global)
    Route::get('/habilidades', [HabilidadAdminController::class, 'index'])->name('admin.habilidades');
    Route::get('/habilidades/{id}', [HabilidadAdminController::class, 'show'])->name('admin.habilidades.show');
    Route::post('/habilidades/{id}/toggle', [HabilidadAdminController::class, 'toggleEstado'])->name('admin.habilidades.toggle');
    Route::delete('/habilidades/{id}', [HabilidadAdminController::class, 'destroy'])->name('admin.habilidades.destroy');

    // Gestión de Proyectos
    Route::get('/proyectos', [ProyectoAdminController::class, 'index'])->name('admin.proyectos');
    Route::get('/proyectos/{id}', [ProyectoAdminController::class, 'show'])->name('admin.proyectos.show');
    Route::post('/proyectos/{id}/toggle-visibilidad', [ProyectoAdminController::class, 'toggleVisibilidad'])->name('admin.proyectos.toggle-visibilidad');
    Route::delete('/proyectos/{id}', [ProyectoAdminController::class, 'destroy'])->name('admin.proyectos.destroy');


    // Configuración del sitio
    Route::get('/configuracion', [ConfiguracionSitioController::class, 'index'])->name('admin.configuracion');
    Route::put('/configuracion', [ConfiguracionSitioController::class, 'update'])->name('admin.configuracion.update');

    // Bitacoras
    Route::get('/logs', [LogsController::class, 'index'])->name('admin.logs');
    Route::get('/logs/export', [LogsController::class, 'export'])->name('admin.logs.export');

    // Backups
    Route::get('/backup', [BackupController::class, 'index'])->name('admin.backup');
    Route::post('/backup/create', [BackupController::class, 'create'])->name('admin.backup.create');
    Route::post('/backup/create-por-fechas', [BackupController::class, 'createByDates'])->name('admin.backup.createByDates');
    Route::get('/backup/download', [BackupController::class, 'download'])->name('admin.backup.download');
    Route::delete('/backup/delete', [BackupController::class, 'destroy'])->name('admin.backup.destroy');

    // Papelera
    Route::prefix('papelera')->group(function () {
    Route::get('/', [PapeleraController::class, 'index'])->name('admin.papelera');
    
    // Usuarios
    Route::post('/usuario/{id}/restaurar', [PapeleraController::class, 'restaurarUsuario'])->name('admin.papelera.restaurar.usuario');
    Route::delete('/usuario/{id}/eliminar', [PapeleraController::class, 'eliminarUsuarioPermanente'])->name('admin.papelera.eliminar.usuario');
    
    // Proyectos
    Route::post('/proyecto/{id}/restaurar', [PapeleraController::class, 'restaurarProyecto'])->name('admin.papelera.restaurar.proyecto');
    Route::delete('/proyecto/{id}/eliminar', [PapeleraController::class, 'eliminarProyectoPermanente'])->name('admin.papelera.eliminar.proyecto');

    // Habilidades técnicas
    Route::post('/habilidad/{id}/restaurar', [PapeleraController::class, 'restaurarHabilidad'])->name('admin.papelera.restaurar.habilidad');

    // Experiencia laboral
    Route::post('/experiencia/{id}/restaurar', [PapeleraController::class, 'restaurarExperiencia'])->name('admin.papelera.restaurar.experiencia');

    // Formación académica
    Route::post('/educacion/{id}/restaurar', [PapeleraController::class, 'restaurarEducacion'])->name('admin.papelera.restaurar.educacion');

    // Vaciar
    Route::delete('/vaciar', [PapeleraController::class, 'vaciarPapelera'])->name('admin.papelera.vaciar');
    Route::put('/perfil/desactivar-cuenta', [CuentaController::class, 'desactivar'])->name('admin.perfil.desactivar-cuenta');
    });
});

// ========================================
// INTEGRACION GITHUB, GOOGLE Y LINKEDIN
// ========================================

Route::get('/auth/github', [AuthController::class, 'redirectGithub']);
Route::get('/auth/github/callback', [AuthController::class, 'callbackGithub']);

Route::get('/auth/google', [AuthController::class, 'redirectGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'callbackGoogle']);


// Notificaciones Admin (usa el controlador que ya tienes en Admin/)
Route::prefix('admin')->middleware(['admin'])->group(function () {

    Route::get('/notificaciones', [App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('admin.notifications');
    Route::get('/notificaciones/crear', [App\Http\Controllers\Admin\NotificationController::class, 'create'])->name('admin.notifications.create');
    Route::post('/notificaciones', [App\Http\Controllers\Admin\NotificationController::class, 'store'])->name('admin.notifications.store');
    Route::get('/notificaciones/{id}', [App\Http\Controllers\Admin\NotificationController::class, 'show'])->name('admin.notifications.show');
    Route::delete('/notificaciones/limpiar', [App\Http\Controllers\Admin\NotificationController::class, 'limpiar'])->name('admin.notifications.limpiar');
    Route::delete('/notificaciones/{id}', [App\Http\Controllers\Admin\NotificationController::class, 'destroy'])->name('admin.notifications.destroy');
    
});
   // ========================================
// NOTIFICACIONES DE USUARIO
// ========================================

// Ver mis notificaciones (página completa)
Route::get('/mis-notificaciones', [NotificationController::class, 'index'])->name('notifications.index');

// API para dropdown (AJAX)
Route::get('/notificaciones/list', [NotificationController::class, 'listarParaDropdown'])->name('notifications.list');

// Contar no leídas (AJAX)
Route::get('/notificaciones/count', [NotificationController::class, 'contarNoLeidas'])->name('notifications.count');

// Marcar una como leída (AJAX)
Route::post('/notificaciones/marcar-leida', [NotificationController::class, 'marcarLeidaAjax'])->name('notifications.marcar-leida');

// Marcar una como leída (desde página, método POST)
Route::post('/notificaciones/{id}/leer', [NotificationController::class, 'marcarLeida'])->name('notifications.marcar');

// Marcar todas como leídas
Route::post('/notificaciones/marcar-todas', [NotificationController::class, 'marcarTodasLeidas'])->name('notifications.marcar-todas');

// NOVEDADES (moderación, proyectos ocultos, etc)
Route::get('/novedades/list', [NotificationController::class, 'obtenerNovedades'])->name('novedades.list');
Route::post('/novedades/marcar-vista', [NotificationController::class, 'marcarNovedadVista'])->name('novedades.marcar-vista');
