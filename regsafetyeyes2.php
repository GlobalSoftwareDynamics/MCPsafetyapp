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
    include_once('navbarmainSupervisor.php');
    ?>
</header>
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
    $agregar="INSERT INTO ParticipantesSE(dni, idSafetyEyes, idTipoParticipante) VALUES('".$_POST['observador']."','".$_POST['idSE']."','2')";
    /*echo $agregar;*/
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
        <form method="post" class="form-horizontal jumbotron col-xs-12 col-sm-offset-3 col-sm-6">
            <div class="col-xs-12">
                <h4 class="text-left">Paso 2: Observadores</h4>
            </div>
            <br>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="empre" class="col-xs-12">Empresa:</label>
                </div>
                <div class="col-xs-12">
                    <select id="empre" name="empresa" class="form-control col-xs-12" onchange="gettrabajadores(this.value)">
                        <option>Seleccionar</option>
                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM Empresa WHERE estado='1'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <option value=".$fila1['ruc'].">".$fila1['siglas']."</option>                            ";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="trabaja" class="col-xs-12">Personal:</label>
                </div>
                <div class="col-xs-12">
                    <select id="trabaja" class="col-xs-12 form-control" name="observador">
                        <option>Seleccionar</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <input type="hidden" name="idSE" value="<?php echo $_POST['idSE'];?>" readonly>
                <div class="col-xs-12 col-sm-6">
                    <input type="submit" class="btn btn-success col-xs-12 col-sm-10 col-sm-offset-1" formaction="regsafetyeyes2.php" name="agregar" value="Agregar">
                </div>
                <div class="col-xs-12 col-sm-6">
                    <input type="submit" class="btn btn-primary col-xs-12 col-sm-10 col-sm-offset-1" formaction="regsafetyeyes3.php" name="siguiente" value="Siguiente">
                </div>
                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                    <input type="submit" class="btn btn-default col-xs-12 col-sm-10 col-sm-offset-1" formaction="verregsafetyeyes2.php" name="revisar" value="Revisar Datos Ingresados">
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