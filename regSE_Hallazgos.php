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
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
<header>
    <?php
    include_once('navbarmainSupervisor.php');
    ?>
</header>

<div class="container-fluid">
    <label>Código: <?php echo $_POST['idSE']?></label>
</div>
<?php
if (isset($_POST['siguiente'])){
	$agregar="INSERT INTO SafetyEyes(idSafetyEyes, idUbicacion, fecha, anoFiscal, hora, duracion, actividadObservada, nropersobservadas, nropersretroalimentadas, estado) VALUES(
    '".$_POST['idSE']."','".$_POST['ubicacion']."','".$_POST['fecha']."','".$_POST['fy']."','".$_POST['hora']."','0','".$_POST['actividad']."','0','0','Pendiente'
    )";
	/*echo $agregar;*/
	$query=mysqli_query($link,$agregar);
	$lider="INSERT INTO ParticipantesSE(dni, idSafetyEyes, idTipoParticipante) VALUES('".$_POST['lider']."','".$_POST['idSE']."','1')";
	$query=mysqli_query($link,$lider);
	/*echo $lider;*/
}
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
	echo "
    <section class='container'>
    <div class=\"alert alert-success\">
      <strong>Información ingresada exitosamente</strong>
    </div>
    </section>
    ";
}
?>
<section class="container">
    <div>
        <form method="post" class="form-horizontal jumbotron col-xs-12 col-md-6 col-md-offset-3">
            <div class="col-xs-12">
                <h4 class="text-left">Registro de Hallazgos</h4>
            </div>
            <br>
            <div class="form-group col-xs-12 col-md-12">
                <div class="col-xs-12">
                    <label for="desc">Descripción:</label>
                </div>
                <div class="col-xs-12">
                    <textarea rows="3" class="col-xs-12 form-control" name="descripcion" id="desc"></textarea>
                </div>
            </div>
            <div class="form-group col-xs-12 col-md-12">
                <div class="col-xs-12">
                    <label for="categ">Categoría:</label>
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
            <div class="form-group col-xs-12 col-md-12">
                <div class="col-xs-12">
                    <label for="class">Clase:</label>
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
            <div class="form-group col-xs-12 col-md-12">
                <div class="col-xs-12">
                    <label for="cop">COP:</label>
                </div>
                <div class="col-xs-12">
                    <select id="cop" class="form-control col-xs-12" name="cop">
                        <option>Seleccionar</option>
                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM COPs");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <option value=".$fila1['idCOPs'].">".$fila1['siglas']."-".$fila1['descripcion']."</option>                            ";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <hr>
            <?php
            if(isset($_POST['addFinal'])){
	            echo "<div class='form-group col-xs-12 col-md-12'>
                <input type='hidden' name='idSE' value='{$_POST['idSE']}' readonly>
                <input type='hidden' name='addFinal' value='{$_POST['addFinal']}' readonly>
                <div class='col-xs-12 col-md-6'>
                    <input type='submit' class='btn btn-success col-xs-12 col-md-10 col-md-offset-1' formaction='#' name='agregar' value='Guardar'>
                </div>
                <div class='col-xs-12 col-md-6'>
                    <input type='submit' class='btn btn-primary col-xs-12 col-md-10 col-md-offset-1' formaction='regSE_RevisionFinal.php' name='siguiente' value='Siguiente'>
                </div>
                <div class='col-xs-12 col-md-6 col-md-offset-3'>
                    <input type='submit' class='btn btn-default col-xs-12 col-md-10 col-md-offset-1' formaction='verRegSE_Hallazgos.php' name='revisar' value='Revisar Datos Ingresados'>
                </div>
            </div>";
            }else{
                echo "<div class='form-group col-xs-12 col-md-12'>
                <input type='hidden' name='idSE' value='{$_POST['idSE']}' readonly>
                <div class='col-xs-12 col-md-6'>
                    <input type='submit' class='btn btn-success col-xs-12 col-md-10 col-md-offset-1' formaction='#' name='agregar' value='Guardar'>
                </div>
                <div class='col-xs-12 col-md-6'>
                    <input type='submit' class='btn btn-primary col-xs-12 col-md-10 col-md-offset-1' formaction='regSE_Evidencias.php' name='siguiente' value='Siguiente'>
                </div>
                <div class='col-xs-12 col-md-6 col-md-offset-3'>
                    <input type='submit' class='btn btn-default col-xs-12 col-md-10 col-md-offset-1' formaction='verRegSE_Hallazgos.php' name='revisar' value='Revisar Datos Ingresados'>
                </div>
            </div>";
            }
            ?>

        </form>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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