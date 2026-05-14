{{-- ===== Modal Portafolio Público (reutilizable: home + dashboard preview) ===== --}}
<div id="modalPortafolio"
     class="fixed inset-0 z-[70] hidden bg-black/60 backdrop-blur-sm overflow-y-auto"
     onclick="cerrarModalPortafolioFondo(event)">
    <div class="min-h-full flex items-start justify-center p-4 py-8">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-6xl overflow-hidden grid grid-cols-1 lg:grid-cols-[320px_1fr] relative" onclick="event.stopPropagation()">

            {{-- Botón cerrar (flotante) --}}
            <button type="button" onclick="cerrarModalPortafolio()"
                    class="absolute top-4 right-4 z-20 w-9 h-9 rounded-full bg-white/90 hover:bg-white text-[#1e3a5f] shadow-md transition flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>

            {{-- Banner de vista previa (se muestra solo en modo preview) --}}
            <div id="mp_preview_banner" class="hidden absolute top-0 inset-x-0 z-10 bg-amber-400 text-amber-950 text-xs font-semibold py-1.5 px-4 text-center tracking-wide">
                <i class="fas fa-eye mr-1"></i> Vista previa — así verán tu portafolio
            </div>

            {{-- ============ SIDEBAR ============ --}}
            <aside id="mp_sidebar"
                   class="relative overflow-hidden text-white px-6 py-8 lg:sticky lg:top-0 lg:self-start lg:max-h-screen lg:overflow-y-auto flex flex-col"
                   style="background-image: linear-gradient(160deg, #1e3a5f 0%, #e11d48 100%);">

                <div class="pointer-events-none absolute inset-0 opacity-40"
                     style="background-image:
                            radial-gradient(circle at 15% 10%, rgba(255,255,255,0.35) 0%, transparent 40%),
                            radial-gradient(circle at 90% 80%, rgba(255,255,255,0.25) 0%, transparent 45%),
                            radial-gradient(circle at 60% 50%, rgba(255,255,255,0.10) 0%, transparent 60%);"></div>
                <div class="pointer-events-none absolute -top-16 -right-16 w-56 h-56 rounded-full bg-white/10 blur-2xl"></div>
                <div class="pointer-events-none absolute -bottom-20 -left-10 w-48 h-48 rounded-full bg-[#e11d48]/20 blur-2xl"></div>

                <div class="relative z-10 flex flex-col h-full">
                    <div class="relative mb-5">
                        <div class="absolute inset-0 rounded-3xl bg-white/20 blur-xl"></div>
                        <div id="mp_avatar"
                             class="relative w-24 h-24 rounded-3xl bg-gradient-to-br from-white/40 to-white/10 backdrop-blur-sm text-white flex items-center justify-center font-extrabold text-3xl ring-2 ring-white/50 shadow-xl overflow-hidden">
                            JP
                        </div>
                        <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-emerald-400 ring-2 ring-white/90 shadow"></span>
                    </div>

                    <h2 id="mp_nombre" class="text-2xl font-extrabold leading-tight drop-shadow-sm"></h2>
                    <p id="mp_rol" class="text-white font-semibold mt-1 drop-shadow-sm"></p>

                    <div class="h-px bg-gradient-to-r from-white/40 via-white/20 to-transparent my-4"></div>

                    <p id="mp_bio_corta" class="text-sm text-white/90 leading-relaxed"></p>

                    <div class="mt-5 flex flex-col gap-2 text-sm">
                        <div id="mp_contact_email" class="hidden items-center gap-3 bg-white/10 hover:bg-white/15 transition border border-white/15 rounded-xl px-3 py-2 text-white/95 min-w-0">
                            <span class="w-7 h-7 rounded-lg bg-white/15 flex items-center justify-center text-xs flex-shrink-0"><i class="far fa-envelope"></i></span>
                            <span class="mp-contact-text truncate text-[13px] min-w-0"></span>
                        </div>
                        <div id="mp_contact_tel" class="hidden items-center gap-3 bg-white/10 hover:bg-white/15 transition border border-white/15 rounded-xl px-3 py-2 text-white/95 min-w-0">
                            <span class="w-7 h-7 rounded-lg bg-white/15 flex items-center justify-center text-xs flex-shrink-0"><i class="fas fa-phone"></i></span>
                            <span class="mp-contact-text truncate text-[13px] min-w-0"></span>
                        </div>
                        <div id="mp_contact_loc" class="hidden items-center gap-3 bg-white/10 hover:bg-white/15 transition border border-white/15 rounded-xl px-3 py-2 text-white/95 min-w-0">
                            <span class="w-7 h-7 rounded-lg bg-white/15 flex items-center justify-center text-xs flex-shrink-0"><i class="fas fa-map-marker-alt"></i></span>
                            <span class="mp-contact-text truncate text-[13px] min-w-0"></span>
                        </div>
                    </div>

                    <div id="mp_links" class="flex flex-wrap gap-2 mt-5"></div>

                    <nav class="mt-7 flex flex-col gap-1 text-sm font-medium">
                        <a href="#mp_sec_sobre"        class="mp-nav group px-4 py-2.5 rounded-xl hover:bg-white/15 transition flex items-center justify-between"><span class="flex items-center gap-2.5"><i class="fas fa-user text-xs opacity-80"></i>Sobre mí</span><i class="fas fa-chevron-right text-[10px] opacity-0 group-hover:opacity-70 transition"></i></a>
                        <a href="#mp_sec_habilidades"  class="mp-nav group px-4 py-2.5 rounded-xl hover:bg-white/15 transition flex items-center justify-between"><span class="flex items-center gap-2.5"><i class="fas fa-code text-xs opacity-80"></i>Habilidades</span><i class="fas fa-chevron-right text-[10px] opacity-0 group-hover:opacity-70 transition"></i></a>
                        <a href="#mp_sec_proyectos"    class="mp-nav group px-4 py-2.5 rounded-xl hover:bg-white/15 transition flex items-center justify-between"><span class="flex items-center gap-2.5"><i class="fas fa-folder-open text-xs opacity-80"></i>Proyectos</span><i class="fas fa-chevron-right text-[10px] opacity-0 group-hover:opacity-70 transition"></i></a>
                        <a href="#mp_sec_experiencia"  class="mp-nav group px-4 py-2.5 rounded-xl hover:bg-white/15 transition flex items-center justify-between"><span class="flex items-center gap-2.5"><i class="fas fa-briefcase text-xs opacity-80"></i>Experiencia</span><i class="fas fa-chevron-right text-[10px] opacity-0 group-hover:opacity-70 transition"></i></a>
                        <a href="#mp_sec_educacion"    class="mp-nav group px-4 py-2.5 rounded-xl hover:bg-white/15 transition flex items-center justify-between"><span class="flex items-center gap-2.5"><i class="fas fa-graduation-cap text-xs opacity-80"></i>Educación</span><i class="fas fa-chevron-right text-[10px] opacity-0 group-hover:opacity-70 transition"></i></a>
                    </nav>
                </div>
            </aside>

            {{-- ============ CONTENIDO ============ --}}
            <div id="mp_contenido" class="bg-white max-h-screen lg:overflow-y-auto">

                <section id="mp_sec_sobre" class="px-6 sm:px-10 py-10 scroll-mt-4">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-[#1e3a5f] to-[#e11d48] text-white shadow-md">
                            <i class="fas fa-user"></i>
                        </span>
                        <h3 class="text-2xl font-extrabold text-[#1e3a5f] tracking-tight">Sobre mí</h3>
                        <span class="flex-1 h-px bg-gradient-to-r from-[#e11d48]/30 to-transparent ml-2"></span>
                    </div>

                    <div class="grid grid-cols-3 gap-3 mb-6">
                        <div class="group relative bg-gradient-to-br from-[#1e3a5f]/5 to-white border border-[#1e3a5f]/15 rounded-2xl p-4 text-center shadow-sm hover:shadow-md hover:-translate-y-0.5 transition overflow-hidden">
                            <div class="absolute -top-6 -right-6 w-16 h-16 rounded-full bg-[#1e3a5f]/15 group-hover:scale-110 transition"></div>
                            <div class="relative w-10 h-10 rounded-xl bg-gradient-to-br from-[#1e3a5f] to-[#e11d48] text-white flex items-center justify-center mx-auto mb-2 shadow">
                                <i class="fas fa-star"></i>
                            </div>
                            <p id="mp_stat_anios" class="relative text-2xl font-extrabold text-[#1e3a5f]">0</p>
                            <p class="relative text-xs text-gray-500 mt-0.5">Años</p>
                        </div>
                        <div class="group relative bg-gradient-to-br from-[#1e3a5f]/8 to-white border border-[#1e3a5f]/15 rounded-2xl p-4 text-center shadow-sm hover:shadow-md hover:-translate-y-0.5 transition overflow-hidden">
                            <div class="absolute -top-6 -right-6 w-16 h-16 rounded-full bg-[#1e3a5f]/15 group-hover:scale-110 transition"></div>
                            <div class="relative w-10 h-10 rounded-xl bg-gradient-to-br from-[#1e3a5f] to-[#e11d48] text-white flex items-center justify-center mx-auto mb-2 shadow">
                                <i class="fas fa-th-large"></i>
                            </div>
                            <p id="mp_stat_proy" class="relative text-2xl font-extrabold text-[#1e3a5f]">0</p>
                            <p class="relative text-xs text-gray-500 mt-0.5">Proyectos</p>
                        </div>
                        <div class="group relative bg-gradient-to-br from-[#e11d48]/5 to-white border border-[#e11d48]/15 rounded-2xl p-4 text-center shadow-sm hover:shadow-md hover:-translate-y-0.5 transition overflow-hidden">
                            <div class="absolute -top-6 -right-6 w-16 h-16 rounded-full bg-[#e11d48]/15 group-hover:scale-110 transition"></div>
                            <div class="relative w-10 h-10 rounded-xl bg-gradient-to-br from-[#e11d48] to-[#1e3a5f] text-white flex items-center justify-center mx-auto mb-2 shadow">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <p id="mp_stat_empresas" class="relative text-2xl font-extrabold text-[#1e3a5f]">0</p>
                            <p class="relative text-xs text-gray-500 mt-0.5">Empresas</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-gray-50 to-white border border-gray-100 rounded-2xl p-5 relative">
                        <i class="fas fa-quote-left absolute top-3 left-3 text-[#e11d48]/30 text-xl"></i>
                        <p id="mp_bio" class="text-sm text-gray-600 leading-relaxed pl-8"></p>
                    </div>
                </section>

                <section id="mp_sec_habilidades" class="px-6 sm:px-10 py-10 scroll-mt-4 border-t border-gray-100 bg-gradient-to-b from-white to-[#1e3a5f]/5">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-[#1e3a5f] to-[#e11d48] text-white shadow-md">
                            <i class="fas fa-code"></i>
                        </span>
                        <h3 class="text-2xl font-extrabold text-[#1e3a5f] tracking-tight">Habilidades</h3>
                        <span class="flex-1 h-px bg-gradient-to-r from-[#e11d48]/30 to-transparent ml-2"></span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                            <h4 class="font-bold text-[#1e3a5f] mb-3 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-gradient-to-br from-[#1e3a5f] to-[#e11d48]"></span>
                                Técnicas
                            </h4>
                            <ul id="mp_habilidades_tecnicas" class="space-y-2 text-sm text-gray-700"></ul>
                            <p id="mp_habilidades_tecnicas_empty" class="text-sm text-gray-400 italic hidden">Sin habilidades registradas.</p>
                        </div>
                        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                            <h4 class="font-bold text-[#1e3a5f] mb-3 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-gradient-to-br from-[#e11d48] to-[#1e3a5f]"></span>
                                Blandas
                            </h4>
                            <ul id="mp_habilidades_blandas" class="space-y-2 text-sm text-gray-700"></ul>
                            <p id="mp_habilidades_blandas_empty" class="text-sm text-gray-400 italic hidden">Sin habilidades blandas.</p>
                        </div>
                    </div>
                </section>

                <section id="mp_sec_proyectos" class="px-6 sm:px-10 py-10 scroll-mt-4 border-t border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-[#1e3a5f] to-[#e11d48] text-white shadow-md">
                            <i class="fas fa-folder-open"></i>
                        </span>
                        <h3 class="text-2xl font-extrabold text-[#1e3a5f] tracking-tight">Proyectos</h3>
                        <span class="flex-1 h-px bg-gradient-to-r from-[#1e3a5f]/30 to-transparent ml-2"></span>
                    </div>
                    <div id="mp_proyectos" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
                    <p id="mp_proyectos_empty" class="text-sm text-gray-400 italic hidden">No hay proyectos publicados.</p>
                </section>

                <section id="mp_sec_experiencia" class="px-6 sm:px-10 py-10 scroll-mt-4 border-t border-gray-100 bg-gradient-to-b from-white to-[#e11d48]/5">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-[#e11d48] to-[#1e3a5f] text-white shadow-md">
                            <i class="fas fa-briefcase"></i>
                        </span>
                        <h3 class="text-2xl font-extrabold text-[#1e3a5f] tracking-tight">Experiencia</h3>
                        <span class="flex-1 h-px bg-gradient-to-r from-[#e11d48]/30 to-transparent ml-2"></span>
                    </div>
                    <div id="mp_experiencias" class="relative pl-6 flex flex-col gap-4 before:content-[''] before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-gradient-to-b before:from-[#1e3a5f]/40 before:via-[#e11d48]/40 before:to-transparent"></div>
                    <p id="mp_experiencias_empty" class="text-sm text-gray-400 italic hidden">No hay experiencia laboral registrada.</p>
                </section>

                <section id="mp_sec_educacion" class="px-6 sm:px-10 py-10 scroll-mt-4 border-t border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-[#1e3a5f] to-[#e11d48] text-white shadow-md">
                            <i class="fas fa-graduation-cap"></i>
                        </span>
                        <h3 class="text-2xl font-extrabold text-[#1e3a5f] tracking-tight">Educación</h3>
                        <span class="flex-1 h-px bg-gradient-to-r from-[#1e3a5f]/30 to-transparent ml-2"></span>
                    </div>
                    <div id="mp_formacion" class="relative pl-6 flex flex-col gap-4 before:content-[''] before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-gradient-to-b before:from-[#1e3a5f]/40 before:via-[#e11d48]/40 before:to-transparent"></div>
                    <p id="mp_formacion_empty" class="text-sm text-gray-400 italic hidden">No hay formación académica registrada.</p>
                </section>

            </div>
        </div>
    </div>
</div>

<style>
    .mp-nav.active {
        background-color: rgba(255,255,255,0.22);
        box-shadow: inset 3px 0 0 #fff;
        font-weight: 700;
    }
    .mp-nav.active i.fa-chevron-right { opacity: 0.9 !important; }
    #mp_contenido { scroll-behavior: smooth; }

    #mp_contenido::-webkit-scrollbar,
    #mp_sidebar::-webkit-scrollbar { width: 6px; }
    #mp_contenido::-webkit-scrollbar-thumb { background: rgba(225,29,72,0.3); border-radius: 3px; }
    #mp_sidebar::-webkit-scrollbar-thumb   { background: rgba(255,255,255,0.3); border-radius: 3px; }

    #mp_experiencias > div,
    #mp_formacion    > div { position: relative; }
    #mp_experiencias > div::before,
    #mp_formacion    > div::before {
        content: '';
        position: absolute;
        left: -1.6rem;
        top: 1.25rem;
        width: 0.75rem;
        height: 0.75rem;
        border-radius: 9999px;
        background: linear-gradient(135deg, #1e3a5f, #e11d48);
        box-shadow: 0 0 0 3px #fff, 0 0 0 4px rgba(225,29,72,0.25);
    }

    @keyframes mpFadeUp {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    #modalPortafolio:not(.hidden) > div > div { animation: mpFadeUp .35s ease both; }
</style>

<script>
(function () {
    const modal = document.getElementById('modalPortafolio');

    const ICONS_LINK = {
        github:    'fab fa-github',
        linkedin:  'fab fa-linkedin',
        twitter:   'fab fa-twitter',
        x:         'fab fa-x-twitter',
        facebook:  'fab fa-facebook',
        instagram: 'fab fa-instagram',
        youtube:   'fab fa-youtube',
        website:   'fas fa-globe',
        web:       'fas fa-globe',
        sitio:     'fas fa-globe',
        portfolio: 'fas fa-globe',
        email:     'fas fa-envelope',
    };

    function setText(id, value) {
        const el = document.getElementById(id);
        if (el) el.textContent = value ?? '';
    }

    function escapeHtml(s) {
        const d = document.createElement('div');
        d.textContent = s ?? '';
        return d.innerHTML;
    }

    // Acepta:
    //   - un botón con dataset.portafolio (uso del home)
    //   - un objeto de datos directamente { data, preview: bool } (uso del dashboard / vista previa)
    window.abrirModalPortafolio = function (input) {
        let data;
        let isPreview = false;

        if (input instanceof Element) {
            try { data = JSON.parse(input.dataset.portafolio); } catch (e) { return; }
        } else if (input && typeof input === 'object') {
            if (input.data) {
                data = input.data;
                isPreview = !!input.preview;
            } else {
                data = input;
            }
        } else {
            return;
        }

        // Banner de preview
        const banner = document.getElementById('mp_preview_banner');
        if (banner) banner.classList.toggle('hidden', !isPreview);

        const sidebar = document.getElementById('mp_sidebar');
        const from = data.cover_from || '#1e3a5f';
        const to   = data.cover_to   || '#e11d48';
        sidebar.style.backgroundImage = `linear-gradient(160deg, ${from} 0%, ${to} 100%)`;

        const avatar = document.getElementById('mp_avatar');
        if (data.foto) {
            avatar.innerHTML = `<img src="${data.foto}" alt="${escapeHtml(data.nombre || '')}" class="w-full h-full rounded-2xl object-cover">`;
        } else {
            avatar.textContent = data.iniciales || '??';
        }

        setText('mp_nombre', data.nombre);
        setText('mp_rol', data.rol);
        setText('mp_bio_corta', data.descripcion);
        setText('mp_bio', data.descripcion);
        setText('mp_stat_anios', (data.anios_num ?? 0) + (data.anios_num >= 1 ? '+' : ''));
        setText('mp_stat_proy', data.cnt_proy ?? 0);
        setText('mp_stat_empresas', data.cnt_empresas ?? 0);

        const setContact = (wrapperId, value) => {
            const wrap = document.getElementById(wrapperId);
            const span = wrap.querySelector('.mp-contact-text');
            const hasValue = value && String(value).trim() !== '' && value !== 'Sin ubicación';
            if (hasValue) {
                span.textContent = value;
                wrap.title = value;
                wrap.classList.remove('hidden');
                wrap.classList.add('flex');
            } else {
                wrap.classList.add('hidden');
                wrap.classList.remove('flex');
            }
        };
        setContact('mp_contact_email', data.email);
        setContact('mp_contact_tel',   data.telefono);
        setContact('mp_contact_loc',   data.ubicacion);

        const linksWrap = document.getElementById('mp_links');
        linksWrap.innerHTML = '';
        const links = data.links || {};
        Object.keys(links).forEach(tipo => {
            const url  = links[tipo];
            if (!url) return;
            const icon = ICONS_LINK[tipo] || 'fas fa-link';
            const a = document.createElement('a');
            a.href = url;
            a.target = '_blank';
            a.rel = 'noopener noreferrer';
            a.title = tipo.charAt(0).toUpperCase() + tipo.slice(1);
            a.className = 'w-9 h-9 rounded-lg bg-white/20 hover:bg-white/35 border border-white/25 text-white flex items-center justify-center transition';
            a.innerHTML = `<i class="${icon}"></i>`;
            linksWrap.appendChild(a);
        });

        const tecnicas = [];
        const grupos = data.habilidades_grupos || {};
        Object.keys(grupos).forEach(cat => (grupos[cat] || []).forEach(h => tecnicas.push(h)));
        const contTec = document.getElementById('mp_habilidades_tecnicas');
        const emptyTec = document.getElementById('mp_habilidades_tecnicas_empty');
        contTec.innerHTML = '';
        if (tecnicas.length === 0) {
            emptyTec.classList.remove('hidden');
        } else {
            emptyTec.classList.add('hidden');
            tecnicas.forEach(nombre => {
                const li = document.createElement('li');
                li.className = 'flex items-center gap-2.5 hover:text-[#1e3a5f] transition cursor-default';
                li.innerHTML = `<span class="w-2 h-2 rounded-full bg-gradient-to-br from-[#1e3a5f] to-[#e11d48] ring-2 ring-[#1e3a5f]/15 flex-shrink-0"></span><span>${escapeHtml(nombre)}</span>`;
                contTec.appendChild(li);
            });
        }

        const blandas     = data.habilidades_blandas || [];
        const contBlandas = document.getElementById('mp_habilidades_blandas');
        const emptyBlandas = document.getElementById('mp_habilidades_blandas_empty');
        contBlandas.innerHTML = '';
        if (blandas.length === 0) {
            emptyBlandas.classList.remove('hidden');
        } else {
            emptyBlandas.classList.add('hidden');
            blandas.forEach(nombre => {
                const li = document.createElement('li');
                li.className = 'flex items-center gap-2.5 hover:text-[#e11d48] transition cursor-default';
                li.innerHTML = `<span class="w-2 h-2 rounded-full bg-gradient-to-br from-[#e11d48] to-[#1e3a5f] ring-2 ring-[#e11d48]/15 flex-shrink-0"></span><span>${escapeHtml(nombre)}</span>`;
                contBlandas.appendChild(li);
            });
        }

        renderTimeline(
            'mp_experiencias', 'mp_experiencias_empty',
            data.experiencias || [],
            (e) => {
                const proys = e.proyectos || [];
                const proysHtml = proys.length ? `
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <p class="text-[11px] font-semibold uppercase tracking-wider text-gray-500 mb-2">
                            <i class="fas fa-folder text-[#1e3a5f]/60 mr-1"></i> Proyectos relacionados
                        </p>
                        <div class="flex flex-wrap gap-1.5">
                            ${proys.map(pr => pr.url_link
                                ? `<a href="${pr.url_link}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-medium bg-[#1e3a5f]/8 hover:bg-[#1e3a5f]/15 text-[#1e3a5f] border border-[#1e3a5f]/15 px-2.5 py-1 rounded-full transition cursor-pointer"><i class="fas fa-code-branch text-[10px]"></i>${escapeHtml(pr.nombre)}<i class="fas fa-external-link-alt text-[9px] opacity-70"></i></a>`
                                : `<button type="button" onclick="irAProyecto(${pr.id_proyecto})" class="inline-flex items-center gap-1.5 text-xs font-medium bg-[#1e3a5f]/8 hover:bg-[#1e3a5f]/15 text-[#1e3a5f] border border-[#1e3a5f]/15 px-2.5 py-1 rounded-full transition cursor-pointer"><i class="fas fa-code-branch text-[10px]"></i>${escapeHtml(pr.nombre)}<i class="fas fa-arrow-down text-[9px] opacity-70"></i></button>`
                            ).join('')}
                        </div>
                    </div>` : '';
                return `
                <div class="group bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition relative overflow-hidden">
                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-[#1e3a5f] to-[#e11d48]"></span>
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0">
                            <h4 class="font-bold text-[#1e3a5f] text-base">${escapeHtml(e.cargo)}</h4>
                            <p class="text-sm font-semibold text-[#1e3a5f] mt-0.5 flex items-center gap-1.5"><i class="fas fa-building text-xs opacity-70"></i>${escapeHtml(e.empresa)}</p>
                        </div>
                        ${e.trabajo_actual
                            ? '<span class="text-[10px] font-semibold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200 px-2 py-0.5 rounded-full whitespace-nowrap flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>Actual</span>'
                            : ''}
                    </div>
                    <p class="text-xs text-gray-500 mt-2 inline-flex items-center gap-1.5 bg-[#1e3a5f]/8 border border-[#1e3a5f]/15 px-2.5 py-1 rounded-full">
                        <i class="far fa-calendar text-[#e11d48]"></i>
                        ${formatRangoFecha(e.fecha_ini, e.fecha_fin, e.trabajo_actual)}
                    </p>
                    ${e.descripcion ? `<p class="text-sm text-gray-600 leading-relaxed mt-3">${escapeHtml(e.descripcion)}</p>` : ''}
                    ${proysHtml}
                </div>`;
            }
        );

        renderTimeline(
            'mp_formacion', 'mp_formacion_empty',
            data.formacion || [],
            (f) => `
                <div class="group bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition relative overflow-hidden">
                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-[#1e3a5f] to-[#e11d48]"></span>
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0">
                            <h4 class="font-bold text-[#1e3a5f] text-base">${escapeHtml(f.titulo)}</h4>
                            <p class="text-sm font-semibold text-[#1e3a5f] mt-0.5 flex items-center gap-1.5"><i class="fas fa-university text-xs opacity-70"></i>${escapeHtml(f.institucion)}</p>
                        </div>
                        ${f.nivel ? `<span class="text-[10px] font-semibold uppercase tracking-wider bg-gradient-to-br from-[#1e3a5f] to-[#e11d48] text-white px-2.5 py-1 rounded-full whitespace-nowrap shadow-sm">${escapeHtml(f.nivel)}</span>` : ''}
                    </div>
                    <p class="text-xs text-gray-500 mt-2 inline-flex items-center gap-1.5 bg-[#1e3a5f]/8 border border-[#1e3a5f]/15 px-2.5 py-1 rounded-full">
                        <i class="far fa-calendar text-[#1e3a5f]"></i>
                        ${formatRangoFecha(f.fecha_ini, f.fecha_fin, false)}
                    </p>
                    ${f.descripcion ? `<p class="text-sm text-gray-600 leading-relaxed mt-3">${escapeHtml(f.descripcion)}</p>` : ''}
                </div>`
        );

        const ESTADO_LABELS = {
            en_progreso: { label: 'En curso',     bg: 'bg-[#1e3a5f]/10', text: 'text-[#1e3a5f]' },
            completado:  { label: 'Completado',   bg: 'bg-emerald-50',   text: 'text-emerald-700' },
            pendiente:   { label: 'Pendiente',    bg: 'bg-gray-100',     text: 'text-gray-600' },
            cancelado:   { label: 'Cancelado',    bg: 'bg-red-50',       text: 'text-[#e11d48]' },
        };
        renderTimeline(
            'mp_proyectos', 'mp_proyectos_empty',
            data.proyectos_lista || [],
            (pr) => {
                const estado = ESTADO_LABELS[pr.estado] || ESTADO_LABELS.pendiente;
                const tags = (pr.tecnologias || '').split(',').map(t => t.trim()).filter(Boolean);
                return `
                <div id="mp_proy_${pr.id_proyecto}" class="group bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition flex flex-col">
                    <div class="h-2 bg-gradient-to-r from-[#1e3a5f] via-[#e11d48] to-[#1e3a5f]"></div>
                    <div class="p-5 flex flex-col gap-2 flex-1">
                        <div class="flex items-start justify-between gap-2">
                            <h4 class="font-bold text-[#1e3a5f] text-base leading-tight">${escapeHtml(pr.nombre)}</h4>
                            <span class="text-[10px] font-semibold uppercase tracking-wider ${estado.bg} ${estado.text} px-2 py-0.5 rounded-full whitespace-nowrap">${estado.label}</span>
                        </div>
                        ${pr.descripcion ? `<p class="text-xs text-gray-600 leading-relaxed">${escapeHtml(pr.descripcion)}</p>` : ''}
                        <p class="text-xs text-gray-500 inline-flex items-center gap-1.5 self-start bg-[#1e3a5f]/8 border border-[#1e3a5f]/15 px-2.5 py-1 rounded-full">
                            <i class="far fa-calendar text-[#1e3a5f]"></i>
                            ${formatRangoFecha(pr.fecha_ini, pr.fecha_fin, false)}
                        </p>
                        ${tags.length ? `<div class="flex flex-wrap gap-1.5 mt-1">${tags.slice(0, 6).map(t => `<span class="text-[11px] font-medium text-[#1e3a5f] bg-[#1e3a5f]/8 border border-[#1e3a5f]/15 px-2 py-0.5 rounded-full">${escapeHtml(t)}</span>`).join('')}${tags.length > 6 ? `<span class="text-[11px] font-medium bg-[#1e3a5f]/8 text-[#e11d48] border border-[#1e3a5f]/15 px-2 py-0.5 rounded-full">+${tags.length - 6}</span>` : ''}</div>` : ''}
                        ${pr.url_link ? `<a href="${pr.url_link}" target="_blank" rel="noopener noreferrer" class="text-xs font-semibold text-[#1e3a5f] hover:text-[#e11d48] transition mt-auto pt-2 inline-flex items-center gap-1.5 self-start"><i class="fas fa-external-link-alt text-[10px]"></i> Ver proyecto</a>` : ''}
                    </div>
                </div>`;
            }
        );

        modal.classList.remove('hidden');
        modal.scrollTop = 0;
        const contenido = document.getElementById('mp_contenido');
        if (contenido) contenido.scrollTop = 0;
        document.body.style.overflow = 'hidden';

        const navLinks = document.querySelectorAll('.mp-nav');
        navLinks.forEach((link, idx) => {
            link.classList.toggle('active', idx === 0);
            link.onclick = function (e) {
                e.preventDefault();
                const id = link.getAttribute('href').replace('#', '');
                const target = document.getElementById(id);
                if (!target) return;
                if (contenido && contenido.scrollHeight > contenido.clientHeight) {
                    contenido.scrollTo({ top: target.offsetTop - 8, behavior: 'smooth' });
                } else {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
                navLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            };
        });
    };

    window.irAProyecto = function (idProyecto) {
        const card = document.getElementById('mp_proy_' + idProyecto);
        if (!card) return;
        card.scrollIntoView({ behavior: 'smooth', block: 'center' });
        card.classList.add('ring-2', 'ring-[#e11d48]', 'ring-offset-2');
        setTimeout(() => card.classList.remove('ring-2', 'ring-[#e11d48]', 'ring-offset-2'), 1800);
    };

    function renderTimeline(contId, emptyId, items, builder) {
        const cont  = document.getElementById(contId);
        const empty = document.getElementById(emptyId);
        cont.innerHTML = '';
        if (!items || items.length === 0) {
            empty.classList.remove('hidden');
            return;
        }
        empty.classList.add('hidden');
        cont.innerHTML = items.map(builder).join('');
    }

    function formatRangoFecha(ini, fin, actual) {
        if (!ini) return '';
        const f = (s) => {
            const d = new Date(s + 'T12:00:00');
            if (isNaN(d.getTime())) return '';
            const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
            return `${meses[d.getMonth()]} ${d.getFullYear()}`;
        };
        const ini2 = f(ini);
        const fin2 = actual ? 'Actualidad' : (fin ? f(fin) : '—');
        return `${ini2} – ${fin2}`;
    }

    window.cerrarModalPortafolio = function () {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    };

    window.cerrarModalPortafolioFondo = function (e) {
        if (e.target === modal) cerrarModalPortafolio();
    };

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) cerrarModalPortafolio();
    });
})();
</script>
