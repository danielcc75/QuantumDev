        <section id="explorar" class="py-20 bg-white scroll-mt-28">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center">
                    <span class="inline-block text-sm font-semibold tracking-wide uppercase text-[#e11d48] bg-red-50 px-4 py-1 rounded-full mb-4">
                        {{ __('general.home.explorar.eyebrow') }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-[#1e3a5f] mb-4">
                        {{ __('general.home.explorar.titulo') }}
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">
                        {{ __('general.home.explorar.subtitulo') }}
                    </p>
                </div>

                @php
                    use Illuminate\Support\Facades\DB;
                    $categoriasCat = DB::table('categoria')->orderBy('nombre')->get(['id_categoria', 'nombre']);
                    $tecnologiasGrupos = DB::table('tecnologias')
                        ->orderBy('categoria')
                        ->orderBy('nombre')
                        ->get(['nombre', 'categoria'])
                        ->groupBy(fn ($t) => $t->categoria ?: __('general.home.explorar.sin_categoria'));
                    $categoriasTec = $tecnologiasGrupos->keys()->sort()->values();
                @endphp

                {{-- Formulario de filtros --}}
                <form id="form-buscador-portafolios"
                      onsubmit="event.preventDefault(); buscarPortafolios(true);"
                      class="mt-10 bg-gray-50 border border-gray-200 rounded-2xl p-5 md:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        {{-- Texto libre --}}
                        <div class="lg:col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-1">{{ __('general.home.explorar.label_buscar') }}</label>
                            <input type="text" name="q" maxlength="150" placeholder="{{ __('general.home.explorar.ph_buscar') }}"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/30 text-sm">
                        </div>

                        {{-- Años mínimos --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">{{ __('general.home.explorar.label_anios') }}</label>
                            <input type="number" name="anios_min" min="0" max="60" placeholder="0"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/30 text-sm">
                        </div>

                        {{-- Categoría de tecnología (single — filtra el dropdown de tecnologías + filtra resultados) --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">{{ __('general.home.explorar.label_categoria_tec') }}</label>
                            <select name="categoria_tec" data-buscador-single="categoriatec">
                                <option value="">{{ __('general.home.explorar.opt_todas_categorias') }}</option>
                                @foreach($categoriasTec as $catTec)
                                    <option value="{{ $catTec }}">{{ $catTec }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tecnologías (multiselect con pills, agrupadas por categoría de tecnología) --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">{{ __('general.home.explorar.label_tecnologias') }}</label>
                            <select name="tecnologias[]" multiple data-buscador-multi="tecnologias"
                                    placeholder="{{ __('general.home.explorar.ph_multi') }}">
                                @foreach($tecnologiasGrupos as $categoria => $tecs)
                                    <optgroup label="{{ $categoria }}">
                                        @foreach($tecs as $tec)
                                            <option value="{{ $tec->nombre }}" data-cat-tec="{{ $categoria }}">{{ $tec->nombre }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>

                        {{-- Categorías (multiselect con pills) --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">{{ __('general.home.explorar.label_categorias') }}</label>
                            <select name="categorias[]" multiple data-buscador-multi="categorias"
                                    placeholder="{{ __('general.home.explorar.ph_multi') }}">
                                @foreach($categoriasCat as $cat)
                                    <option value="{{ $cat->id_categoria }}">{{ $cat->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Ubicación --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">{{ __('general.home.explorar.label_ubicacion') }}</label>
                            <input type="text" name="ubicacion" maxlength="120" placeholder="{{ __('general.home.explorar.ph_ubicacion') }}"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/30 text-sm">
                        </div>
                    </div>

                    {{-- Checkbox + botones --}}
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mt-5 pt-4 border-t border-gray-200">
                        <label class="inline-flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                            <input type="checkbox" name="con_proyectos" value="1" class="rounded text-[#1e3a5f] focus:ring-[#1e3a5f]">
                            {{ __('general.home.explorar.check_con_proyectos') }}
                        </label>
                        <div class="flex gap-2">
                            <button type="button" onclick="limpiarFiltrosPortafolios()"
                                    class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-lg transition">
                                {{ __('general.home.explorar.btn_limpiar') }}
                            </button>
                            <button type="submit"
                                    class="px-5 py-2 bg-[#1e3a5f] hover:bg-[#162a45] text-white text-sm font-semibold rounded-lg transition shadow-sm flex items-center gap-2">
                                <i class="fas fa-search text-xs"></i>
                                {{ __('general.home.explorar.btn_buscar') }}
                            </button>
                        </div>
                    </div>
                </form>

                {{-- Estado + contador --}}
                <div class="flex items-center justify-between mt-6 mb-3 text-sm text-gray-600">
                    <p id="buscador-portafolios-estado">{{ __('general.home.explorar.cargando') }}</p>
                </div>

                {{-- Resultados --}}
                <div id="buscador-portafolios-resultados"
                     class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-left"></div>

                {{-- Skeleton (mientras carga) --}}
                <div id="buscador-portafolios-skeleton" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-2">
                    @for($i = 0; $i < 3; $i++)
                        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden animate-pulse">
                            <div class="h-28 bg-gray-200"></div>
                            <div class="px-5 pt-9 pb-5 space-y-3">
                                <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                                <div class="h-3 bg-gray-200 rounded w-1/3"></div>
                                <div class="h-3 bg-gray-200 rounded w-full"></div>
                                <div class="h-3 bg-gray-200 rounded w-3/4"></div>
                            </div>
                        </div>
                    @endfor
                </div>

                {{-- Estado vacío --}}
                <div id="buscador-portafolios-vacio" class="hidden mt-6 bg-gray-50 border border-dashed border-gray-200 rounded-2xl p-12 text-center">
                    <div class="w-16 h-16 rounded-full bg-[#1e3a5f]/8 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-2xl text-[#1e3a5f]/50"></i>
                    </div>
                    <p class="text-gray-700 font-semibold">{{ __('general.home.explorar.vacio_titulo') }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ __('general.home.explorar.vacio_subtitulo') }}</p>
                </div>

                {{-- Cargar más --}}
                <div class="text-center mt-8">
                    <button type="button" id="btn-buscador-cargar-mas"
                            onclick="buscarPortafolios(false)"
                            class="hidden px-6 py-2.5 bg-white border border-[#1e3a5f] text-[#1e3a5f] hover:bg-[#1e3a5f] hover:text-white text-sm font-semibold rounded-lg transition">
                        {{ __('general.home.explorar.btn_cargar_mas') }}
                    </button>
                </div>
            </div>
        </section>
