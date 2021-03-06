<!DOCTYPE html>

<html lang="es">

<?php
include('funcionesApp.php');
include('session.php');
if(isset($_SESSION['login'])&&(($_SESSION['usertype']=='1'))){
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
        include_once('navbarmainAdmin.php');
        ?>
    </header>
    <?php
    if(isset($_POST['siguiente'])){
        $agregar="INSERT INTO Incidentes(idIncidentes, idTipoLesion, idUbicacion, fuente, titulo, fecha, hora, anoFiscal, descripcion, intercambioenergia, repeticion, estado) VALUES(
    '{$_POST['idINC']}','{$_POST['lesion']}','{$_POST['ubicacion']}','{$_POST['idOCUR']}','{$_POST['titulo']}','{$_POST['fecha']}','{$_POST['hora']}','{$_POST['fy']}',
    '{$_POST['descripcion']}','{$_POST['intercambioenergia']}','{$_POST['repetido']}','Reporte Preliminar'
    )";
        $query=mysqli_query($link,$agregar);
        $agregar="INSERT INTO IncidentesConsecuencia(idIncidentes, idConsecuencia, tipo) VALUES(
    '{$_POST['idINC']}','{$_POST['consecuenciaact']}','Actual'
    )";
        $query=mysqli_query($link,$agregar);
        $agregar="INSERT INTO IncidentesConsecuencia(idIncidentes, idConsecuencia, tipo) VALUES(
    '{$_POST['idINC']}','{$_POST['consecuenciapot']}','Potencial'
    )";
        $query=mysqli_query($link,$agregar);
    }
    if(isset($_POST['siguientesinOC'])){
        $agregar="INSERT INTO Incidentes(idIncidentes, idTipoLesion, idUbicacion, fuente, titulo, fecha, hora, anoFiscal, descripcion, intercambioenergia, repeticion, estado) VALUES(
    '{$_POST['idINC']}','{$_POST['lesion']}','{$_POST['ubicacion']}','NULL','{$_POST['titulo']}','{$_POST['fecha']}','{$_POST['hora']}','{$_POST['fy']}',
    '{$_POST['descripcion']}','{$_POST['intercambioenergia']}','{$_POST['repetido']}','Reporte Preliminar'
    )";
        $query=mysqli_query($link,$agregar);
        $agregar="INSERT INTO IncidentesConsecuencia(idIncidentes, idConsecuencia, tipo) VALUES(
    '{$_POST['idINC']}','{$_POST['consecuenciaact']}','Actual'
    )";
        $query=mysqli_query($link,$agregar);
        $agregar="INSERT INTO IncidentesConsecuencia(idIncidentes, idConsecuencia, tipo) VALUES(
    '{$_POST['idINC']}','{$_POST['consecuenciapot']}','Potencial'
    )";
        $query=mysqli_query($link,$agregar);
        $agregar="INSERT INTO InvolucradosIncidente(dni, idIncidentes, idTipoParticipante, descripcionLesion, diasPerdidos) VALUES (
        '{$_POST['idINC']}','{$_POST['reportante']}','4','NULL','NULL'
        )";
    }
    ?>
    <section>
        <form method="post" action="regOC_ConfirmacionEvidencia.php" enctype='multipart/form-data' class="form-horizontal jumbotron col-xs-12 col-md-6 col-md-offset-3">
            <div class="col-xs-12">
                <h4 class="text-center">Registro de Evidencias Fotográficas</h4>
            </div>
            <div class="form-group text-center col-xs-12 col-md-12">
                <label for="fileToUpload">Tomar una fotografia:
                <input type="file" accept="image/*" capture="capture" id="fileToUpload" name="fileToUpload"></label>
                <input type="hidden" name="idINC" value="<?php echo $_POST['idINC'];?>" readonly>
                <input type="submit" class="btn btn-success col-xs-12 col-md-6 col-md-offset-3" formaction="regINC_ConfirmacionFotos.php" name="submit" value="Subir Fotografía">
                <input type='submit' class='btn btn-primary col-xs-12 col-md-6 col-md-offset-3' formaction='regINC_AccionesInmediatas.php' name='siguiente' value='Siguiente'>
            </div>
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