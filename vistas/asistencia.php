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
    <title>Asistencia</title>

</head>

<body>

<header>
<?php
        include('navbar.php');
?>
</header>


<main>
<div class="content" style="background-color: #ADD8E6;">
    <div class="container mt-0">
        <div class="text-center">
            <h1>Registrar Asistencia</h1>
        </div>

        <form method="POST" action="../controlador/controladores_empleados.php">
            
            <!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Tabla de Empleados
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="input-group input-group-sm mb-3 w-50">
  <span class="input-group-text" id="inputGroup-sizing-sm">Cédula</span>
  <input type="text" class="form-control" id="c_cedula_buscar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="INGRESAR CEDULA DEL EMPLEADO">
</div>
                        

                
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        
                            
        <div id = "employeeTable"></div>
               


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
                <hr>
                <div class="row gx-5">
                    <div class="col ml-5">
                        

                    <div class="form-group mr-1 w-50">
    <label for="Cedula">Cédula</label>
    <input type="text" class="form-control input-readonly" name="c_cedula" maxlength="9" pattern="\d{1,9}" readonly required>
</div>
                    <div class="form-group mr-1 w-50">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control input-readonly" name="c_nombres" maxlength="35" pattern="[A-Za-z\s]{1,35}" readonly required>
                    </div>

                    <div class="form-group mr-1 w-50">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control input-readonly" name="c_apellidos" maxlength="35" pattern="[A-Za-z\s]{1,35}" readonly required>
                    </div>
                        
                    </div>


                    <div class="col">
                        


                        <div class="form-group mr-1 w-50">
                        <label for="Tipo_empleado">Rol de Empleado</label>
                        <select class="form-select input-readonly" id="c_rol" name="c_rol" aria-label="Selecciona una opción" readonly required>
                            <option value="" disabled selected>Selecciona</option>
                        </select>
                        </div>

                        <div class="form-group mr-1 w-50">
                        <label for="sele_depa">Departamento</label>
                        <select class="form-select input-readonly" id="c_departamento" name="c_departamento" aria-label="Selecciona una opción" readonly required>
                            <option value="" disabled selected>Selecciona</option>
                        </select>
                        </div>

                        <div class="form-group mr-1 w-50">
                        <label for="sele_depa">Turno</label>
                        <select class="form-select input-readonly" id="c_turno" name="c_turno" aria-label="Selecciona una opción" readonly required>
                            <option value="" disabled selected>Selecciona</option>
                        </select>
                        </div>
                        
                    </div>

<div class="col">
                        


                        <div class="form-group mr-1 w-50">
                        
                        <span class="input-group-text" id="inputGroup-sizing-sm">Fecha Inicio</span>
                <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>

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
                            <img class="img-profile rounded-circle ml-4" src="../img/asistencia.png" style="width: 270px; height: 270px">
                        </div>
                    </div>
                </div>
            
            <hr>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">Limpiar</button> </div>
            </div>
        </form>
    </div>
</div>
</main>


<!-- jQuery and Bootstrap scripts -->
<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/limpiar_guardar.js"></script>

<script src="../js/funciones_cargar_select.js"></script>
<script src="../js/funciones_empleados.js"></script>

</body>
</html>
