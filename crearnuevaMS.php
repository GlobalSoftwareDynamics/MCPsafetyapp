<!DOCTYPE html>

<html lang="es">

<?php
session_start();
$link = mysqli_connect("gsdynamicscom.ipagemysql.com", "gsdsafeatwork", "6DQ~kTpyHPn+Zs$^", "seapp");
mysqli_query($link,"SET NAMES 'utf8'");
require('funcionesApp.php');
/*if(isset($_SESSION['login'])){*/
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSD Safe@Work</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $(function() {
            $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' }).val()
        });
        function gettiporeporte() {
            var crearnuevaMStiporeporte = document.getElementById('tipo').value;
            var crearnuevaMSfechatiporeporte = document.getElementById('datepicker').value;
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'crearnuevaMStiporeporte':crearnuevaMStiporeporte, 'crearnuevaMSfechatiporeporte':crearnuevaMSfechatiporeporte},
                success: function(data){
                    $("#tiporep").html(data);
                }
            });
        }
        function getcolaboradores(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'crearnuevaACcolaboradores':val},
                success: function(data){
                    $("#resp").html(data);
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
if(isset($_POST['provieneSEconidMS'])){
?>
    <section class="container">
        <div>
            <form action="registromejorasseguridad.php" method="post" class="form-horizontal jumbotron col-sm-6 col-sm-offset-3">
                <?php
                $fecha = date('d/m/Y');
                $clase="MS";
                $idMS=idgen($clase);
                echo "
                    <input type='hidden' value='".$fecha."' name='fecharegistro'>
                    <input type='hidden' value='".$idMS."' name='idmejora'>
                ";
                ?>
                <input type="hidden" name="tiporeporte" value="SE" readonly>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="tiporep" class="col-sm-12">Reporte Seleccionado:</label>
                    </div>
                    <div class="col-sm-12">
                        <input type="text" class="col-sm-12 form-control" id="tiporep" name="idreporte" value="<?php echo $_POST['idSE']?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="desc" class="col-sm-12">Descripción:</label>
                    </div>
                    <div class="col-sm-12">
                        <textarea rows="3" class="col-sm-12 form-control" name="descripcionms" id="desc"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="puesto" class="col-sm-12">Puesto del Responsable:</label>
                    </div>
                    <div class="col-sm-12">
                        <select id="puesto" class="col-sm-12 form-control" name="puesto" onchange="getcolaboradores(this.value)">
                            <option>Seleccionar</option>
                            <?php
                            $result=mysqli_query($link,"SELECT * FROM puesto WHERE estado='1'");
                            while ($fila=mysqli_fetch_array($result)){
                                echo "
                                    <option value='".$fila['idPuesto']."'>".$fila['descripcion']."</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="resp" class="col-sm-12">Responsable:</label>
                    </div>
                    <div class="col-sm-12">
                        <select id="resp" class="col-sm-12 form-control" name="responsable">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <input type="hidden" name="idSE" value="<?php echo $_POST['idSE']?>">
                    <div class="col-sm-6">
                        <input type="submit" formaction="detallesafetyeyes.php" class="btn btn-default col-sm-10 col-sm-offset-1" name="regresar" value="Regresar">
                    </div>
                    <div class="col-sm-6">
                        <input type="submit" class="btn btn-success col-sm-10 col-sm-offset-1" name="crearmsconid" value="Registrar">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php
}elseif(isset($_POST['provieneOCconidMS'])){

}else{
    ?>
    <section class="container">
        <div>
            <form action="registromejorasseguridad.php" method="post" class="form-horizontal jumbotron col-sm-6 col-sm-offset-3">
                <div class="form-group">
                    <?php
                    $fecha = date('d/m/Y');
                    $clase="MS";
                    $idMS=idgen($clase);
                    echo "
                        <input type='hidden' value='".$fecha."' name='fecharegistro'>
                        <input type='hidden' value='".$idMS."' name='idmejora'>
                    ";
                    ?>
                    <div class="col-sm-12">
                        <label for="tipo" class="col-sm-12">Seleccione Proveniencia de la Mejora de Seguridad:</label>
                    </div>
                    <div class="col-sm-12">
                        <select id="tipo" class="col-sm-12 form-control" name="provienede" >
                            <option>Seleccionar</option>
                            <option value="SE">Safety Eyes</option>
                            <option value="OC">Reporte de Ocurrencia</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="datepicker" class="col-sm-12">Seleccione Fecha de Registro:</label>
                    </div>
                    <div id="date" class="col-sm-12">
                        <input type="text" class="col-sm-12 form-control" placeholder="dd/mm/yyyy" name="fechareporte" id="datepicker" onchange="gettiporeporte()">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="tiporep" class="col-sm-12">Seleccione Reporte:</label>
                    </div>
                    <div class="col-sm-12">
                        <select id="tiporep" class="col-sm-12 form-control" name="idreporte">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="desc" class="col-sm-12">Descripción:</label>
                    </div>
                    <div class="col-sm-12">
                        <textarea rows="3" class="col-sm-12 form-control" name="descripcionms" id="desc"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="puesto" class="col-sm-12">Puesto del Responsable:</label>
                    </div>
                    <div class="col-sm-12">
                        <select id="puesto" class="col-sm-12 form-control" name="puesto" onchange="getcolaboradores(this.value)">
                            <option>Seleccionar</option>
                            <?php
                            $result=mysqli_query($link,"SELECT * FROM puesto WHERE estado='1'");
                            while ($fila=mysqli_fetch_array($result)){
                                echo "
                                    <option value='".$fila['idPuesto']."'>".$fila['descripcion']."</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="resp" class="col-sm-12">Responsable:</label>
                    </div>
                    <div class="col-sm-12">
                        <select id="resp" class="col-sm-12 form-control" name="responsable">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="submit" class="btn btn-default col-sm-10 col-sm-offset-1" formaction="registromejorasseguridad.php" name="regresar" value="Regresar">
                    </div>
                    <div class="col-sm-6">
                        <input type="submit" class="btn btn-success col-sm-10 col-sm-offset-1" name="crearms" value="Registrar">
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php
}
?>


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