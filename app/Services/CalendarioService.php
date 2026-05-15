<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CalendarioService
{
    /**
     * Devuelve los eventos agrupados por fecha (YYYY-MM-DD) en el rango dado.
     * Combina hitos personales del usuario (CV) con novedades del sistema.
     */
    public function eventosEnRango(int $idUsuario, Carbon $desde, Carbon $hasta): array
    {
        $idPerfil = DB::table('perfil')->where('id_usuario', $idUsuario)->value('id_perfil');

        $eventos = [];

        if ($idPerfil) {
            $this->cargarHitosPerfil($eventos, $idPerfil, $desde, $hasta);
        }

        $this->cargarNovedadesSistema($eventos, $desde, $hasta);

        ksort($eventos);
        return $eventos;
    }

    private function cargarHitosPerfil(array &$eventos, int $idPerfil, Carbon $desde, Carbon $hasta): void
    {
        // Experiencias laborales
        $experiencias = DB::table('experiencia_laboral')
            ->where('id_perfil', $idPerfil)
            ->whereNull('deleted_at')
            ->get();

        foreach ($experiencias as $e) {
            $this->agregarSiEnRango($eventos, $e->fecha_ini, $desde, $hasta, [
                'tipo'    => 'experiencia_inicio',
                'titulo'  => "Comenzaste como {$e->cargo}",
                'detalle' => $e->empresa,
                'icono'   => 'fa-solid fa-briefcase',
                'color'   => 'bg-indigo-500',
                'colorTexto' => 'text-indigo-600',
            ]);
            if ($e->fecha_fin && !$e->trabajo_actual) {
                $this->agregarSiEnRango($eventos, $e->fecha_fin, $desde, $hasta, [
                    'tipo'    => 'experiencia_fin',
                    'titulo'  => "Finalizaste como {$e->cargo}",
                    'detalle' => $e->empresa,
                    'icono'   => 'fa-solid fa-briefcase',
                    'color'   => 'bg-indigo-400',
                    'colorTexto' => 'text-indigo-600',
                ]);
            }
        }

        // Proyectos
        $proyectos = DB::table('proyectos')
            ->where('id_perfil', $idPerfil)
            ->whereNull('deleted_at')
            ->get();

        foreach ($proyectos as $p) {
            $this->agregarSiEnRango($eventos, $p->fecha_ini, $desde, $hasta, [
                'tipo'    => 'proyecto_inicio',
                'titulo'  => "Iniciaste el proyecto '{$p->nombre}'",
                'detalle' => $p->estado ?? '',
                'icono'   => 'fa-solid fa-code',
                'color'   => 'bg-emerald-500',
                'colorTexto' => 'text-emerald-600',
            ]);
            if ($p->fecha_fin) {
                $this->agregarSiEnRango($eventos, $p->fecha_fin, $desde, $hasta, [
                    'tipo'    => 'proyecto_fin',
                    'titulo'  => "Terminaste el proyecto '{$p->nombre}'",
                    'detalle' => $p->estado ?? '',
                    'icono'   => 'fa-solid fa-code',
                    'color'   => 'bg-emerald-400',
                    'colorTexto' => 'text-emerald-600',
                ]);
            }
        }

        // Educación
        $estudios = DB::table('formacion_academica')
            ->where('id_perfil', $idPerfil)
            ->whereNull('deleted_at')
            ->get();

        foreach ($estudios as $est) {
            $this->agregarSiEnRango($eventos, $est->fecha_ini, $desde, $hasta, [
                'tipo'    => 'educacion_inicio',
                'titulo'  => "Comenzaste {$est->titulo}",
                'detalle' => $est->institucion,
                'icono'   => 'fa-solid fa-graduation-cap',
                'color'   => 'bg-amber-500',
                'colorTexto' => 'text-amber-600',
            ]);
            if ($est->fecha_fin) {
                $this->agregarSiEnRango($eventos, $est->fecha_fin, $desde, $hasta, [
                    'tipo'    => 'educacion_fin',
                    'titulo'  => "Finalizaste {$est->titulo}",
                    'detalle' => $est->institucion,
                    'icono'   => 'fa-solid fa-graduation-cap',
                    'color'   => 'bg-amber-400',
                    'colorTexto' => 'text-amber-600',
                ]);
            }
        }
    }

    private function cargarNovedadesSistema(array &$eventos, Carbon $desde, Carbon $hasta): void
    {
        $tecnologias = DB::table('tecnologias')
            ->whereBetween('created_at', [$desde->copy()->startOfDay(), $hasta->copy()->endOfDay()])
            ->get();
        foreach ($tecnologias as $t) {
            $this->agregarSiEnRango($eventos, $t->created_at, $desde, $hasta, [
                'tipo'    => 'sistema_tecnologia',
                'titulo'  => "Nueva tecnología: {$t->nombre}",
                'detalle' => $t->categoria,
                'icono'   => 'fa-solid fa-microchip',
                'color'   => 'bg-blue-500',
                'colorTexto' => 'text-blue-600',
            ]);
        }

        $categorias = DB::table('categoria')
            ->whereBetween('created_at', [$desde->copy()->startOfDay(), $hasta->copy()->endOfDay()])
            ->get();
        foreach ($categorias as $c) {
            $this->agregarSiEnRango($eventos, $c->created_at, $desde, $hasta, [
                'tipo'    => 'sistema_categoria',
                'titulo'  => "Nueva categoría: {$c->nombre}",
                'detalle' => '',
                'icono'   => 'fa-solid fa-folder-plus',
                'color'   => 'bg-sky-500',
                'colorTexto' => 'text-sky-600',
            ]);
        }

        $blandas = DB::table('habilidades_blandas')
            ->whereBetween('created_at', [$desde->copy()->startOfDay(), $hasta->copy()->endOfDay()])
            ->get();
        foreach ($blandas as $h) {
            $this->agregarSiEnRango($eventos, $h->created_at, $desde, $hasta, [
                'tipo'    => 'sistema_habilidad_blanda',
                'titulo'  => "Nueva habilidad blanda: {$h->nombre}",
                'detalle' => '',
                'icono'   => 'fa-solid fa-handshake',
                'color'   => 'bg-rose-500',
                'colorTexto' => 'text-rose-600',
            ]);
        }
    }

    private function agregarSiEnRango(array &$eventos, ?string $fecha, Carbon $desde, Carbon $hasta, array $evento): void
    {
        if (!$fecha) return;
        $f = Carbon::parse($fecha);
        if ($f->lt($desde->copy()->startOfDay()) || $f->gt($hasta->copy()->endOfDay())) {
            return;
        }
        $clave = $f->toDateString();
        $eventos[$clave][] = $evento;
    }
}
