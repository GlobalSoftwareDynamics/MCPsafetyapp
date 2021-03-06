<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
include('funcionesApp.php');
if(isset($_SESSION['login'])&&(($_SESSION['usertype']=='1'))||($_SESSION['usertype']=='2')){
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

</head>

<body>
<header>
    <?php
    include_once('navbarmainSupervisor.php');
    ?>
</header>
<section class="container">
    <div>
        <form method="post" class="form-horizontal jumbotron col-xs-12 col-sm-6 col-sm-offset-3">
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
                    <label for="dura" class="col-xs-12">Duración (En minutos):</label>
                </div>
                <div class="col-xs-12">
                    <input type="text" class="form-control col-xs-12" name="duracion" id="dura">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <input type="hidden" name="idSE" value="<?php echo $_POST['idSE'];?>" readonly>
                <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary col-xs-12 col-sm-6 col-sm-offset-3" formaction="regsafetyeyes7.php" name="finalizar" value="Siguiente">
                </div>
            </div>
        </form>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<footer class="panel-footer navbar-fixed-bottom">
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