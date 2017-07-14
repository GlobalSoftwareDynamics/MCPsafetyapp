<!DOCTYPE html>

<html lang="es">

<?php
require('funcionesApp.php');
include('session.php');
if(isset($_SESSION['login'])&&($_SESSION['usertype']=='1')){
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSD Safe@Work</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="smartphone-icon-152-185337.png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="smartphone-icon-152-185337.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="smartphone-icon-144-185337.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="smartphone-icon-120-185337.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="smartphone-icon-114-185337.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="smartphone-icon-72-185337.png">
    <link rel="apple-touch-icon-precomposed" href="smartphone-icon-57-185337.png">
    <link rel="icon" href="smartphone-icon-32-185337.png" sizes="32x32">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script>
        function getreportes(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'generaciondereportesReportes':val},
                success: function(data){
                    $("#enfoquerep").html(data);
                }
            });
        }
        function getcontenido(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'generaciondereportesTipo':val},
                success: function(data){
                    $("#contenido").html(data);
                }
            });
        }
        function getnombrecompleto(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'generaciondereportesNombreCompleto':val},
                success: function(data){
                    $("#selecnombrecomp").html(data);
                }
            });
        }
    </script>
</head>

<body>
<header id="navmainadmin">
    <?php
    include_once('navbarmainAdmin.php');
    ?>
</header>

<section class="container">
    <div class="col-md-6 col-md-offset-3 col-xs-12">
        <h4 class="text-center">Generación de Reportes de Seguridad</h4>
    </div>
</section>

<div class="container">
    <form method="post" action="reportes.php" class="form-horizontal jumbotron col-md-6 col-md-offset-3 col-xs-12">
        <div class="form-group col-xs-12 col-md-12">
            <div class="col-md-12">
                <label for="tiporep">Seleccione Tipo de Reporte:</label>
            </div>
            <div class="col-md-12">
                <select id="tiporep" name="tiporeporte" class="form-control col-md-12" onchange="getreportes(this.value)">
                    <option>Seleccionar</option>
                    <option value="SE">Observaciones Safety Eyes</option>
                    <option value="OC">Reportes de Ocurrencias</option>
                    <option value="INC">Reportes de Incidentes</option>
                    <option value="CAP">Reportes CAP</option>
                </select>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-12">
            <div class="col-md-12">
                <label for="enfoquerep">Seleccione Alcance del Reporte:</label>
            </div>
            <div class="col-md-12">
                <select name="enfoque" id="enfoquerep" class="form-control col-md-12" onchange="getcontenido(this.value)">
                    <option>Seleccionar</option>
                </select>
            </div>
        </div>
        <div id="contenido">

        </div>
        <div class="form-group col-xs-12 col-md-12">
            <div class="col-md-8 col-md-offset-2 col-xs-12">
                <input type="submit" name="generar" value="Generar" class="btn btn-success col-md-12 col-xs-12">
            </div>
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<footer class="panel-footer navbar-fixed-bottom hidden-xs">
    <?php
    include_once('footer.php');
    ?>
</footer>
</body>

<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>
</html>