<!DOCTYPE html>

<html lang="es">

<?php
/*require('funciones.php');
require('funcionesApp.php');
session_start();
if(isset($_SESSION['login'])){
*/
require('funcionesApp.php');
$link = mysqli_connect("localhost", "root", "", "seapp");

mysqli_query($link,"SET NAMES 'utf8'");

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>             PLACEHOLDER         </title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $(function() {
            $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' }).val()
        });
    </script>
</head>

<body>
<header>
    <?php
    include_once('navbarmainAdmin.php');
    ?>
</header>

<section class="container">
    <div>
        <form action="registrosaccionescorrectivas.php" method="post" class="form-horizontal">
            <?php
            date_default_timezone_set('America/Lima');
            $fecha = date('d/m/Y');
            echo "
                <input type='hidden' name='fecha' value='".$fecha."' readonly>
            ";
            ?>
            <div class="form-group">
                <div>
                    <label for="idacc">Código Acción Correctiva:</label>
                </div>
                <div>
                    <input type="text" value="<?php echo $_POST['idAC'];?>" id="idacc" name="idAC" readonly>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="datepicker">Fecha de Cumplimiento:</label>
                </div>
                <div>
                    <input type="text" id="datepicker" name="fechaReal">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" formaction="registrosaccionescorrectivas.php" name="regresar" value="Regresar" class="btn btn-default">
                <input type="submit" name="actualizarestado" value="Registrar Cumplimiento" class="btn btn-primary">
            </div>
        </form>
    </div>
</section>

<script src="js/bootstrap.min.js"></script>

<footer class="panel-footer navbar-fixed-bottom">
    <div class="container col-sm-6 col-sm-offset-3 text-center">
        <span>© 2017 by Global Software Dynamics.<br>Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
    </div>
</footer>
</body>

<?php
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>