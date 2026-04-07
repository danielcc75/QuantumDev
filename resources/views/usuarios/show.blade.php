@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">

        <!-- Header con foto de perfil -->
        <div class="relative h-32 bg-gradient-to-r from-blue-600 to-indigo-600">
            <div class="absolute -bottom-12 left-8">
                @if($usuario->perfil && $usuario->perfil->foto_perfil)
                    <img class="w-24 h-24 rounded-full border-4 border-white object-cover shadow-md" src="{{ $usuario->perfil->foto_perfil }}" alt="Foto de perfil">
                @else
                    <div class="w-24 h-24 rounded-full border-4 border-white bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center shadow-md">
                        <span class="text-white text-3xl font-bold">{{ strtoupper(substr($usuario->nombre, 0, 1)) }}{{ strtoupper(substr($usuario->apellido, 0, 1)) }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="pt-16 px-8 pb-8">

            <!-- Nombre -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">{{ $usuario->nombre }} {{ $usuario->apellido }}</h1>
                <p class="text-gray-600 mt-1 text-lg">{{ $usuario->perfil->biografia ?? '' }}</p>
            </div>

            <!-- Información de contacto -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-8">
                @if($usuario->perfil && $usuario->perfil->ubicacion)
                <div class="flex items-center text-gray-600 text-sm">
                    <i class="fas fa-map-marker-alt text-blue-500 w-5 mr-2"></i>
                    <span>{{ $usuario->perfil->ubicacion }}</span>
                </div>
                @endif

                @if($usuario->correo_electronico)
                <div class="flex items-center text-gray-600 text-sm">
                    <i class="fas fa-envelope text-blue-500 w-5 mr-2"></i>
                    <span>{{ $usuario->correo_electronico }}</span>
                </div>
                @endif

                @if($perfilLinks['linkedin'] ?? false)
                <div class="flex items-center text-gray-600 text-sm">
                    <i class="fab fa-linkedin text-blue-500 w-5 mr-2"></i>
                    <a href="{{ $perfilLinks['linkedin'] }}" target="_blank" class="text-blue-600 hover:underline">LinkedIn</a>
                </div>
                @endif

                @if($perfilLinks['github'] ?? false)
                <div class="flex items-center text-gray-600 text-sm">
                    <i class="fab fa-github text-blue-500 w-5 mr-2"></i>
                    <a href="{{ $perfilLinks['github'] }}" target="_blank" class="text-blue-600 hover:underline">GitHub</a>
                </div>
                @endif

                @if($perfilLinks['portfolio'] ?? false)
                <div class="flex items-center text-gray-600 text-sm">
                    <i class="fas fa-globe text-blue-500 w-5 mr-2"></i>
                    <a href="{{ $perfilLinks['portfolio'] }}" target="_blank" class="text-blue-600 hover:underline">Sitio Web</a>
                </div>
                @endif
            </div>

            <!-- Experiencia Laboral -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 border-b-2 border-gray-200 pb-2 mb-4">
                    <i class="fas fa-briefcase text-blue-600 mr-2"></i>Experiencia Laboral
                </h2>

                @forelse($experiencias as $experiencia)
                <div class="mb-6">
                    <div class="flex justify-between items-start mb-1">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $experiencia->cargo }}</h3>
                        <span class="text-sm text-gray-500">
                            {{ $experiencia->fecha_ini->format('F Y') }} –
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

            <!-- Botones de acción -->
            <div class="mt-8 flex justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg transition shadow-sm">
                    <i class="fas fa-edit mr-2"></i>Editar
                </a>
                <a href="{{ route('usuarios.perfil', $usuario->id_usuario) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition shadow-sm">
                    <i class="fas fa-external-link-alt mr-2"></i>Ver perfil público
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
