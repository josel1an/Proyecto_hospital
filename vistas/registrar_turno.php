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
    <title>Turno</title>
</head>
<body>

<?php
		include('navbar.php');
?>


<div class="content" style="background-color: #ADD8E6;">
    <div class="container mt-0">
        <div class="text-center">
            <h1>Registrar el Turno</h1>
        </div>

        <form method="POST" action="../controlador/controlador_turno.php" onsubmit="return confirmarRegistro()">
            
            <hr>
            <div class="row gx-5">
                <div class="col ml-5">

                    <div class="form-group mr-1 w-50">
                        <label for="codigo_turno">Código de Turno</label>
                        <input type="text" class="form-control" name="c_codigo_turno" maxlength="10" pattern="\w{1,10}" required>
                    </div>

                    <div class="form-group mr-1 w-50">
                        <label for="nombre_turno">Nombre del Turno</label>
                        <input type="text" class="form-control" name="c_nombre_turno" maxlength="35" pattern="[A-Za-z\s]{1,35}" required>
                    </div>

                </div>

                <div class="col">

                    <div class="form-group mr-1 w-50">
                        <label for="hora_entrada">Hora de Entrada</label>
                        <input type="time" class="form-control" name="c_hora_entrada" required>
                    </div>

                    <div class="form-group mr-1 w-50">
                        <label for="hora_salida">Hora de Salida</label>
                        <input type="time" class="form-control" name="c_hora_salida" required>
                    </div>
                    
                </div>

                <div class="col">
                    <div>
                        <img class="img-profile rounded-circle ml-4" src="../img/logo_tiempo.jpg" style="width: 270px; height: 270px">
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">REGISTRAR</button>
                <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">LIMPIAR</button>
            </div>
        </form>
    </div>
</div>


<!-- jQuery and Bootstrap scripts -->
<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/limpiar_guardar.js"></script>

</body>
</html>
