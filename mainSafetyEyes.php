<!DOCTYPE html>

<html lang="es">

<?php
session_start();
$link = mysqli_connect("gsdynamicscom.ipagemysql.com", "gsdsafeatwork", "6DQ~kTpyHPn+Zs$^", "seapp");
mysqli_query($link,"SET NAMES 'utf8'");
$_SESSION['login']=$_GET['user'];
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
    include_once('navbarmainAdmin.php');
    ?>
</header>

<section class="container">
        <form method="post" class="form-horizontal jumbotron col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <h3 class="text-center">Seleccione la opción que desea</h3>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" formaction="registrosSE.php?user=<?php echo $_GET['user'];?>" class="btn btn-success col-sm-10 col-sm-offset-1" value="Listado de Safety Eyes">
            </div>
            <div class="form-group">
                <input type="submit" formaction="aprobarSE.php?user=<?php echo $_GET['user'];?>" class="btn btn-success col-sm-10 col-sm-offset-1" value="Aprobación de Safety Eyes">
            </div>
        </form>
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