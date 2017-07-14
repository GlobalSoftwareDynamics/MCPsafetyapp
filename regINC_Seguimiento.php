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
        <script>
            function getdescac(val) {
                $.ajax({
                    type: "POST",
                    url: "getAjax.php",
                    data:{'regINC_SeguimientoidAC':val},
                    success: function(data){
                        $("#descripcion").html(data);
                    }
                });
            }
        </script>
    </head>

    <body>
    <header>
        <?php
        include_once('navbarmainAdmin.php');
        ?>
    </header>

    <section>
        <form method="post" action="regOC_ConfirmacionEvidencia.php" enctype='multipart/form-data' class="form-horizontal jumbotron col-xs-12 col-md-6 col-md-offset-3">
            <div class="col-xs-12">
                <h4 class="text-center">Registro de Evidencias de Seguimiento</h4>
            </div>
            <div class="form-group col-xs-12 col-md-12">
                <div class="col-xs-12 col-md-12">
                    <label for="ac">Seleccione Acción Correctiva:</label>
                </div>
                <div class="col-xs-12 col-md-12">
                    <select id="ac" name="idAC" class="form-control col-xs-12 col-md-12" onchange="getdescac(this.value)">
                        <option>Seleccionar</option>
                        <?php
                        $result=mysqli_query($link,"SELECT * FROM ACINC WHERE idIncidentes ='".$_POST['idINC']."'");
                        while ($fila=mysqli_fetch_array($result)){
                            $result1=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE idAccionesCorrectivas = '{$fila['idAccionesCorrectivas']}'");
                            while ($fila1=mysqli_fetch_array($result1)){
                                echo "
                                    <option value='".$fila1['idAccionesCorrectivas']."'>".$fila1['idAccionesCorrectivas']."-".substr($fila1['descripcion'],0,45)."...</option>
                                ";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-xs-12 col-md-12" id="descripcion">

            </div>
            <div class="form-group text-center col-xs-12 col-md-12">
                <label for="fileToUpload">Tomar una fotografia:
                    <input type="file" accept="image/*" capture="capture" id="fileToUpload" name="fileToUpload"></label>
                <input type="hidden" name="idINC" value="<?php echo $_POST['idINC'];?>" readonly>
                <input type="submit" class="btn btn-success col-xs-12 col-md-6 col-md-offset-3" formaction="regINC_ConfirmacionSeguimiento.php" name="submit" value="Subir Fotografía">
                <input type='submit' class='btn btn-primary col-xs-12 col-md-6 col-md-offset-3' formaction='detalleIncidente.php' name='siguienteSeguimiento' value='Siguiente'>
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