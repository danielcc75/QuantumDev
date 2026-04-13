{{-- resources/views/gestionarProyectos/index.blade.php
     Punto de entrada de la sección Gestión de Proyectos.
     Carga datos y orquesta los sub-componentes. --}}

@php
    use Illuminate\Support\Facades\DB;
    $perfilProy       = DB::table('perfil')->where('id_usuario', $userId)->first();
    $perfilIdProy     = $perfilProy->id_perfil ?? null;

    $proyectos = $perfilIdProy
        ? DB::table('proyectos')->where('id_perfil', $perfilIdProy)->orderBy('created_at', 'desc')->get()
        : collect();

    $totalProyectos = $proyectos->count();
    $enCurso        = $proyectos->where('estado', 'en_progreso')->count();
    $finalizados    = $proyectos->where('estado', 'completado')->count();

    $estadoBadge = [
        'en_progreso' => ['label' => 'en curso',   'class' => 'bg-[#1e3a5f]/10 text-[#1e3a5f]'],
        'completado'  => ['label' => 'finalizado',  'class' => 'bg-indigo-100 text-indigo-700'],
        'pendiente'   => ['label' => 'pendiente',   'class' => 'bg-gray-100 text-gray-600'],
        'cancelado'   => ['label' => 'cancelado',   'class' => 'bg-red-100 text-[#e11d48]'],
    ];
@endphp

<div class="ml-80 mr-80">
    <main class="p-8">

        {{-- Encabezado --}}
        <div class="flex items-start justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-[#1e3a5f]">Gestión de Portafolio</h2>
                <p class="text-sm text-gray-500 mt-1">Administra tus proyectos personales y controla lo que muestras al mundo</p>
                <div class="mt-2 h-1 w-16 rounded-full bg-[#e11d48]"></div>
            </div>
            <button onclick="abrirModalProyecto()"
                class="flex items-center gap-2 bg-[#1e3a5f] hover:bg-[#e11d48] text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors duration-200">
                <i class="fas fa-plus text-xs"></i> Nuevo Proyecto
            </button>
        </div>

        {{-- Estadísticas --}}
        @include('gestionarProyectos._stats', [
            'totalProyectos' => $totalProyectos,
            'enCurso'        => $enCurso,
            'finalizados'    => $finalizados,
        ])

        {{-- Estado vacío --}}
        <div id="empty-state" class="{{ $proyectos->isEmpty() ? '' : 'hidden' }} bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
            <div class="w-16 h-16 rounded-full bg-[#1e3a5f]/8 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-folder-open text-3xl text-[#1e3a5f]/40"></i>
            </div>
            <p class="text-gray-600 font-semibold">No tienes proyectos registrados aún</p>
            <p class="text-xs text-gray-400 mt-1 mb-4">Comienza agregando tu primer proyecto al portafolio</p>
            <button onclick="abrirModalProyecto()"
                class="inline-flex items-center gap-2 text-sm bg-[#1e3a5f] hover:bg-[#e11d48] text-white px-4 py-2 rounded-lg transition-colors duration-200 font-medium">
                <i class="fas fa-plus text-xs"></i> Agregar primer proyecto
            </button>
        </div>

        {{-- Grid de tarjetas --}}
        <div id="proyectos-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 {{ $proyectos->isEmpty() ? 'hidden' : '' }}">
            @foreach($proyectos as $proyecto)
                @include('gestionarProyectos._card', [
                    'proyecto'    => $proyecto,
                    'estadoBadge' => $estadoBadge,
                ])
            @endforeach
        </div>

    </main>
</div>

{{-- Modal crear / editar --}}
@include('gestionarProyectos._modal')

{{-- JavaScript --}}
@include('gestionarProyectos._scripts', ['userId' => $userId])