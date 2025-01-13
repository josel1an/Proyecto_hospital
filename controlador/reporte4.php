<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../modelo/conexion.php');


// Capturar los valores desde la solicitud AJAX
$nombre_depa = isset($_POST['c_departamento']) ? $_POST['c_departamento'] : '';
$nombre_turno = isset($_POST['c_turno']) ? $_POST['c_turno'] : '';

if ($nombre_depa && $nombre_turno) {
    $sql = "SELECT e.cedula_empleado as ce, e.nombre as ne, e.apellido as ae, d.nombre_depa as nd, t.tipo_turno as nt 
            FROM asistencia a 
            JOIN empleados e ON a.id_cedula_empleado = e.cedula_empleado 
            JOIN departamento d ON a.id_departamento = d.id_depa 
            JOIN horario t ON a.id_horario = t.id_horario 
            WHERE d.id_depa = ? AND t.id_horario = ?";

    // Preparar la declaración
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die('Error preparando la declaración: ' . htmlspecialchars($conexion->error));
    }

    // Enlazar los parámetros
    $bind = $stmt->bind_param('ii', $nombre_depa, $nombre_turno);
    if ($bind === false) {
        die('Error enlazando los parámetros: ' . htmlspecialchars($stmt->error));
    }

    // Ejecutar la declaración
    $exec = $stmt->execute();
    if ($exec === false) {
        die('Error ejecutando la declaración: ' . htmlspecialchars($stmt->error));
    }

    // Obtener el resultado
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo '<div class="table-responsive"> <table class="table"> <thead> <tr> <th>Cédula</th> <th>Nombre</th> <th>Apellido</th> <th>Nombre Departamento</th> <th>Nombre Turno</th> </tr> </thead> <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr> <td>' . htmlspecialchars($row["ce"]) . '</td> <td>' . htmlspecialchars($row["ne"]) . '</td> <td>' . htmlspecialchars($row["ae"]) . '</td> <td>' . htmlspecialchars($row["nd"]) . '</td> <td>' . htmlspecialchars($row["nt"]) . '</td> </tr>';
        }
        echo '</tbody> </table> </div>';
    } else {
        echo 'No se encontraron registros.';
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo 'Por favor, seleccione un departamento y un turno.';
}
?>
