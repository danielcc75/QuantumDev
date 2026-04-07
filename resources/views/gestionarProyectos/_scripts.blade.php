{{-- resources/views/gestionarProyectos/_scripts.blade.php
     Toda la lógica JS de proyectos: abrir/cerrar modal, crear, editar,
     eliminar y toggle de visibilidad. --}}

<script>
const CSRF    = document.querySelector('meta[name="csrf-token"]').content;
const USER_ID = {{ $userId }};

// ── Modal ────────────────────────────────────────────────────────────────────

function abrirModalProyecto() {
    document.getElementById('proyectoId').value = '';
    document.getElementById('formProyecto').reset();
    document.getElementById('modalProyectoTitulo').textContent = 'Nuevo Proyecto';
    document.getElementById('modalProyecto').classList.remove('hidden');
    document.getElementById('modalProyecto').classList.add('flex');
}

function cerrarModalProyecto() {
    document.getElementById('modalProyecto').classList.add('hidden');
    document.getElementById('modalProyecto').classList.remove('flex');
}

// Cerrar al hacer clic fuera del modal
document.getElementById('modalProyecto').addEventListener('click', function(e) {
    if (e.target === this) cerrarModalProyecto();
});

// ── Editar (carga datos en el modal) ─────────────────────────────────────────

function abrirModalEditar(id) {
    fetch(`/proyectos/${id}`)
        .then(r => r.json())
        .then(p => {
            document.getElementById('proyectoId').value       = p.id_proyecto;
            document.getElementById('proj_nombre').value      = p.nombre       ?? '';
            document.getElementById('proj_descripcion').value = p.descripcion  ?? '';
            document.getElementById('proj_fecha_ini').value   = p.fecha_ini    ?? '';
            document.getElementById('proj_fecha_fin').value   = p.fecha_fin    ?? '';
            document.getElementById('proj_estado').value      = p.estado       ?? 'pendiente';
            document.getElementById('proj_tecnologias').value = p.tecnologias  ?? '';
            document.getElementById('proj_url_link').value    = p.url_link     ?? '';
            document.getElementById('proj_referencias').value = p.referencias  ?? '';
            document.getElementById('proj_visible').checked   = !!p.visible;
            document.getElementById('modalProyectoTitulo').textContent = 'Editar Proyecto';
            document.getElementById('modalProyecto').classList.remove('hidden');
            document.getElementById('modalProyecto').classList.add('flex');
        });
}

// ── Crear / Actualizar ────────────────────────────────────────────────────────

document.getElementById('formProyecto').addEventListener('submit', function(e) {
    e.preventDefault();

    const id     = document.getElementById('proyectoId').value;
    const url    = id ? `/proyectos/${id}` : '/proyectos';
    const method = id ? 'PUT' : 'POST';

    fetch(url, {
        method,
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({
            user_id:     USER_ID,
            nombre:      document.getElementById('proj_nombre').value,
            descripcion: document.getElementById('proj_descripcion').value,
            fecha_ini:   document.getElementById('proj_fecha_ini').value,
            fecha_fin:   document.getElementById('proj_fecha_fin').value,
            estado:      document.getElementById('proj_estado').value,
            tecnologias: document.getElementById('proj_tecnologias').value,
            url_link:    document.getElementById('proj_url_link').value,
            referencias: document.getElementById('proj_referencias').value,
            visible:     document.getElementById('proj_visible').checked ? 1 : 0,
        })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) { cerrarModalProyecto(); location.reload(); }
        else alert(data.message ?? 'Error al guardar');
    });
});

// ── Eliminar ──────────────────────────────────────────────────────────────────

function eliminarProyecto(id) {
    if (!confirm('¿Eliminar este proyecto?')) return;
    fetch(`/proyectos/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': CSRF }
    }).then(() => location.reload());
}

// ── Toggle visibilidad ────────────────────────────────────────────────────────

function toggleVisibilidad(id, btn) {
    const visible = btn.dataset.visible === '1' ? 0 : 1;
    fetch(`/proyectos/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ visible })
    })
    .then(r => r.json())
    .then(data => { if (data.success) location.reload(); });
}
</script>
