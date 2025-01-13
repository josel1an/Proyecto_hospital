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
                    <h1>Reporte de Empleado por Departamento</h1>
                    <hr>
                </div>
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <form method="POST" action="../controlador/reporte3.php">
                                <div class="input-group input-group-sm mb-3" style="display: flex; flex-wrap: nowrap;">
                                    <div style="flex: 1; margin-right: 5px;">
                                        
                                        
                                        
                                    </div>
                                    <div style="flex: 1;">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Codigo del Departamento</span>
                                    <input type="text" class="form-control" name="c_codigo_departamento" id="c_codigo_departamento" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="CODIGO DEL DEPARTAMENTO">
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
<script>
$(document).ready(function() {
    $('#consultarBtn').click(function() {
        var codigoDepartamento = $('#c_codigo_departamento').val();

        $.ajax({
            url: '../controlador/reporte3.php',
            type: 'POST',
            data: { c_codigo_departamento: codigoDepartamento },
            success: function(response) {
                $('#employeeTable').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>

</body>
</html>
