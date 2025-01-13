// Función para cargar los datos de los selects
function cargarDatosSelects() {
    $.ajax({
        url: '../controlador/contro_emple.php',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            // Cargar roles
            const selectRol = $('#c_rol');
            selectRol.empty();
            selectRol.append('<option value="" disabled selected>Selecciona</option>');
            response.roles.forEach(function(rol) {
                selectRol.append(
                    $('<option></option>')
                        .val(rol.id_rol)
                        .text(rol.nombre_rol)
                );
            });
            selectRol.val(''); // Forzar la selección de la opción por defecto

            // Cargar departamentos
            const selectDepartamento = $('#c_departamento');
            selectDepartamento.empty();
            selectDepartamento.append('<option value="" disabled selected>Selecciona</option>');
            response.departamentos.forEach(function(depto) {
                selectDepartamento.append(
                    $('<option></option>')
                        .val(depto.id_depa)
                        .text(depto.nombre_depa)
                );
            });
            selectDepartamento.val(''); // Forzar la selección de la opción por defecto

            // Cargar turnos
            const selectTurno = $('#c_turno');
            selectTurno.empty();
            selectTurno.append('<option value="" disabled selected>Selecciona</option>');
            response.turnos.forEach(function(turno) {
                selectTurno.append(
                    $('<option></option>')
                        .val(turno.id_horario)
                        .text(turno.tipo_turno)
                );
            });
            selectTurno.val(''); // Forzar la selección de la opción por defecto
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar los datos:', error);
        }
    });
}

// Cargar los datos cuando el documento esté listo
$(document).ready(function() {
    cargarDatosSelects();
    
    // Asegurarse de que los selects mantengan la opción por defecto después de cargar
    $('#c_rol, #c_departamento, #c_turno').each(function() {
        $(this).val('');
    });
});