@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Título -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-database text-[#1e3a5f] mr-2"></i>
            Respaldos (Backups)
        </h1>
        <p class="text-gray-500 mt-1">Administra los respaldos de la base de datos</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        </div>
    @endif

    <!-- Acciones de backup -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Backup completo -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-blue-500">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                    <i class="fas fa-database text-blue-600"></i>
                </div>
                <div>
                    <h2 class="font-bold text-gray-800">Backup completo</h2>
                    <p class="text-xs text-gray-500">Exporta toda la base de datos</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 mb-4">Genera un volcado completo con <code>pg_dump</code>. Incluye esquema y todos los datos.</p>
            <form action="{{ route('admin.backup.create') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                    <i class="fas fa-plus mr-2"></i>Crear backup completo
                </button>
            </form>
        </div>

        <!-- Backup por rango de fechas -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-indigo-500">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                    <i class="fas fa-calendar-alt text-indigo-600"></i>
                </div>
                <div>
                    <h2 class="font-bold text-gray-800">Backup por rango de fechas</h2>
                    <p class="text-xs text-gray-500">Solo los registros creados en ese período</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 mb-4">Exporta únicamente los registros cuya fecha de creación (<code>created_at</code>) esté dentro del rango seleccionado.</p>
            <form action="{{ route('admin.backup.createByDates') }}" method="POST" class="space-y-3">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Desde</label>
                        <input type="date" name="fecha_desde" required
                            value="{{ old('fecha_desde') }}"
                            max="{{ date('Y-m-d') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400
                                   @error('fecha_desde') border-red-400 @enderror">
                        @error('fecha_desde')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Hasta</label>
                        <input type="date" name="fecha_hasta" required
                            value="{{ old('fecha_hasta') }}"
                            max="{{ date('Y-m-d') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400
                                   @error('fecha_hasta') border-red-400 @enderror">
                        @error('fecha_hasta')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                    <i class="fas fa-plus mr-2"></i>Crear backup por fechas
                </button>
            </form>
        </div>
    </div>

    <!-- Filtro de la lista -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <form method="GET" action="{{ route('admin.backup') }}" class="flex flex-wrap items-end gap-3">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Mostrar backups desde</label>
                <input type="date" name="filtro_desde" value="{{ $filtroDesde }}"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Hasta</label>
                <input type="date" name="filtro_hasta" value="{{ $filtroHasta }}"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <button type="submit"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium">
                <i class="fas fa-filter mr-1"></i> Filtrar
            </button>
            @if($filtroDesde || $filtroHasta)
                <a href="{{ route('admin.backup') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-600 rounded-lg text-sm hover:bg-gray-100 inline-flex items-center gap-1">
                    <i class="fas fa-times text-xs"></i> Limpiar
                </a>
            @endif
        </form>
    </div>

    <!-- Lista de backups -->
    @if(count($backups) > 0)
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-3 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
            <span class="text-sm font-medium text-gray-600">
                {{ count($backups) }} backup{{ count($backups) !== 1 ? 's' : '' }} encontrado{{ count($backups) !== 1 ? 's' : '' }}
            </span>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tamaño</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Generado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($backups as $backup)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            @if(str_starts_with($backup['name'], 'backup_fechas_'))
                                <i class="fas fa-calendar-alt text-indigo-500 mr-2"></i>
                            @else
                                <i class="fas fa-database text-blue-500 mr-2"></i>
                            @endif
                            {{ $backup['name'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(str_starts_with($backup['name'], 'backup_fechas_'))
                                <span class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs">Por fechas</span>
                            @else
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">Completo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ number_format($backup['size'] / 1024, 2) }} KB
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ date('d/m/Y H:i:s', $backup['date']) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.backup.download', $backup['name']) }}"
                                   class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 p-2 rounded-lg transition"
                                   title="Descargar">
                                    <i class="fas fa-download"></i>
                                </a>
                                <form action="{{ route('admin.backup.destroy', $backup['name']) }}"
                                      method="POST" class="inline"
                                      data-confirm="¿Eliminar el backup «{{ $backup['name'] }}»?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 p-2 rounded-lg transition"
                                        title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="bg-white rounded-xl shadow-md p-12 text-center">
        <i class="fas fa-database text-gray-300 text-6xl mb-4"></i>
        <p class="text-gray-500 text-lg">No hay respaldos disponibles</p>
        <p class="text-gray-400 text-sm mt-1">
            @if($filtroDesde || $filtroHasta)
                No se encontraron backups en ese rango de fechas.
            @else
                Usa los botones de arriba para generar el primero.
            @endif
        </p>
    </div>
    @endif
</div>
@endsection
