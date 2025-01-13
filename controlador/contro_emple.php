<?php
include('../modelo/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener roles
    $query_roles = "SELECT id_rol, nombre_rol FROM rol";
    $result_roles = $conexion->query($query_roles);

    // Obtener departamentos
    $query_deptos = "SELECT id_depa, nombre_depa FROM departamento";
    $result_deptos = $conexion->query($query_deptos);

    // Obtener turnos
    $query_turnos = "SELECT id_horario, tipo_turno FROM horario";
    $result_turnos = $conexion->query($query_turnos);

    $roles = [];
    $departamentos = [];
    $turnos = [];

    if ($result_roles->num_rows > 0) {
        while($row = $result_roles->fetch_assoc()) {
            $roles[] = $row;
        }
    }

    if ($result_deptos->num_rows > 0) {
        while($row = $result_deptos->fetch_assoc()) {
            $departamentos[] = $row;
        }
    }

    if ($result_turnos->num_rows > 0) {
        while($row = $result_turnos->fetch_assoc()) {
            $turnos[] = $row;
        }
    }

    // Respuesta en formato JSON
    echo json_encode([
        'roles' => $roles,
        'departamentos' => $departamentos,
        'turnos' => $turnos
    ]);
}
?>