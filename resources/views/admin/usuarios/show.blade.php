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
                        <span class="w-32 text-gray-500">Nombre:</span>
                        <span class="text-gray-800">{{ $usuario->nombre }} {{ $usuario->apellido }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-gray-500">Email:</span>
                        <span class="text-gray-800">{{ $usuario->correo_electronico }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-gray-500">Teléfono:</span>
                        <span class="text-gray-800">{{ $usuario->telefono ?? 'No especificado' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-gray-500">Ubicación:</span>
                        <span class="text-gray-800">{{ $usuario->perfil->ubicacion ?? 'No especificada' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-gray-500">Visibilidad:</span>
                        <span class="text-gray-800">
                            {{ ($usuario->perfil->visibilidad ?? 'publico') === 'publico' ? 'Perfil público' : 'Perfil privado' }}
                        </span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-gray-500">Estado:</span>
                        @if($usuario->estado == 'activo')
                            <span class="text-green-600 font-medium">Activo</span>
                        @elseif($usuario->estado == 'suspendido')
                            <span class="text-red-600 font-medium">Suspendido</span>
                            @if($usuario->motivo_suspension)
                                <span class="ml-2 text-xs text-gray-500">({{ $usuario->motivo_suspension }})</span>
                            @endif
                        @elseif($usuario->estado == 'inactivo')
                            <span class="text-orange-600 font-medium">Inactivo (desactivado por el usuario)</span>
                        @else
                            <span class="text-gray-600">{{ ucfirst($usuario->estado) }}</span>
                        @endif
                    </div>
                    <div class="flex">
                        <span class="w-32 text-gray-500">Rol:</span>
                        @if($usuario->is_admin)
                            <span class="text-purple-600 font-medium">Administrador</span>
                        @else
                            <span class="text-gray-600">Usuario</span>
                        @endif
                    </div>
                    <div class="flex">
                        <span class="w-32 text-gray-500">Registro:</span>
                        <span class="text-gray-800">{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : 'No registrada' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-gray-500">Último acceso:</span>
                        <span class="text-gray-800">{{ $usuario->ultimo_acceso ? \Carbon\Carbon::parse($usuario->ultimo_acceso)->format('d/m/Y H:i') : 'Nunca' }}</span>
                    </div>
                </div>

                @if(!empty($usuario->perfil->biografia))
                <div class="mt-5 pt-4 border-t border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-500 mb-2">Biografía</h3>
                    <p class="text-gray-700 text-sm whitespace-pre-line">{{ $usuario->perfil->biografia }}</p>
                </div>
                @endif

                @if($usuario->perfil && $usuario->perfil->links && $usuario->perfil->links->count() > 0)
                <div class="mt-5 pt-4 border-t border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-500 mb-2">Enlaces</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($usuario->perfil->links as $link)
                            <a href="{{ $link->url }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full text-xs">
                                <i class="fas fa-link text-[10px]"></i>
                                {{ ucfirst($link->tipo) }}
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Panel: Experiencia -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Experiencia laboral</h2>
                <div class="space-y-5">
                    @forelse($usuario->perfil->experienciasLaborales ?? [] as $experiencia)
                    <div class="pb-4 border-b border-gray-100 last:border-b-0 last:pb-0">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <h3 class="font-bold text-gray-800">{{ $experiencia->cargo }}</h3>
                                <p class="text-gray-600 text-sm">{{ $experiencia->empresa }}</p>
                            </div>
                            @if($experiencia->trabajo_actual)
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Actual</span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $experiencia->fecha_ini ? $experiencia->fecha_ini->format('m/Y') : '—' }}
                            —
                            {{ $experiencia->trabajo_actual ? 'Presente' : ($experiencia->fecha_fin ? $experiencia->fecha_fin->format('m/Y') : '—') }}
                        </p>
                        @if($experiencia->descripcion)
                            <p class="text-gray-600 text-sm mt-2 whitespace-pre-line">{{ $experiencia->descripcion }}</p>
                        @endif
                        @if($experiencia->referencias)
                            <p class="text-xs text-gray-500 mt-2"><span class="font-medium">Referencias:</span> {{ $experiencia->referencias }}</p>
                        @endif
                    </div>
                    @empty
                    <p class="text-gray-400 text-center">No hay experiencia registrada</p>
                    @endforelse
                </div>
            </div>
            
            <!-- Panel: Proyectos -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-800">
                        Proyectos
                        <span class="text-sm text-gray-400 font-normal">({{ ($usuario->perfil->proyectos ?? collect())->count() }})</span>
                    </h2>
                </div>
                <div class="space-y-5">
                    @forelse($usuario->perfil->proyectos ?? [] as $proyecto)
                    <div class="pb-4 border-b border-gray-100 last:border-b-0 last:pb-0">
                        <div class="flex items-center gap-2 mb-1 flex-wrap">
                            @if($proyecto->estado == 'completado')
                                <i class="fas fa-check-circle text-green-600 text-sm" title="Completado"></i>
                            @elseif($proyecto->estado == 'en_progreso')
                                <i class="fas fa-spinner text-blue-600 text-sm" title="En progreso"></i>
                            @else
                                <i class="far fa-circle text-gray-400 text-sm" title="Pendiente"></i>
                            @endif
                            <h3 class="font-bold text-gray-800">{{ $proyecto->nombre }}</h3>
                            @if($proyecto->destacado)
                                <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full"><i class="fas fa-star text-[10px] mr-1"></i>Destacado</span>
                            @endif
                            @if($proyecto->visible)
                                <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">Público</span>
                            @else
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">Privado</span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-500 pl-6">
                            {{ $proyecto->fecha_ini ? $proyecto->fecha_ini->format('m/Y') : '—' }}
                            —
                            {{ $proyecto->fecha_fin ? $proyecto->fecha_fin->format('m/Y') : 'En curso' }}
                        </p>
                        @if($proyecto->descripcion)
                            <p class="text-gray-600 text-sm pl-6 mt-2">{{ Str::limit($proyecto->descripcion, 200) }}</p>
                        @endif
                        @if($proyecto->url_link)
                            <a href="{{ $proyecto->url_link }}" target="_blank" rel="noopener" class="text-xs text-blue-600 hover:underline pl-6 mt-1 inline-block">
                                <i class="fas fa-external-link-alt text-[10px]"></i> {{ $proyecto->url_link }}
                            </a>
                        @endif
                        @if(!empty($proyecto->tecnologias))
                            <div class="pl-6 mt-2 flex flex-wrap gap-1">
                                @foreach(is_array($proyecto->tecnologias) ? $proyecto->tecnologias : explode(',', $proyecto->tecnologias) as $tec)
                                    @if(trim($tec) !== '')
                                        <span class="text-[11px] bg-gray-100 text-gray-700 px-2 py-0.5 rounded">{{ trim($tec) }}</span>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @empty
                    <p class="text-gray-400 text-center">No hay proyectos registrados</p>
                    @endforelse
                </div>
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
                    
                </div>
            </div>
            
            <!-- Panel: Habilidades -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    Habilidades técnicas
                    <span class="text-sm text-gray-400 font-normal">({{ ($usuario->perfil->habilidades ?? collect())->count() }})</span>
                </h2>
                <div class="space-y-3">
                    @forelse($usuario->perfil->habilidades ?? [] as $habilidad)
                        <div class="border-b border-gray-100 pb-3 last:border-b-0 last:pb-0">
                            <div class="flex items-center justify-between gap-2">
                                <span class="font-medium text-gray-800">{{ $habilidad->nombre }}</span>
                                @if($habilidad->anios_experiencia)
                                    <span class="text-xs text-gray-500">{{ $habilidad->anios_experiencia }} año(s)</span>
                                @endif
                            </div>
                            @if($habilidad->categoria)
                                <p class="text-xs text-gray-500 mt-0.5">Categoría: {{ $habilidad->categoria->nombre }}</p>
                            @endif
                            @if($habilidad->descripcion)
                                <p class="text-sm text-gray-600 mt-1">{{ $habilidad->descripcion }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-400 text-center w-full">No hay habilidades registradas</p>
                    @endforelse
                </div>
            </div>

            <!-- Panel: Habilidades blandas -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    Habilidades blandas
                    <span class="text-sm text-gray-400 font-normal">({{ ($usuario->perfil->habilidadesBlandas ?? collect())->count() }})</span>
                </h2>
                <div class="flex flex-wrap gap-2">
                    @forelse($usuario->perfil->habilidadesBlandas ?? [] as $blanda)
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-sm" title="{{ $blanda->descripcion }}">
                            {{ $blanda->nombre }}
                        </span>
                    @empty
                        <p class="text-gray-400 text-center w-full">No hay habilidades blandas registradas</p>
                    @endforelse
                </div>
            </div>

            <!-- Panel: Formación Académica -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    Formación académica
                    <span class="text-sm text-gray-400 font-normal">({{ ($usuario->perfil->formacionAcademica ?? collect())->count() }})</span>
                </h2>
                <div class="space-y-4">
                    @forelse($usuario->perfil->formacionAcademica ?? [] as $educacion)
                    <div class="pb-3 border-b border-gray-100 last:border-b-0 last:pb-0">
                        <h3 class="font-semibold text-gray-800">{{ $educacion->titulo }}</h3>
                        <p class="text-gray-600 text-sm">{{ $educacion->institucion }}</p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $educacion->nivel }}
                            @if($educacion->fecha_ini || $educacion->fecha_fin)
                                · {{ $educacion->fecha_ini ? $educacion->fecha_ini->format('m/Y') : '—' }}
                                —
                                {{ $educacion->fecha_fin ? $educacion->fecha_fin->format('m/Y') : 'En curso' }}
                            @endif
                        </p>
                        @if($educacion->descripcion)
                            <p class="text-sm text-gray-600 mt-2 whitespace-pre-line">{{ $educacion->descripcion }}</p>
                        @endif
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