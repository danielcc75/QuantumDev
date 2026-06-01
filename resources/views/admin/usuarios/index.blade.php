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
            <button type="button" onclick="abrirModalUsuario()" class="bg-[#1e3a5f] hover:bg-[#152c47] text-white font-semibold py-2 px-4 rounded-lg transition inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Nuevo Usuario
            </button>
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
                            <!-- Botón Ver -->
                            <button type="button" onclick="abrirModalVerUsuario({{ $usuario->id_usuario }})" 
                            class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg transition" 
                            title="Ver perfil">
                                <i class="fas fa-eye"></i>
                            </button>
                            
                            <!-- Botón Editar -->
                            <button type="button" onclick="abrirModalEditarUsuario({{ $usuario->id_usuario }})" 
                            class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-lg transition" 
                            title="Editar usuario">
                                <i class="fas fa-edit"></i>
                            </button>
                            
                            @if($usuario->estado == 'activo')
                                <form action="{{ route('admin.usuarios.toggle-estado', $usuario->id_usuario) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-orange-600 bg-orange-100 p-2 rounded-lg hover:bg-orange-200" title="Suspender usuario">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                    <input type="hidden" name="motivo" value="Sin motivo especificado">
                                </form>
                            @else
                                <form action="{{ route('admin.usuarios.toggle-estado', $usuario->id_usuario) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 bg-green-100 p-2 rounded-lg hover:bg-green-200" title="Activar usuario">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </form>
                            @endif
                            
                            @if($usuario->id_usuario != session('usuario_id'))
                                <form action="{{ route('admin.usuarios.toggle-rol', $usuario->id_usuario) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-purple-600 hover:text-purple-900 bg-purple-100 hover:bg-purple-200 p-2 rounded-lg transition" title="{{ $usuario->is_admin ? 'Quitar admin' : 'Hacer admin' }}">
                                        <i class="fas fa-user-shield"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="text-center">
                            <i class="fas fa-users text-gray-400 text-5xl mb-3"></i>
                            <p class="text-gray-500 text-lg">No hay usuarios registrados</p>
                            <button type="button" onclick="abrirModalUsuario()" class="mt-3 inline-block bg-[#1e3a5f] hover:bg-[#152c47] text-white font-semibold py-2 px-4 rounded-lg">
                                Crear el primer usuario
                            </button>
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

<!-- Incluir los modales -->
@include('admin.usuarios.create')
@include('admin.usuarios.edit')
@include('admin.usuarios.show')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Función para abrir el modal de crear usuario
    function abrirModalUsuario() {
        const modal = document.getElementById('modalCrearUsuario');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }
    
    // Función para abrir modal VER con AJAX
    function abrirModalVerUsuario(id) {
        const modal = document.getElementById('modalVerUsuario');
        const contenidoDiv = modal.querySelector('.p-6');
        
        // Mostrar loading
        contenidoDiv.innerHTML = '<div class="text-center py-12"><i class="fas fa-spinner fa-spin text-4xl text-[#1e3a5f]"></i><p class="mt-4">Cargando...</p></div>';
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        
        // Cargar contenido vía AJAX
        fetch(`/admin/usuarios/${id}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const nuevoContenido = doc.querySelector('#modalVerUsuario .p-6');
            if (nuevoContenido) {
                contenidoDiv.innerHTML = nuevoContenido.innerHTML;
            } else {
                contenidoDiv.innerHTML = '<p class="text-center text-red-500">Error al cargar el perfil</p>';
            }
        })
        .catch(() => {
            contenidoDiv.innerHTML = '<p class="text-center text-red-500">Error de conexión</p>';
        });
    }
    
    // Función para abrir modal EDITAR con AJAX
    function abrirModalEditarUsuario(id) {
        const modal = document.getElementById('modalEditarUsuario');
        const contenidoDiv = modal.querySelector('.p-6');
        
        // Mostrar loading
        contenidoDiv.innerHTML = '<div class="text-center py-12"><i class="fas fa-spinner fa-spin text-4xl text-[#1e3a5f]"></i><p class="mt-4">Cargando...</p></div>';
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        
        fetch(`/admin/usuarios/${id}/editar`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const nuevoContenido = doc.querySelector('#modalEditarUsuario .p-6');
            if (nuevoContenido) {
                contenidoDiv.innerHTML = nuevoContenido.innerHTML;
                // Actualizar action del formulario
                const form = contenidoDiv.querySelector('form');
                if (form) form.action = `/admin/usuarios/${id}`;
                // Re-ejecutar scripts si es necesario (para togglePassword, etc.)
                const scripts = nuevoContenido.querySelectorAll('script');
                scripts.forEach(script => {
                    const newScript = document.createElement('script');
                    if (script.src) {
                        newScript.src = script.src;
                    } else {
                        newScript.textContent = script.textContent;
                    }
                    document.body.appendChild(newScript);
                });
            } else {
                contenidoDiv.innerHTML = '<p class="text-center text-red-500">Error al cargar el formulario</p>';
            }
        })
        .catch(() => {
            contenidoDiv.innerHTML = '<p class="text-center text-red-500">Error de conexión</p>';
        });
    }
    
    // Cerrar modales (funciones ya definidas en cada archivo, pero las redefinimos globalmente por si acaso)
    window.cerrarModalVerUsuario = function() {
        const modal = document.getElementById('modalVerUsuario');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }
    };
    
    window.cerrarModalEditarUsuario = function() {
        const modal = document.getElementById('modalEditarUsuario');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }
    };
    
    window.cerrarModalUsuario = function() {
        const modal = document.getElementById('modalCrearUsuario');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    };
    
    // Cerrar modales con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            cerrarModalVerUsuario();
            cerrarModalEditarUsuario();
            cerrarModalUsuario();
        }
    });
    
    // Cerrar al hacer clic fuera
    document.getElementById('modalVerUsuario')?.addEventListener('click', function(e) {
        if (e.target === this) cerrarModalVerUsuario();
    });
    document.getElementById('modalEditarUsuario')?.addEventListener('click', function(e) {
        if (e.target === this) cerrarModalEditarUsuario();
    });
    document.getElementById('modalCrearUsuario')?.addEventListener('click', function(e) {
        if (e.target === this) cerrarModalUsuario();
    });
    
    // Buscador en tiempo real (sin cambios)
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
            row.style.display = (matchesSearch && matchesEstado) ? '' : 'none';
        });
    }
    
    if (searchInput) searchInput.addEventListener('input', filtrarTabla);
    if (estadoFilter) estadoFilter.addEventListener('change', filtrarTabla);
</script>
@endsection