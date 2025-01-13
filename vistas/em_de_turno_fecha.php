<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (empty($_SESSION['id_usuario'])) {
    header('Location: ./index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Reporte</title>
</head>
<body>

<?php include('navbar.php'); ?>



<div class="content">
            <div class="container mt-0">
                <div class="text-center">
                    <h1>Reporte de Empleados por Departamento en Rango de Fecha</h1>
                    <hr>
                </div>
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <form method="POST" action="../controlador/reporte5.php">
                            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nombre del Departamento</span>
                <select class="form-control" name="c_nombre_departamento" id="c_nombre_departamento" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    <option value="">SELECCIONE</option>
                    
                    
                </select>
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nombre del Turno</span>
                <select class="form-control" name="c_nombre_turno" id="c_nombre_turno" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    <option value="">SELECCIONE</option>
                    
                    
                </select>
            </div>
                        </div>

                        <div class="col">
                        <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Fecha Inicio</span>
                <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Fecha Final</span>
                <input type="date" class="form-control" name="fecha_final" id="fecha_final" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
                        
                        </div>


                        <div class="col">
                            <button type="submit" class="btn btn-warning">Generar Reporte</button><br><br>
                            <button type="button" class="btn btn-primary" id="consultarBtn">Consultar</button>
                        </div>
                            </form>
                    </div>
                </div>
                <div id="employeeTable"></div>
            </div>
        </div>




<!-- jQuery and Bootstrap scripts -->
<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>

<!-- Antes de cerrar el body, después de los otros scripts -->
<script>
$(document).ready(function(){
    // Cargar datos de los selects
    $.ajax({
        url: '../controlador/contro_emple.php',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            // Cargar departamentos
            const selectDepartamento = $('#c_nombre_departamento');
            selectDepartamento.empty();
            selectDepartamento.append('<option value="">SELECCIONE</option>');
            response.departamentos.forEach(function(depto) {
                selectDepartamento.append(
                    $('<option></option>')
                        .val(depto.nombre_depa)
                        .text(depto.nombre_depa)
                );
            });

            // Cargar turnos
            const selectTurno = $('#c_nombre_turno');
            selectTurno.empty();
            selectTurno.append('<option value="">SELECCIONE</option>');
            response.turnos.forEach(function(turno) {
                selectTurno.append(
                    $('<option></option>')
                        .val(turno.tipo_turno)
                        .text(turno.tipo_turno)
                );
            });
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar los datos:', error);
        }
    });


$(document).ready(function(){
    // Mantener el código de carga de selects existente...

    $('#consultarBtn').click(function() {
        var departamento = $('#c_nombre_departamento').val();
        var turno = $('#c_nombre_turno').val();
        var fechaInicio = $('#fecha_inicio').val();
        var fechaFinal = $('#fecha_final').val();

        $.ajax({
            url: '../controlador/reporte5.php',
            type: 'POST',
            data: {
                c_nombre_departamento: departamento,
                c_nombre_turno: turno,
                fecha_inicio: fechaInicio,
                fecha_final: fechaFinal
            },
            success: function(response) {
                $('#employeeTable').html(response);
                
                // Limpiar los campos después de mostrar los resultados
                $('#c_nombre_departamento').val('');
                $('#c_nombre_turno').val('');
                $('#fecha_inicio').val('');
                $('#fecha_final').val('');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

});
</script>

</body>
</html>
