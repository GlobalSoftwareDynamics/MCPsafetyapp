<!DOCTYPE html>

<html lang="es">

<?php
/*require('funciones.php');
require('funcionesApp.php');
session_start();
if(isset($_SESSION['login'])){
*/
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
    <nav>
    </nav>
</header>

<section class="container">
    <div>
        <h3>Seleccione la opción que desea</h3>
    </div>
    <div class="container">
        <form method="post" class="form-horizontal">
            <div class="form-group">
                <input type="submit" formaction="registrosSE.php" class="btn btn-success" value="Listado de Safety Eyes">
            </div>
            <div class="form-group">
                <input type="submit" formaction="aprobarSE.php" class="btn btn-success" value="Aprobación de Safety Eyes">
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