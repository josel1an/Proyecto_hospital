<?php 
error_reporting(E_ALL); 
ini_set('display_errors', 1);

session_start();
if (empty($_SESSION['id_usuario'])) {
    header('Location: ./index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Inicio</title>
</head>
<body>



<div class="content">
    <!-- Contenido central aquí -->

    <header>
<?php
		include('navbar.php');
?>
</header>

<main>
    <div class="content mb-0 text-center">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="height: 91vh">
                    <img src="../img/IMA1.jpg" class="d-block w-100" alt="ima1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="display-4 mb-4 font-weight-bold text-dark">TRABAJAMOS POR UN FUTURO MEJOR</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>


</div>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/jquery-3.3.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>

</body>

</html>
