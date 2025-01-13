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
        <title>Reporte</title>
    </head>
    <body>
        <?php
            include('navbar.php');
        ?>

        <div class="content">
            <div class="container mt-0">
                <div class="text-center">
                    <h1>Reporte de Horas Trabajadas al Mes de Cada Empleado</h1>
                    <hr>
                </div>
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <form method="POST" action="../controlador/Reporte1.php">
                                <div class="input-group input-group-sm mb-3" style="display: flex; flex-wrap: nowrap;">
                                    <div style="flex: 1; margin-right: 5px;">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Mes</span>
                                        <select class="form-control" name="c_mes" id="c_mes" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                            <option value="">SELECCIONE</option>
                                            <option value="01">Enero</option>
                                            <option value="02">Febrero</option>
                                            <option value="03">Marzo</option>
                                            <option value="04">Abril</option>
                                            <option value="05">Mayo</option>
                                            <option value="06">Junio</option>
                                            <option value="07">Julio</option>
                                            <option value="08">Agosto</option>
                                            <option value="09">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                    </div>
                                    <div style="flex: 1;">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Año</span>
                                        <select class="form-control" name="c_ano" id="c_ano" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                            <option value="">SELECCIONE</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-warning">Generar Reporte</button><br><br>
                            <button type="button" class="btn btn-primary" id="consultarBtn">Consultar</button>
                        </div>
                            </form>
                    </div>
                </div>
                <div id="employeeTable"></div>
            </div>
        </div>

        <!-- jQuery and Bootstrap scripts -->
        <script src="../js/jquery-3.7.1.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#consultarBtn').click(function() {
                    var mes = $('#c_mes').val();
                    var ano = $('#c_ano').val();

                    $.ajax({
                        url: '../controlador/Reportes1.php',
                        type: 'POST',
                        data: { c_mes: mes, c_ano: ano },
                        success: function(response) {
                            $('#employeeTable').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    </body>
    <footer>
    <?php include 'footer.php'; ?>
    </footer>
</html>