<!DOCTYPE html>

<html lang="es">

<?php
session_start();
$link = mysqli_connect("gsdynamicscom.ipagemysql.com", "gsdsafeatwork", "6DQ~kTpyHPn+Zs$^", "seapp");
mysqli_query($link,"SET NAMES 'utf8'");
require ('funcionesApp.php');
$_SESSION['login']=$_GET['user'];
if(isset($_SESSION['login'])){
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSD Safe@Work</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script>
        function getubicaciones(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'regsafetyeyes1planta':val},
                success: function(data){
                    $("#ubica").html(data);
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

<section class="container">

</section>

<section class="container">
    <div>
        <form action="regsafetyeyes2.php?user=<? echo $_GET['user'];?>" method="post" class="form-horizontal jumbotron col-xs-12">
            <div class="col-xs-12">
                <h4 class="text-left">Paso 1: Datos Generales</h4>
            </div>
            <br>
            <?php
            $nombre =$_SESSION['login'];
            $result=mysqli_query($link,"SELECT * FROM Colaboradores WHERE usuario ='".$nombre."'");
            while ($fila=mysqli_fetch_array($result)){
                $persona=$fila['dni'];
            }
            date_default_timezone_set('America/Lima');
            $hora = date('H:i:s');
            $fecha = date('d/m/Y');
            $fy=fiscalyear();
            $clase="SE";
            $idSE=idgen($clase);
            echo "
                <input type='hidden' name='idSE' value='".$idSE."' readonly>
                <input type='hidden' name='fecha' value='".$fecha."' readonly>
                <input type='hidden' name='hora' value='".$hora."' readonly>
                <input type='hidden' name='lider' value='".$persona."' readonly>
                <input type='hidden' name='fy' value='".$fy."' readonly>
            ";
            ?>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="plant" class="col-xs-12">Planta:</label>
                </div>
                <div class="col-xs-12">
                    <select id="plant" name="planta" class="form-control col-xs-12" onchange="getubicaciones(this.value)">
                        <option>Seleccionar</option>
                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM Planta WHERE estado='1'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <option value=".$fila1['idPlanta'].">".$fila1['descripcion']."</option>
                            ";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="ubica" class="col-xs-12">Ubicación:</label>
                </div>
                <div class="col-xs-12">
                    <select id="ubica" class="form-control col-xs-12" name="ubicacion">
                        <option>Seleccionar</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="activ" class="col-xs-12">Actividad:</label>
                </div>
                <div class="col-xs-12">
                    <textarea name="actividad" class="form-control col-xs-12" rows="3" id="activ"></textarea>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <input type="submit" name="siguiente" value="Siguiente" class="btn btn-primary col-xs-12" style="font-weight: bold; font-size: 15px">
            </div>
        </form>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<footer class="panel-footer navbar-fixed-bottom">
    <?php
    include_once('footercio.php');
    ?>
</footer>
</body>

    <?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>

</html>