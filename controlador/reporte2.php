<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../modelo/conexion.php'); // Asegúrate de que conet.php contiene la conexión a la base de datos

// Capturar el valor de c_codigo_turno desde la solicitud AJAX
$turni = isset($_POST['c_codigo_turno']) ? (int)$_POST['c_codigo_turno'] : 0;

if ($turni) {
    $sql = "SELECT e.cedula_empleado as ce, e.nombre as ne, e.apellido as ae, t.id_horario as ih, t.tipo_turno as nt 
            FROM asistencia a 
            JOIN empleados e ON a.id_cedula_empleado = e.cedula_empleado 
            JOIN horario t ON a.id_horario = t.id_horario 
            WHERE t.id_horario = ?";

    // Preparar la declaración
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die('Error preparando la declaración: ' . htmlspecialchars($conexion->error));
    }

    // Enlazar los parámetros
    $bind = $stmt->bind_param('i', $turni);
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
            <th>Codigo del Turno</th>
            <th>Nombre del Turno</th>
        </tr>
        </thead>
        <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                <td>' . htmlspecialchars($row["ce"]) . '</td>
                <td>' . htmlspecialchars($row["ne"]) . '</td>
                <td>' . htmlspecialchars($row["ae"]) . '</td>
                <td>' . htmlspecialchars($row["ih"]) . '</td>
                <td>' . htmlspecialchars($row["nt"]) . '</td>
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
    echo 'Por favor, ingrese el código del turno.';
}
?>
