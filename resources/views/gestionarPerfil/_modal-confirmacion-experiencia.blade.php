{{-- Modal de Confirmación --}}
<div id="modalConfirmacionExperiencia" class="fixed inset-0 bg-black bg-opacity-60 z-[60] hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">

        {{-- Franja superior de color --}}
        <div id="confirmHeaderExperiencia" class="h-1.5 w-full"></div>

        {{-- Icono + contenido --}}
        <div class="px-6 pt-6 pb-4 text-center">
            <div id="confirmIconWrapperExperiencia" class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i id="confirmIconExperiencia" class="text-2xl"></i>
            </div>
            <h4 id="confirmTituloExperiencia" class="text-base font-bold text-[#1e3a5f] mb-1.5"></h4>
            <p id="confirmMensajeExperiencia" class="text-xs text-gray-500 leading-relaxed"></p>
        </div>

        <div class="flex gap-3 px-6 pb-6">
            <button type="button" onclick="cerrarConfirmacionExperiencia()"
                class="flex-1 px-4 py-2.5 text-sm border border-gray-200 text-gray-500 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition font-medium">
                No, cancelar
            </button>
            <button type="button" id="confirmBtnExperiencia"
                class="flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition">
                Confirmar
            </button>
        </div>
    </div>
</div>
