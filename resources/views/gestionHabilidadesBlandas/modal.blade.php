<div id="modal-habilidades-blandas"
    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto">

        {{-- HEADER --}}
        <div class="bg-[#1e3a5f] text-white px-6 py-4 flex justify-between items-center rounded-t-2xl">
            <div>
                <h3 class="text-lg font-bold">Habilidades Blandas</h3>
                <p class="text-xs text-blue-200">Selecciona hasta 6 habilidades</p>
            </div>

            <button
                type="button"
                onclick="cerrarModalHabilidadesBlandas()"
                class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-white/20 hover:scale-110 transition duration-200"
            >
                <i class="fas fa-times"></i>
            </button>
        </div>

        {{-- BODY --}}
        <div class="p-6">

            {{-- BUSCADOR --}}
            <div class="mb-4">
                <input
                    type="text"
                    id="buscar-habilidades-blandas"
                    placeholder="Buscar habilidades..."
                    class="w-full border rounded-lg px-4 py-2 text-sm"
                    onkeyup="filtrarHabilidadesBlandas()"
                >
            </div>

            {{-- BURBUJAS --}}
            <div id="contenedor-habilidades-blandas" class="flex flex-wrap gap-3 max-h-64 overflow-y-auto">

                @forelse($habilidadesBlandasActivas as $habilidadBlanda)
                    @php
                        $estaSeleccionada = in_array(
                            $habilidadBlanda->id_habilidad_blanda,
                            $habilidadesBlandasSeleccionadas
                        );
                    @endphp

                    <button
                        type="button"
                        onclick="toggleHabilidad(this)"
                        class="habilidad-blanda border px-4 py-2 rounded-full text-sm hover:bg-blue-100 transition duration-200
                            {{ $estaSeleccionada ? 'bg-[#1e3a5f] text-white border-[#1e3a5f]' : 'border-gray-300 text-gray-700' }}"
                        data-id="{{ $habilidadBlanda->id_habilidad_blanda }}"
                        data-nombre="{{ strtolower($habilidadBlanda->nombre) }}"
                        data-seleccionada="{{ $estaSeleccionada ? '1' : '0' }}"
                    >
                        {{ $habilidadBlanda->nombre }}
                    </button>
                @empty
                    <p class="text-sm text-gray-400">
                        no hay habilidades blandas activas disponibles
                    </p>
                @endforelse

            </div>

            {{-- CONTADOR --}}
            <div id="contador-wrapper" class="mt-4 text-sm text-gray-500">
                seleccionadas:
                <span id="contador-habilidades">{{ count($habilidadesBlandasSeleccionadas) }}</span> / 6
            </div>

            {{-- MENSAJE LIMITE --}}
            <div id="mensaje-limite" class="text-xs text-red-500 mt-1 hidden">
                solo puedes seleccionar hasta 6 habilidades
            </div>

            {{-- BOTON --}}
            <div class="mt-4">
                <button
                    type="button"
                    onclick="guardarHabilidadesBlandas()"
                    class="w-full bg-[#1e3a5f] text-white py-3 rounded-lg font-medium hover:bg-[#e11d48] transition duration-200">
                    Guardar habilidades blandas
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    let seleccionIds = @json($habilidadesBlandasSeleccionadas);
    let seleccionadas = seleccionIds.length;
    const max = 6;

    function abrirModalHabilidadesBlandas() {
        document.getElementById('modal-habilidades-blandas').classList.remove('hidden');
        document.getElementById('modal-habilidades-blandas').classList.add('flex');
    }

    function cerrarModalHabilidadesBlandas() {
        document.getElementById('modal-habilidades-blandas').classList.add('hidden');
        document.getElementById('modal-habilidades-blandas').classList.remove('flex');
    }

    function toggleHabilidad(btn) {
        const id = btn.getAttribute('data-id');
        const mensajeLimite = document.getElementById('mensaje-limite');
        const contadorWrapper = document.getElementById('contador-wrapper');

        if (btn.classList.contains('bg-[#1e3a5f]')) {
            btn.classList.remove('bg-[#1e3a5f]', 'text-white', 'border-[#1e3a5f]');
            btn.classList.add('border-gray-300', 'text-gray-700');

            seleccionadas--;
            seleccionIds = seleccionIds.filter(i => i != id && i != parseInt(id));

            mensajeLimite.classList.add('hidden');
            contadorWrapper.classList.remove('text-red-500', 'font-bold');

        } else {
            if (seleccionadas >= max) {
                mensajeLimite.classList.remove('hidden');
                contadorWrapper.classList.add('text-red-500', 'font-bold');

                setTimeout(() => {
                    mensajeLimite.classList.add('hidden');
                    contadorWrapper.classList.remove('text-red-500', 'font-bold');
                }, 2000);

                return;
            }

            btn.classList.add('bg-[#1e3a5f]', 'text-white', 'border-[#1e3a5f]');
            btn.classList.remove('border-gray-300', 'text-gray-700');

            seleccionadas++;

            if (!seleccionIds.includes(id) && !seleccionIds.includes(parseInt(id))) {
                seleccionIds.push(id);
            }
        }

        document.getElementById('contador-habilidades').innerText = seleccionadas;
    }

    function filtrarHabilidadesBlandas() {
        const texto = document.getElementById('buscar-habilidades-blandas').value.toLowerCase();
        const items = document.querySelectorAll('.habilidad-blanda');

        items.forEach(item => {
            const nombre = item.getAttribute('data-nombre');
            item.style.display = nombre.includes(texto) ? 'inline-block' : 'none';
        });
    }

    function guardarHabilidadesBlandas() {
        fetch("{{ route('habilidades-blandas.guardar') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: JSON.stringify({ habilidades: seleccionIds })
        })
        .then(res => res.json())
        .then(data => {
            if (data.ok) {
                cerrarModalHabilidadesBlandas();
                actualizarChipsBlandasEnVista();
                if (typeof window.notificarItemPublicable === 'function') {
                    window.notificarItemPublicable('blanda');
                }
            } else {
                alert('No se pudieron guardar las habilidades blandas.');
            }
        })
        .catch(() => {
            alert('Ocurrió un error al guardar las habilidades blandas.');
        });
    }

    function actualizarChipsBlandasEnVista() {
        const display = document.getElementById('chips-blandas-display');
        if (!display) return;

        const seleccionados = [...document.querySelectorAll('.habilidad-blanda')]
            .filter(btn => btn.classList.contains('bg-[#1e3a5f]'));

        if (seleccionados.length === 0) {
            display.innerHTML = `
                <div class="flex flex-col items-center py-6 text-center">
                    <div class="w-14 h-14 rounded-full bg-[#1e3a5f]/8 flex items-center justify-center mb-3">
                        <i class="fas fa-user-friends text-2xl text-[#1e3a5f]/40"></i>
                    </div>
                    <p class="text-gray-600 font-semibold text-sm">Aún no agregaste habilidades blandas</p>
                    <p class="text-xs text-gray-400 mt-1">Agrega habilidades interpersonales para completar tu perfil</p>
                </div>`;
            return;
        }

        const chips = seleccionados.map(btn =>
            `<span class="bg-[#1e3a5f] text-white px-3 py-1.5 rounded-full text-xs font-medium">${btn.textContent.trim()}</span>`
        ).join('');

        display.innerHTML = `<div class="flex flex-wrap gap-2">${chips}</div>`;
    }

    document.getElementById('abrir-modal-habilidades-blandas')?.addEventListener('click', abrirModalHabilidadesBlandas);
</script>