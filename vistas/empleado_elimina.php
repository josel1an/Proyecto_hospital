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
    <title>Empleado</title>
</head>
<body>

<?php
        include('navbar.php');
?>




<div class="content">
    <div class="container mt-0">
        <div class="text-center">
            <h1>Eliminar el Empleado</h1>
        </div>

        <form method="POST" action="../controlador/controladores_empleados_eliminar.php">
            <div class="input-group input-group-sm mb-3 w-50">
    <span class="input-group-text" id="inputGroup-sizing-sm">Cédula</span>
    <input type="text" class="form-control" name="c_cedula_buscar" id="c_cedula_buscar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="INGRESAR CEDULA DEL EMPLEADO">
</div>

            <div id="employeeTable"></div>
        </form>
    </div>
</div>




<!-- jQuery and Bootstrap scripts -->
<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>

<script src="../js/funciones_empleados_eliminar.js"></script>

</body>
</html>
