{{-- resources/views/gestionarExperiencia/index.blade.php
     Punto de entrada de la sección Experiencia Laboral.
     Carga datos y orquesta los sub-componentes. --}}

@php
    use Illuminate\Support\Facades\DB;
    $perfilExp   = DB::table('perfil')->where('id_usuario', $userId)->first();
    $perfilIdExp = $perfilExp->id_perfil ?? null;

    $experiencias = $perfilIdExp
        ? DB::table('experiencia_laboral')
              ->where('id_perfil', $perfilIdExp)
              ->orderBy('fecha_ini', 'desc')
              ->get()
        : collect();

    $totalExp      = $experiencias->count();
    $actualesExp   = $experiencias->where('trabajo_actual', 1)->count();
    $finalizadasExp = $experiencias->where('trabajo_actual', 0)->count();
@endphp

<div class="ml-80 mr-80">
    <main class="p-8">

        {{-- Encabezado --}}
        <div class="flex items-start justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-[#1e3a5f]">Experiencia Laboral</h2>
                <p class="text-sm text-gray-500 mt-1">Administra tu historial profesional y controla lo que muestras al mundo</p>
                <div class="mt-2 h-1 w-16 rounded-full bg-[#e11d48]"></div>
            </div>
            <button onclick="abrirModalExperiencia()"
                class="flex items-center gap-2 bg-[#1e3a5f] hover:bg-[#e11d48] text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors duration-200">
                <i class="fas fa-plus text-xs"></i> Nueva Experiencia
            </button>
        </div>

        {{-- Estadísticas --}}
        <div class="grid grid-cols-3 gap-5 mb-8">

            {{-- Total --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 border-l-4 border-l-[#1e3a5f]">
                <div class="flex justify-between items-start mb-3">
                    <p class="text-sm text-gray-500 font-medium">Total Experiencias</p>
                    <div class="w-9 h-9 rounded-xl bg-[#1e3a5f]/8 flex items-center justify-center">
                        <i class="fas fa-briefcase text-[#1e3a5f] text-sm"></i>
                    </div>
                </div>
                <p id="stat-exp-total" class="text-4xl font-bold text-[#1e3a5f]">{{ $totalExp }}</p>
                <p class="text-xs text-gray-400 mt-1">Todas las registradas</p>
            </div>

            {{-- En curso --}}
            <div class="bg-[#1e3a5f]/5 rounded-2xl border border-[#1e3a5f]/15 shadow-sm p-6 border-l-4 border-l-[#1e3a5f]">
                <div class="flex justify-between items-start mb-3">
                    <p class="text-sm text-[#1e3a5f] font-semibold">Trabajo Actual</p>
                    <div class="w-9 h-9 rounded-xl bg-[#1e3a5f]/10 flex items-center justify-center">
                        <i class="fas fa-spinner text-[#1e3a5f] text-sm"></i>
                    </div>
                </div>
                <p id="stat-exp-actual" class="text-4xl font-bold text-[#1e3a5f]">{{ $actualesExp }}</p>
                <p class="text-xs text-[#1e3a5f]/60 mt-1">Posición activa</p>
            </div>

            {{-- Finalizadas --}}
            <div class="bg-red-50 rounded-2xl border border-red-100 shadow-sm p-6 border-l-4 border-l-[#e11d48]">
                <div class="flex justify-between items-start mb-3">
                    <p class="text-sm text-[#e11d48] font-semibold">Finalizadas</p>
                    <div class="w-9 h-9 rounded-xl bg-[#e11d48]/10 flex items-center justify-center">
                        <i class="fas fa-check-circle text-[#e11d48] text-sm"></i>
                    </div>
                </div>
                <p id="stat-exp-finalizada" class="text-4xl font-bold text-[#1e3a5f]">{{ $finalizadasExp }}</p>
                <p class="text-xs text-[#e11d48]/70 mt-1">Experiencias completadas</p>
            </div>
        </div>

        {{-- Estado vacío --}}
        <div id="empty-state-exp" class="{{ $experiencias->isEmpty() ? '' : 'hidden' }} bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
            <div class="w-16 h-16 rounded-full bg-[#1e3a5f]/8 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-briefcase text-3xl text-[#1e3a5f]/40"></i>
            </div>
            <p class="text-gray-600 font-semibold">No tienes experiencias registradas aún</p>
            <p class="text-xs text-gray-400 mt-1 mb-4">Comienza agregando tu primera experiencia laboral</p>
            <button onclick="abrirModalExperiencia()"
                class="inline-flex items-center gap-2 text-sm bg-[#1e3a5f] hover:bg-[#e11d48] text-white px-4 py-2 rounded-lg transition-colors duration-200 font-medium">
                <i class="fas fa-plus text-xs"></i> Agregar primera experiencia
            </button>
        </div>

        {{-- Grid de tarjetas --}}
        <div id="experiencias-lista" class="grid grid-cols-1 md:grid-cols-2 gap-5 {{ $experiencias->isEmpty() ? 'hidden' : '' }}">
            @foreach($experiencias as $exp)
            @php
                $esActual = (bool) $exp->trabajo_actual;
                $badgeClass = $esActual ? 'bg-[#1e3a5f]/10 text-[#1e3a5f]' : 'bg-gray-100 text-gray-600';
                $badgeLabel = $esActual ? 'actual' : 'finalizada';
            @endphp
            <div class="bg-white rounded-2xl border border-gray-200 shadow-md p-5 flex flex-col gap-2
                        border-l-4 border-l-[#1e3a5f] hover:-translate-y-1 hover:shadow-xl transition-all duration-200"
                 data-experiencia-id="{{ $exp->id_experiencia }}"
                 data-trabajo-actual="{{ $esActual ? '1' : '0' }}">

                {{-- Cargo + badge --}}
                <div class="flex items-start justify-between gap-2">
                    <h3 class="font-semibold text-[#1e3a5f] text-sm leading-snug line-clamp-1">{{ $exp->cargo }}</h3>
                    <span class="text-xs font-medium px-2 py-0.5 rounded-full whitespace-nowrap {{ $badgeClass }}">
                        {{ $badgeLabel }}
                    </span>
                </div>

                {{-- Empresa --}}
                <p class="text-xs font-medium text-indigo-600">{{ $exp->empresa }}</p>

                {{-- Fechas --}}
                <div class="flex items-center text-xs text-gray-400 gap-1.5">
                    <i class="fas fa-calendar-alt text-[#1e3a5f]/50"></i>
                    <span>
                        {{ \Carbon\Carbon::parse($exp->fecha_ini)->format('M Y') }} –
                        @if($esActual)
                            <span class="text-green-600 font-medium">Actualidad</span>
                        @else
                            {{ \Carbon\Carbon::parse($exp->fecha_fin)->format('M Y') }}
                        @endif
                    </span>
                </div>

                {{-- Descripción --}}
                @if($exp->descripcion)
                <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">{{ $exp->descripcion }}</p>
                @endif

                {{-- Acciones --}}
                <div class="flex gap-2 pt-2 border-t border-gray-100 mt-auto">
                    <button onclick='abrirModalEditarExperiencia(@json($exp))'
                        class="flex-1 flex items-center justify-center gap-1.5 text-xs border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 px-3 py-1.5 rounded-lg transition">
                        <i class="fas fa-pencil-alt"></i> Editar
                    </button>
                    <button onclick="confirmarEliminarExperiencia({{ $exp->id_experiencia }})"
                        class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </div>
            </div>
            @endforeach
        </div>

    </main>
</div>

{{-- Modal crear / editar + scripts --}}
@include('gestionarPerfil.modal-experiencia')
