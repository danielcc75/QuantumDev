@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Contenedor principal del perfil -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        
        <!-- Header con foto de perfil (más pequeño y elegante) -->
        <div class="relative h-32 bg-gradient-to-r from-blue-600 to-indigo-600">
            <div class="absolute -bottom-12 left-8">
                @if($usuario->perfil && $usuario->perfil->foto)
                    <img class="w-24 h-24 rounded-full border-4 border-white object-cover shadow-md" src="{{ $usuario->perfil->foto }}" alt="Foto de perfil">
                @else
                    <div class="w-24 h-24 rounded-full border-4 border-white bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center shadow-md">
                        <span class="text-white text-3xl font-bold">{{ strtoupper(substr($usuario->nombre, 0, 1)) }}{{ strtoupper(substr($usuario->apellido, 0, 1)) }}</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Contenido del perfil -->
        <div class="pt-16 px-8 pb-8">
            
            <!-- Nombre y título -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">{{ $usuario->nombre }} {{ $usuario->apellido }}</h1>
                <p class="text-gray-600 mt-1 text-lg">{{ $usuario->perfil->titulo ?? 'Desarrollador Full Stack apasionado por crear soluciones innovadoras.' }}</p>
            </div>

            <!-- Información de contacto en grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-8">
                @if($usuario->ubicacion)
                <div class="flex items-center text-gray-600 text-sm">
                    <i class="fas fa-map-marker-alt text-blue-500 w-5 mr-2"></i>
                    <span>{{ $usuario->ubicacion }}</span>
                </div>
                @endif
                
                @if($usuario->email)
                <div class="flex items-center text-gray-600 text-sm">
                    <i class="fas fa-envelope text-blue-500 w-5 mr-2"></i>
                    <span>{{ $usuario->email }}</span>
                </div>
                @endif
                
                @if($usuario->perfil && $usuario->perfil->linkedin)
                <div class="flex items-center text-gray-600 text-sm">
                    <i class="fab fa-linkedin text-blue-500 w-5 mr-2"></i>
                    <a href="{{ $usuario->perfil->linkedin }}" target="_blank" class="text-blue-600 hover:underline">LinkedIn</a>
                </div>
                @endif
                
                @if($usuario->perfil && $usuario->perfil->github)
                <div class="flex items-center text-gray-600 text-sm">
                    <i class="fab fa-github text-blue-500 w-5 mr-2"></i>
                    <a href="{{ $usuario->perfil->github }}" target="_blank" class="text-blue-600 hover:underline">GitHub</a>
                </div>
                @endif
                
                @if($usuario->perfil && $usuario->perfil->sitio_web)
                <div class="flex items-center text-gray-600 text-sm">
                    <i class="fas fa-globe text-blue-500 w-5 mr-2"></i>
                    <a href="{{ $usuario->perfil->sitio_web }}" target="_blank" class="text-blue-600 hover:underline">Sitio Web</a>
                </div>
                @endif
            </div>

            <!-- Experiencia Laboral -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-4">
                    <i class="fas fa-briefcase text-blue-600 mr-2"></i>Experiencia Laboral
                </h2>
                
                @php
                    $experiencias = $usuario->experiencias ?? [];
                @endphp
                
                @forelse($experiencias as $experiencia)
                <div class="mb-6">
                    <div class="flex justify-between items-start mb-1">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $experiencia->cargo }}</h3>
                        <span class="text-sm text-gray-500">{{ $experiencia->fecha_inicio->format('F Y') }} - 
                            @if($experiencia->fecha_fin)
                                {{ $experiencia->fecha_fin->format('F Y') }}
                            @else
                                <span class="text-green-600 font-medium">Actual</span>
                            @endif
                        </span>
                    </div>
                    <p class="text-blue-600 font-medium mb-2">{{ $experiencia->empresa }}</p>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $experiencia->descripcion }}</p>
                </div>
                @empty
                <div class="bg-gray-50 rounded-lg p-6 text-center text-gray-500">
                    <i class="fas fa-briefcase text-3xl mb-2 opacity-50"></i>
                    <p>No hay experiencia laboral registrada</p>
                </div>
                @endforelse
            </div>

            

            <!-- Sobre Mí -->
            <div>
                <h2 class="text-xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-4">
                    <i class="fas fa-user-circle text-blue-600 mr-2"></i>Sobre Mí
                </h2>
                <div class="bg-gray-50 rounded-lg p-5">
                    <p class="text-gray-700 leading-relaxed">
                        {{ $usuario->perfil->biografia ?? 'Ingeniero de software con más de 5 años de experiencia en el desarrollo de aplicaciones web modernas. Apasionado por la tecnología y el aprendizaje continuo.' }}
                    </p>
                </div>
            </div>

            <!-- Botones de acción (opcional) -->
            <div class="mt-8 flex justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg transition shadow-sm">
                    <i class="fas fa-edit mr-2"></i>Editar perfil
                </a>
                <a href="{{ route('usuarios.perfil', $usuario->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition shadow-sm">
                    <i class="fas fa-external-link-alt mr-2"></i>Ver perfil público
                </a>
            </div>
        </div>
    </div>
</div>
@endsection