{{-- Modal de Confirmación --}}
<div id="modalConfirmacionEducacion" class="fixed inset-0 bg-black bg-opacity-60 z-[60] hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">
        <div class="p-6 text-center">
            <div id="confirmIconWrapperEducacion" class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i id="confirmIconEducacion" class="text-2xl"></i>
            </div>
            <h4 id="confirmTituloEducacion" class="text-lg font-bold text-gray-800 mb-2"></h4>
            <p id="confirmMensajeEducacion" class="text-sm text-gray-500 leading-relaxed"></p>
        </div>
        <div class="flex gap-3 px-6 pb-6">
            <button type="button" onclick="cerrarConfirmacionEducacion()"
                class="flex-1 px-4 py-2.5 text-sm border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 transition font-medium">
                No, cancelar
            </button>
            <button type="button" id="confirmBtnEducacion"
                class="flex-1 px-4 py-2.5 text-sm text-white rounded-xl font-medium transition">
                Confirmar
            </button>
        </div>
    </div>
</div>
