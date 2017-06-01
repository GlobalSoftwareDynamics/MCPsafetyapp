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
<?php
if(isset($_POST['finalizar'])){
    $actualziar="UPDATE safetyeyes SET nropersobservadas = '".$_POST['persobs']."' WHERE idSafetyEyes = '".$_POST['idSE']."'";
    $query=mysqli_query($link,$actualziar);
    $actualziar="UPDATE safetyeyes SET nropersretroalimentadas = '".$_POST['persretroalimentadas']."' WHERE idSafetyEyes = '".$_POST['idSE']."'";
    $query=mysqli_query($link,$actualziar);
    $actualziar="UPDATE safetyeyes SET duracion = '".$_POST['duracion']."' WHERE idSafetyEyes = '".$_POST['idSE']."'";
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
    <form action="mainSupervisor.php" class="form-horizontal jumbotron col-xs-12">
        <div class="form-group">
            <input class="btn btn-success col-xs-12" type="submit" value="Regresar al Men&uacute;">
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
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>