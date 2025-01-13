$(document).ready(function(){
    function cargarTablaEmpleados(cedula = '') {
        $.ajax({
            url: '../controlador/controladores_empleados.php',
            type: 'POST',
            data: cedula ? { c_cedula_buscar: cedula } : {},
            success: function(response) {
                $('#employeeTable').html(response);
            }
        });
    }

    // Cargar tabla inicial
    cargarTablaEmpleados();

    // Filtrar empleados por cédula
    $('#c_cedula_buscar').on('input', function() {
        cargarTablaEmpleados($(this).val());
    });

    // Manejar el botón Cargar
    $('#exampleModal').on('click', '.cargarBtn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        var cedula = $(this).data('id');
        
        
        $.ajax({
            url: '../controlador/controladores_empleados.php',
            type: 'POST',
            data: { 
                obtenerEmpleado: true,
                cedula: cedula 
            },
            success: function(response) {
                try {
                    var empleado = typeof response === 'string' ? JSON.parse(response) : response;
                    
                    if (empleado && empleado.cedula_empleado) {
                        $('input[name="c_cedula"]').val(empleado.cedula_empleado);
                        $('input[name="c_nombres"]').val(empleado.nombre);
                        $('input[name="c_apellidos"]').val(empleado.apellido);
                        $('input[name="c_direccion"]').val(empleado.direccion);
                        
                        $('#c_rol').val(empleado.id_rol);
                        $('#c_departamento').val(empleado.id_depa);
                        $('#c_turno').val(empleado.id_horario);
                        
                        $('#exampleModal').modal('hide');
                        
                        // Restaurar el required después de llenar los campos
                        setTimeout(function() {
                            $('form input[data-required], form select[data-required]').prop('required', true);
                        }, 500);
                    }
                } catch (e) {
                    console.error('Error al procesar la respuesta:', e);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición:', error);
            }
        });
    });
});