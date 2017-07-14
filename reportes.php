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
if ($_POST['tiporeporte']==="SE"&&$_POST['enfoque']==="rmens"){
    include_once ('reportemensualgeneralSE.php');
}
if ($_POST['tiporeporte']==="SE"&&$_POST['enfoque']==="ran"){
    include_once('reporteanualgeneralSE.php');
}
if ($_POST['tiporeporte']==="SE"&&$_POST['enfoque']==="ranplant"){
    include_once ('reporteanualxplantaSE.php');
}
if ($_POST['tiporeporte']==="SE"&&$_POST['enfoque']==="rendpersmen"){
    include_once('reportepersonalmensualSE.php');
}
if ($_POST['tiporeporte']==="SE"&&$_POST['enfoque']==="rendpersan"){
    include_once('reportepersonalanualSE.php');
}
if ($_POST['tiporeporte']==="OC"&&$_POST['enfoque']==="rmensplant"){
    include_once ('reportemensualxplantaOC.php');
}
if ($_POST['tiporeporte']==="OC"&&$_POST['enfoque']==="rmens"){
    include_once ('reportemensualgeneralOC.php');
}
if ($_POST['tiporeporte']==="OC"&&$_POST['enfoque']==="ran"){
    include_once ('reporteanualgeneralOC.php');
}
if ($_POST['tiporeporte']==="OC"&&$_POST['enfoque']==="ranplant"){
    include_once ('reporteanualxplantaOC.php');
}
if ($_POST['tiporeporte']==="OC"&&$_POST['enfoque']==="rendpersmen"){
    include_once('reportepersonalmensualOC.php');
}
if ($_POST['tiporeporte']==="OC"&&$_POST['enfoque']==="rendpersan"){
    include_once('reportepersonalanualOC.php');
}
if ($_POST['tiporeporte']==="CAP"&&$_POST['enfoque']==="rmens"){
    include_once ('reportemensualgeneralCAP.php');
}
if ($_POST['tiporeporte']==="CAP"&&$_POST['enfoque']==="ran"){
    include_once('reporteanualgeneralCAP.php');
}
if ($_POST['tiporeporte']==="CAP"&&$_POST['enfoque']==="rendpersmen"){
    include_once('reportepersonalmensualCAP.php');
}
if ($_POST['tiporeporte']==="CAP"&&$_POST['enfoque']==="rendpersan"){
    include_once('reportepersonalanualCAP.php');
}
if ($_POST['tiporeporte']==="INC"&&$_POST['enfoque']==="rmensplant"){
    include_once ('reportemensualxplantaINC.php');
}
if ($_POST['tiporeporte']==="INC"&&$_POST['enfoque']==="rmens"){
    include_once ('reportemensualgeneralINC.php');
}
if ($_POST['tiporeporte']==="INC"&&$_POST['enfoque']==="ran"){
    include_once ('reporteanualgeneralINC.php');
}
if ($_POST['tiporeporte']==="INC"&&$_POST['enfoque']==="ranplant"){
    include_once ('reporteanualxplantaINC.php');
}
?>

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