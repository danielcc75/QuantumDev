@extends('layouts.app')

@section('content')
<div class="space-y-6">
    
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-history text-[#1e3a5f] mr-2"></i>
                    Bitácora de Actividades
                </h1>
                <p class="text-gray-500 mt-1">Registro de acciones realizadas por administradores</p>
            </div>
            <a href="{{ route('admin.logs.export') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                <i class="fas fa-download mr-2"></i>Exportar CSV
            </a>
        </div>
    </div>
    
    <!-- Filtros -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <form method="GET" class="flex flex-wrap gap-3">
            <input type="text" name="accion" placeholder="Buscar acción..." value="{{ request('accion') }}"
                class="px-3 py-2 border rounded-lg text-sm">
            <input type="date" name="fecha" value="{{ request('fecha') }}"
                class="px-3 py-2 border rounded-lg text-sm">
            <button type="submit" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg text-sm">Filtrar</button>
            @if(request()->anyFilled(['accion', 'fecha']))
                <a href="{{ route('admin.logs') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm">Limpiar</a>
            @endif
        </form>
    </div>
    
    <!-- Tabla -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ADMIN</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ACCIÓN</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">DETALLES</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">IP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">FECHA</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($logs as $log)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm">#{{ $log->id_log }}</td>
                    <td class="px-6 py-4 text-sm font-medium">{{ $log->admin->nombre ?? 'N/A' }} {{ $log->admin->apellido ?? '' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-gray-100 rounded-full text-xs">{{ $log->accion }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-md">{{ $log->detalles }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $log->ip_address ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">No hay registros en la bitácora</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection