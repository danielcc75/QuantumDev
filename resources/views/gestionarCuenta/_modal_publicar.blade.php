{{-- Modal: Publicar Portafolio --}}
<div id="modal-publicar" class="hidden fixed inset-0 z-[60] overflow-y-auto bg-black/50 backdrop-blur-sm"
     aria-modal="true" role="dialog">
    <div class="min-h-screen flex items-start justify-center px-3 sm:px-6 py-6">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl overflow-hidden border border-gray-100">

            {{-- Header --}}
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-xl bg-[#1e3a5f]/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-rocket text-[#1e3a5f]"></i>
                    </div>
                    <div class="min-w-0">
                        <h2 class="text-lg sm:text-xl font-bold text-[#1e3a5f] truncate">Portafolio Principal</h2>
                        <p class="text-xs text-gray-500">Selecciona el contenido a publicar</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                    <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-lg border border-[#1e3a5f]/20 bg-[#1e3a5f]/5">
                        <span class="text-[10px] uppercase tracking-wide text-[#1e3a5f]/70 font-semibold">Progreso</span>
                        <span id="mp-progreso" class="text-sm font-bold text-[#1e3a5f]">0%</span>
                    </div>
                    <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-lg border border-gray-200 bg-gray-50">
                        <span class="text-[10px] uppercase tracking-wide text-gray-500 font-semibold">Seleccionados</span>
                        <span id="mp-contador" class="text-sm font-bold text-gray-800">0/0</span>
                    </div>
                    <button id="mp-publicar"
                        class="inline-flex items-center gap-2 bg-[#e11d48] hover:bg-red-600 disabled:opacity-50 disabled:cursor-not-allowed text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors duration-200">
                        <i class="fas fa-rocket text-xs"></i> Publicar
                    </button>
                    <button id="mp-cerrar" type="button"
                        class="w-9 h-9 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 flex items-center justify-center transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            {{-- Tabs --}}
            <div class="px-6 pt-4 border-b border-gray-100">
                <div class="flex gap-1 overflow-x-auto -mb-px scrollbar-thin">
                    @php
                        $mpTabs = [
                            ['id' => 'todo',        'label' => 'Todo',       'icon' => 'fa-chart-line'],
                            ['id' => 'tecnicas',    'label' => 'Técnicas',   'icon' => 'fa-code'],
                            ['id' => 'blandas',     'label' => 'Blandas',    'icon' => 'fa-handshake'],
                            ['id' => 'experiencia', 'label' => 'Experiencia','icon' => 'fa-briefcase'],
                            ['id' => 'educacion',   'label' => 'Educación',  'icon' => 'fa-graduation-cap'],
                            ['id' => 'proyectos',   'label' => 'Proyectos',  'icon' => 'fa-folder-open'],
                        ];
                    @endphp

                    @foreach($mpTabs as $tab)
                        <button type="button" data-mp-tab="{{ $tab['id'] }}"
                            class="mp-tab inline-flex items-center gap-2 px-3 sm:px-4 py-2.5 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-[#1e3a5f] transition whitespace-nowrap">
                            <i class="fas {{ $tab['icon'] }} text-xs"></i>
                            <span>{{ $tab['label'] }}</span>
                            <span class="mp-tab-count text-[10px] font-semibold px-1.5 py-0.5 rounded-full bg-gray-100 text-gray-600">0</span>
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Contenido --}}
            <div class="p-4 sm:p-6 max-h-[60vh] overflow-y-auto">

                {{-- Encabezado de sección + acciones --}}
                <div class="flex items-center justify-between mb-4 gap-3">
                    <h3 id="mp-titulo-seccion" class="text-base sm:text-lg font-semibold text-[#1e3a5f]">Habilidades Técnicas</h3>
                    <div class="flex gap-2 flex-shrink-0">
                        <button type="button" id="mp-todos"
                            class="text-xs font-medium px-3 py-1.5 rounded-lg border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 transition">
                            Seleccionar todas
                        </button>
                        <button type="button" id="mp-ninguno"
                            class="text-xs font-medium px-3 py-1.5 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
                            Deseleccionar todas
                        </button>
                    </div>
                </div>

                {{-- Lista de items --}}
                <div id="mp-lista" class="rounded-xl border border-gray-100 overflow-hidden">
                    {{-- Header tabla --}}
                    <div id="mp-lista-header" class="grid grid-cols-[auto_1fr_auto] gap-3 px-4 py-2.5 bg-gray-50 text-[11px] font-semibold uppercase tracking-wide text-gray-500 border-b border-gray-100">
                        <span class="w-5"></span>
                        <span id="mp-col-nombre">Habilidad</span>
                        <span id="mp-col-detalle">Nivel</span>
                    </div>
                    <div id="mp-lista-body" class="divide-y divide-gray-100"></div>
                </div>

                {{-- Estado vacío --}}
                <div id="mp-vacio" class="hidden text-center py-10">
                    <div class="w-14 h-14 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-3">
                        <i class="fas fa-inbox text-xl text-gray-400"></i>
                    </div>
                    <p class="text-sm text-gray-600 font-medium">No tienes elementos en esta sección</p>
                    <p class="text-xs text-gray-400 mt-1">Agrégalos desde tu dashboard antes de publicar</p>
                </div>

                {{-- Cargando --}}
                <div id="mp-cargando" class="text-center py-10">
                    <i class="fas fa-spinner fa-spin text-2xl text-[#1e3a5f]/60"></i>
                    <p class="text-sm text-gray-500 mt-2">Cargando contenido...</p>
                </div>
            </div>

            {{-- Footer URL pública --}}
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3 min-w-0 w-full sm:w-auto">
                    <div class="w-9 h-9 rounded-lg bg-[#1e3a5f]/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-globe text-[#1e3a5f] text-sm"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] uppercase tracking-wide text-gray-500 font-semibold">URL pública</p>
                        <div class="flex items-center gap-2">
                            <a id="mp-url" href="#" target="_blank"
                               class="text-sm text-[#1e3a5f] hover:text-[#e11d48] truncate max-w-xs sm:max-w-md">—</a>
                            <button type="button" id="mp-copiar" class="text-gray-400 hover:text-[#1e3a5f] transition" title="Copiar URL">
                                <i class="far fa-copy text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <button type="button" id="mp-vista-previa"
                   class="inline-flex items-center gap-2 text-sm font-medium px-4 py-2 rounded-xl border border-[#1e3a5f]/30 text-[#1e3a5f] hover:bg-[#1e3a5f]/5 transition">
                    <i class="fas fa-eye text-xs"></i> Vista previa
                </button>
            </div>
        </div>
    </div>
</div>

@include('gestionarCuenta._modal_publicar_scripts')
