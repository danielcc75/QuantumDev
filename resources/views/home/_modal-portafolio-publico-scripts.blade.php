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
