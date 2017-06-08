<!DOCTYPE html>

<html lang="es">

<?php
$link = mysqli_connect("localhost", "root", "", "seapp");
require('funcionesApp.php');
/*session_start();
if(isset($_SESSION['login'])){*/
mysqli_query($link,"SET NAMES 'utf8'");

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSD Safe@Work</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
<header id="navmainadmin">
    <?php
    include_once('navbarmainAdmin.php');
    ?>
</header>

<?php
if ($_POST['tiporeporte']==="SE"&&$_POST['enfoque']==="rmensplant"){
    include_once ('reportemensualxplantaSE.php');
}
?>

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
    echo "Usted no está autorizado para ingresar a esta sección, por favor vuelva a la página de incio e intente de nuevo.";
}*/
?>
</html>