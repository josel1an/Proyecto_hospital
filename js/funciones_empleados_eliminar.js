$(document).ready(function(){
    // Cargar todos los empleados al inicio
    $.ajax({
        url: '../controlador/controladores_empleados_eliminar.php',
        type: 'POST',
        success: function(response) {
            $('#employeeTable').html(response);
        }
    });

    // Filtrar empleados por cédula
    $('#c_cedula_buscar').on('input', function() {
        var cedula = $(this).val();
        if (cedula.length > 0) {
            $.ajax({
                url: '../controlador/controladores_empleados_eliminar.php',
                type: 'POST',
                data: { c_cedula_buscar: cedula },
                success: function(response) {
                    $('#employeeTable').html(response);
                }
            });
        } else {
            // Si el campo de cédula está vacío, cargar todos los empleados
            $.ajax({
                url: '../controlador/controladores_empleados_eliminar.php',
                type: 'POST',
                success: function(response) {
                    $('#employeeTable').html(response);
                }
            });
        }
    });

    
    // Manejar la eliminación de empleados
    $(document).on('submit', 'form', function(event) {
        event.preventDefault(); // Evitar el envío del formulario
        var form = $(this);
        $.ajax({
            url: '../controlador/controladores_empleados_eliminar.php',
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                $('#employeeTable').html(response); // Actualizar la tabla
            },
            error: function(xhr, status, error) {
                console.error("Error de AJAX: " + status + " - " + error);
            }
        });
    });
});