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
    <title>Departamento</title>
</head>
<body>

<?php
        include('navbar.php');
?>

<div class="content" style="background-color: #ADD8E6;">
    <div class="container mt-0">
        <div class="text-center">
            <h1>Registrar el Departamento</h1>
        </div>

        <form method="POST" action="../controlador/controladores_empleados.php" onsubmit="return confirmarRegistro()">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalturno">
                Tabla de Turno
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalturno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                            <div class="input-group input-group-sm mb-3 w-50">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Codigo del Turno</span>
                                <input type="text" class="form-control" id="c_codigo_buscar_turno" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="INGRESAR CODIGO DEL TURNO">
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="tabla_turno"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="row gx-5">
                <div class="col ml-2">

                    <div class="form-group mr-1 w-75">
                        <label for="codigo_depa">Código</label>
                        <input type="text" class="form-control" name="c_codigo_depa" maxlength="10" pattern="\w{1,10}" required>
                    </div>

                    <div class="form-group mr-1 w-75">
                        <label for="nombre_depa">Nombre del Departamento</label>
                        <input type="text" class="form-control" name="c_nombre_depa" maxlength="35" pattern="[A-Za-z\s]{1,35}" required>
                    </div>

                </div>

                <div class="col ml-2">

                    <div class="form-group w-75">
                        <label for="codigo_turno">Código de Turno</label>
                        <input type="text" class="form-control input-readonly" name="c_codigo_turno" maxlength="10" pattern="\w{1,10}" readonly required>
                    </div>

                    <div class="form-group w-75">
                        <label for="nombre_turno">Nombre del Turno</label>
                        <input type="text" class="form-control input-readonly" name="c_nombre_turno" maxlength="35" pattern="[A-Za-z\s]{1,35}" readonly required>
                    </div>

                    <div class="form-group w-75">
                        <label for="hora_entrada">Hora de Entrada</label>
                        <input type="time" class="form-control input-readonly" name="c_hora_entrada" readonly required>
                    </div>

                    <div class="form-group w-75">
                        <label for="hora_salida">Hora de Salida</label>
                        <input type="time" class="form-control input-readonly" name="c_hora_salida" readonly required>
                    </div>

                </div>

                <div class="col">
                    <div>
                        <img class="img-profile rounded-circle ml-4" src="../img/regi_depa.jpg" style="width: 270px; height: 270px">
                    </div>
                </div>
            </div>

            <hr>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">Limpiar</button>
            </div>
        </form>
    </div>
</div>




<!-- jQuery and Bootstrap scripts -->
<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/limpiar_guardar.js"></script>
<script src="../js/funciones_turnos.js"></script>


</body>
</html>
