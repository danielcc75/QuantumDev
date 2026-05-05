@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
        <h3 class="text-xl font-bold text-gray-800">
            <i class="fas fa-users text-[#1e3a5f] mr-2"></i>
            Usuarios del sistema
        </h3>
    </div>
    
    <!-- Filtros y buscador -->
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
        <div class="flex flex-wrap gap-4 items-center justify-between">
            <div class="flex gap-3">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Buscar usuario..." 
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] w-64">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                </div>
                <select id="estadoFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]">
                    <option value="todos">Todos los estados</option>
                    <option value="activo">Activos</option>
                    <option value="suspendido">Inactivos</option>
                </select>
            </div>
            <a href="{{ route('admin.usuarios.create') }}" class="bg-[#1e3a5f] hover:bg-[#152c47] text-white font-semibold py-2 px-4 rounded-lg transition inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Nuevo Usuario
            </a>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NOMBRE</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CORREO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ESTADO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">FECHA DE REGISTRO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ACCIONES</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($usuarios as $usuario)
                <tr class="hover:bg-gray-50 transition" data-estado="{{ $usuario->estado }}" data-nombre="{{ strtolower($usuario->nombre) }} {{ strtolower($usuario->apellido) }}" data-email="{{ strtolower($usuario->correo_electronico) }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                @if($usuario->perfil && $usuario->perfil->foto_perfil)
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $usuario->perfil->foto_perfil }}" alt="">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-[#1e3a5f] to-indigo-600 flex items-center justify-center">
                                        <span class="text-white text-sm font-bold">{{ substr($usuario->nombre, 0, 1) }}{{ substr($usuario->apellido, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">{{ $usuario->nombre }} {{ $usuario->apellido }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-600">{{ $usuario->correo_electronico }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($usuario->estado == 'activo')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1 text-xs"></i> Activado
                            </span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-ban mr-1 text-xs"></i> Inactivo
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $usuario->created_at ? $usuario->created_at->format('d M Y') : 'No registrada' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <!-- Ver -->
                            <a href="{{ route('admin.usuarios.show', $usuario->id_usuario) }}" 
                            class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg transition" 
                            title="Ver perfil">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            <!-- Editar -->
                            <a href="{{ route('admin.usuarios.edit', $usuario->id_usuario) }}" 
                            class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-lg transition" 
                            title="Editar usuario">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <!-- Suspender/Activar (cambiar estado) -->
                            @if($usuario->estado == 'activo')
                                <form action="{{ route('admin.usuarios.toggle-estado', $usuario->id_usuario) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-orange-600 hover:text-orange-900 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg transition" title="Suspender usuario">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.usuarios.toggle-estado', $usuario->id_usuario) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 p-2 rounded-lg transition" title="Activar usuario">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </form>
                            @endif
                            
                            <!-- Cambiar rol (Admin/Usuario) -->
                            @if($usuario->id_usuario != session('usuario_id'))
                                <form action="{{ route('admin.usuarios.toggle-rol', $usuario->id_usuario) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-purple-600 hover:text-purple-900 bg-purple-100 hover:bg-purple-200 p-2 rounded-lg transition" title="{{ $usuario->is_admin ? 'Quitar admin' : 'Hacer admin' }}">
                                        <i class="fas fa-user-shield"></i>
                                    </button>
                                </form>
                            @endif
                            
                            <!-- Eliminar -->
                            <form action="{{ route('admin.usuarios.destroy', $usuario->id_usuario) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 p-2 rounded-lg transition" title="Eliminar usuario">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="text-center">
                            <i class="fas fa-users text-gray-400 text-5xl mb-3"></i>
                            <p class="text-gray-500 text-lg">No hay usuarios registrados</p>
                            <a href="{{ route('admin.usuarios.create') }}" class="mt-3 inline-block bg-[#1e3a5f] hover:bg-[#152c47] text-white font-semibold py-2 px-4 rounded-lg">
                                Crear el primer usuario
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Paginación -->
    <div class="px-6 py-4 border-t border-gray-200 flex justify-between items-center">
        <div class="text-sm text-gray-500">
            Mostrando {{ $usuarios->firstItem() ?? 0 }} a {{ $usuarios->lastItem() ?? 0 }} de {{ $usuarios->total() }} usuarios
        </div>
        <div class="flex space-x-1">
            @if($usuarios->onFirstPage())
                <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-lg">Anterior</span>
            @else
                <a href="{{ $usuarios->previousPageUrl() }}" class="px-3 py-1 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Anterior</a>
            @endif
            
            @foreach($usuarios->getUrlRange(1, $usuarios->lastPage()) as $page => $url)
                @if($page == $usuarios->currentPage())
                    <span class="px-3 py-1 bg-[#1e3a5f] text-white rounded-lg">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-3 py-1 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">{{ $page }}</a>
                @endif
            @endforeach
            
            @if($usuarios->hasMorePages())
                <a href="{{ $usuarios->nextPageUrl() }}" class="px-3 py-1 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Siguiente</a>
            @else
                <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-lg">Siguiente</span>
            @endif
        </div>
    </div>
</div>

<script>
    // Buscador en tiempo real
    const searchInput = document.getElementById('searchInput');
    const estadoFilter = document.getElementById('estadoFilter');
    const tableRows = document.querySelectorAll('tbody tr[data-estado]');
    
    function filtrarTabla() {
        const searchTerm = searchInput.value.toLowerCase();
        const estadoValue = estadoFilter.value;
        
        tableRows.forEach(row => {
            const nombre = row.getAttribute('data-nombre') || '';
            const email = row.getAttribute('data-email') || '';
            const estado = row.getAttribute('data-estado');
            
            const matchesSearch = searchTerm === '' || nombre.includes(searchTerm) || email.includes(searchTerm);
            const matchesEstado = estadoValue === 'todos' || estado === estadoValue;
            
            if (matchesSearch && matchesEstado) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    searchInput.addEventListener('input', filtrarTabla);
    estadoFilter.addEventListener('change', filtrarTabla);
    
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection