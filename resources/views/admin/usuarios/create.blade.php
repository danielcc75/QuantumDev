<!-- ======================================== -->
<!-- MODAL PARA CREAR USUARIO (create.blade.php) -->
<!-- ======================================== -->
<div id="modalCrearUsuario" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[95vh] overflow-y-auto">
        
        <!-- Header del modal -->
        <div class="bg-[#1e3a5f] px-6 py-4 rounded-t-2xl sticky top-0 z-10">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-white">
                        <i class="fas fa-user-plus mr-2"></i> Crear Usuario
                    </h2>
                    <p class="text-blue-200 text-sm">Completa el formulario para registrar un nuevo usuario</p>
                </div>
                <button type="button" onclick="cerrarModalUsuario()" class="text-white hover:text-gray-200 transition-colors">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <p class="text-gray-200 text-sm">
                Completa el formulario para registrar un nuevo usuario en el sistema
            </p>
        </div>

        <!-- Contenido del modal -->
        <div class="p-6">
            
            @php
                $inputClass = "w-full mt-1 px-3 py-2 rounded-md border border-gray-300 bg-white outline-none focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/20 transition-all";
            @endphp

            <form id="formCrearUsuario" action="{{ route('admin.usuarios.store') }}" method="POST" class="grid md:grid-cols-2 gap-4">
                @csrf

                <!-- Nombre -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-user text-[#1e3a5f] text-xs"></i>
                        Nombre <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nombre" id="nombre" 
                        placeholder="Nombre del usuario" 
                        class="{{ $inputClass }}" required>
                    <p class="error-nombre text-sm text-red-600 hidden mt-1"></p>
                </div>

                <!-- Apellido -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-users text-[#1e3a5f] text-xs"></i>
                        Apellido <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="apellido" id="apellido" 
                        placeholder="Apellido del usuario" 
                        class="{{ $inputClass }}" required>
                    <p class="error-apellido text-sm text-red-600 hidden mt-1"></p>
                </div>

                <!-- Email -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-envelope text-[#1e3a5f] text-xs"></i>
                        Correo electrónico <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="correo_electronico" id="correo_electronico" 
                        placeholder="usuario@email.com" 
                        class="{{ $inputClass }}" required>
                    <p class="error-correo_electronico text-sm text-red-600 hidden mt-1"></p>
                </div>

                <!-- Teléfono -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-phone text-[#1e3a5f] text-xs"></i>
                        Teléfono
                    </label>
                    <input type="text" name="telefono" id="telefono" 
                        placeholder="+591 700 00000" 
                        class="{{ $inputClass }}">
                    <p class="error-telefono text-sm text-red-600 hidden mt-1"></p>
                </div>

                <!-- Contraseña -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-lock text-[#1e3a5f] text-xs"></i>
                        Contraseña <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="contrasenia" id="contrasenia" 
                            placeholder="Mínimo 6 caracteres" 
                            class="{{ $inputClass }} pr-10" required>
                        <button type="button" onclick="togglePassword('contrasenia', 'passwordIcon')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#1e3a5f]">
                            <i id="passwordIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Mínimo 6 caracteres</p>
                    <p class="error-contrasenia text-sm text-red-600 hidden mt-1"></p>
                </div>

                <!-- Rol -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-user-shield text-[#1e3a5f] text-xs"></i>
                        Rol
                    </label>
                    <select name="is_admin" id="is_admin" class="{{ $inputClass }}">
                        <option value="0">Usuario normal</option>
                        <option value="1">Administrador</option>
                    </select>
                    <p class="error-is_admin text-sm text-red-600 hidden mt-1"></p>
                </div>

                <!-- Botones -->
                <div class="md:col-span-2 flex justify-end gap-3 mt-2 pt-4 border-t border-gray-200">
                    <button type="button" onclick="cerrarModalUsuario()" 
                        class="px-5 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-times mr-2"></i>Cancelar
                    </button>
                    <button type="submit" 
                        class="px-5 py-2 bg-[#1e3a5f] hover:bg-[#152c47] text-white rounded-lg transition flex items-center gap-2">
                        <i class="fas fa-check"></i>
                        Crear Usuario
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input && icon) {
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    }
    
    function cerrarModalUsuario() {
        const modal = document.getElementById('modalCrearUsuario');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }
    
    // Envío del formulario con AJAX
    document.addEventListener('DOMContentLoaded', function() {
        const formCrearUsuario = document.getElementById('formCrearUsuario');
        
        if (formCrearUsuario) {
            formCrearUsuario.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Creando...';
                submitBtn.disabled = true;
                
                // Limpiar errores
                document.querySelectorAll('[class^="error-"]').forEach(el => {
                    el.classList.add('hidden');
                });
                document.querySelectorAll('#formCrearUsuario input, #formCrearUsuario select').forEach(input => {
                    input.classList.remove('border-red-500');
                });
                
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
                        await Swal.fire({
                            icon: 'success',
                            title: '¡Usuario creado!',
                            text: data.message,
                            confirmButtonColor: '#1e3a5f',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        
                        cerrarModalUsuario();
                        location.reload();
                    } else {
                        if (data.errors) {
                            for (const [key, messages] of Object.entries(data.errors)) {
                                const errorElement = document.querySelector(`.error-${key}`);
                                if (errorElement) {
                                    errorElement.textContent = messages[0];
                                    errorElement.classList.remove('hidden');
                                    
                                    const inputElement = document.getElementById(key);
                                    if (inputElement) {
                                        inputElement.classList.add('border-red-500');
                                    }
                                }
                            }
                        } else {
                            await Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'Error al crear el usuario',
                                confirmButtonColor: '#d33'
                            });
                        }
                        
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                } catch (error) {
                    console.error('Error:', error);
                    await Swal.fire({
                        icon: 'error',
                        title: 'Error de conexión',
                        text: 'No se pudo conectar con el servidor.',
                        confirmButtonColor: '#d33'
                    });
                    
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });
        }
    });
</script>

<style>
    /* Animación suave para el modal */
    #modalCrearUsuario {
        animation: fadeIn 0.2s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>