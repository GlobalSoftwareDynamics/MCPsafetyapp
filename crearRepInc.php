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
        <link href="css/navbar-tabs.css">
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    </head>

    <body>
    <header>
        <?php
        include_once('navbarmainAdmin.php');
        ?>
    </header>
    <?php
    if(isset($_POST['escalar'])){
        $result=mysqli_query($link,"UPDATE Ocurrencias SET idClase = '8' WHERE idOcurrencias = '{$_POST['idOCUR']}'");
        $result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE idOcurrencias ='{$_POST['idOCUR']}'");
        while ($fila=mysqli_fetch_array($result)){
            if($fila['idClase']==="8"){
                $msg = "Estimado,\nSe ha registrado la siguiente Ocurrencia como INCIDENTE:\n".$fila['descripcion']."\nPor favor sirvase ingresar a Safe@Work para revisarlo.\nGracias.";
                $msg = wordwrap($msg,70);
                $headers = "From: notificaciones@gsdynamics.com";
                $result2=mysqli_query($link,"SELECT * FROM Colaboradores WHERE idTipoUsuario ='1' AND idPuesto ='1'");
                while ($fila2=mysqli_fetch_array($result2)){
                    $email=$fila2['email'];
                }
                mail("$email","Ocurrencia Reportada como Incidente: ".$_POST['idOCUR'].".",$msg,$headers);
            }
        }
    }
    if (isset($_POST['cambclase'])){
        $result=mysqli_query($link,"UPDATE Ocurrencias SET idClase = '6' WHERE idOcurrencias = '{$_POST['idOCUR']}'");
    }
    if (isset($_POST['descartar'])){
        $result=mysqli_query($link,"SELECT * FROM AIOCUR WHERE idOcurrencias= '".$_POST['idOCUR']."'");
        while ($fila=mysqli_fetch_array($result)){
            $idAI=$fila['idAccionesInmediatas'];
            $borar=mysqli_query($link,"DELETE FROM AIOCUR WHERE idOcurrencias= '".$_POST['idOCUR']."' AND idAccionesInmediatas='".$idAI."'");
            $borar=mysqli_query($link,"DELETE FROM AccionesInmediatas WHERE idAccionesInmediatas= '".$idAI."'");
        }
        $result=mysqli_query($link,"SELECT * FROM MEOCUR WHERE idOcurrencias= '".$_POST['idOCUR']."'");
        while ($fila=mysqli_fetch_array($result)){
            $idME=$fila['idMejoras'];
            $borar=mysqli_query($link,"DELETE FROM MEOCUR WHERE idOcurrencias= '".$_POST['idOCUR']."' AND idMejoras='".$idME."'");
            $borar=mysqli_query($link,"DELETE FROM MejorasSeguridad WHERE idMejoras= '".$idME."'");
        }
        $result1=mysqli_query($link,"SELECT * FROM ACOCUR WHERE idOcurrencias ='".$_POST['idOCUR']."'");
        while ($fila1=mysqli_fetch_array($result1)){
            $idAC=$fila1['idAccionesCorrectivas'];
            $borar=mysqli_query($link,"DELETE FROM ACOCUR WHERE idOcurrencias= '".$_POST['idOCUR']."' AND idAccionesCorrectivas='".$idAC."'");
            $borar=mysqli_query($link,"DELETE FROM AccionesCorrectivas WHERE idAccionesCorrectivas= '".$idAC."'");
        }
        $borrar=mysqli_query($link,"DELETE FROM InvolucradosOCUR WHERE idOcurrencias= '".$_POST['idOCUR']."'");
        $borrar=mysqli_query($link,"DELETE FROM Ocurrencias WHERE idOcurrencias= '".$_POST['idOCUR']."'");
    }
    ?>
    <section class="container">
        <div class="container">
            <h4>Reporte Nuevo no proveniente de Ocurrencia:</h4>
        </div>
        <form method="post" action="regINC_DatosGenerales.php" class="form-horizontal col-md-12 col-xs-12">
            <div class="col-md-6 col-md-offset-3 col-xs-12">
                <input type="submit" value="Crear Reporte" name="crearcero" class="btn btn-success col-md-8 col-md-offset-2 col-xs-12">
            </div>
        </form>
    </section>
    <hr>
    <section class="container">
        <div class="container">
            <h4>Elija la Ocurrencia con la cual desea iniciar un Nuevo Reporte :</h4>
        </div>
        <ul class="nav nav-tabs">
		    <?php
		    $aux=0;
		    $result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE estado ='Pendiente' AND idClase = '8'");
		    while ($fila=mysqli_fetch_array($result)) {
			    if ($aux == 0) {
				    ?>
                    <li class="active"><a data-toggle="tab" href="#<?php echo $fila['idOcurrencias'] ?>"><?php echo $fila['idOcurrencias'] ?></a>
                    </li>
				    <?php
				    $aux++;
			    } else {
				    ?>
                    <li><a data-toggle="tab" href="#<?php echo $fila['idOcurrencias'] ?>"><?php echo $fila['idOcurrencias'] ?></a>
                    </li>
				    <?php
			    }
		    }
		    ?>
        </ul>

        <div class="tab-content">
	        <?php
	        $result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE estado ='Pendiente' AND idClase = '8'");
	        while ($fila=mysqli_fetch_array($result)) {
		        if($aux==1){
			        ?>
                    <div id="<?php echo $fila['Ocurrencias']?>" class="tab-pane fade in active">
                        <form method="post" class="col-xs-12 col-md-6 form-horizontal jumbotron">
                            <div class="form-group col-xs-12 col-md-12">
                                <label for="idac">Código:</label>
                                <input id="idac" class="col-xs-12 form-control col-md-8" name="idOCUR" value="<?php echo $fila['idOcurrencias']?>" readonly>
                            </div>
                            <div class="form-group col-xs-12 col-md-12">
                                <label for="desc">Descripción:</label>
                                <textarea name="descripcion" class="form-control col-xs-12 col-md-12" rows="5" id="desc"><?php echo $fila['descripcion']?></textarea>
                            </div>
                            <div class="form-group col-xs-12 col-md-12">
                                <div class="col-xs-12 col-md-4">
                                    <input type="submit" formaction="regINC_DatosGenerales.php" name="crearInc" value="Crear Reporte" class="btn btn-success col-xs-12 col-md-12">
                                </div>
                                <div class="spacer5"></div>
                                <div class="col-xs-12 col-md-4">
                                    <input type="submit" formaction="crearRepInc.php" name="cambclase" value="Volver AS" class="btn btn-primary col-xs-12 col-md-12">
                                </div>
                                <div class="spacer5"></div>
                                <div class="col-xs-12 col-md-4">
                                    <input type="submit" formaction="crearRepInc.php" name="descartar" value="Descartar" class="btn btn-default col-xs-12 col-md-12">
                                </div>
                            </div>
                        </form>
                    </div>
			        <?php
			        $aux++;
		        }else{
			        ?>
                    <div id="<?php echo $fila['idOcurrencias']?>" class="tab-pane fade">
                        <form method="post" class="col-xs-12 col-md-6 form-horizontal jumbotron">
                            <div class="form-group col-xs-12 col-md-12">
                                <label for="idac">Código:</label>
                                <input id="idac" class="col-xs-12 form-control col-md-8" name="idOCUR" value="<?php echo $fila['idOcurrencias']?>" readonly>
                            </div>
                            <div class="form-group col-xs-12 col-md-12">
                                <label for="desc">Descripción:</label>
                                <textarea name="descripcion" class="form-control col-xs-12 col-md-12" rows="5" id="desc"><?php echo $fila['descripcion']?></textarea>
                            </div>
                            <div class="form-group col-xs-12 col-md-12">
                                <div class="col-xs-12 col-md-4">
                                    <input type="submit" formaction="regINC_DatosGenerales.php" name="crearInc" value="Crear Reporte" class="btn btn-success col-xs-12 col-md-12">
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <input type="submit" formaction="crearRepInc.php" name="cambclase" value="Volver AS" class="btn btn-primary col-xs-12 col-md-12">
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <input type="submit" formaction="crearRepInc.php" name="descartar" value="Descartar" class="btn btn-default col-xs-12 col-md-12">
                                </div>
                            </div>
                        </form>
                    </div>
			        <?php
		        }
	        }
	        ?>
        </div>
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