<!DOCTYPE html>

<html lang="es">

<?php
session_start();
$link = mysqli_connect("gsdynamicscom.ipagemysql.com", "gsdsafeatwork", "6DQ~kTpyHPn+Zs$^", "seapp");
mysqli_query($link,"SET NAMES 'utf8'");
require ('funcionesApp.php');
/*if(isset($_SESSION['login'])){*/
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
<?php
if (isset($_POST['agregar'])){
    /*echo $_POST['idAI'];*/
    $result=mysqli_query($link,"SELECT * FROM safetyeyes WHERE idSafetyEyes='".$_POST['idSE']."'");
    while ($fila=mysqli_fetch_array($result)){
        $fecharegistro=$fila['fecha'];
    }
    $agregar="INSERT INTO accionesinmediatas(idAccionesInmediatas, dni, fecharegistro, descripcion, fuente) VALUES (
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
?>
<section class="container">

<div>
    <form method="post" class="form-horizontal jumbotron col-xs-12">
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
                    $result1=mysqli_query($link,"SELECT * FROM colaboradores WHERE ruc='20100192064'");
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
            <div class="col-xs-12">
                <input type="submit" class="btn btn-success col-xs-12" formaction="regsafetyeyes4.php"name="agregar" value="Agregar">
            </div>
            <div class="col-xs-12">
                <input type="submit" class="btn btn-primary col-xs-12" formaction="regsafetyeyes5.php" name="siguiente" value="Siguiente">
            </div>
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
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>