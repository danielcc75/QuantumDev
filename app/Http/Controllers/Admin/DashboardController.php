<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Perfil;
use App\Models\Proyecto;
use App\Models\Categoria;
use App\Models\Tecnologia;
use App\Models\Habilidad;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ========================================
        // 1. ESTADÍSTICAS BÁSICAS (ya las tenías)
        // ========================================
        $totalUsuarios = Usuario::count();
        $usuariosActivos = Usuario::where('estado', 'activo')->count();
        $usuariosSuspendidos = Usuario::where('estado', 'suspendido')->count();
        $totalPortafolios = Perfil::count();
        $totalCategorias = Categoria::count();
        $totalProyectos = Proyecto::count();
        
        // ========================================
        // 2. NUEVOS USUARIOS (hoy, esta semana, este mes)
        // ========================================
        $usuariosHoy = Usuario::whereDate('created_at', today())->count();
        $usuariosSemana = Usuario::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $usuariosMes = Usuario::whereMonth('created_at', now()->month)->count();
        
        // Porcentaje de crecimiento vs mes anterior
        $usuariosMesAnterior = Usuario::whereMonth('created_at', now()->subMonth()->month)->count();
        $crecimientoUsuarios = $usuariosMesAnterior > 0 
            ? round((($usuariosMes - $usuariosMesAnterior) / $usuariosMesAnterior) * 100, 1) 
            : 0;
        
        // ========================================
        // 3. NUEVOS PROYECTOS (hoy, esta semana, este mes)
        // ========================================
        $proyectosHoy = Proyecto::whereDate('created_at', today())->count();
        $proyectosSemana = Proyecto::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $proyectosMes = Proyecto::whereMonth('created_at', now()->month)->count();
        
        // Crecimiento de proyectos
        $proyectosMesAnterior = Proyecto::whereMonth('created_at', now()->subMonth()->month)->count();
        $crecimientoProyectos = $proyectosMesAnterior > 0 
            ? round((($proyectosMes - $proyectosMesAnterior) / $proyectosMesAnterior) * 100, 1) 
            : 0;
        
        // ========================================
        // 4. TASA DE CONVERSIÓN (perfiles completos)
        // ========================================
        // Un perfil se considera "completo" si tiene:
        // - Foto de perfil
        // - Biografía
        // - Ubicación
        // - Al menos 1 experiencia laboral
        // - Al menos 1 habilidad
        $perfilesCompletos = Perfil::whereNotNull('foto_perfil')
            ->whereNotNull('biografia')
            ->whereNotNull('ubicacion')
            ->whereHas('experienciasLaborales')
            ->whereHas('habilidades')
            ->count();
        
        $tasaConversion = $totalPortafolios > 0 
            ? round(($perfilesCompletos / $totalPortafolios) * 100, 1) 
            : 0;
        
        // ========================================
        // 5. USUARIOS QUE NUNCA HAN INICIADO SESIÓN
        // ========================================
        $usuariosNuncaAccedieron = Usuario::whereNull('ultimo_acceso')->count();
        $porcentajeNuncaAccedieron = $totalUsuarios > 0 
            ? round(($usuariosNuncaAccedieron / $totalUsuarios) * 100, 1) 
            : 0;
        
        // ========================================
        // 6. PROYECTOS PRIVADOS (no visibles públicamente)
        // ========================================
        $proyectosPrivados = Proyecto::where('visible', false)->count();
        $proyectosPublicos = Proyecto::where('visible', true)->count();
        $porcentajePrivados = $totalProyectos > 0 
            ? round(($proyectosPrivados / $totalProyectos) * 100, 1) 
            : 0;
        
        // ========================================
        // 7. USUARIOS INACTIVOS (30+ días sin login)
        // ========================================
        $usuariosInactivos30Dias = Usuario::where('ultimo_acceso', '<', now()->subDays(30))
            ->whereNotNull('ultimo_acceso')
            ->count();
        
        // ========================================
        // 8. DATOS PARA GRÁFICOS (últimos 6 meses)
        // ========================================
        $registrosPorMes = Usuario::select(
            DB::raw('DATE_TRUNC(\'month\', created_at) as mes'),
            DB::raw('count(*) as total')
        )
        ->where('created_at', '>=', now()->subMonths(6))
        ->groupBy('mes')
        ->orderBy('mes', 'asc')
        ->get()
        ->map(function ($item) {
            $fecha = $item->mes ? \Carbon\Carbon::parse($item->mes) : null;
            return [
                'mes' => $fecha ? $fecha->format('M Y') : 'Sin fecha',
                'total' => $item->total
            ];
        });
        $proyectosPorMes = Proyecto::select(
            DB::raw('DATE_TRUNC(\'month\', created_at) as mes'),
            DB::raw('count(*) as total')
        )
        ->where('created_at', '>=', now()->subMonths(6))
        ->groupBy('mes')
        ->orderBy('mes', 'asc')
        ->get()
        ->map(function ($item) {
            // Convertir el string a Carbon solo si no es null
            $fecha = $item->mes ? \Carbon\Carbon::parse($item->mes) : null;
            return [
                'mes' => $fecha ? $fecha->format('M Y') : 'Sin fecha',
                'total' => $item->total
            ];
        });
        // ========================================
        // 9. TOP 5 (ya los tenías)
        // ========================================
        $topTecnologias = Tecnologia::withCount('proyectos')
            ->orderBy('proyectos_count', 'desc')
            ->limit(5)
            ->get();
        
        $topHabilidades = Habilidad::select('nombre', DB::raw('count(*) as total'))
            ->groupBy('nombre')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();
        
        $usuariosRecientes = Usuario::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // ========================================
        // 10. DATOS PARA TARJETAS DE CRECIMIENTO
        // ========================================
        $porcentajeActivos = $totalUsuarios > 0 
            ? round(($usuariosActivos / $totalUsuarios) * 100, 1) 
            : 0;
        
        $porcentajeCompletos = $totalPortafolios > 0 
            ? round(($perfilesCompletos / $totalPortafolios) * 100, 1) 
            : 0;
        
        $esAdmin = true;
        
        return view('admin.dashboard', compact(
            // Básicas
            'totalUsuarios',
            'usuariosActivos',
            'usuariosSuspendidos',
            'totalPortafolios',
            'totalCategorias',
            'totalProyectos',
            
            // Nuevos usuarios
            'usuariosHoy',
            'usuariosSemana',
            'usuariosMes',
            'crecimientoUsuarios',
            
            // Nuevos proyectos
            'proyectosHoy',
            'proyectosSemana',
            'proyectosMes',
            'crecimientoProyectos',
            
            // Conversión
            'perfilesCompletos',
            'tasaConversion',
            'porcentajeCompletos',
            
            // Inactividad
            'usuariosNuncaAccedieron',
            'porcentajeNuncaAccedieron',
            'usuariosInactivos30Dias',
            
            // Visibilidad proyectos
            'proyectosPrivados',
            'proyectosPublicos',
            'porcentajePrivados',
            
            // Gráficos
            'registrosPorMes',
            'proyectosPorMes',
            
            // Top y recientes
            'topTecnologias',
            'topHabilidades',
            'usuariosRecientes',
            'porcentajeActivos',
            'esAdmin'
        ));
    }
}