@extends('layouts.app')

@section('content')
<div>
    <!-- Breadcrumb -->
    <div class="mb-6">
        <p class="text-sm text-gray-500">Dashboard / Resumen general</p>
        <h1 class="text-2xl font-bold text-gray-800 mt-1">Resumen general</h1>
    </div>

    <!-- PRIMERA FILA: Tarjetas principales -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Usuarios -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Usuarios</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($totalUsuarios) }}</p>
                    <p class="text-green-600 text-sm mt-2">
                        <i class="fas fa-arrow-up"></i> +{{ $crecimientoUsuarios }}% vs mes anterior
                    </p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Usuarios Activos -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Usuarios Activos</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($usuariosActivos) }}</p>
                    <p class="text-green-600 text-sm mt-2">
                        <i class="fas fa-chart-line"></i> {{ $porcentajeActivos }}% del total
                    </p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <i class="fas fa-user-check text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Usuarios Suspendidos -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-500 hover:shadow-lg transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Usuarios Suspendidos</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($usuariosSuspendidos) }}</p>
                    <p class="text-red-600 text-sm mt-2">
                        <i class="fas fa-ban"></i> {{ $usuariosSuspendidos > 0 ? 'Requiere atención' : 'Todo bien' }}
                    </p>
                </div>
                <div class="bg-red-100 p-3 rounded-lg">
                    <i class="fas fa-user-slash text-red-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Portafolios -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500 hover:shadow-lg transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Portafolios</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($totalPortafolios) }}</p>
                    <p class="text-purple-600 text-sm mt-2">
                        <i class="fas fa-percent"></i> {{ $porcentajeCompletos }}% completos
                    </p>
                </div>
                <div class="bg-purple-100 p-3 rounded-lg">
                    <i class="fas fa-id-card text-purple-600 text-2xl"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $porcentajeCompletos }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- SEGUNDA FILA: Nuevos Usuarios y Proyectos -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Usuarios Hoy -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-teal-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Usuarios hoy</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $usuariosHoy }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $usuariosSemana }} esta semana | {{ $usuariosMes }} este mes</p>
                </div>
                <div class="bg-teal-100 p-3 rounded-lg">
                    <i class="fas fa-user-plus text-teal-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Proyectos Hoy -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-cyan-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Proyectos hoy</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $proyectosHoy }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $proyectosSemana }} esta semana | {{ $proyectosMes }} este mes</p>
                </div>
                <div class="bg-cyan-100 p-3 rounded-lg">
                    <i class="fas fa-folder-open text-cyan-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Tasa de Conversión -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Tasa de conversión</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $tasaConversion }}%</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $perfilesCompletos }} de {{ $totalPortafolios }} perfiles completos</p>
                </div>
                <div class="bg-indigo-100 p-3 rounded-lg">
                    <i class="fas fa-chart-line text-indigo-600 text-2xl"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $tasaConversion }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- TERCERA FILA: Indicadores de salud -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Usuarios inactivos 30+ días -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-orange-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Inactivos >30 días</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $usuariosInactivos30Dias }}</p>
                    <p class="text-xs text-gray-400 mt-1">Sin actividad reciente</p>
                </div>
                <div class="bg-orange-100 p-3 rounded-lg">
                    <i class="fas fa-user-slash text-orange-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Proyectos privados -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-gray-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Proyectos privados</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $proyectosPrivados }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $porcentajePrivados }}% del total</p>
                </div>
                <div class="bg-gray-100 p-3 rounded-lg">
                    <i class="fas fa-lock text-gray-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- CUARTA FILA: Crecimiento -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Crecimiento Usuarios -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">
                <i class="fas fa-chart-line text-green-600 mr-2"></i>
                Crecimiento de Usuarios
            </h3>
            <div class="mb-6">
                                <div class="flex items-baseline gap-2">
                                    <span class="text-4xl font-bold text-gray-800">{{ $usuariosMes }}</span>
                                    <span class="text-sm {{ $crecimientoUsuarios >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        <i class="fas fa-arrow-{{ $crecimientoUsuarios >= 0 ? 'up' : 'down' }}"></i>
                                        {{ abs($crecimientoUsuarios) }}% vs mes anterior
                                    </span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Este mes</span>
                                    <span class="font-semibold text-gray-800">{{ $usuariosMes }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Mes anterior</span>
                                    <span class="font-semibold text-gray-800">{{ $usuariosMesAnterior ?? 0 }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600">Proyección próximo mes</span>
                                    <span class="font-semibold text-blue-600">{{ round($usuariosMes * (1 + $crecimientoUsuarios / 100)) }}</span>
                                </div>
                            </div>
                        </div>

        <!-- Crecimiento Proyectos -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">
                <i class="fas fa-chart-line text-blue-600 mr-2"></i>
                Crecimiento de Proyectos
            </h3>
            <div class="mb-6">
                                <div class="flex items-baseline gap-2">
                                    <span class="text-4xl font-bold text-gray-800">{{ $proyectosMes }}</span>
                                    <span class="text-sm {{ $crecimientoProyectos >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        <i class="fas fa-arrow-{{ $crecimientoProyectos >= 0 ? 'up' : 'down' }}"></i>
                                        {{ abs($crecimientoProyectos) }}% vs mes anterior
                                    </span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Este mes</span>
                                    <span class="font-semibold text-gray-800">{{ $proyectosMes }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Mes anterior</span>
                                    <span class="font-semibold text-gray-800">{{ $proyectosMesAnterior ?? 0 }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600">Proyección próximo mes</span>
                                    <span class="font-semibold text-blue-600">{{ round($proyectosMes * (1 + $crecimientoProyectos / 100)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- QUINTA FILA: Top y Gráficos -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Tecnologías más usadas -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">
                <i class="fas fa-microchip text-cyan-600 mr-2"></i>
                Tecnologías más usadas
            </h3>
            <div class="space-y-4">
                @forelse($topTecnologias as $tecnologia)
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-700">{{ $tecnologia->nombre }}</span>
                        <span class="text-gray-500">{{ $tecnologia->proyectos_count }} proyectos</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        @php
                            $max = $topTecnologias->first()->proyectos_count ?? 0;
                            $width = ($max > 0) ? ($tecnologia->proyectos_count / $max) * 100 : 0;
                        @endphp
                        <div class="bg-cyan-600 h-2 rounded-full" style="width: {{ $width }}%"></div>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">No hay datos disponibles</p>
                @endforelse
            </div>
        </div>

        <!-- Habilidades más comunes -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">
                <i class="fas fa-star text-yellow-500 mr-2"></i>
                Habilidades más comunes
            </h3>
            <div class="space-y-4">
                @forelse($topHabilidades as $habilidad)
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-700">{{ $habilidad->nombre }}</span>
                        <span class="text-gray-500">{{ $habilidad->total }} usuarios</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        @php
                            $maxHabilidad = $topHabilidades->first()->total ?? 0;
                            $widthHabilidad = ($maxHabilidad > 0) ? ($habilidad->total / $maxHabilidad) * 100 : 0;
                        @endphp
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $widthHabilidad }}%"></div>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">No hay datos disponibles</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- SEXTA FILA: Usuarios Recientes -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">
                <i class="fas fa-clock text-blue-600 mr-2"></i>
                Usuarios Recientes
            </h3>
            <a href="{{ route('admin.usuarios') }}" class="text-[#1e3a5f] hover:text-[#152c47] text-sm font-medium">
                Ver todos <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">USUARIO</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">EMAIL</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ESTADO</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">FECHA REGISTRO</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ÚLTIMO ACCESO</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($usuariosRecientes as $usuario)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-[#1e3a5f] to-indigo-600 flex items-center justify-center">
                                    <span class="text-white text-sm font-bold">{{ substr($usuario->nombre, 0, 1) }}{{ substr($usuario->apellido, 0, 1) }}</span>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">{{ $usuario->nombre }} {{ $usuario->apellido }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $usuario->correo_electronico }}</td>
                        <td class="px-6 py-4">
                            @if($usuario->estado == 'activo')
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Activo</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Suspendido</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y') : 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $usuario->ultimo_acceso ? $usuario->ultimo_acceso->format('d/m/Y H:i') : 'Nunca' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            No hay usuarios registrados
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection