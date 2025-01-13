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

<?php include('navbar.php'); ?>

<div class="content" style="background-color: #ADD8E6;">
    <div class="container mt-0">
        <div class="text-center">
            <h1>Registrar el Empleado</h1>
        </div>

        <form method="POST" action="../controlador/controladores_empleados.php">
            <hr>
            <div class="row gx-5">
                <div class="col ml-5">
                    <div class="form-group mr-1 w-50">
                        <label for="Cedula">Cédula</label>
                        <input type="text" class="form-control" name="c_cedula" maxlength="9" pattern="\d{1,9}" required>
                    </div>

                    <div class="form-group mr-1 w-50">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" name="c_nombres" maxlength="35" pattern="[A-Za-z\s]{1,35}" required>
                    </div>

                    <div class="form-group mr-1 w-50">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" name="c_apellidos" maxlength="35" pattern="[A-Za-z\s]{1,35}" required>
                    </div>

                    <div class="form-group mr-1 w-50">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" name="c_direccion" maxlength="55" required>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group mr-1 w-50">
                        <label for="Tipo_empleado">Rol de Empleado</label>
                        <select class="form-select" id="c_rol" name="c_rol" aria-label="Selecciona una opción" required>
                            <option value="" disabled selected>Selecciona</option>
                        </select>
                    </div>

                    <div class="form-group mr-1 w-50">
                        <label for="sele_depa">Departamento</label>
                        <select class="form-select" id="c_departamento" name="c_departamento" aria-label="Selecciona una opción" required>
                            <option value="" disabled selected>Selecciona</option>
                        </select>
                    </div>

                    <div class="form-group mr-1 w-50">
                        <label for="sele_depa">Turno</label>
                        <select class="form-select" id="c_turno" name="c_turno" aria-label="Selecciona una opción" required>
                            <option value="" disabled selected>Selecciona</option>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div>
                        <img class="img-profile rounded-circle ml-4" src="../img/agg_emple.png" style="width: 270px; height: 270px">
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
<script src= "../js/funciones_cargar_select.js"></script>

</body>
</html>