<!DOCTYPE html>

<html lang="es">

<?php
/*require('funciones.php');
require('funcionesApp.php');
session_start();
if(isset($_SESSION['login'])){
*/
require('funcionesApp.php');
$link = mysqli_connect("localhost", "root", "", "seapp");

mysqli_query($link,"SET NAMES 'utf8'");

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>             PLACEHOLDER         </title>
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
    <div>
        <h4>Paso 1: Datos Generales</h4>
    </div>
    <div>
        <form action="regsafetyeyes2.php" method="post" class="form-horizontal">
            <?php
            $persona="46815198";
            /*$nombre =$_SESSION['nombre'];
            $result=mysqli_query($link,"SELECT * FROM colaboradores WHERE nombre ='".$nombre."'");
            while ($fila=mysqli_fetch_array($result)){
                $persona=$fila['dni'];
                echo "
                    <input type='text' name='lider' value='".$persona."' readonly>
                ";
            }*/
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
                <div>
                    <label for="plant">Planta:</label>
                </div>
                <div>
                    <select id="plant" name="planta" onchange="getubicaciones(this.value)">
                        <option>Seleccionar</option>
                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM planta WHERE estado='1'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <option value=".$fila1['idPlanta'].">".$fila1['descripcion']."</option>                            ";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="ubica">Ubicación:</label>
                </div>
                <div>
                    <select id="ubica" name="ubicacion">
                        <option>Seleccionar</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="activ">Actividad:</label>
                </div>
                <div>
                    <textarea name="actividad" rows="3" id="activ"></textarea>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" name="siguiente" value="Siguiente" class="btn btn-primary">
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
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>