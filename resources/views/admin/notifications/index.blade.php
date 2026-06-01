@extends('layouts.app')

@section('content')
<div class="space-y-6">
    
    <!-- Tarjeta principal -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-bell text-[#1e3a5f] mr-2"></i>
                    Notificaciones
                </h1>
                <p class="text-gray-500 mt-1">Gestiona las notificaciones del sistema</p>
            </div>
            <div class="flex gap-2">
                <button type="button" onclick="abrirModalNotificacion()" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg text-sm hover:bg-[#152c47] transition-colors">
                    <i class="fas fa-plus mr-2"></i>Nueva Notificación
                </button>
                <form action="{{ route('admin.notifications.limpiar') }}" method="POST" onsubmit="return confirm('¿Eliminar notificaciones antiguas (+30 días)?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="fas fa-trash-alt mr-2"></i>Limpiar Antiguas
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-blue-500">
            <p class="text-2xl font-bold">{{ $estadisticas['total'] }}</p>
            <p class="text-xs text-gray-500">Total</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-green-500">
            <p class="text-2xl font-bold">{{ $estadisticas['leidas'] }}</p>
            <p class="text-xs text-gray-500">Leídas</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-yellow-500">
            <p class="text-2xl font-bold">{{ $estadisticas['no_leidas'] }}</p>
            <p class="text-xs text-gray-500">No leídas</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-purple-500">
            <p class="text-2xl font-bold">{{ $estadisticas['por_tipo']['info'] }}</p>
            <p class="text-xs text-gray-500">Información</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-red-500">
            <p class="text-2xl font-bold">{{ $estadisticas['por_tipo']['warning'] + $estadisticas['por_tipo']['error'] }}</p>
            <p class="text-xs text-gray-500">Alertas</p>
        </div>
    </div>
    
    <!-- Filtros -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <form method="GET" class="flex flex-wrap gap-3">
            <select name="tipo" class="px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#1e3a5f] focus:border-[#1e3a5f]">
                <option value="todos">Todos los tipos</option>
                <option value="info" {{ request('tipo') == 'info' ? 'selected' : '' }}>ℹ️ Información</option>
                <option value="success" {{ request('tipo') == 'success' ? 'selected' : '' }}>✅ Éxito</option>
                <option value="warning" {{ request('tipo') == 'warning' ? 'selected' : '' }}>⚠️ Advertencia</option>
                <option value="error" {{ request('tipo') == 'error' ? 'selected' : '' }}>❌ Error</option>
            </select>
            
            <select name="leido" class="px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#1e3a5f] focus:border-[#1e3a5f]">
                <option value="todos">Todos</option>
                <option value="si" {{ request('leido') == 'si' ? 'selected' : '' }}>Leídas</option>
                <option value="no" {{ request('leido') == 'no' ? 'selected' : '' }}>No leídas</option>
            </select>
            
            <button type="submit" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg text-sm hover:bg-[#152c47] transition-colors">
                <i class="fas fa-search mr-2"></i>Filtrar
            </button>
            
            @if(request()->anyFilled(['tipo', 'leido']))
                <a href="{{ route('admin.notifications') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-400 transition-colors">
                    <i class="fas fa-times mr-2"></i>Limpiar
                </a>
            @endif
        </form>
    </div>
    
    <!-- Tabla de notificaciones -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">USUARIO</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TIPO</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TÍTULO</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ESTADO</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">FECHA</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($notificaciones as $notif)
                    <tr class="hover:bg-gray-50 transition-colors {{ !$notif->leido ? 'bg-yellow-50' : '' }}">
                        <td class="px-6 py-4 text-sm">{{ $notif->usuario->nombre ?? 'N/A' }} {{ $notif->usuario->apellido ?? '' }}</td>
                        <td class="px-6 py-4">
                            @if($notif->tipo == 'info')
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">ℹ️ Info</span>
                            @elseif($notif->tipo == 'success')
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">✅ Éxito</span>
                            @elseif($notif->tipo == 'warning')
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">⚠️ Alerta</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">❌ Error</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $notif->titulo }}</td>
                        <td class="px-6 py-4">
                            @if($notif->leido)
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">
                                    <i class="fas fa-check-circle mr-1"></i>Leída
                                </span>
                            @else
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">
                                    <i class="fas fa-clock mr-1"></i>No leída
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $notif->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.notifications.show', $notif->id_notification) }}" class="text-blue-600 bg-blue-100 p-2 rounded-lg hover:bg-blue-200 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.notifications.destroy', $notif->id_notification) }}" method="POST" onsubmit="return confirm('¿Eliminar esta notificación?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 bg-red-100 p-2 rounded-lg hover:bg-red-200 transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-bell-slash text-4xl mb-2 block"></i>
                            No hay notificaciones registradas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t">
            {{ $notificaciones->links() }}
        </div>
    </div>
</div>

<!-- ======================================== -->
<!-- MODAL PARA CREAR NOTIFICACIÓN -->
<!-- ======================================== -->
<div id="modalNotificacion" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[95vh] overflow-y-auto">
        
        <div class="bg-[#1e3a5f] px-6 py-4 rounded-t-2xl sticky top-0 z-10">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-white">
                        <i class="fas fa-bell mr-2"></i> Nueva Notificación
                    </h2>
                    <p class="text-blue-200 text-sm">Envía notificaciones a los usuarios del sistema</p>
                </div>
                <button type="button" onclick="cerrarModalNotificacion()" class="text-white hover:text-gray-200 transition-colors">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
        </div>
        
        <form id="formNotificacion" action="{{ route('admin.notifications.store') }}" method="POST" class="p-6">
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de notificación *</label>
                <div class="flex gap-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="tipo" value="info" checked class="mr-1 text-[#1e3a5f]"> 
                        <span>ℹ️ Información</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="tipo" value="success" class="mr-1 text-[#1e3a5f]"> 
                        <span>✅ Éxito</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="tipo" value="warning" class="mr-1 text-[#1e3a5f]"> 
                        <span>⚠️ Advertencia</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="tipo" value="error" class="mr-1 text-[#1e3a5f]"> 
                        <span>❌ Error</span>
                    </label>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Destinatario *</label>
                <div class="flex gap-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="destinatario" value="todos" id="modalParaTodos" checked class="mr-1 text-[#1e3a5f]"> 
                        <span>Todos los usuarios</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="destinatario" value="individual" id="modalParaIndividual" class="mr-1 text-[#1e3a5f]"> 
                        <span>Usuario específico</span>
                    </label>
                </div>
            </div>
            
            <div id="modalSelectUsuario" class="mb-4 hidden">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Buscar usuario *
                <span class="text-xs text-gray-500">(Escribe nombre, apellido o email)</span>
            </label>
            
            <!-- Input de búsqueda -->
            <input type="text" 
                id="buscadorUsuarioNotificacion" 
                placeholder="🔍 Escribe para buscar usuario..." 
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:border-[#1e3a5f]"
                autocomplete="off">
            
            <!-- Resultados -->
            <div id="resultadosUsuariosNotificacion" class="mt-2 border rounded-lg max-h-48 overflow-y-auto hidden"></div>
            
            <!-- Usuario seleccionado -->
            <div id="usuarioSeleccionadoNotificacion" class="mt-2 hidden">
                <div class="bg-green-50 border border-green-200 rounded-lg p-2 flex justify-between items-center">
                    <div>
                        <span id="usuarioSeleccionadoNombre" class="font-medium text-sm"></span>
                        <span id="usuarioSeleccionadoEmail" class="text-xs text-gray-500 block"></span>
                    </div>
                    <button type="button" onclick="limpiarSeleccionUsuarioNotificacion()" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <input type="hidden" name="usuario_id" id="usuarioIdSeleccionadoNotificacion" value="">
        </div>
                    
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Título *</label>
                <input type="text" name="titulo" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:border-[#1e3a5f]" placeholder="Ej: Nuevo proyecto destacado">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Mensaje *</label>
                <textarea name="mensaje" rows="4" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-[#1e3a5f] focus:border-[#1e3a5f]" placeholder="Escribe el contenido de la notificación..."></textarea>
            </div>
            
            <div class="flex justify-end gap-3 pt-4 border-t">
                <button type="button" onclick="cerrarModalNotificacion()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </button>
                <button type="submit" class="px-4 py-2 bg-[#1e3a5f] text-white rounded-lg hover:bg-[#152c47] transition-colors">
                    <i class="fas fa-paper-plane mr-2"></i> Enviar Notificación
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Abrir modal
    function abrirModalNotificacion() {
        const modal = document.getElementById('modalNotificacion');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Resetear formulario
        const form = document.getElementById('formNotificacion');
        form.reset();
        
        // Resetear campos específicos
        document.getElementById('modalSelectUsuario').classList.add('hidden');
        document.getElementById('modalParaTodos').checked = true;
        
        // Limpiar errores visuales si los hay
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.classList.remove('border-red-500');
        });
    }
    
    // Cerrar modal
    function cerrarModalNotificacion() {
        const modal = document.getElementById('modalNotificacion');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    
    // Mostrar/ocultar selector de usuario
    document.addEventListener('DOMContentLoaded', function() {
        const radioButtons = document.querySelectorAll('input[name="destinatario"]');
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                const selectDiv = document.getElementById('modalSelectUsuario');
                if (this.value === 'individual') {
                    selectDiv.classList.remove('hidden');
                } else {
                    selectDiv.classList.add('hidden');
                }
            });
        });
    });
    
    // Envío del formulario con AJAX
    const formNotificacion = document.getElementById('formNotificacion');
    
    if (formNotificacion) {
        formNotificacion.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Mostrar loading en el botón
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Enviando...';
            submitBtn.disabled = true;
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    // Éxito
                    await Swal.fire({
                        icon: 'success',
                        title: '¡Notificación enviada!',
                        text: data.message || 'La notificación se ha enviado correctamente',
                        confirmButtonColor: '#1e3a5f',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    cerrarModalNotificacion();
                    location.reload();
                } else {
                    // Error de validación o del servidor
                    let errorMsg = '';
                    if (data.errors) {
                        const errorList = Object.values(data.errors).flat();
                        errorMsg = errorList.join('\n');
                    } else {
                        errorMsg = data.message || 'Error al enviar la notificación';
                    }
                    
                    await Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMsg,
                        confirmButtonColor: '#d33'
                    });
                    
                    // Restaurar botón
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            } catch (error) {
                console.error('Error:', error);
                await Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo conectar con el servidor. Verifica tu conexión.',
                    confirmButtonColor: '#d33'
                });
                
                // Restaurar botón
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    }
    
    // Cerrar modal con ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('modalNotificacion');
            if (modal && !modal.classList.contains('hidden')) {
                cerrarModalNotificacion();
            }
        }
    });
    
    // Cerrar modal al hacer clic fuera
    const modal = document.getElementById('modalNotificacion');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModalNotificacion();
            }
        });
    }
    // Variables para el buscador
let todosUsuarios = [];

// Cargar todos los usuarios al abrir el modal
function cargarListaUsuarios() {
    fetch('/admin/usuarios/listado-simple')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                todosUsuarios = data.usuarios;
            }
        })
        .catch(error => console.error('Error:', error));
}

// Buscar usuarios en tiempo real
function buscarUsuariosNotificacion() {
    const searchTerm = document.getElementById('buscadorUsuarioNotificacion').value.toLowerCase();
    const resultadosDiv = document.getElementById('resultadosUsuariosNotificacion');
    
    if (searchTerm.length < 1) {
        resultadosDiv.classList.add('hidden');
        return;
    }
    
    const filtrados = todosUsuarios.filter(user => {
        const nombreCompleto = `${user.nombre} ${user.apellido}`.toLowerCase();
        const email = user.correo_electronico.toLowerCase();
        return nombreCompleto.includes(searchTerm) || email.includes(searchTerm);
    });
    
    if (filtrados.length === 0) {
        resultadosDiv.innerHTML = `<div class="p-3 text-center text-gray-500">No se encontraron usuarios</div>`;
        resultadosDiv.classList.remove('hidden');
        return;
    }
    
    resultadosDiv.innerHTML = filtrados.map(user => `
        <div class="p-2 hover:bg-gray-100 cursor-pointer border-b last:border-b-0" 
             onclick="seleccionarUsuarioNotificacion(${user.id_usuario}, '${user.nombre}', '${user.apellido}', '${user.correo_electronico}')">
            <div class="font-medium text-sm">${user.nombre} ${user.apellido}</div>
            <div class="text-xs text-gray-500">${user.correo_electronico}</div>
        </div>
    `).join('');
    
    resultadosDiv.classList.remove('hidden');
}

// Seleccionar usuario
function seleccionarUsuarioNotificacion(id, nombre, apellido, email) {
    document.getElementById('usuarioIdSeleccionadoNotificacion').value = id;
    document.getElementById('usuarioSeleccionadoNombre').innerHTML = `<i class="fas fa-user mr-1"></i> ${nombre} ${apellido}`;
    document.getElementById('usuarioSeleccionadoEmail').innerHTML = `<i class="fas fa-envelope mr-1"></i> ${email}`;
    
    document.getElementById('resultadosUsuariosNotificacion').classList.add('hidden');
    document.getElementById('usuarioSeleccionadoNotificacion').classList.remove('hidden');
    document.getElementById('buscadorUsuarioNotificacion').value = '';
}

// Limpiar selección
function limpiarSeleccionUsuarioNotificacion() {
    document.getElementById('usuarioIdSeleccionadoNotificacion').value = '';
    document.getElementById('usuarioSeleccionadoNotificacion').classList.add('hidden');
    document.getElementById('buscadorUsuarioNotificacion').value = '';
    document.getElementById('buscadorUsuarioNotificacion').focus();
}

// Evento de búsqueda en tiempo real
document.getElementById('buscadorUsuarioNotificacion')?.addEventListener('input', function() {
    buscarUsuariosNotificacion();
});

// Modificar la función abrirModalNotificacion
const abrirModalOriginal = window.abrirModalNotificacion;
window.abrirModalNotificacion = function() {
    if (abrirModalOriginal) abrirModalOriginal();
    cargarListaUsuarios();
    limpiarSeleccionUsuarioNotificacion();
};

// Validar que se haya seleccionado un usuario antes de enviar
const formOriginal = document.getElementById('formNotificacion');
if (formOriginal) {
    formOriginal.addEventListener('submit', function(e) {
        const destinatario = document.querySelector('input[name="destinatario"]:checked').value;
        if (destinatario === 'individual') {
            const usuarioId = document.getElementById('usuarioIdSeleccionadoNotificacion').value;
            if (!usuarioId) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Campo requerido',
                    text: 'Por favor, busca y selecciona un usuario',
                    confirmButtonColor: '#1e3a5f'
                });
            }
        }
    });
}
</script>
@endsection