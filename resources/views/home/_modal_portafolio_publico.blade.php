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

@include('home._modal-portafolio-publico-scripts')
