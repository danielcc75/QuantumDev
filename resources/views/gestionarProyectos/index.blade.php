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
        'en_progreso' => ['label' => 'en curso',  'class' => 'bg-blue-100 text-blue-700'],
        'completado'  => ['label' => 'finalizado', 'class' => 'bg-green-100 text-green-700'],
        'pendiente'   => ['label' => 'pendiente',  'class' => 'bg-gray-100 text-gray-600'],
        'cancelado'   => ['label' => 'cancelado',  'class' => 'bg-red-100 text-red-600'],
    ];
@endphp

<div class="ml-80 mr-80">
    <main class="p-8">

        {{-- Encabezado --}}
        <div class="flex items-start justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Gestión de Portafolio</h2>
                <p class="text-sm text-gray-500 mt-1">Administra tus proyectos personales y controla lo que muestras al mundo</p>
            </div>
            <button onclick="abrirModalProyecto()"
                class="flex items-center gap-2 bg-gray-900 hover:bg-gray-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">
                <i class="fas fa-plus text-xs"></i> Nuevo Proyecto
            </button>
        </div>

        {{-- Estadísticas --}}
        @include('gestionarProyectos._stats', [
            'totalProyectos' => $totalProyectos,
            'enCurso'        => $enCurso,
            'finalizados'    => $finalizados,
        ])

        {{-- Grid de tarjetas --}}
        @if($proyectos->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
                <i class="fas fa-folder-open text-5xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 font-medium">No tienes proyectos registrados aún</p>
                <button onclick="abrirModalProyecto()"
                    class="mt-4 text-sm text-blue-600 hover:underline">+ Agregar tu primer proyecto</button>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                @foreach($proyectos as $proyecto)
                    @include('gestionarProyectos._card', [
                        'proyecto'    => $proyecto,
                        'estadoBadge' => $estadoBadge,
                    ])
                @endforeach
            </div>
        @endif

    </main>
</div>

{{-- Modal crear / editar --}}
@include('gestionarProyectos._modal')

{{-- JavaScript --}}
@include('gestionarProyectos._scripts', ['userId' => $userId])
