<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
if(isset($_SESSION['login'])){
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
<?php
if(isset($_POST['finalizar'])){
    $actualziar="UPDATE SafetyEyes SET nropersobservadas = '".$_POST['persobs']."' WHERE idSafetyEyes = '".$_POST['idSE']."'";
    $query=mysqli_query($link,$actualziar);
    $actualziar="UPDATE SafetyEyes SET nropersretroalimentadas = '".$_POST['persretroalimentadas']."' WHERE idSafetyEyes = '".$_POST['idSE']."'";
    $query=mysqli_query($link,$actualziar);
    $actualziar="UPDATE SafetyEyes SET duracion = '".$_POST['duracion']."' WHERE idSafetyEyes = '".$_POST['idSE']."'";
    $query=mysqli_query($link,$actualziar);
    if ( !empty( $error = mysql_error() ) ) {
        echo "
        <section class='container'>
            <h4 class='text-center'>¡Error al Registrar los Datos!</h4>
        </section>
        ";
    }else{
        echo "
        <section class='container'>
            <h4 class='text-center'>¡Felicitaciones ha registrado el Safety Eyes con éxito!</h4>
        </section>
        ";
    }
}
?>

<br>
<section class="container">
    <form method="post" action="mainSupervisor.php" class="form-horizontal jumbotron col-xs-12 col-sm-6 col-sm-offset-3">
        <div class="form-group">
            <input class="btn btn-success col-xs-12 col-sm-12" type="submit" value="Regresar al Men&uacute;">
        </div>
    </form>
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