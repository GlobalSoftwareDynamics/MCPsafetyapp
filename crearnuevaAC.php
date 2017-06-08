<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
include('funcionesApp.php');
if(isset($_SESSION['login'])&&($_SESSION['usertype']=='1')){
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
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

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
    <?php
    include_once('navbarmainAdmin.php');
    ?>
</header>

<?php
if (isset($_POST['provieneSE'])){
?>
    <section class="container">
        <div>
            <form action="registrosaccionescorrectivas.php" method="post" class="form-horizontal jumbotron col-sm-6 col-sm-offset-3">
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
                    <div class="col-sm-12">
                        <label for="datepicker" class="col-sm-12">Fecha de Registro:</label>
                    </div>
                    <div class="col-sm-12">
                        <input id="datepicker" class="col-sm-12 form-control" name="fecha" onchange="getsafetyeyes(this.value)">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="codigose" class="col-sm-12">Codigo del Safety Eyes:</label>
                    </div>
                    <div class="col-sm-12">
                        <select id="codigose" class="col-sm-12 form-control" name="idSE" onchange="getobservacionesse(this.value)">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="obsse" class="col-sm-12">Observaciones del Safety Eyes:</label>
                    </div>
                    <div class="col-sm-12">
                        <select id="obsse" class="col-sm-12 form-control" name="observaciones" onchange="getdescobservaciones(this.value)">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="descripcion">

                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="desc" class="col-sm-12">Descripción:</label>
                    </div>
                    <div class="col-sm-12">
                        <textarea rows="3" class="col-sm-12 form-control" name="descripcionac" id="desc"></textarea>
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
                            $result=mysqli_query($link,"SELECT * FROM Puesto WHERE estado='1'");
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
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="datepicker1" class="col-sm-12">Fecha Planeada:</label>
                    </div>
                    <div class="col-sm-12">
                        <input id="datepicker1" class="col-sm-12 form-control" name="fechaplaneada">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="submit" class="btn btn-default col-sm-10 col-sm-offset-1" formaction="crearnuevaAC.php" value="Regresar">
                    </div>
                    <div class="col-sm-6">
                        <input type="submit" class="btn btn-success col-sm-10 col-sm-offset-1" name="crearacse" value="Registrar">
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php
}elseif(isset($_POST['provieneSEconidAC'])){
?>
    <section class="container">
        <div>
            <form action="registrosaccionescorrectivas.php" method="post" class="form-horizontal jumbotron col-sm-6 col-sm-offset-3">
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
                    <div class="col-sm-12">
                        <label for="codigose" class="col-sm-12">Codigo del Safety Eyes:</label>
                    </div>
                    <div class="col-sm-12">
                        <input id="codigose" class="col-sm-12 form-control" type="text" name="idse" value="<?php echo $_POST['idSE']?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="obsse" class="col-sm-12">Observaciones del Safety Eyes:</label>
                    </div>
                    <div class="col-sm-12">
                        <select id="obsse" class="col-sm-12 form-control" name="observaciones" onchange="getdescobservaciones(this.value)">
                            <option>Seleccionar</option>
                            <?php
                            $result=mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE idSafetyEyes='".$_POST['idSE']."'");
                            while ($fila=mysqli_fetch_array($result)){
                                echo "
                                    <option value='".$fila['idObservacionesSE']."'>".$fila['idObservacionesSE']."</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="descripcion">

                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="desc" class="col-sm-12">Descripción:</label>
                    </div>
                    <div class="col-sm-12">
                        <textarea rows="3" class="col-sm-12 form-control"name="descripcionac" id="desc"></textarea>
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
                            $result=mysqli_query($link,"SELECT * FROM Puesto WHERE estado='1'");
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
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="datepicker1" class="col-sm-12">Fecha Planeada:</label>
                    </div>
                    <div class="col-sm-12">
                        <input id="datepicker1" class="col-sm-12 form-control" name="fechaplaneada">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <input type="hidden" name="idSE" value="<?php echo $_POST['idSE']?>" readonly>
                    <div class="col-sm-6">
                        <input type="submit" class="btn btn-default col-sm-10 col-sm-offset-1" formaction="detallesafetyeyes.php" value="Regresar">
                    </div>
                    <div class="col-sm-6">
                        <input type="submit" class="btn btn-success col-sm-10 col-sm-offset-1" name="crearacseconidse" value="Registrar">
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php
}elseif(isset($_POST['provieneOC'])){
?>

<?php
}else{
    ?>
    <section class="container">
        <div class="col-sm-6 col-sm-offset-3">
            <h4 class="text-center">Nueva Acción Correctiva</h4>
        </div>
    </section>
    <br>
    <section class="container">
        <div>
            <form action="crearnuevaAC.php" method="post" class="form-horizontal jumbotron col-sm-6 col-sm-offset-3">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="tipo" class="col-sm-12">Seleccione Proveniencia de la Acción Correctiva:</label>
                    </div>
                    <div class="col-sm-12">
                        <select id="tipo" class="form-control col-sm-12" name="provienede" onchange="gettiporeporte(this.value)">
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
    <br>
    <section class="container">
        <form action="registrosaccionescorrectivas.php" class="form-horizontal">
            <input type="submit" class="btn btn-default col-sm-4 col-sm-offset-4" name="regresar" value="Regresar">
        </form>
    </section>
    <?php
}
?>

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