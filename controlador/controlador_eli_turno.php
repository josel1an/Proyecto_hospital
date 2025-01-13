<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../modelo/conexion.php';

// Obtener datos de un turno específico
if (isset($_POST['obtenerTurno']) && isset($_POST['codigo_turno'])) {
    $codigo_turno = $conexion->real_escape_string($_POST['codigo_turno']);
    $sql = "SELECT id_horario, tipo_turno, hora_entrada, hora_salida 
            FROM horario 
            WHERE id_horario = '$codigo_turno'";
    
    $result = $conexion->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
        exit;
    }
    echo json_encode(['error' => 'No se encontró el turno']);
    exit;
}

// Mostrar tabla de turnos con filtro opcional
if (isset($_POST['c_codigo_buscar']) && !empty($_POST['c_codigo_buscar'])) {
    $codigo = $conexion->real_escape_string($_POST['c_codigo_buscar']);
    $sql = "SELECT id_horario, tipo_turno, hora_entrada, hora_salida 
            FROM horario 
            WHERE id_horario LIKE '%$codigo%'";
} else {
    $sql = "SELECT id_horario, tipo_turno, hora_entrada, hora_salida 
            FROM horario";
}

$result = $conexion->query($sql);
if ($result && $result->num_rows > 0) {
    echo '<div class="table-responsive">
    <table class="table">
    <thead>
    <tr>
        <th>Código Turno</th>
        <th>Nombre del Turno</th>
        <th>Hora de Entrada</th>
        <th>Hora de Salida</th>
        <th>Acción</th>
    </tr>
    </thead>
    <tbody>';
    
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
            <td>' . htmlspecialchars($row["id_horario"]) . '</td>
            <td>' . htmlspecialchars($row["tipo_turno"]) . '</td>
            <td>' . htmlspecialchars($row["hora_entrada"]) . '</td>
            <td>' . htmlspecialchars($row["hora_salida"]) . '</td>
            <td><button class="btn btn-danger cargarBtn" data-id="' . htmlspecialchars($row["id_horario"]) . '">Eliminar</button></td>
        </tr>';
    }
    echo '</tbody></table></div>';
} else {
    echo '<div class="alert alert-info">No se encontraron registros.</div>';
}

$conexion->close();
?>