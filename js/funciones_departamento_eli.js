$(document).ready(function(){
    // Cargar todos los empleados al inicio
    $.ajax({
        url: '../controlador/controlador_departamento_eliminar.php',
        type: 'POST',
        success: function(response) {
            $('#tabla_depa_turno').html(response);
        }
    });

    // Filtrar empleados por codigo Departamento
    $('#c_codigo_buscar_departamento').on('input', function() {
        var codigo = $(this).val();
        if (codigo.length > 0) {
            $.ajax({
                url: '../controlador/controlador_departamento_eliminar.php',
                type: 'POST',
                data: { c_codigo_buscar_departamento: codigo },
                success: function(response) {
                    $('#tabla_depa_turno').html(response);
                }
            });
        } else {
            // Si el campo de cédula está vacío, cargar todos los departamentos
            $.ajax({
                url: '../controlador/controlador_departamento_eliminar.php',
                type: 'POST',
                success: function(response) {
                    $('#tabla_depa_turno').html(response);
                }
            });
        }
    });

    
});