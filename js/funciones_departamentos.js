$(document).ready(function(){
    console.log("Documento listo"); // Verificar que el script se está cargando

    // Cargar tabla inicial
    cargarTablaDepartamento();

    function cargarTablaDepartamento(codigo = '') {
        console.log("Cargando tabla departamento"); // Verificar llamada a función
        $.ajax({
            url: '../controlador/controlador_departamento.php',
            type: 'POST',
            data: codigo ? { c_codigo_buscar_departamento: codigo } : {},
            success: function(response) {
                console.log("Respuesta tabla:", response); // Ver respuesta del servidor
                $('#tabla_departamento').html(response);
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar tabla:", error);
            }
        });
    }

    // Filtrar departamentos
    $('#c_codigo_buscar_departamento').on('input', function() {
        console.log("Filtrando:", $(this).val()); // Verificar evento de filtrado
        cargarTablaDepartamento($(this).val());
    });

    // Verificar que el evento está siendo registrado
    console.log("Registrando evento click para .cargarBtnDepartamento");

    // Manejar el botón Cargar de departamentos
    $(document).on('click', '.cargarBtnDepartamento', function(e) {
        console.log("Botón departamento clickeado"); // Verificar que el click se detecta
        e.preventDefault();
        e.stopPropagation();
        
        var codigo_depa = $(this).data('id');
        console.log("Código del departamento:", codigo_depa);
        
        // Verificar que el botón tiene el atributo data-id
        console.log("Atributos del botón:", $(this).data());
        
        $.ajax({
            url: '../controlador/controlador_departamento.php',
            type: 'POST',
            dataType: 'json',
            data: { 
                obtenerDepartamento: true,
                codigo_Depa: codigo_depa
            },
            success: function(response) {
                console.log("Respuesta del servidor:", response);
                
                if (response.error) {
                    console.error(response.error);
                    alert('Error al cargar los datos');
                    return;
                }
                
                // Verificar que los campos existen
                console.log("Campo código:", $('input[name="c_codigo_depa"]').length);
                console.log("Campo nombre:", $('input[name="c_nombre_depa"]').length);
                
                // Llenar los campos
                $('input[name="c_codigo_depa"]').val(response.id_depa);
                $('input[name="c_nombre_depa"]').val(response.nombre_depa);
                
                // Verificar valores después de llenar
                console.log("Valores establecidos:", {
                    codigo: $('input[name="c_codigo_depa"]').val(),
                    nombre: $('input[name="c_nombre_depa"]').val()
                });
                
                // Cerrar el modal
                var myModal = bootstrap.Modal.getInstance(document.getElementById('Modal_departamento'));
                if (myModal) {
                    myModal.hide();
                } else {
                    console.log("Modal no encontrado");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error completo:", {
                    xhr: xhr,
                    status: status,
                    error: error,
                    responseText: xhr.responseText
                });
                alert("Error al cargar los datos del departamento. Revisa la consola para más detalles.");
            }
        });
    });
});