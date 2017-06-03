<!DOCTYPE html>

<html lang="es">

<?php
session_start();
$link = mysqli_connect("gsdynamicscom.ipagemysql.com", "gsdsafeatwork", "6DQ~kTpyHPn+Zs$^", "seapp");
mysqli_query($link,"SET NAMES 'utf8'");
$_SESSION['login'] = $_GET['user'];
if(isset($_SESSION['login'])){
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSD Safe@Work</title>
    <link href="css/bootstrap.css" rel="stylesheet">
</head>

<body>
<header>
    <?php
    include_once('navbarmainSupervisor.php');
    ?>
</header>

<section class="container">
    <div class="col-xs-12">
        <h3 class="text-center">Bienvenido a GSD-Safe@Work Reportes</h3>
    </div>
</section>
<br>
<section class="container">
    <div>
        <form class="form-horizontal jumbotron col-xs-12">
            <div class="form-group">
                <input type="submit" style="font-weight: bold; font-size: 15px" class="btn btn-success col-xs-12" value="Registrar Safety Eyes" formaction="regsafetyeyes1.php?user=<?php echo $_GET['user'];?>">
            </div>
            <div class="form-group">
                <input type="submit" style="font-weight: bold; font-size: 15px" class="btn btn-success col-xs-12" value="Registrar Ocurrencia" formaction="regocurrencia1.php?user=<?php echo $_GET['user'];?>">
            </div>
            <div class="form-group">
                <input type="submit" style="font-weight: bold; font-size: 15px" class="btn btn-success col-xs-12" value="Registrar CAP" formaction="regcap1.php?user=<?php echo $_GET['user'];?>">
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
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>

</html>