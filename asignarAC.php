<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
include('funcionesApp.php');
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
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>

<body>
<header>
    <?php
    include_once('navbarmainSupervisor.php');
    ?>
</header>
<?php
if (isset($_POST['actualizarac'])){
    $query = mysqli_query($link, "UPDATE AccionesCorrectivas SET fechaPlan = '{$_POST['fechaplaneada']}', dni = '{$_POST['responsable']}', idEstado = '1', descripcion = '{$_POST['descripcion']}' WHERE idAccionesCorrectivas = '{$_POST['idAC']}'");
}
?>
<div class="container">
    <h4>Listado de Acciones Pendientes</h4>
</div>
<hr>
<section class="container">
<?php
$result=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE idEstado ='5'");
while ($fila=mysqli_fetch_array($result)) {
    ?>
    <form method="post" action="asignarAC_Formulario.php" class="col-xs-12 col-md-6 form-horizontal jumbotron">
        <div class="form-group col-xs-12 col-md-12">
            <label for="idac">Código:</label>
            <input id="idac" class="col-xs-12 form-control col-md-12" name="idAC" value="<?php echo $fila['idAccionesCorrectivas']?>" readonly>
        </div>
        <div class="form-group col-xs-12 col-md-12">
            <label for="desc">Descripción:</label>
            <textarea name="descripcion" class="form-control col-xs-12 col-md-12" rows="5" id="desc"><?php echo $fila['descripcion']?></textarea>
        </div>
        <div class="form-group col-xs-12 col-md-12">
            <input type="submit" name="actualizar" value="Completar Registro" class="btn btn-success col-xs-12 col-md-8 col-md-offset-2">
        </div>
    </form>
<?php
}
?>
</section>

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