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

                <div class="bg-gray-50 rounded-xl p-4 right-sidebar-item">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-gray-800">Calendario</h3>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Ver agenda →</a>
                    </div>
                    @php
                        $hoyC       = \Carbon\Carbon::now();
                        $meses      = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
                        $mesNombre  = $meses[$hoyC->month - 1] . ' ' . $hoyC->year;
                        $diasSemana = ['L','M','X','J','V','S','D'];
                        $offset     = $hoyC->copy()->startOfMonth()->dayOfWeekIso - 1;
                        $diasEnMes  = $hoyC->daysInMonth;
                        $diaHoy     = $hoyC->day;
                    @endphp
                    <div class="text-center mb-4">
                        <p class="text-lg font-medium text-gray-700">{{ $mesNombre }}</p>
                    </div>
                    <div class="grid grid-cols-7 gap-1 text-center text-sm">
                        @foreach($diasSemana as $dia)
                            <div class="text-gray-500 font-medium py-1">{{ $dia }}</div>
                        @endforeach
                        @for($i = 0; $i < $offset; $i++)
                            <div></div>
                        @endfor
                        @for($i = 1; $i <= $diasEnMes; $i++)
                            <div class="py-1 {{ $i == $diaHoy ? 'bg-blue-600 text-white rounded-full w-7 h-7 flex items-center justify-center mx-auto' : 'text-gray-700' }}">
                                {{ $i }}
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 right-sidebar-item">
                    <h3 class="font-semibold text-gray-800 mb-4">Notificaciones y novedades</h3>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3 pb-3 border-b border-gray-200">
                            <i class="fas fa-folder-open text-blue-500 mt-1 text-sm"></i>
                            <div>
                                <p class="font-medium text-gray-800 text-sm">Actualizaste tu portafolio principal</p>
                                <p class="text-xs text-gray-500">Hace 2 horas - Agregaste 3 nuevos proyectos</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 pb-3 border-b border-gray-200">
                            <i class="fas fa-newspaper text-green-500 mt-1 text-sm"></i>
                            <div>
                                <p class="font-medium text-gray-800 text-sm">Nuevo artículo disponible</p>
                                <p class="text-xs text-gray-500">Diseño de dashboards - Lectura recomendada</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fab fa-github text-gray-700 mt-1 text-sm"></i>
                            <div>
                                <p class="font-medium text-gray-800 text-sm">Repositorio conectado</p>
                                <p class="text-xs text-gray-500">Sincronización activa con GitHub</p>
                            </div>
                        </div>
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
