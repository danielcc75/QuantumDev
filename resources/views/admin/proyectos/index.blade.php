@extends('layouts.app')

@section('content')
<div class="space-y-6">
    
    <!-- Título -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-folder-open text-[#1e3a5f] mr-2"></i>
            Gestión de Proyectos
        </h1>
        <p class="text-gray-500 mt-1">Modera y administra todos los proyectos del sistema</p>
    </div>
    
    <!-- Estadísticas -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-blue-500">
            <p class="text-2xl font-bold">{{ $estadisticas['total'] }}</p>
            <p class="text-xs text-gray-500">Total Proyectos</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-green-500">
            <p class="text-2xl font-bold">{{ $estadisticas['publicos'] }}</p>
            <p class="text-xs text-gray-500">Públicos</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-gray-500">
            <p class="text-2xl font-bold">{{ $estadisticas['privados'] }}</p>
            <p class="text-xs text-gray-500">Privados</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-yellow-500">
            <p class="text-2xl font-bold">{{ $estadisticas['destacados'] }}</p>
            <p class="text-xs text-gray-500">Destacados</p>
        </div>
    </div>
    
    <!-- Filtros -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <form method="GET" class="flex flex-wrap gap-3">
            <input type="text" name="search" placeholder="Buscar proyecto..." value="{{ request('search') }}"
                class="px-3 py-2 border rounded-lg text-sm w-64">
            
            <select name="estado" class="px-3 py-2 border rounded-lg text-sm">
                <option value="todos">Todos los estados</option>
                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en_progreso" {{ request('estado') == 'en_progreso' ? 'selected' : '' }}>En progreso</option>
                <option value="completado" {{ request('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
                <option value="cancelado" {{ request('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
            </select>
            
            <select name="visibilidad" class="px-3 py-2 border rounded-lg text-sm">
                <option value="todos">Todos</option>
                <option value="publico" {{ request('visibilidad') == 'publico' ? 'selected' : '' }}>Públicos</option>
                <option value="privado" {{ request('visibilidad') == 'privado' ? 'selected' : '' }}>Privados</option>
            </select>
            
            <select name="destacado" class="px-3 py-2 border rounded-lg text-sm">
                <option value="todos">Todos</option>
                <option value="si" {{ request('destacado') == 'si' ? 'selected' : '' }}>Destacados</option>
                <option value="no" {{ request('destacado') == 'no' ? 'selected' : '' }}>No destacados</option>
            </select>
            
            <button type="submit" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg text-sm">Filtrar</button>
            
            @if(request()->anyFilled(['search', 'estado', 'visibilidad', 'destacado']))
                <a href="{{ route('admin.proyectos') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm">Limpiar</a>
            @endif
        </form>
    </div>
    
    <!-- Tabla de proyectos -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">PROYECTO</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">AUTOR</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ESTADO</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">VISIBILIDAD</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">FECHA</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($proyectos as $proyecto)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-900">{{ $proyecto->nombre }}</p>
                                <p class="text-xs text-gray-500">{{ Str::limit($proyecto->descripcion, 60) }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-gradient-to-r from-[#1e3a5f] to-indigo-600 flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">{{ substr($proyecto->perfil->usuario->nombre ?? 'U', 0, 1) }}</span>
                                </div>
                                <div class="ml-2">
                                    <p class="text-sm font-medium">{{ $proyecto->perfil->usuario->nombre ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500">{{ $proyecto->perfil->usuario->correo_electronico ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs 
                                @if($proyecto->estado == 'completado') bg-green-100 text-green-700
                                @elseif($proyecto->estado == 'en_progreso') bg-blue-100 text-blue-700
                                @elseif($proyecto->estado == 'pendiente') bg-yellow-100 text-yellow-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($proyecto->estado) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($proyecto->visible)
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">Público</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs">Oculto</span>
                            @endif
                            @if($proyecto->destacado)
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs ml-1">⭐ Destacado</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $proyecto->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.proyectos.show', $proyecto->id_proyecto) }}" 
                                   class="p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <form action="{{ route('admin.proyectos.toggle-visibilidad', $proyecto->id_proyecto) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2 rounded-lg bg-orange-100 text-orange-600 hover:bg-orange-200" 
                                            title="{{ $proyecto->visible ? 'Ocultar' : 'Mostrar' }}">
                                        <i class="fas {{ $proyecto->visible ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </form>
                                
                                <form action="{{ route('admin.proyectos.toggle-destacado', $proyecto->id_proyecto) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200" 
                                            title="{{ $proyecto->destacado ? 'Quitar destacado' : 'Destacar' }}">
                                        <i class="fas {{ $proyecto->destacado ? 'fa-star' : 'fa-star-o' }}"></i>
                                    </button>
                                </form>
                                
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            No hay proyectos registrados
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">
            {{ $proyectos->links() }}
        </div>
    </div>
</div>
@endsection