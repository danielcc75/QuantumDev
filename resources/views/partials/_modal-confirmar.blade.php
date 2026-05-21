{{-- Modal global de confirmación. Incluido una sola vez en layouts.app.
     Uso programático:
        window.confirmar({
            tipo: 'danger'|'warning'|'success'|'info'|'primary',
            titulo: '¿Eliminar?',
            mensaje: 'Esta acción no se puede deshacer',
            textoConfirmar: 'Sí, eliminar',
            textoCancelar: 'Cancelar',
            onConfirm: () => { ... },
            onCancel: () => { ... },
        });

     Uso declarativo (forms con confirmación):
        <form ... data-confirm="¿Eliminar X?" data-confirm-type="danger">
            ...
        </form>
--}}
<div id="gcfModal" class="fixed inset-0 bg-black bg-opacity-60 z-[100] hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">
        <div id="gcfHeader" class="h-1.5 w-full bg-red-500"></div>
        <div class="px-6 pt-6 pb-4 text-center">
            <div id="gcfIconWrap" class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 bg-red-50">
                <i id="gcfIcon" class="fas fa-exclamation-triangle text-2xl text-red-500"></i>
            </div>
            <h4 id="gcfTitle" class="text-base font-bold text-[#1e3a5f] mb-1.5">¿Estás seguro?</h4>
            <p id="gcfMessage" class="text-xs text-gray-500 leading-relaxed">Esta acción no se puede deshacer.</p>
        </div>
        <div class="flex gap-3 px-6 pb-6">
            <button type="button" id="gcfBtnCancel"
                class="flex-1 px-4 py-2.5 text-sm border border-gray-200 text-gray-500 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition font-medium">
                Cancelar
            </button>
            <button type="button" id="gcfBtnConfirm"
                class="flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition bg-red-500 hover:bg-red-600">
                Confirmar
            </button>
        </div>
    </div>
</div>

<script>
(function () {
    const modal = document.getElementById('gcfModal');
    if (!modal) return;

    const presets = {
        danger:  { header: 'bg-red-500',          iconBg: 'bg-red-50',          iconColor: 'text-red-500',          icon: 'fas fa-trash-alt',           btn: 'bg-red-500 hover:bg-red-600' },
        warning: { header: 'bg-yellow-500',       iconBg: 'bg-yellow-50',       iconColor: 'text-yellow-500',       icon: 'fas fa-exclamation-triangle',btn: 'bg-yellow-500 hover:bg-yellow-600' },
        success: { header: 'bg-[#1e3a5f]',        iconBg: 'bg-[#1e3a5f]/10',    iconColor: 'text-[#1e3a5f]',        icon: 'fas fa-check-circle',        btn: 'bg-[#1e3a5f] hover:bg-[#1e3a5f]/90' },
        info:    { header: 'bg-blue-500',         iconBg: 'bg-blue-50',         iconColor: 'text-blue-500',         icon: 'fas fa-info-circle',         btn: 'bg-blue-500 hover:bg-blue-600' },
        primary: { header: 'bg-[#1e3a5f]',        iconBg: 'bg-[#1e3a5f]/10',    iconColor: 'text-[#1e3a5f]',        icon: 'fas fa-question-circle',     btn: 'bg-[#1e3a5f] hover:bg-[#1e3a5f]/90' },
    };

    // Extrae el color base de un btnClass tipo "bg-yellow-500 hover:bg-yellow-600"
    // o "bg-[#e11d48] hover:bg-[#e11d48]/80" → "bg-yellow-500" / "bg-[#e11d48]"
    function deriveHeader(btnClass) {
        if (!btnClass) return null;
        const m = btnClass.match(/bg-(?:\[[^\]]+\]|[a-z]+-\d+)/);
        return m ? m[0] : null;
    }

    window.confirmar = function (cfg) {
        cfg = cfg || {};
        const tipo = cfg.tipo || 'danger';
        const base = presets[tipo] || presets.danger;

        const iconBg    = cfg.iconBg      || base.iconBg;
        const iconColor = cfg.iconColor   || base.iconColor;
        const icon      = cfg.icon        || base.icon;
        const btnClass  = cfg.btnClass    || base.btn;
        // Si no hay headerColor explícito, se infiere del btnClass
        const header    = cfg.headerColor || deriveHeader(btnClass) || base.header;

        document.getElementById('gcfHeader').className   = 'h-1.5 w-full ' + header;
        document.getElementById('gcfIconWrap').className = 'w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 ' + iconBg;
        document.getElementById('gcfIcon').className     = 'text-2xl ' + icon + ' ' + iconColor;
        document.getElementById('gcfTitle').textContent  = cfg.titulo  || '¿Estás seguro?';

        const messageEl = document.getElementById('gcfMessage');
        if (cfg.mensajeHtml) {
            messageEl.innerHTML = cfg.mensajeHtml;
        } else {
            messageEl.textContent = cfg.mensaje || 'Esta acción no se puede deshacer.';
        }

        const btnConfirm = document.getElementById('gcfBtnConfirm');
        btnConfirm.textContent = cfg.textoConfirmar || 'Confirmar';
        btnConfirm.className   = 'flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition ' + btnClass;

        const btnCancel = document.getElementById('gcfBtnCancel');
        btnCancel.textContent = cfg.textoCancelar || 'Cancelar';
        btnCancel.style.display = cfg.soloConfirmar ? 'none' : '';
        btnConfirm.style.display = cfg.ocultarBotones ? 'none' : '';
        if (cfg.ocultarBotones) btnCancel.style.display = 'none';

        btnConfirm.onclick = function () {
            cerrarConfirmar();
            if (typeof cfg.onConfirm === 'function') cfg.onConfirm();
            else if (typeof cfg.accion === 'function') cfg.accion();
        };
        btnCancel.onclick = function () {
            cerrarConfirmar();
            if (typeof cfg.onCancel === 'function') cfg.onCancel();
        };

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        if (window._gcfAutoCloseTimer) {
            clearTimeout(window._gcfAutoCloseTimer);
            window._gcfAutoCloseTimer = null;
        }
        if (cfg.autoCerrarMs && cfg.autoCerrarMs > 0) {
            window._gcfAutoCloseTimer = setTimeout(function () {
                cerrarConfirmar();
                if (typeof cfg.onAutoCerrar === 'function') cfg.onAutoCerrar();
            }, cfg.autoCerrarMs);
        }
    };

    window.cerrarConfirmar = function () {
        if (window._gcfAutoCloseTimer) {
            clearTimeout(window._gcfAutoCloseTimer);
            window._gcfAutoCloseTimer = null;
        }
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };

    // Aliases retrocompatibles con código existente
    window.cerrarConfirmacion            = window.cerrarConfirmar;
    window.cerrarConfirmacionPerfil      = window.cerrarConfirmar;
    window.cerrarConfirmacionExperiencia = window.cerrarConfirmar;
    window.cerrarConfirmacionEducacion   = window.cerrarConfirmar;
    window.cerrarConfirmacionHabilidad   = window.cerrarConfirmar;

    // Cerrar al clic en backdrop
    modal.addEventListener('click', function (e) {
        if (e.target === modal) cerrarConfirmar();
    });

    // Cerrar con Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) cerrarConfirmar();
    });

    // Auto-handler: formularios con atributo data-confirm
    document.addEventListener('submit', function (e) {
        const form = e.target;
        if (!form.dataset.confirm) return;
        if (form.dataset.confirmed === '1') {
            form.removeAttribute('data-confirmed');
            return;
        }
        e.preventDefault();
        confirmar({
            tipo: form.dataset.confirmType || 'danger',
            titulo: form.dataset.confirmTitle || '¿Confirmar eliminación?',
            mensaje: form.dataset.confirm,
            textoConfirmar: form.dataset.confirmButton || 'Eliminar',
            onConfirm: function () {
                form.dataset.confirmed = '1';
                form.submit();
            }
        });
    });
})();
</script>
