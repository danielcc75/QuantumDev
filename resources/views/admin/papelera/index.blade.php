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
            <form action="{{ route('admin.papelera.vaciar') }}" method="POST" 
                  onsubmit="return confirm('¿Vaciar toda la papelera? Esta acción no se puede deshacer.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                    <i class="fas fa-trash-alt mr-2"></i>Vaciar Papelera
                </button>
            </form>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-blue-500">
            <p class="text-2xl font-bold">{{ $totalUsuarios }}</p>
            <p class="text-xs text-gray-500">Usuarios eliminados</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 text-center border-l-4 border-green-500">
            <p class="text-2xl font-bold">{{ $totalProyectos }}</p>
            <p class="text-xs text-gray-500">Proyectos eliminados</p>
        </div>
    </div>

    <!-- Tabs -->
    <div class="flex border-b border-gray-200">
        <button onclick="mostrarTab('usuarios')" id="tabUsuariosBtn" 
            class="px-4 py-2 text-sm font-medium text-[#1e3a5f] border-b-2 border-[#1e3a5f]">
            👥 Usuarios ({{ $totalUsuarios }})
        </button>
        <button onclick="mostrarTab('proyectos')" id="tabProyectosBtn" 
            class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
            📁 Proyectos ({{ $totalProyectos }})
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
                        <div class="flex space-x-2">
                            <form action="{{ route('admin.papelera.restaurar.usuario', $usuario->id_usuario) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-green-600 bg-green-100 p-2 rounded-lg" title="Restaurar">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.papelera.eliminar.usuario', $usuario->id_usuario) }}" method="POST" 
                                  onsubmit="return confirm('¿Eliminar permanentemente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 bg-red-100 p-2 rounded-lg" title="Eliminar permanentemente">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        No hay usuarios en la papelera
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $usuariosEliminados->appends(['tab' => 'usuarios'])->links() }}
        </div>
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
                        <div class="flex space-x-2">
                            <form action="{{ route('admin.papelera.restaurar.proyecto', $proyecto->id_proyecto) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-green-600 bg-green-100 p-2 rounded-lg" title="Restaurar">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.papelera.eliminar.proyecto', $proyecto->id_proyecto) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar permanentemente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 bg-red-100 p-2 rounded-lg" title="Eliminar permanentemente">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        No hay proyectos en la papelera
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $proyectosEliminados->appends(['tab' => 'proyectos'])->links() }}
        </div>
    </div>
</div>

<script>
    function mostrarTab(tab) {
        const tabUsuarios = document.getElementById('tabUsuarios');
        const tabProyectos = document.getElementById('tabProyectos');
        const btnUsuarios = document.getElementById('tabUsuariosBtn');
        const btnProyectos = document.getElementById('tabProyectosBtn');
        
        if (tab === 'usuarios') {
            tabUsuarios.classList.remove('hidden');
            tabProyectos.classList.add('hidden');
            btnUsuarios.classList.add('border-[#1e3a5f]', 'text-[#1e3a5f]');
            btnUsuarios.classList.remove('text-gray-500');
            btnProyectos.classList.remove('border-[#1e3a5f]', 'text-[#1e3a5f]');
            btnProyectos.classList.add('text-gray-500');
        } else {
            tabUsuarios.classList.add('hidden');
            tabProyectos.classList.remove('hidden');
            btnProyectos.classList.add('border-[#1e3a5f]', 'text-[#1e3a5f]');
            btnProyectos.classList.remove('text-gray-500');
            btnUsuarios.classList.remove('border-[#1e3a5f]', 'text-[#1e3a5f]');
            btnUsuarios.classList.add('text-gray-500');
        }
    }
    
    // Verificar parámetro en URL
    const urlParams = new URLSearchParams(window.location.search);
    const tabParam = urlParams.get('tab');
    if (tabParam === 'proyectos') {
        mostrarTab('proyectos');
    }
</script>
@endsection