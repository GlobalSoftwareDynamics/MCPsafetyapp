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

        </script>
    </head>

    <body>
    <header>
        <?php
        include_once('navbarmainAdmin.php');
        ?>
    </header>
    <?php
    if (isset($_POST['agregar'])){
        $agregar="INSERT INTO CausasIncidente(idIncidentes, idCausas, descripcion, tipo) VALUES(
        '{$_POST['idINC']}','{$_POST['causa']}','{$_POST['descripcion']}','{$_POST['tipocausa']}')";
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
            <form method="post" class="form-horizontal jumbotron col-xs-12 col-md-offset-3 col-md-6">
                <div class="col-xs-12">
                    <h4 class="text-left">Causas Encontradas</h4>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12">
                        <label for="cau">Causa:</label>
                    </div>
                    <div class="col-xs-12">
                        <select id="cau" name="causa" class="form-control col-xs-12">
                            <option>Seleccionar</option>
                            <?php
                            $result1=mysqli_query($link,"SELECT * FROM Causas");
                            while ($fila1=mysqli_fetch_array($result1)){
                                echo "
                                    <option value=".$fila1['idCausas'].">".$fila1['descripcion']."</option>                            
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12">
                        <label for="desccau">Descripción Detallada:</label>
                    </div>
                    <div class="col-xs-12">
                        <textarea name="descripcion" class="form-control col-xs-12 col-md-12" rows="3" id="desccau"></textarea>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12">
                        <label for="tip">Tipo de Causa:</label>
                    </div>
                    <div class="col-xs-12">
                        <select id="tip" name="tipocausa" class="form-control col-xs-12">
                            <option>Seleccionar</option>
                            <option value="1">Causa Raíz</option>
                            <option value="2">Causa Contributiva</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group col-xs-12 col-md-12">
                    <input type="hidden" name="idINC" value="<?php echo $_POST['idINC'];?>" readonly>
                    <div class="col-xs-12 col-md-6">
                        <input type="submit" class="btn btn-success col-xs-12 col-md-10 col-md-offset-1" formaction="regINC_Causas.php" name="agregar" value="Agregar">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <input type="submit" class="btn btn-primary col-xs-12 col-md-10 col-md-offset-1" formaction="regINC_FotosInvestigacion.php" name="siguiente" value="Siguiente">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <input type="submit" class="btn btn-default col-xs-12 col-md-10 col-md-offset-1" formaction="verRegINC_Causas.php" name="revisar" value="Revisar Datos">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <input type="submit" class="btn btn-default col-xs-12 col-md-10 col-md-offset-1" formaction="detalleIncidente.php" name="regresar" value="Regresar">
                    </div>
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