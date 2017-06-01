<!DOCTYPE html>

<html lang="es">

<?php
/*require('funciones.php');

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

</head>

<body>
<header>
    <?php
    include_once('navbarmainSupervisor.php');
    ?>
</header>
<section class="container">
    <div>
        <form method="post" class="form-horizontal jumbotron col-xs-12">
            <div class="col-xs-12">
                <h4 class="text-left">Paso 6: Personas y Duración</h4>
            </div>
            <br>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="observados" class="col-xs-12">Nro. Pers. Observadas:</label>
                </div>
                <div class="col-xs-12">
                    <input type="text" class="form-control col-xs-12" name="persobs" id="observados">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="retroalim" class="col-xs-12">Nro. Pers. Retroalimentadas:</label>
                </div>
                <div class="col-xs-12">
                    <input type="text" class="form-control col-xs-12" id="retroalim" name="persretroalimentadas">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="dura" class="col-xs-12">Duración:</label>
                </div>
                <div class="col-xs-12">
                    <input type="text" class="form-control col-xs-12" name="duracion" id="dura">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <input type="hidden" name="idSE" value="<?php echo $_POST['idSE'];?>" readonly>
                <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary col-xs-12" formaction="regsafetyeyes7.php" name="finalizar" value="Siguiente">
                </div>
            </div>
        </form>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<footer class="panel-footer navbar-fixed-bottom">
    <?php
    include_once('footercio.php');
    ?>
</footer>
</body>

<?php
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>