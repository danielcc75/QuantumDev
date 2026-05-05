@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
        <h3 class="text-xl font-bold text-gray-800">
            <i class="fas fa-shield-alt text-orange-600 mr-2"></i>
            Moderación de Perfiles
        </h3>
        <p class="text-sm text-gray-600 mt-1">Revisa y modera los perfiles de los usuarios</p>
    </div>
    
    <!-- Filtros -->
    <div class="px-6 py-3 bg-gray-50 border-b flex gap-3">
        <form method="GET" class="flex gap-3">
            <input type="text" name="search" placeholder="Buscar usuario..." value="{{ request('search') }}"
                class="px-3 py-1 border rounded-lg text-sm">
            <select name="visible" class="px-3 py-1 border rounded-lg text-sm">
                <option value="todos">Todos</option>
                <option value="visible" {{ request('visible') == 'visible' ? 'selected' : '' }}>Visibles</option>
                <option value="oculto" {{ request('visible') == 'oculto' ? 'selected' : '' }}>Ocultos</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded-lg text-sm">Filtrar</button>
        </form>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Usuario</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Ubicación</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Nota</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($perfiles as $perfil)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                <span class="text-sm font-bold">{{ substr($perfil->usuario->nombre, 0, 1) }}</span>
                            </div>
                            <div class="ml-3">
                                <p class="font-medium">{{ $perfil->usuario->nombre }} {{ $perfil->usuario->apellido }}</p>
                                <p class="text-xs text-gray-500">{{ $perfil->usuario->correo_electronico }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $perfil->ubicacion ?? 'No especificada' }}</td>
                    <td class="px-6 py-4">
                        @if($perfil->visible)
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Visible</span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Oculto</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm max-w-xs truncate">{{ $perfil->moderation_note ?? 'Sin nota' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.moderacion.ver-perfil', $perfil->id_perfil) }}" 
                               class="text-blue-600 bg-blue-100 p-2 rounded-lg">Ver</a>
                            <form action="{{ route('admin.moderacion.toggle-visibilidad', $perfil->id_perfil) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-orange-600 bg-orange-100 p-2 rounded-lg">
                                    {{ $perfil->visible ? 'Ocultar' : 'Mostrar' }}
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">No hay perfiles para moderar</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection