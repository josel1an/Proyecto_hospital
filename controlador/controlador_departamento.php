<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../modelo/conexion.php';

// Obtener datos de un turno específico
if (isset($_POST['obtenerDepartamento']) && isset($_POST['codigo_Depa'])) {
    $codigo_Depa = $conexion->real_escape_string($_POST['codigo_Depa']);
    $sql = "SELECT id_depa, nombre_depa FROM departamento WHERE id_depa = '$codigo_Depa'";
    
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
if (isset($_POST['c_codigo_buscar_departamento']) && !empty($_POST['c_codigo_buscar_departamento'])) {
    $codigo = $conexion->real_escape_string($_POST['c_codigo_buscar_departamento']);
    $sql = "SELECT id_depa, nombre_depa FROM departamento WHERE id_depa LIKE '%$codigo%'";
} else {
    $sql = "SELECT id_depa, nombre_depa FROM departamento";
}

$result = $conexion->query($sql);
if ($result && $result->num_rows > 0) {
    echo '<div class="table-responsive">
    <table class="table">
    <thead>
    <tr>
        <th>Código del Departamento</th>
        <th>Nombre del Departamento</th>
        <th>Acción</th>
    </tr>
    </thead>
    <tbody>';
    
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
            <td>' . htmlspecialchars($row["id_depa"]) . '</td>
            <td>' . htmlspecialchars($row["nombre_depa"]) . '</td>
            <td><button class="btn btn-primary cargarBtnDepartamento" data-id="' . htmlspecialchars($row["id_depa"]) . '">Cargar</button></td>
        </tr>';
    }
    echo '</tbody></table></div>';
} else {
    echo '<div class="alert alert-info">No se encontraron registros.</div>';
}

$conexion->close();
?>