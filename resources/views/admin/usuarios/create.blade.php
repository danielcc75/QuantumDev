@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <!-- Botón volver -->
    <div class="mb-4">
        <a href="{{ route('admin.usuarios') }}" class="text-[#1e3a5f] hover:text-[#152c47] inline-flex items-center gap-2">
            <i class="fas fa-arrow-left"></i>
            <span>Volver a usuarios</span>
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        
        <!-- Header -->
        <div class="bg-[#1e3a5f] text-center px-6 py-6">
            <div class="flex justify-center items-center gap-2 mb-1">
                <i class="fas fa-user-plus text-white text-xl"></i>
                <h2 class="text-white text-2xl font-bold">Crear Usuario</h2>
            </div>
            <p class="text-gray-200 text-sm">
                Completa el formulario para registrar un nuevo usuario en el sistema
            </p>
        </div>

        <!-- Contenido -->
        <div class="p-6">
            
            @php
                $inputClass = "w-full mt-1 px-3 py-2 rounded-md border border-gray-300 bg-white outline-none focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/20";
            @endphp

            <form action="{{ route('admin.usuarios.store') }}" method="POST" class="grid md:grid-cols-2 gap-4">
                @csrf

                <!-- Nombre -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-user text-[#1e3a5f] text-xs"></i>
                        Nombre <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" 
                        placeholder="Nombre del usuario" 
                        class="{{ $inputClass }}" required>
                    @error('nombre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Apellido -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-users text-[#1e3a5f] text-xs"></i>
                        Apellido <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="apellido" value="{{ old('apellido') }}" 
                        placeholder="Apellido del usuario" 
                        class="{{ $inputClass }}" required>
                    @error('apellido')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-envelope text-[#1e3a5f] text-xs"></i>
                        Correo electrónico <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="correo_electronico" value="{{ old('correo_electronico') }}" 
                        placeholder="usuario@email.com" 
                        class="{{ $inputClass }}" required>
                    @error('correo_electronico')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-phone text-[#1e3a5f] text-xs"></i>
                        Teléfono
                    </label>
                    <input type="text" name="telefono" value="{{ old('telefono') }}" 
                        placeholder="+591 700 00000" 
                        class="{{ $inputClass }}">
                    @error('telefono')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-lock text-[#1e3a5f] text-xs"></i>
                        Contraseña <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="contrasenia" id="password" 
                            placeholder="Mínimo 6 caracteres" 
                            class="{{ $inputClass }} pr-10" required>
                        <button type="button" onclick="togglePassword('password', 'passwordIcon')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#1e3a5f]">
                            <i id="passwordIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Mínimo 6 caracteres</p>
                    @error('contrasenia')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rol -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-user-shield text-[#1e3a5f] text-xs"></i>
                        Rol
                    </label>
                    <select name="is_admin" class="{{ $inputClass }}">
                        <option value="0" {{ old('is_admin') == 0 ? 'selected' : '' }}>Usuario normal</option>
                        <option value="1" {{ old('is_admin') == 1 ? 'selected' : '' }}>Administrador</option>
                    </select>
                    @error('is_admin')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="md:col-span-2 flex justify-end gap-3 mt-2 pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.usuarios') }}" 
                        class="px-5 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition">
                        Cancelar
                    </a>
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
</script>
@endsection