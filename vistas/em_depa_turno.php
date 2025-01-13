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

<?php
include('navbar.php');
?>

<div class="content">
            <div class="container mt-0">
                <div class="text-center">
                    <h1>Reporte de Empleado por Departamento en un Turno</h1>
                    <hr>
                </div>
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <form id="reporteForm">
                                <div class="input-group input-group-sm mb-3" style="display: flex; flex-wrap: nowrap;">
                                    <div style="flex: 1; margin-right: 5px;"> 
                <span class="input-group-text" id="inputGroup-sizing-sm">Nombre del Departamento</span>
                <select class="form-control" name="c_departamento" id="c_departamento" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                <option value="" disabled selected>Selecciona</option>
                </select>
            

                                    </div>
                                    <div style="flex: 1;">
                                    
                <span class="input-group-text" id="inputGroup-sizing-sm">Nombre del Turno</span>
                <select class="form-control" name="c_turno" id="c_turno" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                <option value="" disabled selected>Selecciona</option>
                </select>
            
                                    </div>
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
<script src="../js/funciones_cargar_select.js"></script>
<script>
$(document).ready(function(){
    $('#consultarBtn').click(function(e) {
        e.preventDefault(); // Prevenir comportamiento por defecto
        
        var departamento = $('#c_departamento').val();
        var turno = $('#c_turno').val();
        
        console.log('Departamento:', departamento); // Depuración
        console.log('Turno:', turno); // Depuración
        
        if (!departamento || !turno) {
            alert('Por favor, seleccione tanto el departamento como el turno');
            return;
        }

        $.ajax({
            url: '../controlador/reporte4.php',
            type: 'POST',
            dataType: 'html',
            data: { 
                c_departamento: departamento,
                c_turno: turno
            },
            success: function(response) {
                console.log('Respuesta recibida:', response); // Depuración
                $('#employeeTable').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Error Ajax:', error);
                console.log('Estado:', status);
                console.log('Respuesta:', xhr.responseText);
            }
        });
    });
});
</script>

</body>
</html>
