<!DOCTYPE html>

<html lang="es">

<?php
include('funcionesApp.php');
include('session.php');
if(isset($_SESSION['login'])&&(($_SESSION['usertype']=='1')||($_SESSION['usertype']=='2')||($_SESSION['usertype']=='5'))){
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
        if($_SESSION['usertype']=='1'||$_SESSION['usertype']=='2'){
            include_once('navbarmainSupervisor.php');
        }elseif($_SESSION['usertype']=='5'){
            include_once('navbarmainOperario.php');
        }
        ?>
    </header>
    <?php
    $result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE idOcurrencias ='{$_POST['idOCUR']}'");
    while ($fila=mysqli_fetch_array($result)){
        if($fila['idTipoLesion']=='5'){
            $idINC = idgen('INC');;
            $update=mysqli_query($link,"UPDATE Ocurrencias SET estado = 'Aprobado' WHERE idOcurrencias = '{$_POST['idOCUR']}'");
            $agregar="INSERT INTO Incidentes(idIncidentes, idTipoLesion, idUbicacion, fuente, titulo, fecha, hora, anoFiscal, descripcion, intercambioenergia, repeticion, estado) VALUES(
            '{$idINC}','5','{$fila['idUbicacion']}','{$_POST['idOCUR']}','Fatalidad {$_POST['idOCUR']}','{$fila['fecha']}','{$fila['hora']}','{$fila['anoFiscal']}',
            '{$fila['descripcion']}','1','TBD','Reporte Preliminar')";
            $query=mysqli_query($link,$agregar);
            $agregar="INSERT INTO IncidentesConsecuencia(idIncidentes, idConsecuencia, tipo) VALUES('{$idINC}','4','Actual')";
            $query=mysqli_query($link,$agregar);
            $agregar="INSERT INTO IncidentesConsecuencia(idIncidentes, idConsecuencia, tipo) VALUES('{$idINC}','4','Potencial')";
            $query=mysqli_query($link,$agregar);
        }
    }
    ?>
    <section class="container">
        <div>
            <form method="post" class="form-horizontal jumbotron col-xs-12 col-md-6 col-md-offset-3">
                <div class="col-xs-12">
                    <h4 class="text-center">Su reporte ha sido registrado exitosamente</h4>
	                <?php
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
			                echo "<h4 class='text-center'>Se envió un e-mail de notificación a su gerente</h4>";
		                }
	                }
	                ?>
                </div>
                <br>
                <hr>
                <div class="form-group col-xs-12 col-md-12">
                    <input type="hidden" name="idOCUR" value="<?php echo $_POST['idOCUR'];?>" readonly>
                    <?php
                    if($_SESSION['usertype']=='1'||$_SESSION['usertype']=='2'){
                        echo "
                            <div class='col-xs-12'>
                                <input type='submit' class='btn btn-primary col-xs-12 col-md-6 col-md-offset-3' formaction='mainSupervisor.php' name='finalizar' value='Finalizar'>
                            </div>
                        ";
                    }elseif($_SESSION['usertype']=='5'){
                        echo "
                            <div class='col-xs-12'>
                                <input type='submit' class='btn btn-primary col-xs-12 col-md-6 col-md-offset-3' formaction='mainOperario.php' name='finalizar' value='Finalizar'>
                            </div>
                        ";
                    }
                    ?>
                </div>
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