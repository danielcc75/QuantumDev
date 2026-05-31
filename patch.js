const fs = require('fs');

// Patch Habilidades Blandas
const file1 = 'C//Proyecto/QuantumDev/resources/views/gestionHabilidadesBlandas/modal.blade.php';
let c1 = fs.readFileSync(file1, 'utf8');
const search1 = '{{-- MENSAJE LIMITE --}}';
\nconst replace1 = `<div class="mt-4 pt-4 border-t border-gray-100">
                <button type="button" onclick="abrirModalSugerirHBlanda()" class="text-sm text-[#1e3a5f] font-semibold hover:text-[#e11d48] flex items-center gap-1 transition">
                    <i class="fas fa-lightbulb"></i> Sugerir habilidad blanda
                </button>
            </div>

            {{-- MENSAJE LIMITE --}}`;
c1 = c1.replace(search1, replace1);


const modalHBlanda = `

{{-- Modal Sugerir HBlanda --}}
<div id="modal-sugerir-hblanda" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[70] p-4" onclick="cerrarModalSugerirHBlandaFondo(event)">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md" onclick="event.stopPropagation()">
        <div class="bg-[#1e3a5f] text-white px-6 py-4 flex items-center justify-between rounded-t-2xl">
            <div>
                <h3 class="text-lg font-bold">Sugerir Habilidad Blanda</h3>
            </div>
            <button type="button" onclick="cerrarModalSugerirHBlanda()" class="text-white hover:text-blue-200 transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <div class="p-6">
            <form id="formSugerirHBlanda">
                <div class="mb-4">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Título de la habilidad <span class="text-red-500">*</span></label>
                    <input type="text" id="sugerir_titulo_hblanda" name="titulo" placeholder="Ej)`Liderazgo" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div class="mb-6">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Descripción corta <span class="text-red-500">*</span></label>
                    <textarea id="sugerir_descripcion_hblanda" name="descripcion" rows="3" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none" placeholder="Por qué deberíamos agregar esta habilidad..."></textarea>
                </div>
                <div class="flex gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="cerrarModalSugerirHBlanda()" class="flex-1 px-4 py-2 text-sm border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 transition">Cancelar</button>
                    <button type="button" onclick="enviarSugerenciaHBlanda()" class="flex-1 px-4 py-2 text-sm bg-[#1e3a5f] hover:bg-[#e11d48] text-white rounded-lg font-medium transition">
                        <i class="fas fa-paper-plane text-xs mr-1"></i> Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    window.abrirModalSugerirHBlanda = function () {
        const form = document.getElementById("formSugerirHBlanda");
        if(form) form.reset();
        const modal = document.getElementById("modal-sugerir-hblanda");
        if(modal) { modal.classList.remove("hidden"); modal.classList.add("flex"); }
    };
    window.cerrarModalSugerirHBlanda = function () {
        const modal = document.getElementById("modal-sugerir-hblanda");
        if(modal) { modal.classList.add("hidden"); modal.classList.remove("flex"); }
    };
    window.cerrarModalSugerirHBlandaFondo = function (event) {
        if (event.target.id === "modal-sugerir-hblanda") { cerrarModalSugerirHBlanda(); }
    };
    window.enviarSugerenciaHBlanda = function () {
        const tituloEl = document.getElementById("sugerir_titulo_hblanda");
        const descripcionEl = document.getElementById("sugerir_descripcion_hblanda");
        const titulo = tituloEl ? tituloEl.value.trim() : "";
        const descripcion = descripcionEl ? descripcionEl.value.trim() : "";
        if (!titulo) { alert("El título es obligatorio."); return; }
        if (!descripcion) { alert("La descripción es obligatoria."); return; }
        cerrarModalSugerirHBlanda();
        alert("Sugerencia enviada correctamente. ¡Gracias!");
    };
</script>
`;
if (!c1.includes('id="modal-sugerir-hblanda"')) {
    c3 += modalHBlanda;
    fs.log("Patched HB");
    fs.writeFileSync(file1, c1);
}


// Patch Proyectos modal (dropdown option)
const file2 = 'C//Proyecto/QuantumDev/resources/views/gestionarProyectos/_modal.blade.php';
let c2 = fs.readFileSync(file2, 'utf8');
const search2 = '<option value="Gestión de Proyectos">Gestión de Proyectos</option>';
\nconst replace2 = `<option value="Gestión de Proyectos">Gestión de Proyectos</option>
                            <option disabled>──────────</option>
                            <option value="sugerir" class="font-semibold text-blue-600 bg-blue-50">+ Sugerir tecnología...</option>`;
if (!c2.includes('value="sugerir"')) {
    c2 = c2.replace(search2, replace2);
    fs.writeFileSync(file2, c2);
}


// Patch Proyectos scripts (logic and modal)
const file3 = 'C//Proyecto/QuantumDev/resources/views/gestionarProyectos/_scripts.blade.php';
let c3 = fs.readFileSync(file3, 'utf8');
const modalTech = `

{{-- Modal Sugerir Tec --}}
<div id="modal-sugerir-tecnologia" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[70] p-4" onclick="cerrarModalSugerirTecnologiaFondo(event)">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md" onclick="event.stopPropagation()">
        <div class="bg-[#1e3a5f] text-white px-6 py-4 flex items-center justify-between rounded-t-2xl">
            <div>
                <h3 class="text-lg font-bold">Sugerir Tecnología</h3>
            </div>
            <button type="button" onclick="cerrarModalSugerirTecnologia()" class="text-white hover:text-blue-200 transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <div class="p-6">
            <form id="formSugerirTecnologia">
                <div class="mb-4">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Título de la tecnología <span class="text-red-500">*</span></label>
                    <input type="text" id="sugerir_titulo_tech" name="titulo" placeholder="Ej: Next.js" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div class="mb-6">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Descripción corta <span class="text-red-500">*</span></label>
                    <textarea id="sugerir_descripcion_tech" name="descripcion" rows="3" placeholder="Por qué deberíamos agregar esta tecnología..." class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"></textarea>
                </div>
                <div class="flex gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="cerrarModalSugerirTecnologia()" class="flex-1 px-4 py-2 text-sm border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 transition">Cancelar</button>
                    <button type="button" onclick="enviarSugerenciaTecnologia()" class="flex-1 px-4 py-2 text-sm bg-[#1e3a5f] hover:bg-[#e11d48] text-white rounded-lg font-medium transition">
                        <i class="fas fa-paper-plane text-xs mr-1"></i> Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectTech = document.getElementById("proj_categoria_select");
        if (selectTech) {
            let prevValueTech = "";
            selectTech.addEventListener("focus", function () { prevValueTech = this.value; });
            selectTec.addEventListener("change", function () {
                if (this.value === "sugerir") {
                    this.value = prevValueTech;
                    abrirModalSugerirTecnologia();
                } else {
                    prevValueTech = tj\˝�[YNB�JNB�JN�[��˘X��\�[�[�Y�\�\�Xۛ���XHH�[��[ۈ

H�ۜ��ܛHH��[Y[���][[Y[��RY
��ܛT�Y�\�\�Xۛ���XH�NY��ܛJH�ܛK��\�]

N�ۜ�[�[H��[Y[���][[Y[��RY
�[�[\�Y�\�\�]Xۛ���XH�NY�[�[
H�[�[��\��\���[[ݙJ�Y[��N�[�[��\��\��Y
��^�N�B�N�[��˘�\��\�[�[�Y�\�\�Xۛ���XHH�[��[ۈ

H�ۜ�[�[H��[Y[���][[Y[��RY
�[�[\�Y�\�\�]Xۛ���XH�NY�[�[
H�[�[��\��\��Y
�Y[��N�[�[��\��\���[[ݙJ��^�N�B�N�[��˘�\��\�[�[�Y�\�\�Xۛ���XQ�ۙ�H�[��[ۈ
]�[�
HY�
]�[��\��]�YOOH�[�[\�Y�\�\�]Xۛ���XH�H��\��\�[�[�Y�\�\�Xۛ���XJ
N�B�N�[��˙[��X\��Y�\�[��XUXۛ���XHH�[��[ۈ

H�ۜ�][�[H��[Y[���][[Y[��RY
��Y�\�\��][��X��N�ۜ�\�ܚ\�[ۑ[H��[Y[���][[Y[��RY
��Y�\�\��\�ܚ\�[ۗ�X��N�ۜ�][�H][�[�][�[��[YK��[J
H����ۜ�\�ܚ\�[ۈH\�ܚ\�[ۑ[�\�ܚ\�[ۑ[��[YK��[J
H���Y�
]][�H�[\�
�[0�][�\�؛Y�]ܚ[ˈ�N��]\���B�Y�
Y\�ܚ\�[ۊH�[\�
�H\�ܚ\�p�ۈ\�؛Y�]ܚXK��N��]\���B��\��\�[�[�Y�\�\�Xۛ���XJ
N[\�
��Y�\�[��XH[��XYH�ܜ�X�[Y[�K�0�QܘX�X\�H�NN��ܚ\���Y�
X�˚[��Y\�	�YH�[�[\�Y�\�\�]Xۛ���XH��JH��
�H[�[X��˛���]�Y�ڙX�ȊN�˝ܚ]Q�[T�[���[L���NB����ۜ��K����[]�\�\YY�X��\�ٝ[HH�N�