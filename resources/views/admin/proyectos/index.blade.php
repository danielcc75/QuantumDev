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
            
            <button type="submit" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg text-sm">Filtrar</button>

            @if(request()->anyFilled(['search', 'estado', 'visibilidad']))
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
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $proyecto->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <!-- Ver - Abre el modal de ver proyecto -->
                                <button type="button" onclick="abrirModalVerProyecto({{ $proyecto->id_proyecto }})" 
                                    class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg transition" 
                                    title="Ver proyecto">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <!-- Ocultar/Mostrar - Abre modal para motivo (solo para ocultar) -->
                                @if($proyecto->visible)
                                    <button type="button"
                                        onclick="abrirModalOcultarProyecto({{ $proyecto->id_proyecto }}, '{{ addslashes($proyecto->nombre) }}')"
                                        class="text-orange-600 bg-orange-100 hover:bg-orange-200 p-2 rounded-lg">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                @else
                                    <form action="{{ route('admin.proyectos.toggle-visibilidad', $proyecto->id_proyecto) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-700 bg-green-100 hover:bg-green-200 p-2 rounded-lg" title="Mostrar proyecto">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </form>
                                @endif
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

<!-- Incluir el modal de ver proyecto -->
@include('admin.proyectos.show')

<!-- Modal: motivo para ocultar proyecto -->
<div id="modalOcultarProyecto" class="fixed inset-0 z-[80] hidden bg-black/50 backdrop-blur-sm items-center justify-center" onclick="cerrarModalOcultarProyectoFondo(event)">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
        <div class="bg-gradient-to-r from-[#1e3a5f] to-[#1e3a5f] px-6 py-4 flex items-center justify-between">
                <h3 class="text-white font-bold text-lg">
                    <i class="fas fa-eye-slash mr-2"></i> Ocultar proyecto
                </h3>
                <button type="button" onclick="cerrarModalOcultarProyecto()" class="text-white/90 hover:text-white text-xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="formOcultarProyecto" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <p class="text-sm text-gray-700">
                        Vas a ocultar el proyecto
                        <span id="modalOcultarProyectoNombre" class="font-semibold text-gray-900"></span>.
                        Indica el motivo (será visible para el dueño del proyecto en su panel).
                    </p>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Motivo <span class="text-red-500">*</span>
                        </label>
                        <textarea name="motivo" id="modalOcultarProyectoMotivo" rows="4" maxlength="500" required
                            class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/20 outline-none"
                            placeholder="Ej. Contenido inapropiado, datos sensibles expuestos, denuncia recibida..."></textarea>
                        <p id="modalOcultarProyectoError" class="hidden mt-1 text-xs text-red-600"></p>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-3 flex justify-end gap-2">
                    <button type="button" onclick="cerrarModalOcultarProyecto()"
                        class="px-4 py-2 rounded-lg text-sm text-gray-700 bg-gray-200 hover:bg-gray-300">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg text-sm text-white bg-[#e11d48] hover:bg-[#be123c]">
                        <i class="fas fa-eye-slash mr-1"></i> Confirmar ocultar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // ========================================
    // FUNCIONES PARA EL MODAL DE VER PROYECTO
    // ========================================
    
    // Esta función necesita que cargues el proyecto específico
    // Si ya tienes el proyecto en la variable $proyecto en el modal, usa esta versión:
    function abrirModalVerProyecto(proyectoId) {
        const modal = document.getElementById('modalVerProyecto');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        
        // Si necesitas cargar los datos vía AJAX, descomenta esto:
        /*
        fetch(`/admin/proyectos/${proyectoId}/json`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualizar el contenido del modal con los datos
                actualizarModalProyecto(data.proyecto);
            }
        });
        */
    }
    
    // ========================================
    // FUNCIONES PARA EL MODAL DE OCULTAR PROYECTO
    // ========================================
    
    const __modalOcultarProyecto = document.getElementById('modalOcultarProyecto');
    const __formOcultarProyecto  = document.getElementById('formOcultarProyecto');
    const __motivoProyectoInput  = document.getElementById('modalOcultarProyectoMotivo');
    const __motivoProyectoError  = document.getElementById('modalOcultarProyectoError');

    function abrirModalOcultarProyecto(idProyecto, nombre) {
        __formOcultarProyecto.action = `/admin/proyectos/${idProyecto}/toggle-visibilidad`;
        document.getElementById('modalOcultarProyectoNombre').textContent = nombre || '';
        __motivoProyectoInput.value = '';
        __motivoProyectoError.classList.add('hidden');
        __motivoProyectoError.textContent = '';
        __modalOcultarProyecto.classList.remove('hidden');
        __modalOcultarProyecto.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        setTimeout(() => __motivoProyectoInput.focus(), 50);
    }

    function cerrarModalOcultarProyecto() {
        __modalOcultarProyecto.classList.add('hidden');
        __modalOcultarProyecto.style.display = 'none';
        document.body.style.overflow = '';
    }

    function cerrarModalOcultarProyectoFondo(event) {
        if (event.target === __modalOcultarProyecto) cerrarModalOcultarProyecto();
    }

    __formOcultarProyecto.addEventListener('submit', function (e) {
        if (!__motivoProyectoInput.value.trim()) {
            e.preventDefault();
            __motivoProyectoError.textContent = 'Debes indicar el motivo para ocultar el proyecto.';
            __motivoProyectoError.classList.remove('hidden');
            __motivoProyectoInput.focus();
        }
    });

    // Cerrar modales con ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            if (!__modalOcultarProyecto.classList.contains('hidden')) {
            cerrarModalOcultarProyecto();
            }
            const modalProyecto = document.getElementById('modalVerProyecto');
            if (modalProyecto && !modalProyecto.classList.contains('hidden')) {
                cerrarModalVerProyecto();
            }
        }
    });
</script>

<style>
    #modalOcultarProyecto {
        display: none;
    }
</style>
@endsection