<?php

session_start();

if(!empty($_POST['btningresar'])){
    
    if(!empty($_POST['usuario']) and !empty($_POST['clave'])){
    
    
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    
    
    
    $sql = $conexion->query("SELECT * FROM `usuarios` WHERE nombre_usuario = '$usuario' and clave = '$clave' ");
    
    if($row=$sql->fetch_object()){
        
    
    $_SESSION['id_usuario']=$row->id_usuario;
    $_SESSION['nombre_usuario']=$row->nombre_usuario;
    $_SESSION['nombre']=$row->nombre;
    $_SESSION['apellido']=$row->apellido;
    $_SESSION['cargo']=$row->cargo;
    
        header("Location: ./vistas/inicio.php");
    }else{
        echo "<div class='alert alert-danger'>Acesso Denegado</div>";
    }
}else{
    echo 'Campos vacios';
}
}

?>