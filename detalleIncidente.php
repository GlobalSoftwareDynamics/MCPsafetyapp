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
    <link href="css/Formatos.css" rel="stylesheet">
</head>

<body>
<header>
    <?php
    include_once('navbarmainAdmin.php');
    ?>
</header>

<?php
if(isset($_POST['siguienteRepPre'])){
    $result=mysqli_query($link,"SELECT * FROM Incidentes WHERE idIncidentes = '{$_POST['idINC']}'");
    while ($fila=mysqli_fetch_array($result)){
        if($fila['fuente']!=="NA"){
            $update=mysqli_query($link,"UPDATE Ocurrencias SET estado = 'Aprobado' WHERE idOcurrencias = '{$fila['fuente']}'");
        }else{

        }
    }
}
if(isset($_POST['siguienteLesion'])){
    $update=mysqli_query($link,"UPDATE Incidentes SET estado = 'Lesiones' WHERE idIncidentes = '{$_POST['idINC']}'");
}
if(isset($_POST['siguienteInvestigacion'])){
    $update=mysqli_query($link,"UPDATE Incidentes SET estado = 'Investigación' WHERE idIncidentes = '{$_POST['idINC']}'");
}
if(isset($_POST['siguienteAC'])){
    $update=mysqli_query($link,"UPDATE Incidentes SET estado = 'Acciones Correctivas' WHERE idIncidentes = '{$_POST['idINC']}'");
}
if(isset($_POST['siguienteSeguimiento'])){
    $update=mysqli_query($link,"UPDATE Incidentes SET estado = 'Seguimiento' WHERE idIncidentes = '{$_POST['idINC']}'");
}
if(isset($_POST['siguienteCierre'])){
    $agregar="INSERT INTO InvolucradosIncidente(dni, idIncidentes, idTipoParticipante, descripcionLesion, diasPerdidos) VALUES (
    '{$_POST['respcierre']}','{$_POST['idINC']}','10','NULL','NULL'
    )";
    $query=mysqli_query($link,$agregar);
    $update=mysqli_query($link,"UPDATE Incidentes SET estado = 'Cerrado' WHERE idIncidentes = '{$_POST['idINC']}'");
}

$result=mysqli_query($link,"SELECT * FROM Incidentes WHERE idIncidentes = '{$_POST['idINC']}'");
while ($fila=mysqli_fetch_array($result)){
    if($fila['estado']==="Reporte Preliminar"){
        include_once ("detalleIncidenteRepPreliminar.php");
    }
    if($fila['estado']==="Lesiones"){
        include_once ("detalleIncidenteRepLesiones.php");
    }
    if($fila['estado']==="Investigación"){
        include_once ("detalleIncidenteRepInvestigacion.php");
    }
    if($fila['estado']==="Acciones Correctivas"){
        include_once ("detalleIncidenteRepAcciones.php");
    }
    if($fila['estado']==="Seguimiento"){
        include_once ("detalleIncidenteRepSeguimiento.php");
    }
    if($fila['estado']==="Cerrado"){
        include_once ("detalleIncidenteRepFinal.php");
    }
}
?>
<section class="container">
    <form method="post" class="form-horizontal col-xs-12 col-md-12">
        <?php
        $result=mysqli_query($link,"SELECT * FROM Incidentes WHERE idIncidentes = '{$_POST['idINC']}'");
        while ($fila=mysqli_fetch_array($result)){
            echo "
                <input type='hidden' name='idINC' value='".$_POST['idINC']."' readonly>
            ";
            if($fila['estado']==="Reporte Preliminar"){
                echo "
                    <div class='form-group col-xs-12 col-md-12'>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='regINC_Lesiones.php' value='Continuar Reporte' class='btn btn-success col-md-8 col-md-offset-2 col-xs-12' name='continuarlesiones'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='detalleincidenteRepPreliminarPDF.php' value='Generar PDF' class='btn btn-primary col-md-8 col-md-offset-2 col-xs-12' name='PDF'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='registrosINC.php' value='Registro de Incidentes' class='btn btn-default col-md-8 col-md-offset-2 col-xs-12' name='regresar'>
                        </div>
                    </div>
                ";
            }
            if($fila['estado']==="Lesiones"){
                echo "
                    <div class='form-group col-xs-12 col-md-12'>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='regINC_EquipoInvestigacion.php' value='Continuar Reporte' class='btn btn-success col-md-8 col-md-offset-2 col-xs-12' name='continuarlesiones'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='detalleincidenteRepLesionesPDF.php' value='Generar PDF' class='btn btn-primary col-md-8 col-md-offset-2 col-xs-12' name='PDF'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='registrosINC.php' value='Registro de Incidentes' class='btn btn-default col-md-8 col-md-offset-2 col-xs-12' name='regresar'>
                        </div>
                    </div>
                ";
            }
            if($fila['estado']==="Investigación"){
                echo "
                    <div class='form-group col-xs-12 col-md-12'>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='regINC_AccionesCorrectivas.php' value='Continuar Reporte' class='btn btn-success col-md-8 col-md-offset-2 col-xs-12' name='continuarlesiones'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='detalleincidenteRepInvestigacionPDF.php' value='Generar PDF' class='btn btn-primary col-md-8 col-md-offset-2 col-xs-12' name='PDF'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='registrosINC.php' value='Registro de Incidentes' class='btn btn-default col-md-8 col-md-offset-2 col-xs-12' name='regresar'>
                        </div>
                    </div>
                ";
            }
            if($fila['estado']==="Acciones Correctivas"){
                echo "
                    <div class='form-group col-xs-12 col-md-12'>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='regINC_Seguimiento.php' value='Continuar Reporte' class='btn btn-success col-md-8 col-md-offset-2 col-xs-12' name='continuarlesiones'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='detalleincidenteRepAccionesPDF.php' value='Generar PDF' class='btn btn-primary col-md-8 col-md-offset-2 col-xs-12' name='PDF'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='registrosINC.php' value='Registro de Incidentes' class='btn btn-default col-md-8 col-md-offset-2 col-xs-12' name='regresar'>
                        </div>
                    </div>
                ";
            }
            if($fila['estado']==="Seguimiento"){
                echo "
                    <div class='form-group col-xs-12 col-md-12'>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='regINC_Cierre.php' value='Cerrar Reporte' class='btn btn-success col-md-8 col-md-offset-2 col-xs-12' name='continuarlesiones'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='detalleincidenteRepSeguimientoPDF.php' value='Generar PDF' class='btn btn-primary col-md-8 col-md-offset-2 col-xs-12' name='PDF'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-4 col-xs-12'>
                             <input type='submit' formaction='registrosINC.php' value='Registro de Incidentes' class='btn btn-default col-md-8 col-md-offset-2 col-xs-12' name='regresar'>
                        </div>
                    </div>
                ";
            }
            if($fila['estado']==="Cerrado"){
                echo "
                    <div class='form-group col-xs-12 col-md-12'>
                        <div class='col-md-6 col-xs-12'>
                             <input type='submit' formaction='detalleincidenteRepFinalPDF.php' value='Generar PDF' class='btn btn-primary col-md-8 col-md-offset-2 col-xs-12' name='PDF'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-6 col-xs-12'>
                             <input type='submit' formaction='registrosINC.php' value='Registro de Incidentes' class='btn btn-default col-md-8 col-md-offset-2 col-xs-12' name='regresar'>
                        </div>
                    </div>
                ";
            }
        }
        ?>
    </form>
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
