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
if (isset($_POST['agregar'])){
    $aux = 0;
    $result = mysqli_query($link,"SELECT * FROM observacionesse WHERE idSafetyEyes='".$_POST['idSE']."'");
    while($fila = mysqli_fetch_array($result)){
        $aux++;
    }
    $aux++;
    $idObs="OBS".$aux.$_POST['idSE'];
    /*echo $idObs;*/
    $agregar="INSERT INTO observacionesse(idObservacionesSE, idSafetyEyes, idCategoria, idClase, idCOPs, descripcion) VALUES
    ('".$idObs."','".$_POST['idSE']."','".$_POST['categoria']."','".$_POST['clase']."','".$_POST['cop']."','".$_POST['descripcion']."'
    )";
    $query=mysqli_query($link,$agregar);
    /*echo $agregar;*/
}
?>
<section class="container">
    <div>
        <form method="post" class="form-horizontal jumbotron col-xs-12">
            <div class="col-xs-12">
                <h4 class="text-left">Paso 3: Observaciones</h4>
            </div>
            <br>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="desc" class="col-xs-12">Descripción:</label>
                </div>
                <div class="col-xs-12">
                    <textarea rows="3" class="col-xs-12 form-control" name="descripcion" id="desc"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="categ" class="col-xs-12">Categoría:</label>
                </div>
                <div class="col-xs-12">
                    <select id="categ" class="col-xs-12 form-control" name="categoria">
                        <option>Seleccionar</option>
                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM categoria");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <option value=".$fila1['idCategoria'].">".$fila1['siglas']."-".$fila1['descripcion']."</option>                            ";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="class" class="col-xs-12">Clase:</label>
                </div>
                <div class="col-xs-12">
                    <select id="class" class="col-xs-12 form-control" name="clase">
                        <option>Seleccionar</option>
                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM clase WHERE categoria='SE'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <option value=".$fila1['idClase'].">".$fila1['siglas']."-".$fila1['descripcion']."</option>                            ";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="cop" class="col-xs-12">COP:</label>
                </div>
                <div class="col-xs-12">
                    <select id="cop" class="form-control col-xs-12" name="cop">
                        <option>Seleccionar</option>
                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM COPs");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <option value=".$fila1['idCOPs'].">".$fila1['siglas']."</option>                            ";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <input type="hidden" name="idSE" value="<?php echo $_POST['idSE'];?>" readonly>
                <div class="col-xs-12">
                    <input type="submit" class="btn btn-success col-xs-12" formaction="regsafetyeyes3.php"name="agregar" value="Agregar">
                </div>
                <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary col-xs-12" formaction="regsafetyeyes4.php" name="siguiente" value="Siguiente">
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