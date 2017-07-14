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
            function gettrabajadores(val) {
                $.ajax({
                    type: "POST",
                    url: "getAjax.php",
                    data:{'regsafetyeyes2empresa':val},
                    success: function(data){
                        $("#trabaja").html(data);
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
    <?php
    if (isset($_POST['agregar'])){
        $agregar="INSERT INTO InvolucradosIncidente(dni, idIncidentes, idTipoParticipante, descripcionLesion, diasPerdidos) VALUES(
        '{$_POST['involucrado']}','{$_POST['idINC']}','10','NULL','NULL')";
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
                    <h4 class="text-left">Cierre del Incidente</h4>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12">
                        <label for="empre">Empresa:</label>
                    </div>
                    <div class="col-xs-12">
                        <select id="empre" name="empresa" class="form-control col-xs-12" onchange="gettrabajadores(this.value)">
                            <option>Seleccionar</option>
                            <?php
                            $result1=mysqli_query($link,"SELECT * FROM Empresa WHERE estado='1'");
                            while ($fila1=mysqli_fetch_array($result1)){
                                echo "
                                <option value=".$fila1['ruc'].">".$fila1['siglas']."</option>                            
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12">
                        <label for="trabaja">Personal:</label>
                    </div>
                    <div class="col-xs-12">
                        <select id="trabaja" class="col-xs-12 form-control" name="respcierre">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="alert alert-danger">
                        <strong>La persona seleccionada tiene conocimiento de su asignación como responsable del cierre del presente Reporte de Incidente. A partir de este momento la información contenida en el Reporte no será sujeta a cambios ni modificaciones.</strong>
                    </div>
                </div>
                <hr>
                <div class="form-group col-xs-12 col-md-12">
                    <input type="hidden" name="idINC" value="<?php echo $_POST['idINC'];?>" readonly>
                    <div class="col-xs-12 col-md-6">
                        <input type="submit" class="btn btn-success col-xs-12 col-md-10 col-md-offset-1" formaction="detalleIncidente.php" name="siguienteCierre" value="Cerrar Incidente">
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