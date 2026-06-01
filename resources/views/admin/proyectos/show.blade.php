<!-- Modal: ver proyecto -->
<div id="modalVerProyecto" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[95vh] overflow-y-auto">
        
        <!-- Header del modal - AHORA SOLO AZUL -->
        <div class="bg-[#1e3a5f] px-6 py-4 rounded-t-2xl sticky top-0 z-10">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-white">
                        <i class="fas fa-project-diagram mr-2"></i> Detalle del Proyecto
                    </h2>
                    <p class="text-blue-200 text-sm">Información completa del proyecto</p>
                </div>
                <button type="button" onclick="cerrarModalVerProyecto()" class="text-white hover:text-gray-200 transition-colors">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Contenido del modal -->
        <div class="p-6">
            
            <!-- Botón volver (oculto en el modal) -->
            <div class="mb-4 hidden">
        <a href="{{ route('admin.proyectos') }}" class="text-[#1e3a5f] hover:underline inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Volver a proyectos
        </a>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Cabecera del proyecto - AHORA SOLO AZUL -->
                <div class="bg-[#1e3a5f] px-6 py-4">
            <h1 class="text-2xl font-bold text-white">{{ $proyecto->nombre }}</h1>
            <p class="text-blue-200 text-sm mt-1">
                Creado por {{ $proyecto->perfil->usuario->nombre ?? 'Usuario' }} 
                el {{ $proyecto->created_at->format('d/m/Y H:i') }}
            </p>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <h3 class="font-bold text-gray-800 mb-2">Descripción</h3>
                    <p class="text-gray-600">{{ $proyecto->descripcion ?: 'Sin descripción' }}</p>
                    
                    @php
                        $tags = $proyecto->tecnologias
                            ? array_filter(array_map('trim', explode(',', $proyecto->tecnologias)))
                            : [];
                    @endphp
                    @if(count($tags) > 0)
                    <h3 class="font-bold text-gray-800 mt-4 mb-2">Tecnologías</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tec)
                            <span class="px-2 py-1 bg-gray-100 rounded-full text-xs">{{ $tec }}</span>
                        @endforeach
                    </div>
                    @endif
                    
                    @if($proyecto->url_link)
                    <h3 class="font-bold text-gray-800 mt-4 mb-2">Enlace</h3>
                    <a href="{{ $proyecto->url_link }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                        {{ $proyecto->url_link }}
                    </a>
                    @endif
                </div>
                
                <div class="bg-gray-50 rounded-xl p-4">
                    <h3 class="font-bold text-gray-800 mb-3">Información</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Estado:</span>
                            <span class="capitalize">{{ $proyecto->estado }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Visibilidad:</span>
                            <span>{{ $proyecto->visible ? 'Público' : 'Oculto' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Fecha inicio:</span>
                            <span>{{ $proyecto->fecha_ini ? $proyecto->fecha_ini->format('d/m/Y') : 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Fecha fin:</span>
                            <span>{{ $proyecto->fecha_fin ? $proyecto->fecha_fin->format('d/m/Y') : 'En curso' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
        </div>
    </div>
</div>

<script>
    function abrirModalVerProyecto() {
        const modal = document.getElementById('modalVerProyecto');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function cerrarModalVerProyecto() {
        const modal = document.getElementById('modalVerProyecto');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }
    
    // Cerrar modal con ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('modalVerProyecto');
            if (modal && !modal.classList.contains('hidden')) {
                cerrarModalVerProyecto();
            }
        }
    });
    
    // Cerrar modal al hacer clic fuera
    const modalProyecto = document.getElementById('modalVerProyecto');
    if (modalProyecto) {
        modalProyecto.addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModalVerProyecto();
            }
        });
    }
</script>

<style>
    #modalVerProyecto {
        animation: fadeIn 0.2s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>