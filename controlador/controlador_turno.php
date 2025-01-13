<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../modelo/conexion.php';

// Si es una petición AJAX para obtener datos de un turno específico
if (isset($_POST['obtenerTurno'])) {
    try {
        $codigo_turno = $_POST['codigo_turno'];
        
        $stmt = $conexion->prepare("SELECT id_horario, tipo_turno, hora_entrada, hora_salida 
                                   FROM horario 
                                   WHERE id_horario = ?");
        
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
        }
        
        $stmt->bind_param("s", $codigo_turno);
        
        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            header('Content-Type: application/json');
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'No se encontró el turno']);
        }
        
        $stmt->close();
        exit;
        
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
}




// Mostrar tabla de turnos con filtro opcional
if (isset($_POST['c_codigo_buscar_turno']) && !empty($_POST['c_codigo_buscar_turno'])) {
    $codigo = $conexion->real_escape_string($_POST['c_codigo_buscar_turno']);
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
            <td><button class="btn btn-primary cargarBtnTurno" data-id="' . htmlspecialchars($row["id_horario"]) . '">Cargar</button></td>
        </tr>';
    }
    echo '</tbody></table></div>';
} else {
    echo '<div class="alert alert-info">No se encontraron registros.</div>';
}

$conexion->close();
?>