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

        <form action="{{ route('usuarios.updatePerfil', $usuario->id_usuario) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-image text-gray-400 mr-1"></i>
                        Foto (URL)
                    </label>
                    <input type="url" name="foto_perfil" value="{{ $usuario->perfil->foto_perfil ?? '' }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="https://ejemplo.com/foto.jpg">
                    @if($usuario->perfil && $usuario->perfil->foto_perfil)
                        <img src="{{ $usuario->perfil->foto_perfil }}" class="mt-2 h-20 w-20 rounded-full object-cover">
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>
                        Ubicación
                    </label>
                    <input type="text" name="ubicacion" value="{{ $usuario->perfil->ubicacion ?? '' }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Ciudad, País">
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
                        Redes sociales
                    </label>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <i class="fab fa-github w-6 text-gray-700 text-lg"></i>
                            <input type="url" name="links[github]" value="{{ $perfilLinks['github'] ?? '' }}"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="https://github.com/tuusuario">
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fab fa-linkedin w-6 text-blue-700 text-lg"></i>
                            <input type="url" name="links[linkedin]" value="{{ $perfilLinks['linkedin'] ?? '' }}"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="https://linkedin.com/in/tuusuario">
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fab fa-twitter w-6 text-blue-400 text-lg"></i>
                            <input type="url" name="links[twitter]" value="{{ $perfilLinks['twitter'] ?? '' }}"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="https://twitter.com/tuusuario">
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-globe w-6 text-green-600 text-lg"></i>
                            <input type="url" name="links[portfolio]" value="{{ $perfilLinks['portfolio'] ?? '' }}"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="https://tusitio.com">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
                <a href="{{ route('usuarios.show', $usuario->id_usuario) }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
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
