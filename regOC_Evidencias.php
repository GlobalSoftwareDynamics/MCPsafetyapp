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
    <div class="container-fluid">
        <label>Código: <?php echo $_POST['idOCUR']?></label>
    </div>
    <section>
        <form method="post" action="regOC_ConfirmacionEvidencia.php" enctype='multipart/form-data' class="form-horizontal jumbotron col-xs-12 col-md-6 col-md-offset-3">
            <div class="col-xs-12">
                <h4 class="text-center">Registro de Evidencias Fotográficas</h4>
            </div>
            <div class="form-group text-center col-xs-12 col-md-12">
                <label for="fileToUpload">Tomar una fotografia:
                    <input type="file" accept="image/*" capture="capture" id="fileToUpload" name="fileToUpload"></label>
                <input type="hidden" name="idOCUR" value="<?php echo $_POST['idOCUR'];?>" readonly>
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                    <input type="submit" class="btn btn-success col-xs-12 col-md-12" formaction="regOC_ConfirmacionEvidencia.php" name="submit" value="Subir Fotografía">
                </div>
                <?php
                if(isset($_POST['modificarEvidencias'])){
                    echo "
                            <input type='hidden' value='{$_POST['modificarEvidencias']}' name='modificarEvidencias' readonly>
                        ";
                    echo "
                            <div class='col-xs-12 col-md-6 col-md-offset-3'>
                                <input type='submit' class='btn btn-primary col-xs-12 col-md-12' formaction='regOC_RevisionFinal.php' name='siguiente' value='Guardar Cambios'>
                            </div>
                        ";
                }else{
                    echo "
                            <div class='col-xs-12 col-md-6 col-md-offset-3'>
                                <input type='submit' class='btn btn-primary col-xs-12 col-md-12' formaction='regOC_DecisionAI.php' name='finalizar' value='Siguiente'>
                            </div>
                        ";
                }
                ?>
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