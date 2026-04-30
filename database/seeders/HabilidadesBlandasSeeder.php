<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HabilidadBlanda;

class HabilidadesBlandasSeeder extends Seeder
{
    public function run(): void
    {
        $habilidades = [
            'Comunicación efectiva',
            'Trabajo en equipo',
            'Liderazgo',
            'Pensamiento crítico',
            'Resolución de problemas',
            'Creatividad',
            'Adaptabilidad',
            'Gestión del tiempo',
            'Inteligencia emocional',
            'Empatía',
            'Escucha activa',
            'Negociación',
            'Toma de decisiones',
            'Organización',
            'Planificación',
            'Delegación',
            'Motivación',
            'Gestión de conflictos',
            'Flexibilidad',
            'Proactividad',
            'Resiliencia',
            'Autogestión',
            'Colaboración',
            'Mentoría',
            'Persuasión',
            'Networking',
            'Ética profesional',
            'Puntualidad',
            'Responsabilidad',
            'Compromiso',
            'Aprendizaje continuo',
            'Orientación a resultados',
            'Pensamiento estratégico',
            'Innovación',
            'Capacidad de análisis'
        ];

        foreach ($habilidades as $nombre) {
            HabilidadBlanda::firstOrCreate([
                'nombre' => $nombre
            ], [
                'descripcion' => null,
                'estado' => 'activo'
            ]);
        }
    }
}