@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header con foto de perfil -->
        <div class="relative h-32 bg-gradient-to-r from-blue-600 to-purple-600">
            <div class="absolute -bottom-12 left-6">
                @if($usuario->perfil && $usuario->perfil->foto)
                    <img class="w-24 h-24 rounded-full border-4 border-white object-cover" src="{{ $usuario->perfil->foto }}" alt="">
                @else
                    <div class="w-24 h-24 rounded-full border-4 border-white bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                        <span class="text-white text-3xl font-bold">{{ substr($usuario->nombre, 0, 1) }}{{ substr($usuario->apellido, 0, 1) }}</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Información del usuario -->
        <div class="pt-16 px-6 pb-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $usuario->nombre }} {{ $usuario->apellido }}</h2>
                    <p class="text-gray-600">{{ $usuario->email }}</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition">
                        <i class="fas fa-edit mr-2"></i>Editar
                    </a>
                    <a href="{{ route('usuarios.perfil', $usuario->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition">
                        <i class="fas fa-user-circle mr-2"></i>Perfil
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mt-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">
                        <i class="fas fa-phone text-blue-600 mr-2"></i>Teléfono
                    </p>
                    <p class="text-gray-800 font-medium">{{ $usuario->telefono ?? 'No especificado' }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">
                        <i class="fas fa-calendar text-blue-600 mr-2"></i>Registrado
                    </p>
                    <p class="text-gray-800 font-medium">{{ $usuario->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            @if($usuario->perfil)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>Biografía
                    </h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700">{{ $usuario->perfil->biografia ?? 'Sin biografía' }}</p>
                    </div>
                </div>

                @if($usuario->perfil->links)
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">
                            <i class="fas fa-link text-blue-600 mr-2"></i>Enlaces
                        </h3>
                        <div class="flex space-x-3">
                            @php
                                $links = json_decode($usuario->perfil->links, true);
                            @endphp
                            @if($links)
                                @foreach($links as $key => $url)
                                    <a href="{{ $url }}" target="_blank" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg transition">
                                        <i class="fab fa-{{ $key }} mr-1"></i>{{ ucfirst($key) }}
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection