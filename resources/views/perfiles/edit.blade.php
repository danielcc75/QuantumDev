@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-green-600 to-green-700">
            <h3 class="text-xl font-bold text-white">
                <i class="fas fa-user-circle mr-2"></i>
                Editar Perfil de {{ $usuario->nombre }} {{ $usuario->apellido }}
            </h3>
        </div>
        
        <form action="{{ route('usuarios.updatePerfil', $usuario->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-image text-gray-400 mr-1"></i>
                        Foto (URL)
                    </label>
                    <input type="url" name="foto" value="{{ $usuario->perfil->foto ?? '' }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="https://ejemplo.com/foto.jpg">
                    @if($usuario->perfil && $usuario->perfil->foto)
                        <img src="{{ $usuario->perfil->foto }}" class="mt-2 h-20 w-20 rounded-full object-cover">
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-align-left text-gray-400 mr-1"></i>
                        Biografía
                    </label>
                    <textarea name="biografia" rows="5"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Cuéntanos sobre ti...">{{ $usuario->perfil->biografia ?? '' }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-link text-gray-400 mr-1"></i>
                        Links (Formato JSON)
                    </label>
                    <textarea name="links" rows="4"
    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 font-mono text-sm"
    placeholder='{"github": "https://github.com/usuario", "linkedin": "https://linkedin.com/in/usuario"}'>
    {{ old('links', json_encode($usuario->perfil->links ?? [])) }}
</textarea>
                    <p class="text-xs text-gray-500 mt-1">Ejemplo: {"github": "https://...", "twitter": "https://..."}</p>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
                <a href="{{ route('usuarios.show', $usuario->id) }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>
                    Actualizar Perfil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection