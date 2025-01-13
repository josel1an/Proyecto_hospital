<?php 


	include '../modelo/conexion.php';

$query = 'SELECT `nombre`, `apellido`, `nombre_usuario`, `cargo` FROM `usuarios`';
$result = $conexion->query($query);

if ($result) {
    while ($row = $result->fetch_array()) {
        // Aquí puedes acceder a los datos de cada fila
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $nombre_usuario = $row['nombre_usuario'];
        $cargo = $row['cargo'];
        
    }
} else {
    echo "Error al ejecutar la consulta: " . $conexion->error;
}

 ?>