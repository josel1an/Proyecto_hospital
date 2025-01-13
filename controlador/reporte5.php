<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../modelo/conexion.php'); // Asegúrate de que conexion.php contiene la conexión a la base de datos

// Capturar los valores desde la solicitud AJAX
$nombre_depa = isset($_POST['c_nombre_departamento']) ? $_POST['c_nombre_departamento'] : '';
$nombre_turno = isset($_POST['c_nombre_turno']) ? $_POST['c_nombre_turno'] : '';
$fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : '';
$fecha_final = isset($_POST['fecha_final']) ? $_POST['fecha_final'] : '';

if ($nombre_depa && $nombre_turno && $fecha_inicio && $fecha_final) {
    $sql = "SELECT e.cedula_empleado as ce, e.nombre as ne, e.apellido as ae, d.nombre_depa as nd, t.tipo_turno as nt, a.fecha as ft 
            FROM asistencia a 
            JOIN empleados e ON a.id_cedula_empleado = e.cedula_empleado 
            JOIN departamento d ON a.id_departamento = d.id_depa 
            JOIN horario t ON a.id_horario = t.id_horario 
            WHERE d.nombre_depa = ? AND t.tipo_turno = ? AND a.fecha BETWEEN ? AND ?";

    // Preparar la declaración
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die('Error preparando la declaración: ' . htmlspecialchars($conexion->error));
    }

    // Enlazar los parámetros
    $bind = $stmt->bind_param('ssss', $nombre_depa, $nombre_turno, $fecha_inicio, $fecha_final);
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
        echo '<div class="table-responsive">
        <table class="table">
        <thead>
        <tr>
            <th>Cédula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Nombre Departamento</th>
            <th>Nombre Turno</th>
            <th>Fecha</th>
        </tr>
        </thead>
        <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                <td>' . htmlspecialchars($row["ce"]) . '</td>
                <td>' . htmlspecialchars($row["ne"]) . '</td>
                <td>' . htmlspecialchars($row["ae"]) . '</td>
                <td>' . htmlspecialchars($row["nd"]) . '</td>
                <td>' . htmlspecialchars($row["nt"]) . '</td>
                <td>' . htmlspecialchars($row["ft"]) . '</td>
                </tr>';
        }
        echo '</tbody>
        </table>
        </div>';
    } else {
        echo 'No se encontraron registros.';
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo 'Por favor, seleccione un departamento, un turno y un rango de fechas.';
}
?>
