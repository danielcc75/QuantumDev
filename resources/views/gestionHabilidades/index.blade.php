@php
    $totalHab      = $habilidades->count();
    $categoriasHab = $habilidades->pluck('id_categoria')->unique()->count();
    $promedioAnios = $totalHab > 0
        ? round($habilidades->avg('anios_experiencia'), 1)
        : 0;
@endphp

<div class="w-full">
    <main class="p-4 sm:p-6 lg:p-8 flex flex-col gap-10">

        {{-- ══════════════════════════════════════════════════════════
             SECCIÓN 1 — HABILIDADES TÉCNICAS
        ══════════════════════════════════════════════════════════ --}}
        <section>

            {{-- Encabezado --}}
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-code text-[#1e3a5f]"></i>
                        <h2 class="text-2xl md:text-3xl font-bold text-[#1e3a5f]">Habilidades Técnicas</h2>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Administra tus habilidades técnicas y controla lo que muestras al mundo</p>
                    <div class="mt-2 h-1 w-16 rounded-full bg-[#e11d48]"></div>
                </div>
                <button id="agregar-habilidad-btn"
                    class="inline-flex items-center justify-center gap-2 bg-[#1e3a5f] hover:bg-[#e11d48] text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors duration-200 self-start sm:self-auto">
                    <i class="fas fa-plus text-xs"></i> Nueva Habilidad
                </button>
            </div>

            {{-- Estadísticas --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-5 mb-6">

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 border-l-4 border-l-[#1e3a5f]">
                    <div class="flex justify-between items-start mb-3">
                        <p class="text-sm text-gray-500 font-medium">Total Habilidades</p>
                        <div class="w-9 h-9 rounded-xl bg-[#1e3a5f]/8 flex items-center justify-center">
                            <i class="fas fa-code text-[#1e3a5f] text-sm"></i>
                        </div>
                    </div>
                    <p id="stat-hab-total" class="text-4xl font-bold text-[#1e3a5f]">{{ $totalHab }}</p>
                    <p class="text-xs text-gray-400 mt-1">Todas las registradas</p>
                </div>

                <div class="bg-[#1e3a5f]/5 rounded-2xl border border-[#1e3a5f]/15 shadow-sm p-6 border-l-4 border-l-[#1e3a5f]">
                    <div class="flex justify-between items-start mb-3">
                        <p class="text-sm text-[#1e3a5f] font-semibold">Categorías</p>
                        <div class="w-9 h-9 rounded-xl bg-[#1e3a5f]/10 flex items-center justify-center">
                            <i class="fas fa-layer-group text-[#1e3a5f] text-sm"></i>
                        </div>
                    </div>
                    <p id="stat-hab-categorias" class="text-4xl font-bold text-[#1e3a5f]">{{ $categoriasHab }}</p>
                    <p class="text-xs text-[#1e3a5f]/60 mt-1">Distintas áreas cubiertas</p>
                </div>

                <div class="bg-red-50 rounded-2xl border border-red-100 shadow-sm p-6 border-l-4 border-l-[#e11d48]">
                    <div class="flex justify-between items-start mb-3">
                        <p class="text-sm text-[#e11d48] font-semibold">Promedio Años</p>
                        <div class="w-9 h-9 rounded-xl bg-[#e11d48]/10 flex items-center justify-center">
                            <i class="fas fa-chart-line text-[#e11d48] text-sm"></i>
                        </div>
                    </div>
                    <p id="stat-hab-promedio" class="text-4xl font-bold text-[#1e3a5f]">{{ $promedioAnios }}</p>
                    <p class="text-xs text-[#e11d48]/70 mt-1">Años de experiencia promedio</p>
                </div>

            </div>

            {{-- Estado vacío --}}
            <div id="empty-state-hab" class="{{ $habilidades->isEmpty() ? '' : 'hidden' }} bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-[#1e3a5f]/8 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-code text-3xl text-[#1e3a5f]/40"></i>
                </div>
                <p class="text-gray-600 font-semibold">No tienes habilidades técnicas registradas aún</p>
                <p class="text-xs text-gray-400 mt-1 mb-4">Comienza agregando tu primera habilidad técnica</p>
                <button id="agregar-habilidad-btn-empty"
                    class="inline-flex items-center gap-2 text-sm bg-[#1e3a5f] hover:bg-[#e11d48] text-white px-4 py-2 rounded-lg transition-colors duration-200 font-medium">
                    <i class="fas fa-plus text-xs"></i> Agregar primera habilidad
                </button>
            </div>

            {{-- Grid de tarjetas --}}
            <div id="habilidades-lista" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 {{ $habilidades->isEmpty() ? 'hidden' : '' }}">
                @foreach($habilidades as $habilidad)
                <div class="bg-white rounded-2xl border border-gray-200 shadow-md p-5 flex flex-col gap-2
                            border-l-4 border-l-[#1e3a5f] hover:-translate-y-1 hover:shadow-xl transition-all duration-200"
                     data-habilidad-id="{{ $habilidad->id_habilidad }}"
                     data-categoria-id="{{ $habilidad->id_categoria }}">

                    <div class="flex justify-center mb-1">
                        <img src="{{ $habilidad->categoria->imagen ?? 'https://via.placeholder.com/100' }}"
                             alt="{{ $habilidad->categoria->nombre }}"
                             class="h-14 w-14 rounded-full object-cover border-2 border-[#1e3a5f]/10">
                    </div>

                    <div class="text-center">
                        <h3 class="font-semibold text-[#1e3a5f] text-sm leading-snug">{{ $habilidad->nombre }}</h3>
                        <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-[#1e3a5f]/10 text-[#1e3a5f] whitespace-nowrap">
                            {{ $habilidad->categoria->nombre }}
                        </span>
                    </div>

                    <div class="flex items-center justify-center text-xs text-gray-400 gap-1.5">
                        <i class="fas fa-calendar-alt text-[#1e3a5f]/50"></i>
                        <span>{{ $habilidad->anios_experiencia }} {{ $habilidad->anios_experiencia == 1 ? 'año' : 'años' }} de experiencia</span>
                    </div>

                    @if($habilidad->descripcion)
                    <p class="text-xs text-gray-500 leading-relaxed line-clamp-2 text-center">{{ $habilidad->descripcion }}</p>
                    @endif

                    <div class="flex gap-2 pt-2 border-t border-gray-100 mt-auto">
                        <button class="editar-habilidad flex-1 flex items-center justify-center gap-1.5 text-xs border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 px-3 py-1.5 rounded-lg transition"
                            data-id="{{ $habilidad->id_habilidad }}"
                            data-nombre="{{ $habilidad->nombre }}"
                            data-categoria="{{ $habilidad->id_categoria }}"
                            data-experiencia="{{ $habilidad->anios_experiencia }}"
                            data-descripcion="{{ $habilidad->descripcion }}">
                            <i class="fas fa-pencil-alt"></i> Editar
                        </button>
                        <form id="delete-hab-{{ $habilidad->id_habilidad }}"
                              action="{{ route('habilidades.destroy', $habilidad->id_habilidad) }}"
                              method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                onclick="confirmarEliminarHabilidad({{ $habilidad->id_habilidad }})"
                                class="w-full flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>

                </div>
                @endforeach
            </div>

        </section>

        {{-- Divisor --}}
        <hr class="border-gray-200">

        {{-- ══════════════════════════════════════════════════════════
             SECCIÓN 2 — HABILIDADES BLANDAS
        ══════════════════════════════════════════════════════════ --}}
        <section id="seccion-habilidades-blandas">

            {{-- Encabezado --}}
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-user-friends text-[#1e3a5f]"></i>
                        <h2 class="text-2xl md:text-3xl font-bold text-[#1e3a5f]">Habilidades Blandas</h2>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Selecciona hasta 6 habilidades interpersonales para mostrar en tu perfil</p>
                    <div class="mt-2 h-1 w-16 rounded-full bg-[#e11d48]"></div>
                </div>
                <button
                    type="button"
                    id="abrir-modal-habilidades-blandas"
                    class="inline-flex items-center justify-center gap-2 bg-[#1e3a5f] hover:bg-[#e11d48] text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors duration-200 self-start sm:self-auto">
                    <i class="fas fa-plus text-xs"></i> Agregar
                </button>
            </div>

            {{-- Chips seleccionados --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div id="chips-blandas-display">
                    @if(count($habilidadesBlandasSeleccionadas) > 0)
                        <div class="flex flex-wrap gap-2">
                            @foreach($habilidadesBlandasActivas->whereIn('id_habilidad_blanda', $habilidadesBlandasSeleccionadas) as $hab)
                                <span class="bg-[#1e3a5f] text-white px-3 py-1.5 rounded-full text-xs font-medium">
                                    {{ $hab->nombre }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center py-6 text-center">
                            <div class="w-14 h-14 rounded-full bg-[#1e3a5f]/8 flex items-center justify-center mb-3">
                                <i class="fas fa-user-friends text-2xl text-[#1e3a5f]/40"></i>
                            </div>
                            <p class="text-gray-600 font-semibold text-sm">Aún no agregaste habilidades blandas</p>
                            <p class="text-xs text-gray-400 mt-1">Agrega habilidades interpersonales para completar tu perfil</p>
                        </div>
                    @endif
                </div>
            </div>

        </section>

    </main>
</div>

{{-- Modal crear / editar habilidad técnica --}}
<div id="modal-habilidades"
    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4"
    onclick="cerrarModalHabilidadFondo(event)">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">

        <div class="bg-[#1e3a5f] text-white px-6 py-4 flex items-center justify-between rounded-t-2xl sticky top-0 z-10">
            <div>
                <h3 id="titulo-modal-habilidad" class="text-lg font-bold">Registrar Habilidad</h3>
                <p class="text-blue-200 text-xs mt-0.5">Completa los detalles de tu habilidad</p>
            </div>
            <button type="button" onclick="confirmarCancelarHabilidad()" class="text-white hover:text-blue-200 transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <div class="p-6">
            @include('gestionHabilidades.Habilidades', ['categorias' => $categorias])
        </div>

    </div>
</div>

@include('gestionHabilidadesBlandas.modal')

{{-- Modal de confirmación reemplazado por el modal global en layouts.app. --}}

{{-- Scripts de habilidades --}}
@include('gestionHabilidades._scripts')
