        <aside id="sidebar-derecho"
            class="fixed xl:sticky top-0 xl:top-16 right-0 z-40 xl:z-0 w-80 max-w-[85vw] bg-white shadow-lg border-l border-gray-200
                   h-screen xl:h-[calc(100vh-4rem)] overflow-y-auto flex-shrink-0
                   transform translate-x-full xl:translate-x-0 transition-transform duration-300">
            <!-- botón cerrar drawer (móvil / tablet) -->
            <button type="button" onclick="cerrarSidebars()"
                class="xl:hidden absolute top-3 right-3 w-9 h-9 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 flex items-center justify-center transition z-10">
                <i class="fas fa-times"></i>
            </button>
            <div class="p-6 space-y-6">

                <div class="bg-gray-50 rounded-xl p-4 right-sidebar-item"
                     id="widget-calendario"
                     data-hoy="{{ \Carbon\Carbon::now()->toDateString() }}"
                     data-endpoint="{{ route('calendario.eventos') }}">
                    <div class="flex justify-between items-center mb-3">
                        <button type="button" id="cal-prev" class="w-7 h-7 rounded-full hover:bg-gray-200 text-gray-600 flex items-center justify-center" aria-label="Mes anterior">
                            <i class="fas fa-chevron-left text-xs"></i>
                        </button>
                        <h3 class="font-semibold text-gray-800 text-sm" id="cal-titulo">—</h3>
                        <button type="button" id="cal-next" class="w-7 h-7 rounded-full hover:bg-gray-200 text-gray-600 flex items-center justify-center" aria-label="Mes siguiente">
                            <i class="fas fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                    <div class="grid grid-cols-7 gap-1 text-center text-xs text-gray-500 font-medium mb-1">
                        <div>L</div><div>M</div><div>X</div><div>J</div><div>V</div><div>S</div><div>D</div>
                    </div>
                    <div id="cal-grid" class="grid grid-cols-7 gap-1 text-center text-sm"></div>

                    <div id="cal-panel-eventos" class="mt-4 pt-3 border-t border-gray-200">
                        <p class="text-xs font-medium text-gray-700 mb-2" id="cal-panel-titulo">Eventos del día</p>
                        <div id="cal-panel-lista" class="space-y-2 max-h-56 overflow-y-auto">
                            <p class="text-xs text-gray-400 italic">Selecciona un día para ver sus eventos.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 right-sidebar-item">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-800">Notificaciones y novedades</h3>
                        @if(($novedades ?? collect())->isNotEmpty())
                            <button type="button"
                                    id="btn-marcar-novedades-vistas"
                                    class="text-xs text-blue-600 hover:underline">
                                Marcar leídas
                            </button>
                        @endif
                    </div>
                    <div class="space-y-3" id="contenedor-notificaciones">
                        @php
                            $perfilUsuario = $usuario->perfil ?? null;
                            $portafolioOculto = $perfilUsuario && !$perfilUsuario->visible;
                            $notaModeracion   = $perfilUsuario->moderation_note ?? null;
                            $novedades = $novedades ?? collect();
                            $proyectosOcultosMod = $proyectosOcultosMod ?? collect();
                            $habilidadesOcultasMod = $habilidadesOcultasMod ?? collect();
                            $hayAvisos = $portafolioOculto || $notaModeracion || $proyectosOcultosMod->isNotEmpty() || $habilidadesOcultasMod->isNotEmpty();
                        @endphp

                        @if($portafolioOculto)
                            <div class="flex items-start space-x-3 pb-3 border-b border-gray-200 bg-red-50 -mx-4 -mt-1 px-4 py-2 rounded-t-xl">
                                <i class="fas fa-eye-slash text-red-600 mt-1 text-sm"></i>
                                <div>
                                    <p class="font-medium text-red-800 text-sm">Un administrador ocultó tu portafolio</p>
                                    @if($notaModeracion)
                                        <p class="text-xs text-red-700 mt-1"><span class="font-semibold">Motivo:</span> {{ $notaModeracion }}</p>
                                    @else
                                        <p class="text-xs text-red-700 mt-1">No se indicó motivo. Contacta al administrador.</p>
                                    @endif
                                </div>
                            </div>
                        @elseif($notaModeracion)
                            <div class="flex items-start space-x-3 pb-3 border-b border-gray-200 bg-yellow-50 -mx-4 -mt-1 px-4 py-2 rounded-t-xl">
                                <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 text-sm"></i>
                                <div>
                                    <p class="font-medium text-yellow-800 text-sm">Aviso del administrador</p>
                                    <p class="text-xs text-yellow-700 mt-1">{{ $notaModeracion }}</p>
                                </div>
                            </div>
                        @endif

                        @foreach($proyectosOcultosMod as $proyOculto)
                            <div class="flex items-start space-x-3 pb-3 border-b border-gray-200 bg-orange-50 -mx-4 px-4 py-2">
                                <i class="fas fa-folder-minus text-orange-600 mt-1 text-sm"></i>
                                <div>
                                    <p class="font-medium text-orange-800 text-sm">Proyecto oculto: «{{ $proyOculto->nombre }}»</p>
                                    <p class="text-xs text-orange-700 mt-1"><span class="font-semibold">Motivo:</span> {{ $proyOculto->moderation_note }}</p>
                                </div>
                            </div>
                        @endforeach

                        @foreach($habilidadesOcultasMod as $habOculta)
                            <div class="flex items-start space-x-3 pb-3 border-b border-gray-200 bg-orange-50 -mx-4 px-4 py-2">
                                <i class="fas fa-code text-orange-600 mt-1 text-sm"></i>
                                <div>
                                    <p class="font-medium text-orange-800 text-sm">Habilidad oculta: «{{ $habOculta->nombre }}»</p>
                                    <p class="text-xs text-orange-700 mt-1"><span class="font-semibold">Motivo:</span> {{ $habOculta->moderation_note }}</p>
                                </div>
                            </div>
                        @endforeach

                        @forelse($novedades as $novedad)
                            <div class="flex items-start space-x-3 pb-3 @if(!$loop->last) border-b border-gray-200 @endif novedad-item"
                                 data-tipo="{{ $novedad['tipo'] }}"
                                 data-id="{{ $novedad['id_entidad'] }}">
                                <i class="{{ $novedad['icono'] }} {{ $novedad['color'] }} mt-1 text-sm"></i>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800 text-sm">{{ $novedad['titulo'] }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $novedad['detalle'] }} · {{ \Carbon\Carbon::parse($novedad['created_at'])->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            @unless($hayAvisos)
                                <p class="text-xs text-gray-500 italic">No hay novedades recientes.</p>
                            @endunless
                        @endforelse
                    </div>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 right-sidebar-item">
                    <h3 class="font-semibold text-gray-800 mb-3">Enlaces rápidos</h3>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="#" class="text-blue-600 hover:underline flex items-center">
                                <i class="fas fa-external-link-alt mr-2 text-xs"></i>
                                Mi portafolio público
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-blue-600 hover:underline flex items-center">
                                <i class="fas fa-bookmark mr-2 text-xs"></i>
                                Artículos guardados
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-blue-600 hover:underline flex items-center">
                                <i class="fas fa-bullhorn mr-2 text-xs"></i>
                                Novedades del sistema
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
