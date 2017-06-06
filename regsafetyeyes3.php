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
if (isset($_POST['agregar'])){
    $aux = 0;
    $result = mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE idSafetyEyes='".$_POST['idSE']."'");
    while($fila = mysqli_fetch_array($result)){
        $aux++;
    }
    $aux++;
    $idObs="OBS".$aux.$_POST['idSE'];
    /*echo $idObs;*/
    $agregar="INSERT INTO ObservacionesSE(idObservacionesSE, idSafetyEyes, idCategoria, idClase, idCOPs, descripcion) VALUES
    ('".$idObs."','".$_POST['idSE']."','".$_POST['categoria']."','".$_POST['clase']."','".$_POST['cop']."','".$_POST['descripcion']."'
    )";
    $query=mysqli_query($link,$agregar);
    /*echo $agregar;*/
}
?>
<section class="container">
    <div>
        <form method="post" class="form-horizontal jumbotron col-xs-12 col-sm-6 col-sm-offset-3">
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
                        $result1=mysqli_query($link,"SELECT * FROM Categoria");
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
                        $result1=mysqli_query($link,"SELECT * FROM Clase WHERE categoria='SE'");
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
                <div class="col-xs-12 col-sm-6">
                    <input type="submit" class="btn btn-success col-xs-12 col-sm-10 col-sm-offset-1" formaction="regsafetyeyes3.php" name="agregar" value="Agregar">
                </div>
                <div class="col-xs-12 col-sm-6">
                    <input type="submit" class="btn btn-primary col-xs-12 col-sm-10 col-sm-offset-1" formaction="regsafetyeyes4.php" name="siguiente" value="Siguiente">
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