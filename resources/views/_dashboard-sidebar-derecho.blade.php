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
                        <button type="button" id="cal-prev" class="w-7 h-7 rounded-full hover:bg-gray-200 text-gray-600 flex items-center justify-center" aria-label="{{ __('general.dashboard.sidebar.mes_anterior') }}">
                            <i class="fas fa-chevron-left text-xs"></i>
                        </button>
                        <h3 class="font-semibold text-gray-800 text-sm" id="cal-titulo">—</h3>
                        <button type="button" id="cal-next" class="w-7 h-7 rounded-full hover:bg-gray-200 text-gray-600 flex items-center justify-center" aria-label="{{ __('general.dashboard.sidebar.mes_siguiente') }}">
                            <i class="fas fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                    <div class="grid grid-cols-7 gap-1 text-center text-xs text-gray-500 font-medium mb-1">
                        @foreach (__('general.dashboard.sidebar.dias_iniciales') as $dia)
                            <div>{{ $dia }}</div>
                        @endforeach
                    </div>
                    <div id="cal-grid" class="grid grid-cols-7 gap-1 text-center text-sm"></div>

                    <div id="cal-panel-eventos" class="mt-4 pt-3 border-t border-gray-200">
                        <p class="text-xs font-medium text-gray-700 mb-2" id="cal-panel-titulo">{{ __('general.dashboard.sidebar.eventos_dia') }}</p>
                        <div id="cal-panel-lista" class="space-y-2 max-h-56 overflow-y-auto">
                            <p class="text-xs text-gray-400 italic">{{ __('general.dashboard.sidebar.selecciona_dia') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 right-sidebar-item">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-800">{{ __('general.dashboard.sidebar.notificaciones_novedades') }}</h3>
                            <button type="button"
                                    id="btn-marcar-novedades-vistas"
                                class="text-xs text-blue-600 hover:underline hidden">
                                {{ __('general.dashboard.sidebar.marcar_leidas') }}
                            </button>
                    </div>
                    <div class="space-y-3" id="contenedor-novedades">
                        <div class="text-center py-4" id="novedades-loading">
                            <i class="fas fa-spinner fa-spin text-gray-400"></i>
                            <p class="text-xs text-gray-500 mt-1">{{ __('general.dashboard.sidebar.cargando') }}</p>
                            </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 right-sidebar-item">
                    <h3 class="font-semibold text-gray-800 mb-3">{{ __('general.dashboard.sidebar.enlaces_rapidos') }}</h3>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="#" class="text-blue-600 hover:underline flex items-center">
                                <i class="fas fa-external-link-alt mr-2 text-xs"></i>
                                {{ __('general.dashboard.sidebar.mi_portafolio_publico') }}
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-blue-600 hover:underline flex items-center">
                                <i class="fas fa-bookmark mr-2 text-xs"></i>
                                {{ __('general.dashboard.sidebar.articulos_guardados') }}
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-blue-600 hover:underline flex items-center">
                                <i class="fas fa-bullhorn mr-2 text-xs"></i>
                                {{ __('general.dashboard.sidebar.novedades_sistema') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

<script>
function cargarNovedades() {
    const container = document.getElementById('contenedor-novedades');
    const loadingDiv = document.getElementById('novedades-loading');
    const btnMarcar = document.getElementById('btn-marcar-novedades-vistas');
    
    fetch('{{ route("novedades.list") }}', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        credentials: 'same-origin'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('HTTP error ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if (loadingDiv) loadingDiv.style.display = 'none';
        
        if (data.error) {
            container.innerHTML = `<p class="text-xs text-red-500 italic">Error: ${data.error}</p>`;
            if (btnMarcar) btnMarcar.classList.add('hidden');
            return;
        }
        
        if (!data.novedades || data.novedades.length === 0) {
            container.innerHTML = `<p class="text-xs text-gray-500 italic">${__t('js.dashboard.sin_novedades')}</p>`;
            if (btnMarcar) btnMarcar.classList.add('hidden');
            return;
        }
        
        const hayNoLeidas = data.novedades.some(n => n.tipo === 'notificacion' && !n.leido);
        if (btnMarcar) {
            if (hayNoLeidas) {
                btnMarcar.classList.remove('hidden');
            } else {
                btnMarcar.classList.add('hidden');
            }
        }
        
        let html = '';
        data.novedades.forEach(novedad => {
            let bgClass = '';
            if (novedad.tipo === 'portafolio_oculto') bgClass = 'bg-red-50';
            else if (novedad.tipo === 'nota_moderacion') bgClass = 'bg-yellow-50';
            else if (novedad.tipo === 'notificacion' && !novedad.leido) bgClass = 'bg-blue-50';
            
            html += `
                <div class="flex items-start space-x-3 pb-3 border-b border-gray-200 ${bgClass} p-2 rounded-lg transition cursor-pointer"
                     data-tipo="${novedad.tipo || ''}"
                     data-id="${novedad.id_entidad || ''}"
                     data-url="${novedad.url || ''}">
                    <i class="${novedad.icono || 'fas fa-bell'} ${novedad.color || 'text-gray-500'} mt-1 text-sm"></i>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800 text-sm">${escapeHtml(novedad.titulo || __t('js.dashboard.sin_titulo'))}</p>
                        <p class="text-xs text-gray-500">${escapeHtml(novedad.detalle || '')}</p>
                    </div>
                    ${novedad.tipo === 'notificacion' && !novedad.leido ? '<span class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0 mt-2"></span>' : ''}
                </div>
            `;
        });
        container.innerHTML = html;
        
        document.querySelectorAll('[data-tipo]').forEach(item => {
            item.addEventListener('click', function(e) {
                e.stopPropagation();
                const tipo = this.dataset.tipo;
                const id = this.dataset.id;
                const url = this.dataset.url;
                
                if (tipo === 'notificacion' && id) {
                    fetch('{{ route("novedades.marcar-vista") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ tipo: tipo, id: id })
                    }).then(() => {
                        if (url) {
                            window.location.href = url;
                        } else {
                            cargarNovedades();
                        }
                    }).catch(err => console.error('Error:', err));
                } else if (url) {
                    window.location.href = url;
                }
            });
        });
    })
    .catch(error => {
        console.error('Error:', error);
        if (loadingDiv) loadingDiv.style.display = 'none';
        container.innerHTML = `<p class="text-xs text-red-500 italic">${__t('js.dashboard.error_novedades')}</p>`;
    });
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

document.getElementById('btn-marcar-novedades-vistas')?.addEventListener('click', function() {
    fetch('{{ route("novedades.marcar-vista") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ todas: true })
    }).then(() => {
        cargarNovedades();
    }).catch(err => console.error('Error:', err));
});

document.addEventListener('DOMContentLoaded', function() {
    cargarNovedades();
});
</script>