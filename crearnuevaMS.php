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
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
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
    <nav>
    </nav>
</header>
<?php
if(isset($_POST['provieneSEconidMS'])){
?>
    <section class="container">
        <div>
            <form action="registromejorasseguridad.php" method="post" class="form-horizontal">
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
                    <div>
                        <label for="tiporep">Reporte Seleccionado:</label>
                    </div>
                    <div>
                        <input type="text" id="tiporep" name="idreporte" value="<?php echo $_POST['idSE']?>">
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <label for="desc">Descripción:</label>
                    </div>
                    <div>
                        <textarea rows="3" name="descripcionms" id="desc"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <label for="puesto">Puesto del Responsable:</label>
                    </div>
                    <div>
                        <select id="puesto" name="puesto" onchange="getcolaboradores(this.value)">
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
                    <div>
                        <label for="resp">Responsable:</label>
                    </div>
                    <div>
                        <select id="resp" name="responsable">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="crearmsconid" value="Registrar Mejora de Seguridad">
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
            <form action="registromejorasseguridad.php" method="post" class="form-horizontal">
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
                    <div>
                        <label for="tipo">Seleccione Proveniencia de la Mejora de Seguridad:</label>
                    </div>
                    <div>
                        <select id="tipo" name="provienede" >
                            <option>Seleccionar</option>
                            <option value="SE">Safety Eyes</option>
                            <option value="OC">Reporte de Ocurrencia</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <label for="datepicker">Seleccione Fecha de Registro:</label>
                    </div>
                    <div id="date">
                        <input type="text" value="dd/mm/yyyy" name="fechareporte" id="datepicker" onchange="gettiporeporte()">
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <label for="tiporep">Seleccione Reporte:</label>
                    </div>
                    <div>
                        <select id="tiporep" name="idreporte">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <label for="desc">Descripción:</label>
                    </div>
                    <div>
                        <textarea rows="3" name="descripcionms" id="desc"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <label for="puesto">Puesto del Responsable:</label>
                    </div>
                    <div>
                        <select id="puesto" name="puesto" onchange="getcolaboradores(this.value)">
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
                    <div>
                        <label for="resp">Responsable:</label>
                    </div>
                    <div>
                        <select id="resp" name="responsable">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="crearms" value="Registrar Mejora de Seguridad">
                </div>
            </form>
        </div>
    </section>
<?php
}
?>
<hr>
<section class="container">
    <form action="registromejorasseguridad.php">
        <input type="submit" name="regresar" value="Regresar">
    </form>
</section>

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