<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../modelo/conexion.php';

if (isset($_POST['c_cedula_buscar']) && !empty($_POST['c_cedula_buscar'])) {
    $cedula = $_POST['c_cedula_buscar'];
    $sql = "SELECT e.cedula_empleado as cedula_em, e.nombre as nombre_em, e.apellido as apellido_em, e.direccion as dire_em, r.nombre_rol as nombre_rol, d.nombre_depa as nombre_depa, h.tipo_turno as tipo_turno 
            FROM empleados e 
            INNER JOIN rol r ON e.id_rol = r.id_rol 
            INNER JOIN departamento d ON e.id_depa = d.id_depa 
            INNER JOIN horario h ON d.id_horario = h.id_horario 
            WHERE e.cedula_empleado LIKE '%$cedula%'";
} else {
    $sql = "SELECT e.cedula_empleado as cedula_em, e.nombre as nombre_em, e.apellido as apellido_em, e.direccion as dire_em, r.nombre_rol as nombre_rol, d.nombre_depa as nombre_depa, h.tipo_turno as tipo_turno 
            FROM empleados e 
            INNER JOIN rol r ON e.id_rol = r.id_rol 
            INNER JOIN departamento d ON e.id_depa = d.id_depa 
            INNER JOIN horario h ON d.id_horario = h.id_horario";
}

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="table-responsive" id="employeeTable">
    <table class="table">
    <thead>
    <tr>
    <th>Cédula</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Direccion</th>
    <th>Rol</th>
    <th>Departamento</th>
    <th>Turno</th>
    <th></th>
    </tr>
    </thead>
    <tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
            <td>' . $row["cedula_em"] . '</td>
            <td>' . $row["nombre_em"] . '</td>
            <td>' . $row["apellido_em"] . '</td>
            <td>' . $row["dire_em"] . '</td>
            <td>' . $row["nombre_rol"] . '</td>
            <td>' . $row["nombre_depa"] . '</td>
            <td>' . $row["tipo_turno"] . '</td>
            <td>
                <form method="POST" class="delete-form">
                    <input type="hidden" name="cedula_eliminar" value="' . $row["cedula_em"] . '">
                    <input type="hidden" name="eliminar" value="1">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
            </tr>';
    }
    echo '</tbody>
    </table>
    </div>';
} else {
    echo 'No se encontraron registros.<br>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['eliminar'])) {
        $response = array('status' => 'error');
        if (isset($_POST['cedula_eliminar'])) {
            $cedulaEliminar = $_POST['cedula_eliminar'];
            $deleteSql = "DELETE FROM empleados WHERE cedula_empleado = '$cedulaEliminar'";
            if ($conexion->query($deleteSql) === TRUE) {
                $response['status'] = 'success';
                $response['message'] = 'Registro eliminado correctamente.';
            } else {
                $response['message'] = "Error al eliminar el registro: " . $conexion->error;
            }
        } else {
            $response['message'] = "No se recibió la cédula para eliminar.";
        }
        echo json_encode($response);
        exit;
    }
}

$conexion->close();
?>
