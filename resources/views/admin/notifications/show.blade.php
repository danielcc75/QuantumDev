{{-- resources/views/admin/notifications/show.blade.php --}}
@extends('layouts.app')

@php
    $tipos = [
        'info'    => ['label' => 'Información', 'emoji' => 'ℹ️', 'badge' => 'bg-blue-100 text-blue-700',   'bar' => 'from-[#1e3a5f] to-indigo-600'],
        'success' => ['label' => 'Éxito',       'emoji' => '✅', 'badge' => 'bg-green-100 text-green-700', 'bar' => 'from-green-600 to-emerald-500'],
        'warning' => ['label' => 'Advertencia', 'emoji' => '⚠️', 'badge' => 'bg-yellow-100 text-yellow-700','bar' => 'from-yellow-500 to-amber-500'],
        'error'   => ['label' => 'Error',        'emoji' => '❌', 'badge' => 'bg-red-100 text-red-700',     'bar' => 'from-red-600 to-rose-500'],
    ];
    $t = $tipos[$notificacion->tipo] ?? $tipos['info'];
@endphp

@section('content')
<div class="max-w-2xl mx-auto space-y-4">

    <div>
        <a href="{{ route('admin.notifications') }}" class="text-[#1e3a5f] hover:underline">
            <i class="fas fa-arrow-left mr-2"></i> Volver a notificaciones
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r {{ $t['bar'] }} px-6 py-4">
            <h1 class="text-xl font-bold text-white">
                <i class="fas {{ $notificacion->icono ?? 'fa-bell' }} mr-2"></i>
                Detalle de la notificación
            </h1>
            <p class="text-blue-100 text-sm">Notificación #{{ $notificacion->id_notification }}</p>
        </div>

        <div class="p-6 space-y-5">

            <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $t['badge'] }}">
                    {{ $t['emoji'] }} {{ $t['label'] }}
                </span>
                @if($notificacion->leido)
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                        <i class="fas fa-check-circle mr-1"></i>Leída
                    </span>
                @else
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                        <i class="fas fa-clock mr-1"></i>No leída
                    </span>
                @endif
            </div>

            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Destinatario</p>
                <p class="text-sm text-gray-900 font-medium">
                    <i class="fas fa-user text-gray-400 mr-1"></i>
                    {{ $notificacion->usuario->nombre ?? 'N/A' }} {{ $notificacion->usuario->apellido ?? '' }}
                    @if($notificacion->usuario)
                        <span class="text-gray-500 font-normal">({{ $notificacion->usuario->correo_electronico }})</span>
                    @endif
                </p>
            </div>

            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Título</p>
                <p class="text-base font-semibold text-gray-900">{{ $notificacion->titulo }}</p>
            </div>

            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Mensaje</p>
                <p class="text-sm text-gray-700 whitespace-pre-line bg-gray-50 rounded-lg p-3 border border-gray-100">{{ $notificacion->mensaje }}</p>
            </div>

            @if($notificacion->url)
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Enlace</p>
                <a href="{{ $notificacion->url }}" target="_blank" rel="noopener noreferrer"
                   class="text-sm text-blue-600 hover:underline break-all">
                    <i class="fas fa-link mr-1"></i>{{ $notificacion->url }}
                </a>
            </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-gray-100">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Creada</p>
                    <p class="text-sm text-gray-700">
                        <i class="far fa-calendar text-gray-400 mr-1"></i>
                        {{ $notificacion->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Leída el</p>
                    <p class="text-sm text-gray-700">
                        @if($notificacion->leido_at)
                            <i class="far fa-calendar-check text-gray-400 mr-1"></i>
                            {{ $notificacion->leido_at->format('d/m/Y H:i') }}
                        @else
                            <span class="text-gray-400">— Sin leer</span>
                        @endif
                    </p>
                </div>
            </div>

        </div>

        <div class="px-6 py-4 bg-gray-50 border-t flex justify-end gap-3">
            <a href="{{ route('admin.notifications') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-400 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Volver
            </a>
            <form action="{{ route('admin.notifications.destroy', $notificacion->id_notification) }}" method="POST"
                  data-confirm="¿Eliminar esta notificación?" data-confirm-title="Eliminar notificación" data-confirm-button="Eliminar">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700 transition-colors">
                    <i class="fas fa-trash mr-2"></i>Eliminar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
