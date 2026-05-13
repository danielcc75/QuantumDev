{{-- resources/views/gestionarProyectos/_card.blade.php
     Tarjeta individual de un proyecto. Recibe $proyecto. --}}

@php
    $estadoBadge = [
        'en_progreso' => ['label' => 'en curso',   'class' => 'bg-[#1e3a5f]/10 text-[#1e3a5f]'],
        'completado'  => ['label' => 'finalizado',  'class' => 'bg-indigo-100 text-indigo-700'],
        'pendiente'   => ['label' => 'pendiente',   'class' => 'bg-gray-100 text-gray-600'],
        'cancelado'   => ['label' => 'cancelado',   'class' => 'bg-red-100 text-[#e11d48]'],
    ];

    $badge    = $estadoBadge[$proyecto->estado] ?? ['label' => $proyecto->estado, 'class' => 'bg-gray-100 text-gray-600'];
    $tags     = $proyecto->tecnologias
        ? array_filter(array_map('trim', explode(',', $proyecto->tecnologias)))
        : [];
    $fechaIni  = \Carbon\Carbon::parse($proyecto->fecha_ini)->format('d M Y');
    $fechaFin  = $proyecto->fecha_fin
        ? \Carbon\Carbon::parse($proyecto->fecha_fin)->format('d M Y')
        : 'Presente';
@endphp

<div class="bg-white rounded-2xl border border-gray-200 shadow-md p-5 flex flex-col gap-3
            border-t-4 border-t-[#1e3a5f] hover:-translate-y-1 hover:shadow-xl transition-all duration-200"
     data-proyecto-id="{{ $proyecto->id_proyecto }}"
     data-estado="{{ $proyecto->estado }}">

    {{-- Nombre + estado --}}
    <div class="flex items-center justify-between gap-2">
        <h3 class="font-semibold text-[#1e3a5f] text-sm leading-snug line-clamp-1">{{ $proyecto->nombre }}</h3>
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
        <i class="fas fa-calendar-alt text-[#1e3a5f]/50"></i>
        <span>{{ $fechaIni }} – {{ $fechaFin }}</span>
    </div>

    {{-- Tecnologías --}}
    @if(count($tags))
    <div class="flex flex-wrap gap-1.5">
        @foreach($tags as $tag)
        <span class="text-xs bg-[#1e3a5f]/5 text-[#1e3a5f] border border-[#1e3a5f]/15 px-2 py-0.5 rounded-md font-medium">{{ $tag }}</span>
        @endforeach
    </div>
    @endif

    {{-- Botón demo --}}
    @if($proyecto->url_link)
    <a href="{{ $proyecto->url_link }}" target="_blank"
        class="flex items-center gap-2 text-xs font-medium bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-lg w-fit transition">
        <i class="fas fa-globe text-xs"></i> Ver Demo
        <i class="fas fa-external-link-alt text-xs"></i>
    </a>
    @endif

    {{-- Acciones editar / eliminar --}}
    <div class="flex gap-2 pt-1 border-t border-gray-100 mt-auto">
        <button onclick="confirmarEditar({{ $proyecto->id_proyecto }})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 px-3 py-1.5 rounded-lg transition">
            <i class="fas fa-pencil-alt"></i> Editar
        </button>
        <button onclick="confirmarEliminar({{ $proyecto->id_proyecto }})"
            class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">
            <i class="fas fa-trash"></i> Eliminar
        </button>
    </div>

</div>
