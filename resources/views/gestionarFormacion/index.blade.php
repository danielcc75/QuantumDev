{{-- resources/views/gestionarFormacion/index.blade.php
     Punto de entrada de la sección Formación Académica.
     Carga datos y orquesta los sub-componentes. --}}

@php
    use Illuminate\Support\Facades\DB;
    $perfilEdu   = DB::table('perfil')->where('id_usuario', $userId)->first();
    $perfilIdEdu = $perfilEdu->id_perfil ?? null;

    $educaciones = $perfilIdEdu
        ? DB::table('formacion_academica')
              ->where('id_perfil', $perfilIdEdu)
              ->whereNull('deleted_at')
              ->orderBy('fecha_ini', 'desc')
              ->get()
        : collect();

    $totalEdu      = $educaciones->count();
    $enCursoEdu    = $educaciones->whereNull('fecha_fin')->count();
    $completadasEdu = $educaciones->whereNotNull('fecha_fin')->count();
@endphp

<div class="w-full">
    <main class="p-4 sm:p-6 lg:p-8">

        {{-- Encabezado --}}
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6 md:mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-[#1e3a5f]">{{ __('general.formacion.titulo') }}</h2>
                <p class="text-sm text-gray-500 mt-1">{{ __('general.formacion.subtitulo') }}</p>
                <div class="mt-2 h-1 w-16 rounded-full bg-[#e11d48]"></div>
            </div>
            <button onclick="abrirModalEducacion()"
                class="inline-flex items-center justify-center gap-2 bg-[#1e3a5f] hover:bg-[#e11d48] text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors duration-200 self-start sm:self-auto">
                <i class="fas fa-plus text-xs"></i> {{ __('general.formacion.btn_nueva') }}
            </button>
        </div>

        {{-- Estadísticas --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-5 mb-6 md:mb-8">

            {{-- Total --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 border-l-4 border-l-[#1e3a5f]">
                <div class="flex justify-between items-start mb-3">
                    <p class="text-sm text-gray-500 font-medium">{{ __('general.formacion.stat_total') }}</p>
                    <div class="w-9 h-9 rounded-xl bg-[#1e3a5f]/8 flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-[#1e3a5f] text-sm"></i>
                    </div>
                </div>
                <p id="stat-edu-total" class="text-4xl font-bold text-[#1e3a5f]">{{ $totalEdu }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ __('general.formacion.stat_total_desc') }}</p>
            </div>

            {{-- En curso --}}
            <div class="bg-[#1e3a5f]/5 rounded-2xl border border-[#1e3a5f]/15 shadow-sm p-6 border-l-4 border-l-[#1e3a5f]">
                <div class="flex justify-between items-start mb-3">
                    <p class="text-sm text-[#1e3a5f] font-semibold">{{ __('general.formacion.stat_en_curso') }}</p>
                    <div class="w-9 h-9 rounded-xl bg-[#1e3a5f]/10 flex items-center justify-center">
                        <i class="fas fa-spinner text-[#1e3a5f] text-sm"></i>
                    </div>
                </div>
                <p id="stat-edu-en-curso" class="text-4xl font-bold text-[#1e3a5f]">{{ $enCursoEdu }}</p>
                <p class="text-xs text-[#1e3a5f]/60 mt-1">{{ __('general.formacion.stat_en_curso_desc') }}</p>
            </div>

            {{-- Completadas --}}
            <div class="bg-red-50 rounded-2xl border border-red-100 shadow-sm p-6 border-l-4 border-l-[#e11d48]">
                <div class="flex justify-between items-start mb-3">
                    <p class="text-sm text-[#e11d48] font-semibold">{{ __('general.formacion.stat_completadas') }}</p>
                    <div class="w-9 h-9 rounded-xl bg-[#e11d48]/10 flex items-center justify-center">
                        <i class="fas fa-check-circle text-[#e11d48] text-sm"></i>
                    </div>
                </div>
                <p id="stat-edu-completada" class="text-4xl font-bold text-[#1e3a5f]">{{ $completadasEdu }}</p>
                <p class="text-xs text-[#e11d48]/70 mt-1">{{ __('general.formacion.stat_compl_desc') }}</p>
            </div>
        </div>

        {{-- Estado vacío --}}
        <div id="empty-state-edu" class="{{ $educaciones->isEmpty() ? '' : 'hidden' }} bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
            <div class="w-16 h-16 rounded-full bg-[#1e3a5f]/8 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-graduation-cap text-3xl text-[#1e3a5f]/40"></i>
            </div>
            <p class="text-gray-600 font-semibold">{{ __('general.formacion.vacio_titulo') }}</p>
            <p class="text-xs text-gray-400 mt-1 mb-4">{{ __('general.formacion.vacio_subtitulo') }}</p>
            <button onclick="abrirModalEducacion()"
                class="inline-flex items-center gap-2 text-sm bg-[#1e3a5f] hover:bg-[#e11d48] text-white px-4 py-2 rounded-lg transition-colors duration-200 font-medium">
                <i class="fas fa-plus text-xs"></i> {{ __('general.formacion.vacio_btn') }}
            </button>
        </div>

        {{-- Grid de tarjetas --}}
        <div id="educaciones-lista" class="grid grid-cols-1 md:grid-cols-2 gap-5 {{ $educaciones->isEmpty() ? 'hidden' : '' }}">
            @foreach($educaciones as $edu)
            @php
                $enCurso = is_null($edu->fecha_fin);
                $nivelColors = [
                    'Técnico'    => 'bg-orange-100 text-orange-700',
                    'Tecnólogo'  => 'bg-yellow-100 text-yellow-700',
                    'Pregrado'   => 'bg-blue-100 text-blue-700',
                    'Posgrado'   => 'bg-indigo-100 text-indigo-700',
                    'Maestría'   => 'bg-purple-100 text-purple-700',
                    'Doctorado'  => 'bg-pink-100 text-pink-700',
                    'Diplomado'  => 'bg-teal-100 text-teal-700',
                    'Curso'      => 'bg-gray-100 text-gray-600',
                ];
                $nivelClass = $nivelColors[$edu->nivel] ?? 'bg-blue-100 text-blue-700';
            @endphp
            <div class="bg-white rounded-2xl border border-gray-200 shadow-md p-5 flex flex-col gap-2
                        border-l-4 border-l-[#1e3a5f] hover:-translate-y-1 hover:shadow-xl transition-all duration-200"
                 data-formacion-id="{{ $edu->id_formacion }}"
                 data-en-curso="{{ $enCurso ? '1' : '0' }}">

                {{-- Título + nivel --}}
                <div class="flex items-start justify-between gap-2">
                    <h3 class="font-semibold text-[#1e3a5f] text-sm leading-snug line-clamp-1">{{ $edu->titulo }}</h3>
                    <span class="text-xs font-medium px-2 py-0.5 rounded-full whitespace-nowrap {{ $nivelClass }}">
                        {{ $edu->nivel }}
                    </span>
                </div>

                {{-- Institución --}}
                <p class="text-xs font-medium text-indigo-600">{{ $edu->institucion }}</p>

                {{-- Fechas --}}
                <div class="flex items-center text-xs text-gray-400 gap-1.5">
                    <i class="fas fa-calendar-alt text-[#1e3a5f]/50"></i>
                    <span>
                        {{ \Carbon\Carbon::parse($edu->fecha_ini)->locale(app()->getLocale())->isoFormat('MMM YYYY') }} –
                        @if($enCurso)
                            <span class="text-green-600 font-medium">{{ __('general.formacion.badge_en_curso') }}</span>
                        @else
                            {{ \Carbon\Carbon::parse($edu->fecha_fin)->locale(app()->getLocale())->isoFormat('MMM YYYY') }}
                        @endif
                    </span>
                </div>

                {{-- Descripción --}}
                @if($edu->descripcion)
                <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">{{ $edu->descripcion }}</p>
                @endif

                {{-- Acciones --}}
                <div class="flex gap-2 pt-2 border-t border-gray-100 mt-auto">
                    <button onclick='abrirModalEditarEducacion(@json($edu))'
                        class="flex-1 flex items-center justify-center gap-1.5 text-xs border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 px-3 py-1.5 rounded-lg transition">
                        <i class="fas fa-pencil-alt"></i> {{ __('general.common.editar') }}
                    </button>
                    <button onclick="confirmarEliminarEducacion({{ $edu->id_formacion }})"
                        class="flex-1 flex items-center justify-center gap-1.5 text-xs bg-[#e11d48] hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition">
                        <i class="fas fa-trash"></i> {{ __('general.common.eliminar') }}
                    </button>
                </div>
            </div>
            @endforeach
        </div>

    </main>
</div>

{{-- Modal crear / editar + scripts --}}
@include('gestionarPerfil.modal-educacion')
