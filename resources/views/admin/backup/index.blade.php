@extends('layouts.app')

@section('content')
<div class="space-y-6">
    
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-database text-[#1e3a5f] mr-2"></i>
                    Respaldos (Backups)
                </h1>
                <p class="text-gray-500 mt-1">Administra los respaldos de la base de datos</p>
            </div>
            <form action="{{ route('admin.backup.create') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Crear Backup
                </button>
            </form>
        </div>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
            {{ session('error') }}
        </div>
    @endif
    
    <!-- 👈 CORREGIDO: Mostrar tabla SI hay backups -->
    @if(count($backups) > 0)
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NOMBRE</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TAMAÑO</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">FECHA</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ACCIONES</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($backups as $backup)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <i class="fas fa-database text-blue-500 mr-2"></i>
                            {{ $backup['name'] }}
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
                                      method="POST" 
                                      class="inline" 
                                      onsubmit="return confirm('¿Eliminar este backup?')">
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
    <!-- 👈 Esto solo se muestra si NO hay backups -->
    <div class="bg-white rounded-xl shadow-md p-12 text-center">
        <i class="fas fa-database text-gray-300 text-6xl mb-4"></i>
        <p class="text-gray-500 text-lg">No hay respaldos disponibles</p>
        <p class="text-gray-400 text-sm mt-1">Haz clic en "Crear Backup" para generar el primero</p>
    </div>
    @endif
</div>
@endsection