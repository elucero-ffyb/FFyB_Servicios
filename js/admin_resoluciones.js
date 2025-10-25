// admin_resoluciones.js

document.addEventListener('DOMContentLoaded', function () {
    // Cargar combos dinámicamente al inicio
    cargarResoluciones();
    
    // Evento para manejar el envío del formulario
    document.getElementById('resolucionesForm').addEventListener('submit', function (e) {
        e.preventDefault();
        guardarResolucion();
    });

    // Cargar resoluciones en la tabla al cargar la página
    cargarTablaResoluciones();
});

/**
 * Función para cargar las resoluciones en el combo dinámico
 */
function cargarResoluciones() {
    fetch('rutas/cargar_resoluciones.php')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('resolucion');
            select.innerHTML = '<option value="">Seleccione una resolución</option>';
            data.forEach(resolucion => {
                const option = document.createElement('option');
                option.value = resolucion.id;
                option.textContent = `${resolucion.numero} - ${resolucion.nombre}`;
                select.appendChild(option);
            });
        })
        .catch(error => console.error('Error cargando resoluciones:', error));
}

/**
 * Función para guardar una resolución (alta o edición)
 */
function guardarResolucion() {
    const formData = new FormData(document.getElementById('resolucionesForm'));

    fetch('rutas/guardar_resolucion.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Resolución guardada exitosamente');
                document.getElementById('resolucionesForm').reset();
                cargarTablaResoluciones();
            } else {
                alert('Error guardando la resolución: ' + data.message);
            }
        })
        .catch(error => console.error('Error al guardar resolución:', error));
}

/**
 * Función para cargar las resoluciones en la tabla
 */
function cargarTablaResoluciones() {
    fetch('rutas/listar_resoluciones.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tablaResoluciones tbody');
            tbody.innerHTML = '';

            data.forEach(resolucion => {
                const tr = document.createElement('tr');

                tr.innerHTML = `
                    <td>${resolucion.numero}</td>
                    <td>${resolucion.nombre}</td>
                    <td>${resolucion.fecha}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editarResolucion(${resolucion.id})">Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarResolucion(${resolucion.id})">Eliminar</button>
                    </td>
                `;

                tbody.appendChild(tr);
            });
        })
        .catch(error => console.error('Error al cargar la tabla de resoluciones:', error));
}

/**
 * Función para cargar los datos de una resolución en el formulario para editar
 * @param {number} id
 */
function editarResolucion(id) {
    fetch(`rutas/obtener_resolucion.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('id').value = data.id;
            document.getElementById('numero').value = data.numero;
            document.getElementById('nombre').value = data.nombre;
            document.getElementById('fecha').value = data.fecha;
        })
        .catch(error => console.error('Error al cargar resolución para editar:', error));
}

/**
 * Función para eliminar una resolución
 * @param {number} id
 */
function eliminarResolucion(id) {
    if (confirm('¿Está seguro de que desea eliminar esta resolución?')) {
        fetch(`rutas/eliminar_resolucion.php?id=${id}`, {
            method: 'DELETE'
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Resolución eliminada exitosamente');
                    cargarTablaResoluciones();
                } else {
                    alert('Error eliminando la resolución: ' + data.message);
                }
            })
            .catch(error => console.error('Error al eliminar resolución:', error));
    }
}