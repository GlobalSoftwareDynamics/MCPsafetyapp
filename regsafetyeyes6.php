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
    include_once('mainnavbarSupervisor.php');
    ?>
</header>
<section class="container">
    <div>
        <h4>Paso 6: Personas y Duración</h4>
    </div>
    <div>
        <form method="post" class="form-horizontal">
            <div class="form-group">
                <div>
                    <label for="observados">Nro. Pers. Observadas:</label>
                </div>
                <div>
                    <input type="text" name="persobs" id="observados">
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="retroalim">Nro. Pers. Retroalimentadas:</label>
                </div>
                <div>
                    <input type="text" id="retroalim" name="persretroalimentadas">
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="dura">Duración:</label>
                </div>
                <div>
                    <input type="text" name="duracion" id="dura">
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" name="idSE" value="<?php echo $_POST['idSE'];?>" readonly>
                <input type="submit" formaction="regsafetyeyes7.php" name="finalizar" value="Siguiente" class="btn btn-primary">
            </div>
        </form>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<footer class="panel-footer navbar-fixed-bottom">
</footer>
</body>

<?php
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>