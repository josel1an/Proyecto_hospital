$(document).ready(function(){
    // Cargar tabla inicial
    cargarTablaTurnos();

    function cargarTablaTurnos(codigo = '') {
        $.ajax({
            url: '../controlador/controlador_turno.php',
            type: 'POST',
            data: codigo ? { c_codigo_buscar_turno: codigo } : {},
            success: function(response) {
                $('#tabla_turno').html(response);
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar tabla:", error);
            }
        });
    }

    // Filtrar turnos
    $('#c_codigo_buscar_turno').on('input', function() {
        cargarTablaTurnos($(this).val());
    });

    // Manejar el botón Cargar - Cambiado a cargarBtnTurno
    $(document).on('click', '.cargarBtnTurno', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        var codigo = $(this).data('id');
        console.log("Código del turno:", codigo); // Para depuración
        
        $.ajax({
            url: '../controlador/controlador_turno.php',
            type: 'POST',
            dataType: 'json',
            data: { 
                obtenerTurno: true,
                codigo_turno: codigo 
            },
            success: function(response) {
                console.log("Respuesta del servidor:", response); // Para depuración
                
                if (response.error) {
                    alert(response.error);
                    return;
                }
                
                // Llenar SOLO los campos relacionados con el turno
                $('input[name="c_codigo_turno"]').val(response.id_horario);
                $('input[name="c_nombre_turno"]').val(response.tipo_turno);
                $('input[name="c_hora_entrada"]').val(response.hora_entrada);
                $('input[name="c_hora_salida"]').val(response.hora_salida);
                
                // Cerrar el modal usando Bootstrap 5
                var myModal = bootstrap.Modal.getInstance(document.getElementById('modalturno'));
                if (myModal) {
                    myModal.hide();
                }
            },
            error: function(xhr, status, error) {
                console.error("Error completo:", {
                    xhr: xhr,
                    status: status,
                    error: error
                });
                alert("Error al cargar los datos del turno. Revisa la consola para más detalles.");
            }
        });
    });
});