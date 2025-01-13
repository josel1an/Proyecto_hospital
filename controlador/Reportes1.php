<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../modelo/conexion.php'); // Asegúrate de que conet.php contiene la conexión a la base de datos

// Capturar los valores de mes y año desde la solicitud AJAX
$mes = isset($_POST['c_mes']) ? (int)$_POST['c_mes'] : 0;
$ano = isset($_POST['c_ano']) ? (int)$_POST['c_ano'] : 0;

if ($mes && $ano) {
    $sql = "SELECT e.cedula_empleado as ce, e.nombre as ne, e.apellido as ae, SUM(TIMESTAMPDIFF(HOUR, a.hora_ingreso, a.hora_salida)) as horas_trabajadas 
            FROM asistencia a 
            JOIN empleados e ON a.id_cedula_empleado = e.cedula_empleado 
            WHERE MONTH(a.fecha) = ? AND YEAR(a.fecha) = ? 
            GROUP BY e.cedula_empleado";

    // Preparar la declaración
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die('Error preparando la declaración: ' . htmlspecialchars($conexion->error));
    }

    // Enlazar los parámetros
    $bind = $stmt->bind_param('ii', $mes, $ano); // 'ii' indica que ambos parámetros son enteros
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
        <table class="table table-striped">
        <thead>
        <tr>
            <th>Cédula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Horas Trabajadas</th>
        </tr>
        </thead>
        <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                <td>' . htmlspecialchars($row["ce"]) . '</td>
                <td>' . htmlspecialchars($row["ne"]) . '</td>
                <td>' . htmlspecialchars($row["ae"]) . '</td>
                <td>' . htmlspecialchars($row["horas_trabajadas"]) . '</td>
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
    echo 'Por favor, seleccione un mes y un año.';
}
?>
