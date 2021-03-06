<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
include('funcionesApp.php');
if(isset($_SESSION['login'])&&(($_SESSION['usertype']=='1'))||($_SESSION['usertype']=='2')){
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
if (isset($_POST['agregar'])){
    /*echo $_POST['idAI'];*/
    $result=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idSafetyEyes='".$_POST['idSE']."'");
    while ($fila=mysqli_fetch_array($result)){
        $fecharegistro=$fila['fecha'];
    }
    $agregar="INSERT INTO AccionesInmediatas(idAccionesInmediatas, dni, fecharegistro, descripcion, fuente) VALUES (
    '".$_POST['idAI']."','".$_POST['responsable']."','".$fecharegistro."','".$_POST['descripcion']."','SE'
    )";
    /*echo $agregar;*/
    $query=mysqli_query($link,$agregar);
    $agregar="INSERT INTO AISE(idSafetyEyes, idAccionesInmediatas) VALUES (
    '".$_POST['idSE']."','".$_POST['idAI']."'
    )";
    /*echo $agregar;*/
    $query=mysqli_query($link,$agregar);
    }
echo "
    <section class='container'>
    <div class=\"alert alert-success\">
      <strong>Información ingresada exitosamente</strong>
    </div>
    </section>
    ";
?>
<section class="container">

<div>
    <form method="post" class="form-horizontal jumbotron col-xs-12 col-sm-6 col-sm-offset-3">
        <div class="col-xs-12">
            <h4 class="text-left">Paso 4: Acciones Correctivas Inmediatas</h4>
        </div>
        <br>
        <?php
        $clase="AI";
        $idAI=idgen($clase);
        echo "<input type='hidden' name='idAI' value='".$idAI."' readonly>";
        ?>
        <div class="form-group">
            <div class="col-xs-12">
                <label for="desc" class="col-xs-12">Descripción:</label>
            </div>
            <div class="col-xs-12">
                <textarea rows="3" class="form-control col-xs-12" name="descripcion" id="desc"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label for="resp" class="col-xs-12">Responsable:</label>
            </div>
            <div class="col-xs-12">
                <select id="resp" class="form-control col-xs-12" name="responsable">
                    <option>Seleccionar</option>
                    <?php
                    $result1=mysqli_query($link,"SELECT * FROM Colaboradores WHERE ruc='20100192064'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        echo "
                            <option value=".$fila1['dni'].">".$fila1['nombre']."-".$fila1['apellidos']."</option>                            ";
                    }
                    ?>
                </select>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <input type="hidden" name="idSE" value="<?php echo $_POST['idSE'];?>" readonly>
            <div class="col-xs-12 col-sm-6">
                <input type="submit" class="btn btn-success col-xs-12 col-sm-10 col-sm-offset-1" formaction="regsafetyeyes4.php" name="agregar" value="Agregar">
            </div>
            <div class="col-xs-12 col-sm-6">
                <input type="submit" class="btn btn-primary col-xs-12 col-sm-10 col-sm-offset-1" formaction="regsafetyeyes5.php" name="siguiente" value="Siguiente">
            </div>
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <input type="submit" class="btn btn-default col-xs-12 col-sm-10 col-sm-offset-1" formaction="verregsafetyeyes4.php" name="revisar" value="Revisar Datos Ingresados">
            </div>
        </div>
    </form>
</div>
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