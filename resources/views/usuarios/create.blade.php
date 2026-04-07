@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700">
            <h3 class="text-xl font-bold text-white">
                <i class="fas fa-user-plus mr-2"></i>
                Crear Nuevo Usuario
            </h3>
            <p class="text-blue-100 text-sm mt-1">Ingresa los datos del nuevo usuario</p>
        </div>
        
        <form action="{{ route('usuarios.store') }}" method="POST" class="p-6">
            @csrf
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user text-gray-400 mr-1"></i>
                        Nombre *
                    </label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nombre') border-red-500 @enderror"
                        placeholder="Ingrese el nombre">
                    @error('nombre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user text-gray-400 mr-1"></i>
                        Apellido *
                    </label>
                    <input type="text" name="apellido" value="{{ old('apellido') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('apellido') border-red-500 @enderror"
                        placeholder="Ingrese el apellido">
                    @error('apellido')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-400 mr-1"></i>
                        Email *
                    </label>
                    <input type="email" name="correo_electronico" value="{{ old('correo_electronico') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('correo_electronico') border-red-500 @enderror"
                        placeholder="usuario@ejemplo.com">
                    @error('correo_electronico')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-phone text-gray-400 mr-1"></i>
                        Teléfono
                    </label>
                    <input type="text" name="telefono" value="{{ old('telefono') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="+54 11 1234-5678">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-1"></i>
                        Contraseña *
                    </label>
                    <input type="password" name="contrasenia" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('contrasenia') border-red-500 @enderror"
                        placeholder="Mínimo 6 caracteres">
                    @error('contrasenia')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
                <a href="{{ route('usuarios.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>
                    Guardar Usuario
                </button>
            </div>
        </form>
    </div>
</div>
@endsection