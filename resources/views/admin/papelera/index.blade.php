@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-trash-alt text-red-500 mr-2"></i>
                    Papelera
                </h1>
                <p class="text-gray-500 mt-1">Elementos eliminados recientemente</p>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-blue-500">
            <p class="text-2xl font-bold">{{ $totalUsuarios }}</p>
            <p class="text-xs text-gray-500">Usuarios</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-green-500">
            <p class="text-2xl font-bold">{{ $totalProyectos }}</p>
            <p class="text-xs text-gray-500">Proyectos</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-purple-500">
            <p class="text-2xl font-bold">{{ $totalHabilidades }}</p>
            <p class="text-xs text-gray-500">Habilidades técnicas</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-amber-500">
            <p class="text-2xl font-bold">{{ $totalExperiencias }}</p>
            <p class="text-xs text-gray-500">Experiencias</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-pink-500">
            <p class="text-2xl font-bold">{{ $totalEducaciones }}</p>
            <p class="text-xs text-gray-500">Formación</p>
        </div>
    </div>

    <!-- Tabs -->
    <div class="flex flex-wrap gap-1 border-b border-gray-200">
        <button onclick="mostrarTab('usuarios')" id="tabUsuariosBtn"
            class="px-4 py-2 text-sm font-medium text-[#1e3a5f] border-b-2 border-[#1e3a5f]">
            👥 Usuarios ({{ $totalUsuarios }})
        </button>
        <button onclick="mostrarTab('proyectos')" id="tabProyectosBtn"
            class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
            📁 Proyectos ({{ $totalProyectos }})
        </button>
        <button onclick="mostrarTab('habilidades')" id="tabHabilidadesBtn"
            class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
            🧠 Habilidades ({{ $totalHabilidades }})
        </button>
        <button onclick="mostrarTab('experiencias')" id="tabExperienciasBtn"
            class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
            💼 Experiencias ({{ $totalExperiencias }})
        </button>
        <button onclick="mostrarTab('educaciones')" id="tabEducacionesBtn"
            class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
            🎓 Formación ({{ $totalEducaciones }})
        </button>
    </div>

    <!-- Tabla de Usuarios -->
    <div id="tabUsuarios" class="bg-white rounded-xl shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">USUARIO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">EMAIL</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ELIMINADO POR</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">MOTIVO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">FECHA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ACCIONES</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($usuariosEliminados as $usuario)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium">{{ $usuario->nombre }} {{ $usuario->apellido }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $usuario->correo_electronico }}</td>
                    <td class="px-6 py-4 text-sm">{{ $usuario->deletedBy->nombre ?? 'Sistema' }} {{ $usuario->deletedBy->apellido ?? '' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $usuario->delete_reason ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $usuario->deleted_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.papelera.restaurar.usuario', $usuario->id_usuario) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-green-600 bg-green-100 p-2 rounded-lg" title="Restaurar">
                                <i class="fas fa-trash-restore"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-6 py-12 text-center text-gray-500">No hay usuarios en la papelera</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $usuariosEliminados->appends(['tab' => 'usuarios'])->links() }}</div>
    </div>

    <!-- Tabla de Proyectos -->
    <div id="tabProyectos" class="bg-white rounded-xl shadow-md overflow-hidden hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">PROYECTO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">AUTOR</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ELIMINADO POR</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">FECHA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ACCIONES</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($proyectosEliminados as $proyecto)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium">{{ $proyecto->nombre }}</td>
                    <td class="px-6 py-4 text-sm">{{ $proyecto->perfil->usuario->nombre ?? 'N/A' }} {{ $proyecto->perfil->usuario->apellido ?? '' }}</td>
                    <td class="px-6 py-4 text-sm">{{ $proyecto->deletedBy->nombre ?? 'Usuario' }} {{ $proyecto->deletedBy->apellido ?? '' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $proyecto->deleted_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.papelera.restaurar.proyecto', $proyecto->id_proyecto) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-green-600 bg-green-100 p-2 rounded-lg" title="Restaurar">
                                <i class="fas fa-trash-restore"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">No hay proyectos en la papelera</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $proyectosEliminados->appends(['tab' => 'proyectos'])->links() }}</div>
    </div>

    <!-- Tabla de Habilidades técnicas -->
    <div id="tabHabilidades" class="bg-white rounded-xl shadow-md overflow-hidden hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">HABILIDAD</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">CATEGORÍA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">USUARIO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">FECHA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ACCIONES</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($habilidadesEliminadas as $habilidad)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium">{{ $habilidad->nombre }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $habilidad->categoria->nombre ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm">{{ $habilidad->perfil->usuario->nombre ?? 'N/A' }} {{ $habilidad->perfil->usuario->apellido ?? '' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $habilidad->deleted_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.papelera.restaurar.habilidad', $habilidad->id_habilidad) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-green-600 bg-green-100 p-2 rounded-lg" title="Restaurar">
                                <i class="fas fa-trash-restore"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">No hay habilidades en la papelera</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $habilidadesEliminadas->appends(['tab' => 'habilidades'])->links() }}</div>
    </div>

    <!-- Tabla de Experiencias -->
    <div id="tabExperiencias" class="bg-white rounded-xl shadow-md overflow-hidden hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">CARGO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">EMPRESA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">USUARIO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">FECHA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ACCIONES</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($experienciasEliminadas as $experiencia)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium">{{ $experiencia->cargo }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $experiencia->empresa }}</td>
                    <td class="px-6 py-4 text-sm">{{ $experiencia->perfil->usuario->nombre ?? 'N/A' }} {{ $experiencia->perfil->usuario->apellido ?? '' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $experiencia->deleted_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.papelera.restaurar.experiencia', $experiencia->id_experiencia) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-green-600 bg-green-100 p-2 rounded-lg" title="Restaurar">
                                <i class="fas fa-trash-restore"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">No hay experiencias en la papelera</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $experienciasEliminadas->appends(['tab' => 'experiencias'])->links() }}</div>
    </div>

    <!-- Tabla de Formación -->
    <div id="tabEducaciones" class="bg-white rounded-xl shadow-md overflow-hidden hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">TÍTULO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">INSTITUCIÓN</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">USUARIO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">FECHA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ACCIONES</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($educacionesEliminadas as $educacion)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium">{{ $educacion->titulo }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $educacion->institucion }}</td>
                    <td class="px-6 py-4 text-sm">{{ $educacion->perfil->usuario->nombre ?? 'N/A' }} {{ $educacion->perfil->usuario->apellido ?? '' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $educacion->deleted_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.papelera.restaurar.educacion', $educacion->id_formacion) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-green-600 bg-green-100 p-2 rounded-lg" title="Restaurar">
                                <i class="fas fa-trash-restore"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">No hay formación en la papelera</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $educacionesEliminadas->appends(['tab' => 'educaciones'])->links() }}</div>
    </div>
</div>

<script>
    const TABS = ['usuarios', 'proyectos', 'habilidades', 'experiencias', 'educaciones'];

    function mostrarTab(tab) {
        TABS.forEach(t => {
            const idCap = t.charAt(0).toUpperCase() + t.slice(1);
            const panel = document.getElementById('tab' + idCap);
            const btn   = document.getElementById('tab' + idCap + 'Btn');
            if (!panel || !btn) return;

            if (t === tab) {
                panel.classList.remove('hidden');
                btn.classList.add('border-b-2', 'border-[#1e3a5f]', 'text-[#1e3a5f]');
                btn.classList.remove('text-gray-500');
            } else {
                panel.classList.add('hidden');
                btn.classList.remove('border-b-2', 'border-[#1e3a5f]', 'text-[#1e3a5f]');
                btn.classList.add('text-gray-500');
            }
        });
    }

    const urlParams = new URLSearchParams(window.location.search);
    const tabParam = urlParams.get('tab');
    if (tabParam && TABS.includes(tabParam)) {
        mostrarTab(tabParam);
    }
</script>
@endsection
