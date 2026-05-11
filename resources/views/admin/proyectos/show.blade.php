@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="mb-4">
        <a href="{{ route('admin.proyectos') }}" class="text-[#1e3a5f] hover:underline inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Volver a proyectos
        </a>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#1e3a5f] to-indigo-600 px-6 py-4">
            <h1 class="text-2xl font-bold text-white">{{ $proyecto->nombre }}</h1>
            <p class="text-blue-200 text-sm mt-1">
                Creado por {{ $proyecto->perfil->usuario->nombre ?? 'Usuario' }} 
                el {{ $proyecto->created_at->format('d/m/Y H:i') }}
            </p>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <h3 class="font-bold text-gray-800 mb-2">Descripción</h3>
                    <p class="text-gray-600">{{ $proyecto->descripcion ?: 'Sin descripción' }}</p>
                    
                    @php
                        $tags = $proyecto->tecnologias
                            ? array_filter(array_map('trim', explode(',', $proyecto->tecnologias)))
                            : [];
                    @endphp
                    @if(count($tags) > 0)
                    <h3 class="font-bold text-gray-800 mt-4 mb-2">Tecnologías</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tec)
                            <span class="px-2 py-1 bg-gray-100 rounded-full text-xs">{{ $tec }}</span>
                        @endforeach
                    </div>
                    @endif
                    
                    @if($proyecto->url_link)
                    <h3 class="font-bold text-gray-800 mt-4 mb-2">Enlace</h3>
                    <a href="{{ $proyecto->url_link }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                        {{ $proyecto->url_link }}
                    </a>
                    @endif
                </div>
                
                <div class="bg-gray-50 rounded-xl p-4">
                    <h3 class="font-bold text-gray-800 mb-3">Información</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Estado:</span>
                            <span class="capitalize">{{ $proyecto->estado }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Visibilidad:</span>
                            <span>{{ $proyecto->visible ? 'Público' : 'Oculto' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Destacado:</span>
                            <span>{{ $proyecto->destacado ? 'Sí' : 'No' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Fecha inicio:</span>
                            <span>{{ $proyecto->fecha_ini ? $proyecto->fecha_ini->format('d/m/Y') : 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Fecha fin:</span>
                            <span>{{ $proyecto->fecha_fin ? $proyecto->fecha_fin->format('d/m/Y') : 'En curso' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection