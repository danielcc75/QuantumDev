@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    
    <!-- Botón volver -->
    <div class="mb-4">
        <a href="{{ route('admin.usuarios') }}" class="text-[#1e3a5f] hover:text-[#152c47] inline-flex items-center gap-2">
            <i class="fas fa-arrow-left"></i>
            <span>Volver a usuarios</span>
        </a>
    </div>
    
    <!-- Título con nombre del usuario -->
    <div class="flex items-center gap-4 mb-6">
        @if($usuario->perfil && $usuario->perfil->foto_perfil)
            <img src="{{ $usuario->perfil->foto_perfil }}" alt="Foto de {{ $usuario->nombre }}" class="h-16 w-16 rounded-full object-cover shadow-md">
        @else
            <div class="h-16 w-16 rounded-full bg-gradient-to-r from-[#1e3a5f] to-indigo-600 flex items-center justify-center shadow-md">
                <span class="text-white text-xl font-bold">{{ substr($usuario->nombre, 0, 1) }}{{ substr($usuario->apellido, 0, 1) }}</span>
            </div>
        @endif
        <h1 class="text-2xl font-bold text-gray-800">{{ $usuario->nombre }} {{ $usuario->apellido }}</h1>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- COLUMNA IZQUIERDA -->
        <div class="space-y-6">
            
            <!-- Panel: Información Personal -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Información Personal</h2>
                <div class="space-y-3">
                    <div class="flex">
                        <span class="w-28 text-gray-500">Nombre:</span>
                        <span class="text-gray-800">{{ $usuario->nombre }} {{ $usuario->apellido }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-28 text-gray-500">Email:</span>
                        <span class="text-gray-800">{{ $usuario->correo_electronico }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-28 text-gray-500">Teléfono:</span>
                        <span class="text-gray-800">{{ $usuario->telefono ?? 'No especificado' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-28 text-gray-500">Ubicación:</span>
                        <span class="text-gray-800">{{ $usuario->perfil->ubicacion ?? 'No especificada' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-28 text-gray-500">Estado:</span>
                        @if($usuario->estado == 'activo')
                            <span class="text-green-600">Activo</span>
                        @else
                            <span class="text-red-600">Inactivo</span>
                        @endif
                    </div>
                    <div class="flex">
                        <span class="w-28 text-gray-500">Rol:</span>
                        @if($usuario->is_admin)
                            <span class="text-purple-600">Administrador</span>
                        @else
                            <span class="text-gray-600">Usuario</span>
                        @endif
                    </div>
                    <div class="flex">
                        <span class="w-28 text-gray-500">Registro:</span>
                        <span class="text-gray-800">{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y') : 'No registrada' }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Panel: Experiencia -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Experiencia</h2>
                <div class="space-y-5">
                    @forelse($usuario->perfil->experienciasLaborales ?? [] as $experiencia)
                    <div>
                        <h3 class="font-bold text-gray-800">{{ $experiencia->cargo }}</h3>
                        <p class="text-gray-600 text-sm">{{ $experiencia->empresa }}</p>
                        <p class="text-gray-500 text-sm mt-1">{{ $experiencia->descripcion }}</p>
                    </div>
                    @empty
                    <p class="text-gray-400 text-center">No hay experiencia registrada</p>
                    @endforelse
                </div>
            </div>
            
            <!-- Panel: Proyectos -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-800">Proyectos</h2>
                    <div class="flex gap-3">
                        <span class="text-xs text-gray-500 flex items-center gap-1">
                            <i class="fas fa-check-circle text-green-600 text-xs"></i> Completado
                        </span>
                        <span class="text-xs text-gray-500 flex items-center gap-1">
                            <i class="fas fa-spinner text-blue-600 text-xs"></i> En progreso
                        </span>
                    </div>
                </div>
                <div class="space-y-5">
                    @forelse($usuario->perfil->proyectos ?? [] as $proyecto)
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            @if($proyecto->estado == 'completado')
                                <i class="fas fa-check-circle text-green-600 text-sm"></i>
                            @elseif($proyecto->estado == 'en_progreso')
                                <i class="fas fa-spinner text-blue-600 text-sm"></i>
                            @else
                                <i class="far fa-circle text-gray-400 text-sm"></i>
                            @endif
                            <h3 class="font-bold text-gray-800">{{ $proyecto->nombre }}</h3>
                        </div>
                        <p class="text-gray-500 text-sm pl-6">{{ Str::limit($proyecto->descripcion, 100) }}</p>
                    </div>
                    @empty
                    <p class="text-gray-400 text-center">No hay proyectos registrados</p>
                    @endforelse
                </div>
                @if(($usuario->perfil->proyectos ?? [])->count() > 0)
                <div class="mt-4 pt-3 border-t border-gray-100">
                    <a href="#" class="text-[#1e3a5f] text-sm font-medium hover:underline">Ver todos →</a>
                </div>
                @endif
            </div>
        </div>
        
        <!-- COLUMNA DERECHA -->
        <div class="space-y-6">
            
            <!-- Panel: Gestión de cuenta -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Gestión de cuenta</h2>
                <div class="space-y-2">
                    @if($usuario->estado == 'activo')
                        <form action="{{ route('admin.usuarios.toggle-estado', $usuario->id_usuario) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left text-gray-700 hover:bg-gray-50 p-3 rounded-lg transition flex items-center gap-3">
                                <i class="fas fa-ban text-orange-500 w-5"></i>
                                <span>Desactivar cuenta</span>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.usuarios.toggle-estado', $usuario->id_usuario) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left text-gray-700 hover:bg-gray-50 p-3 rounded-lg transition flex items-center gap-3">
                                <i class="fas fa-check-circle text-green-500 w-5"></i>
                                <span>Activar cuenta</span>
                            </button>
                        </form>
                    @endif
                    
                    @if($usuario->id_usuario != session('usuario_id'))
                        <form action="{{ route('admin.usuarios.destroy', $usuario->id_usuario) }}" method="POST" onsubmit="return confirm('¿Eliminar este usuario?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-left text-gray-700 hover:bg-gray-50 p-3 rounded-lg transition flex items-center gap-3">
                                <i class="fas fa-trash-alt text-red-500 w-5"></i>
                                <span>Eliminar usuario</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            
            <!-- Panel: Habilidades -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Habilidades</h2>
                <div class="flex flex-wrap gap-2">
                    @forelse($usuario->perfil->habilidades ?? [] as $habilidad)
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-700">
                            {{ $habilidad->nombre }}
                        </span>
                    @empty
                        <p class="text-gray-400 text-center w-full">No hay habilidades registradas</p>
                    @endforelse
                </div>
            </div>
            
            <!-- Panel: Formación Académica -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Formación</h2>
                <div class="space-y-3">
                    @forelse($usuario->perfil->formacionAcademica ?? [] as $educacion)
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $educacion->titulo }}</h3>
                        <p class="text-gray-500 text-sm">{{ $educacion->institucion }}</p>
                        <p class="text-gray-400 text-xs">{{ $educacion->nivel }}</p>
                    </div>
                    @empty
                    <p class="text-gray-400 text-center">No hay formación registrada</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection