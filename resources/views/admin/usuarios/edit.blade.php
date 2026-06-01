<!-- ======================================== -->
<!-- MODAL PARA EDITAR USUARIO (edit.blade.php) -->
<!-- ======================================== -->
<div id="modalEditarUsuario" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[95vh] overflow-y-auto">
        
        <!-- Header del modal -->
        <div class="bg-[#1e3a5f] px-6 py-4 rounded-t-2xl sticky top-0 z-10">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-white">
                        <i class="fas fa-edit mr-2"></i> Editar Usuario
                    </h2>
                    <p class="text-blue-200 text-sm">Modifica la información del usuario</p>
                </div>
                <button type="button" onclick="cerrarModalEditarUsuario()" class="text-white hover:text-gray-200 transition-colors">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Contenido del modal -->
        <div class="p-6">
    
            <!-- Botón volver (oculto en el modal) -->
            <div class="mb-4 hidden">
        <a href="{{ route('admin.usuarios') }}" class="text-[#1e3a5f] hover:text-[#152c47] inline-flex items-center gap-2">
            <i class="fas fa-arrow-left"></i>
            <span>Volver a usuarios</span>
        </a>
    </div>

    <!-- Título -->
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Usuario</h1>

    <!-- Formulario principal -->
            <form id="formEditarUsuario" action="{{ route('admin.usuarios.update', $usuario->id_usuario) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- COLUMNA IZQUIERDA -->
            <div class="space-y-6">
                
                <!-- Tarjeta: Datos Personales -->
                <div class="bg-[#f0f4f8] rounded-2xl p-5 shadow-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-user text-blue-500 text-sm"></i>
                        <h4 class="font-semibold text-gray-800 text-sm">Datos Personales</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">Información básica del usuario</p>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            Nombre <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            Apellido <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="apellido" value="{{ old('apellido', $usuario->apellido) }}" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            Correo Electrónico <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="correo_electronico" value="{{ old('correo_electronico', $usuario->correo_electronico) }}" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono', $usuario->telefono) }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white"
                            placeholder="Ej: +34 123 456 789">
                    </div>
                </div>

                <!-- Tarjeta: Rol y Estado -->
                <div class="bg-[#f0f4f8] rounded-2xl p-5 shadow-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-shield-alt text-purple-500 text-sm"></i>
                        <h4 class="font-semibold text-gray-800 text-sm">Rol y Estado</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">Configuración de permisos</p>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Rol</label>
                        <select name="is_admin" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">
                            <option value="0" {{ !$usuario->is_admin ? 'selected' : '' }}>Usuario normal</option>
                            <option value="1" {{ $usuario->is_admin ? 'selected' : '' }}>Administrador</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Estado</label>
                        <select name="estado" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">
                            <option value="activo" {{ $usuario->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="suspendido" {{ $usuario->estado == 'suspendido' ? 'selected' : '' }}>Suspendido</option>
                        </select>
                    </div>
                </div>

            </div>

            <!-- COLUMNA DERECHA -->
            <div class="space-y-6">

                <!-- Tarjeta: Contraseña -->
                <div class="bg-[#f0f4f8] rounded-2xl p-5 shadow-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-lock text-green-500 text-sm"></i>
                        <h4 class="font-semibold text-gray-800 text-sm">Seguridad</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">Cambiar contraseña del usuario</p>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Nueva Contraseña</label>
                        <input type="password" name="contrasenia"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white"
                            placeholder="Dejar en blanco para mantener la actual">
                                <p class="text-xs text-gray-400 mt-1">Mínimo 6 caracteres</p>
                    </div>
                </div>

                <!-- Tarjeta: Información Adicional -->
                <div class="bg-[#f0f4f8] rounded-2xl p-5 shadow-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-calendar-alt text-gray-500 text-sm"></i>
                        <h4 class="font-semibold text-gray-800 text-sm">Información del sistema</h4>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">Datos de registro</p>

                    <div class="space-y-2">
                        <div class="flex">
                            <span class="w-32 text-xs text-gray-500">ID de usuario:</span>
                            <span class="text-xs text-gray-800">#{{ $usuario->id_usuario }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-32 text-xs text-gray-500">Registrado:</span>
                            <span class="text-xs text-gray-800">{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : 'No registrada' }}</span>
                        </div>
                        @if($usuario->ultimo_acceso)
                        <div class="flex">
                            <span class="w-32 text-xs text-gray-500">Último acceso:</span>
                            <span class="text-xs text-gray-800">{{ $usuario->ultimo_acceso->format('d/m/Y H:i') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <!-- Botones de acción -->
        <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="cerrarModalEditarUsuario()" 
                class="px-5 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition">
                Cancelar
                    </button>
            <button type="submit" 
                class="px-5 py-2 bg-[#1e3a5f] hover:bg-[#152c47] text-white rounded-lg transition flex items-center gap-2">
                <i class="fas fa-save"></i>
                Guardar Cambios
            </button>
        </div>
    </form>
            
        </div>
    </div>
</div>