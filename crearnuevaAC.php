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
        function gettiporeporte(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'crearnuevaACtiporeporte':val},
                success: function(data){
                    $("#botontipo").html(data);
                }
            });
        }
        function getsafetyeyes(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'crearnuevaACsafetyeyes':val},
                success: function(data){
                    $("#codigose").html(data);
                }
            });
        }
        function getobservacionesse(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'crearnuevaACobservaciones':val},
                success: function(data){
                    $("#obsse").html(data);
                }
            });
        }
        function getdescobservaciones(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'crearnuevaACdescobservaciones':val},
                success: function(data){
                    $("#descripcion").html(data);
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
if (isset($_POST['provieneSE'])){
?>
    <section class="container">
        <div>
            <form action="registrosaccionescorrectivas.php" method="post" class="form-horizontal">
                <script>
                    $(function() {
                        $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' }).val()
                    });
                    $(function() {
                        $('#datepicker1').datepicker({ dateFormat: 'dd/mm/yy' }).val()
                    });
                </script>
                <?php
                $fecha = date('d/m/Y');
                $clase="AC";
                $idAC=idgen($clase);
                echo "
                    <input type='hidden' value='".$fecha."' name='fecharegistro'>
                    <input type='hidden' value='".$idAC."' name='idaccioncorrectiva'>
                ";
                ?>
                <div class="form-group">
                    <div>
                        <label for="datepicker">Fecha de Registro:</label>
                    </div>
                    <div>
                        <input id="datepicker" name="fecha" onchange="getsafetyeyes(this.value)">
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <label for="codigose">Codigo del Safety Eyes:</label>
                    </div>
                    <div>
                        <select id="codigose" name="idSE" onchange="getobservacionesse(this.value)">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <label for="obsse">Observaciones del Safety Eyes:</label>
                    </div>
                    <div>
                        <select id="obsse" name="observaciones" onchange="getdescobservaciones(this.value)">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <p id="descripcion"></p>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <label for="desc">Descripción:</label>
                    </div>
                    <div>
                        <textarea rows="3" name="descripcionac" id="desc"></textarea>
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
                    <div>
                        <label for="datepicker1">Fecha Planeada:</label>
                    </div>
                    <div>
                        <input id="datepicker1" name="fechaplaneada">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="crearacse" value="Registrar Acción Correctiva">
                </div>
            </form>
        </div>
    </section>
    <hr>
    <section class="container">
        <form action="crearnuevaAC.php">
            <input type="submit" name="regresar" value="Regresar">
        </form>
    </section>
<?php
}elseif(isset($_POST['provieneSEconidAC'])){
?>
    <section class="container">
        <div>
            <form action="registrosaccionescorrectivas.php" method="post" class="form-horizontal">
                <script>
                    $(function() {
                        $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' }).val()
                    });
                    $(function() {
                        $('#datepicker1').datepicker({ dateFormat: 'dd/mm/yy' }).val()
                    });
                </script>
                <?php
                $fecha = date('d/m/Y');
                $clase="AC";
                $idAC=idgen($clase);
                echo "
                    <input type='hidden' value='".$fecha."' name='fecharegistro'>
                    <input type='hidden' value='".$idAC."' name='idaccioncorrectiva'>
                ";
                ?>
                <div class="form-group">
                    <div>
                        <label for="codigose">Codigo del Safety Eyes:</label>
                    </div>
                    <div>
                        <input for="codigose" type="text" name="idse" value="<?php echo $_POST['idSE']?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <label for="obsse">Observaciones del Safety Eyes:</label>
                    </div>
                    <div>
                        <select id="obsse" name="observaciones" onchange="getdescobservaciones(this.value)">
                            <option>Seleccionar</option>
                            <?php
                            $result=mysqli_query($link,"SELECT * FROM observacionesse WHERE idSafetyEyes='".$_POST['idSE']."'");
                            while ($fila=mysqli_fetch_array($result)){
                                echo "
                                    <option value='".$fila['idObservacionesSE']."'>".$fila['idObservacionesSE']."</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <p id="descripcion"></p>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <label for="desc">Descripción:</label>
                    </div>
                    <div>
                        <textarea rows="3" name="descripcionac" id="desc"></textarea>
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
                    <div>
                        <label for="datepicker1">Fecha Planeada:</label>
                    </div>
                    <div>
                        <input id="datepicker1" name="fechaplaneada">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="crearacseconidse" value="Registrar Acción Correctiva">
                </div>
            </form>
        </div>
    </section>
    <hr>
    <section class="container">
        <form action="crearnuevaAC.php">
            <input type="submit" name="regresar" value="Regresar">
        </form>
    </section>
<?php
}elseif(isset($_POST['provieneOC'])){
?>

<?php
}else{
    ?>
    <section class="container">
        <div>
            <form action="crearnuevaAC.php" method="post" class="form-horizontal">
                <div class="form-group">
                    <div>
                        <label for="tipo">Seleccione Proveniencia de la Acción Correctiva:</label>
                    </div>
                    <div>
                        <select id="tipo" name="provienede" onchange="gettiporeporte(this.value)">
                            <option>Seleccionar</option>
                            <option value="SE">Safety Eyes</option>
                            <option value="OC">Reporte de Ocurrencia</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="botontipo">
                </div>
            </form>
        </div>
    </section>
    <hr>
    <section class="container">
        <form action="registrosaccionescorrectivas.php">
            <input type="submit" name="regresar" value="Regresar">
        </form>
    </section>
    <?php
}
?>

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