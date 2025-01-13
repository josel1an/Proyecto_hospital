<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../modelo/conexion.php'); // Asegúrate de que conet.php contiene la conexión a la base de datos

// Capturar el valor de c_codigo_departamento desde la solicitud AJAX
$depa = isset($_POST['c_codigo_departamento']) ? (int)$_POST['c_codigo_departamento'] : 0;

if ($depa) {
    $sql = "SELECT e.cedula_empleado as ce, e.nombre as ne, e.apellido as ae, d.id_depa as id, d.nombre_depa as nd
            FROM empleados e
            JOIN departamento d ON e.id_depa = d.id_depa 
            WHERE d.id_depa = ?";

    // Preparar la declaración
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die('Error preparando la declaración: ' . htmlspecialchars($conexion->error));
    }

    // Enlazar los parámetros
    $bind = $stmt->bind_param('i', $depa);
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
            <th>Codig del Departamento</th>
            <th>Nombre del Departamento</th>
        </tr>
        </thead>
        <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                <td>' . htmlspecialchars($row["ce"]) . '</td>
                <td>' . htmlspecialchars($row["ne"]) . '</td>
                <td>' . htmlspecialchars($row["ae"]) . '</td>
                <td>' . htmlspecialchars($row["id"]) . '</td>
                <td>' . htmlspecialchars($row["nd"]) . '</td>
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
    echo 'Por favor, ingrese el código del departamento.';
}
?>
