<!DOCTYPE html>

<html lang="es">
<?php
session_start();
$link = mysqli_connect("gsdynamicscom.ipagemysql.com", "gsdsafeatwork", "6DQ~kTpyHPn+Zs$^", "seapp");
mysqli_query($link,"SET NAMES 'utf8'");
/*if(isset($_SESSION['login'])){*/
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSD Safe@Work</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $(function() {
            $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' }).val()
        });
    </script>
</head>

<body>
<header>
    <?php
    include_once('navbarmainAdmin.php');
    ?>
</header>

<section class="container">
    <div>
        <form action="registrosaccionescorrectivas.php" method="post" class="form-horizontal jumbotron col-sm-6 col-sm-offset-3">
            <?php
            date_default_timezone_set('America/Lima');
            $fecha = date('d/m/Y');
            echo "
                <input type='hidden' name='fecha' value='".$fecha."' readonly>
            ";
            ?>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="idacc" class="col-sm-12">Código Acción Correctiva:</label>
                </div>
                <div class="col-sm-12">
                    <input type="text" class="col-sm-12 form-control" value="<?php echo $_POST['idAC'];?>" id="idacc" name="idAC" readonly>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="datepicker" class="col-sm-12">Fecha de Cumplimiento:</label>
                </div>
                <div class="col-sm-12">
                    <input type="text" class="col-sm-12 form-control" id="datepicker" name="fechaReal">
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="submit" formaction="registrosaccionescorrectivas.php" name="regresar" value="Regresar" class="btn btn-default col-sm-10 col-sm-offset-1">
                </div>
                <div class="col-sm-6">
                    <input type="submit" name="actualizarestado" value="Registrar Cumplimiento" class="btn btn-success col-sm-10 col-sm-offset-1">
                </div>
            </div>
        </form>
    </div>
</section>

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