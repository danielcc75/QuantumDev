{{-- resources/views/gestionarProyectos/_card.blade.php
     Tarjeta individual de un proyecto. Recibe $proyecto y $estadoBadge. --}}

@php
    $badge    = $estadoBadge[$proyecto->estado] ?? ['label' => $proyecto->estado, 'class' => 'bg-gray-100 text-gray-600'];
    $tags     = $proyecto->tecnologias
        ? array_filter(array_map('trim', explode(',', $proyecto->tecnologias)))
        : [];
    $esPublico = (bool) $proyecto->visible;
    $fechaIni  = \Carbon\Carbon::parse($proyecto->fecha_ini)->format('d M Y');
    $fechaFin  = $proyecto->fecha_fin
        ? \Carbon\Carbon::parse($proyecto->fecha_fin)->format('d M Y')
        : 'Presente';
@endphp

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex flex-col gap-3"
     data-proyecto-id="{{ $proyecto->id_proyecto }}"
     data-estado="{{ $proyecto->estado }}">

    {{-- Nombre + estado --}}
    <div class="flex items-center justify-between gap-2">
        <h3 class="font-semibold text-gray-800 text-sm leading-snug line-clamp-1">{{ $proyecto->nombre }}</h3>
        <span class="text-xs font-medium px-2 py-0.5 rounded-full whitespace-nowrap {{ $badge['class'] }}">
            {{ $badge['label'] }}
        </span>
    </div>

    {{-- Descripción --}}
    <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">
        {{ $proyecto->descripcion ?? 'Sin descripción' }}
    </p>

    {{-- Fechas --}}
    <div class="flex items-center text-xs text-gray-400 gap-1.5">
        <i class="fas fa-calendar-alt"></i>
        <span>{{ $fechaIni }} – {{ $fechaFin }}</span>
    </div>

    {{-- Tecnologías --}}
    @if(count($tags))
    <div class="flex flex-wrap gap-1.5">
        @foreach($tags as $tag)
        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-md">{{ $tag }}</span>
        @endforeach
    </div>
    @endif

    {{-- Botón demo --}}
    @if($proyecto->url_link && $esPublico)
    <a href="{{ $proyecto->url_link }}" target="_blank"
        class="flex items-center gap-2 text-xs font-medium bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg w-fit transition">
        <i class="fas fa-globe text-xs"></i> Ver Demo
        <i class="fas fa-external-link-alt text-xs"></i>
    </a>
    @endif

    {{-- Toggle visibilidad --}}
    <div class="flex items-center gap-2 text-xs text-gray-500">
        <span>Visibilidad:</span>
        <span class="font-medium {{ $esPublico ? 'text-gray-700' : 'text-gray-400' }}">
            {{ $esPublico ? 'Público' : 'Privado' }}
        </span>
        <button onclick="toggleVisibilidad({{ $proyecto->id_proyecto }}, this)"
            data-visible="{{ $esPublico ? '1' : '0' }}"
            class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors
                   {{ $esPublico ? 'bg-blue-500' : 'bg-gray-300' }}">
            <span class="inline-block h-3.5 w-3.5 transform rounded-full bg-white shadow transition-transform
                         {{ $esPublico ? 'translate-x-4' : 'translate-x-1' }}"></span>
        </button>
    </div>

    {{-- Acciones editar / eliminar --}}
    <div class="flex gap-2 pt-1 border-t border-gray-100 mt-auto">
        <button onclick="abrirModalEditar({{ $proyecto->id_proyecto }})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs border border-gray-200 text-gray-600 hover:bg-gray-50 px-3 py-1.5 rounded-lg transition">
            <i class="fas fa-pencil-alt"></i> Editar
        </button>
        <button onclick="eliminarProyecto({{ $proyecto->id_proyecto }})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">
            <i class="fas fa-trash"></i> Eliminar
        </button>
    </div>

</div>
