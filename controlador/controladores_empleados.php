<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../modelo/conexion.php';

// Si es una petición AJAX para obtener datos de un empleado específico
if (isset($_POST['obtenerEmpleado'])) {
    $cedula = $_POST['cedula'];
    $sql = "SELECT e.*, r.id_rol, d.id_depa, h.id_horario 
            FROM empleados e 
            INNER JOIN rol r ON e.id_rol = r.id_rol 
            INNER JOIN departamento d ON e.id_depa = d.id_depa 
            INNER JOIN horario h ON d.id_horario = h.id_horario 
            WHERE e.cedula_empleado = '$cedula'";
    
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
        exit;
    }
}

// Código existente para mostrar la tabla
if (isset($_POST['c_cedula_buscar']) && !empty($_POST['c_cedula_buscar'])) {
    $cedula = $_POST['c_cedula_buscar'];
    $sql = "SELECT e.cedula_empleado as cedula_em, e.nombre as nombre_em, e.apellido as apellido_em, e.direccion as dire_em, r.nombre_rol as nombre_rol, d.nombre_depa as nombre_depa 
            FROM empleados e 
            INNER JOIN rol r ON e.id_rol = r.id_rol 
            INNER JOIN departamento d ON e.id_depa = d.id_depa 
            INNER JOIN horario h ON d.id_horario = h.id_horario 
            WHERE e.cedula_empleado LIKE '%$cedula%'";
} else {
    $sql = "SELECT e.cedula_empleado as cedula_em, e.nombre as nombre_em, e.apellido as apellido_em, e.direccion as dire_em, r.nombre_rol as nombre_rol, d.nombre_depa as nombre_depa 
            FROM empleados e 
            INNER JOIN rol r ON e.id_rol = r.id_rol 
            INNER JOIN departamento d ON e.id_depa = d.id_depa 
            INNER JOIN horario h ON d.id_horario = h.id_horario";
}

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    echo '<div class="table-responsive">
    <table class="table">
    <thead>
    <tr>
    <th>Cédula</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Direccion</th>
    <th>Rol</th>
    <th>Departamento</th>
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
            <td><button class="btn btn-primary cargarBtn" data-id="' . $row["cedula_em"] . '">Cargar</button></td>
            </tr>';
    }
    echo '</tbody>
    </table>
    </div>';
} else {
    echo 'No se encontraron registros.';
}

$conexion->close();
?>