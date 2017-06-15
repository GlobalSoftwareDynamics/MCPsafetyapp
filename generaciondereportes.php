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
    <script>
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
    <div class="col-sm-6 col-sm-offset-3">
        <h4 class="text-center">Generación de Reportes de Seguridad</h4>
    </div>
</section>

<div class="container">
    <form method="post" action="reportes.php" class="form-horizontal jumbotron col-sm-6 col-sm-offset-3">
        <div class="form-group">
            <div class="col-sm-12">
                <label class="col-sm-12" for="tiporep">Seleccione Tipo de Reporte:</label>
            </div>
            <div class="col-sm-12">
                <select id="tiporep" name="tiporeporte" class="form-control col-sm-12">
                    <option>Seleccionar</option>
                    <option value="SE">Observaciones Safety Eyes</option>
                    <option value="OC">Reportes de Ocurrencias</option>
                    <option value="INC">Reportes de Incidentes</option>
                    <option value="CAP">Reportes CAP</option>
                    <option value="ALL">Reporte General(SE, OC, INC, CAP)</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <label for="enfoquerep" class="col-sm-12">Seleccione Alcance del Reporte:</label>
            </div>
            <div class="col-sm-12">
                <select name="enfoque" id="enfoquerep" class="form-control col-sm-12" onchange="getcontenido(this.value)">
                    <option>Seleccionar</option>
                    <option value="rmensplant">Reporte Mensual por Planta</option>
                    <option value="rmens">Reporte Mensual General (Todas las Plantas)</option>
                    <option value="ranplant">Reporte Anual por Planta</option>
                    <option value="ran">Reporte Anual General (Todas las Plantas)</option>
                    <option value="rendpersmen">Reporte de Rendimiento Personal Mensual</option>
                    <option value="rendpersan">Reporte de Rendimiento Personal Anual</option>
                </select>
            </div>
        </div>
        <div id="contenido">

        </div>
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-2">
                <input type="submit" name="generar" value="Generar" class="btn btn-success col-sm-10 col-sm-offset-1">
            </div>
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<footer class="panel-footer navbar-fixed-bottom">
    <?php
    include_once('footercio.php');
    ?>
</footer>
</body>

<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>
</html>
