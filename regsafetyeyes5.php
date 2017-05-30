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
                    $("#prop").html(data);
                }
            });
        }
    </script>

</head>

<body>
<header>
    <?php
    include_once('mainnavbarSupervisor.php');
    ?>
</header>
<?php
if (isset($_POST['agregar'])){
    /*echo $_POST['idMS'];*/
    $result=mysqli_query($link,"SELECT * FROM safetyeyes WHERE idSafetyEyes='".$_POST['idSE']."'");
    while ($fila=mysqli_fetch_array($result)){
        $fecharegistro=$fila['fecha'];
    }
    $agregar="INSERT INTO mejorasseguridad(idMejoras, dni, fecharegistro ,descripcion, fuente, estado) VALUES (
    '".$_POST['idMS']."','".$_POST['proponente']."','".$fecharegistro."','".$_POST['descripcion']."','SE','En Proceso'
    )";
    /*echo $agregar;*/
    $query=mysqli_query($link,$agregar);
    $agregar="INSERT INTO MESE(idSafetyEyes, idMejoras) VALUES (
    '".$_POST['idSE']."','".$_POST['idMS']."'
    )";
    /*echo $agregar;*/
    $query=mysqli_query($link,$agregar);
}
?>
<section class="container">
    <div>
        <h4>Paso 5: Mejoras de Seguridad</h4>
    </div>
    <div>
        <form method="post" class="form-horizontal">
            <?php
            $clase="MS";
            $idMS=idgen($clase);
            echo "<input type='hidden' name='idMS' value='".$idMS."' readonly>";
            ?>
            <div class="form-group">
                <div>
                    <label for="desc">Descripción:</label>
                </div>
                <div>
                    <textarea rows="3" name="descripcion" id="desc"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="emp">Empresa:</label>
                </div>
                <div>
                    <select name="empresa" id="emp" onchange="gettrabajadores(this.value)">
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
                    <label for="prop">Propuesta por:</label>
                </div>
                <div>
                    <select id="prop" name="proponente">
                        <option>Seleccionar</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" name="idSE" value="<?php echo $_POST['idSE'];?>" readonly>
                <input type="submit" formaction="regsafetyeyes5.php"name="agregar" value="Agregar" class="btn btn-success">
                <input type="submit" formaction="regsafetyeyes6.php" name="siguiente" value="Siguiente" class="btn btn-primary">
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