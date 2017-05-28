<!DOCTYPE html>

<html lang="es">

<?php
/*require('funciones.php');

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
    <nav>
    </nav>
</header>
<?php
if (isset($_POST['siguiente'])){
    $agregar="INSERT INTO safetyeyes(idSafetyEyes, idUbicacion, fecha, anoFiscal, hora, duracion, actividadObservada, nropersobservadas, nropersretroalimentadas, estado) VALUES(
    '".$_POST['idSE']."','".$_POST['ubicacion']."','".$_POST['fecha']."','".$_POST['fy']."','".$_POST['hora']."','0','".$_POST['actividad']."','0','0','Pendiente'
    )";
    /*echo $agregar;*/
    $query=mysqli_query($link,$agregar);
    $lider="INSERT INTO participantesse(dni, idSafetyEyes, idTipoParticipante) VALUES('".$_POST['lider']."','".$_POST['idSE']."','1')";
    $query=mysqli_query($link,$lider);
    /*echo $lider;*/
}
if (isset($_POST['agregar'])){
    $agregar="INSERT INTO participantesse(dni, idSafetyEyes, idTipoParticipante) VALUES('".$_POST['observador']."','".$_POST['idSE']."','2')";
    /*echo $agregar;*/
    $query=mysqli_query($link,$agregar);
}
?>
<section class="container">
    <div>
        <h4>Paso 2: Observadores</h4>
    </div>
    <div>
        <form method="post" class="form-horizontal">
            <div class="form-group">
                <div>
                    <label for="empre">Empresa:</label>
                </div>
                <div>
                    <select id="empre" name="empresa" onchange="gettrabajadores(this.value)">
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
                <div>
                    <label for="trabaja">Personal:</label>
                </div>
                <div>
                    <select id="trabaja" name="observador">
                        <option>Seleccionar</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" name="idSE" value="<?php echo $_POST['idSE'];?>" readonly>
                <input type="submit" formaction="regsafetyeyes2.php"name="agregar" value="Agregar" class="btn btn-success">
                <input type="submit" formaction="regsafetyeyes3.php" name="siguiente" value="Siguiente" class="btn btn-primary">
            </div>
        </form>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<footer class="panel-footer navbar-fixed-bottom">
</footer>
</body>

<?php
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>