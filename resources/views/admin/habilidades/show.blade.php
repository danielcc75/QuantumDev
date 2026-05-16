@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="mb-4">
        <a href="{{ route('admin.habilidades') }}" class="text-[#1e3a5f] hover:underline inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Volver a habilidades
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#1e3a5f] to-indigo-600 px-6 py-4">
            <h1 class="text-2xl font-bold text-white">{{ $habilidad->nombre }}</h1>
            <p class="text-blue-200 text-sm mt-1">
                Registrada por {{ $habilidad->perfil?->usuario?->nombre_completo ?? 'Sin usuario' }}
                el {{ $habilidad->created_at->format('d/m/Y H:i') }}
            </p>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <h3 class="font-bold text-gray-800 mb-2">Descripción</h3>
                    <p class="text-gray-600">{{ $habilidad->descripcion ?: 'Sin descripción' }}</p>

                    <h3 class="font-bold text-gray-800 mt-4 mb-2">Categoría</h3>
                    <div class="inline-flex items-center bg-gray-100 rounded-lg px-3 py-1.5 text-sm">
                        @if($habilidad->categoria?->imagen)
                            <img src="{{ $habilidad->categoria->imagen }}" alt="{{ $habilidad->categoria->nombre }}"
                                 class="h-6 w-6 rounded-full object-cover border border-gray-200 mr-2"
                                 onerror="this.onerror=null;this.style.display='none';">
                        @else
                            <span class="h-6 w-6 rounded-full bg-gray-200 mr-2 flex items-center justify-center text-gray-400 text-xs">
                                <i class="fas fa-image"></i>
                            </span>
                        @endif
                        <span class="font-medium text-gray-700">{{ $habilidad->categoria->nombre ?? 'Sin categoría' }}</span>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <h3 class="font-bold text-gray-800 mb-3">Información</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Estado:</span>
                            <span>{{ $habilidad->activa ? 'Activa' : 'Inactiva' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Años experiencia:</span>
                            <span>{{ $habilidad->anios_experiencia ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Usuario:</span>
                            <span class="text-right">{{ $habilidad->perfil?->usuario?->nombre_completo ?? 'Sin usuario' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Email:</span>
                            <span class="text-right text-xs">{{ $habilidad->perfil?->usuario?->email ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Creada:</span>
                            <span>{{ $habilidad->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
