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
    include_once('navbarmainSupervisor.php');
    ?>
</header>
<?php
if (isset($_POST['agregar'])){
    /*echo $_POST['idMS'];*/
    $result=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idSafetyEyes='".$_POST['idSE']."'");
    while ($fila=mysqli_fetch_array($result)){
        $fecharegistro=$fila['fecha'];
    }
    $agregar="INSERT INTO MejorasSeguridad(idMejoras, dni, fecharegistro ,descripcion, fuente, estado) VALUES (
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
        <form method="post" class="form-horizontal jumbotron col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="col-xs-12">
                <h4 class="text-left">Paso 5: Mejoras de Seguridad</h4>
            </div>
            <br>
            <?php
            $clase="MS";
            $idMS=idgen($clase);
            echo "<input type='hidden' name='idMS' value='".$idMS."' readonly>";
            ?>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="desc" class="col-xs-12">Descripción:</label>
                </div>
                <div class="col-xs-12">
                    <textarea rows="3" class="form-control col-xs-12" name="descripcion" id="desc"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="emp" class="col-xs-12">Empresa:</label>
                </div>
                <div class="col-xs-12">
                    <select name="empresa" class="form-control col-xs-12" id="emp" onchange="gettrabajadores(this.value)">
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
                    <label for="prop" class="col-xs-12">Propuesta por:</label>
                </div>
                <div class="col-xs-12">
                    <select id="prop" class="col-xs-12 form-control" name="proponente">
                        <option>Seleccionar</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <input type="hidden" name="idSE" value="<?php echo $_POST['idSE'];?>" readonly>
                <div class="col-xs-12 col-sm-6">
                    <input type="submit" class="btn btn-success col-xs-12 col-sm-10 col-sm-offset-1" formaction="regsafetyeyes5.php?user=<?php echo $_GET['user'];?>"name="agregar" value="Agregar">
                </div>
                <div class="col-xs-12 col-sm-6">
                    <input type="submit" class="btn btn-primary col-xs-12 col-sm-10 col-sm-offset-1" formaction="regsafetyeyes6.php?user=<?php echo $_GET['user'];?>" name="siguiente" value="Siguiente">
                </div>
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