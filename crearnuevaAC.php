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
    <link href="css/styles.css" rel="stylesheet">
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
        function getocurrencias(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'crearnuevaACocurrencia':val},
                success: function(data){
                    $("#codigooc").html(data);
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
        function getdescripcion(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'crearnuevaACdescripcion':val},
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
            <form action="registrosaccionescorrectivas.php" method="post" class="form-horizontal jumbotron col-md-6 col-md-offset-3 col-xs-12">
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
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="datepicker">Fecha de Registro:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <input id="datepicker" class=" col-xs-12 col-md-12 form-control" name="fecha" onchange="getsafetyeyes(this.value)">
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="codigose">Codigo del Safety Eyes:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <select id="codigose" class=" col-xs-12 col-md-12 form-control" name="idSE" onchange="getobservacionesse(this.value)">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="obsse">Observaciones del Safety Eyes:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <select id="obsse" class="col-md-12 form-control" name="observaciones" onchange="getdescobservaciones(this.value)">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12" id="descripcion">

                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="desc">Descripción:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <textarea rows="3" class=" col-xs-12 col-md-12 form-control" name="descripcionac" id="desc"></textarea>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="puesto">Puesto del Responsable:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <select id="puesto" class=" col-xs-12 col-md-12 form-control" name="puesto" onchange="getcolaboradores(this.value)">
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
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="resp">Responsable:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <select id="resp" class=" col-xs-12 col-md-12 form-control" name="responsable">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-12 col-xs-12 col-md-12">
                        <label for="datepicker1">Fecha Planeada:</label>
                    </div>
                    <div class="col-md-12 col-xs-12 col-md-12">
                        <input id="datepicker1" class=" col-xs-12 col-md-12 form-control" name="fechaplaneada">
                    </div>
                </div>
                <br>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" class="btn btn-default col-md-10 col-md-offset-1 col-xs-12" formaction="crearnuevaAC.php" value="Regresar">
                    </div>
                    <div class="spacer5"></div>
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" class="btn btn-success col-md-10 col-md-offset-1 col-xs-12" name="crearacse" value="Registrar">
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
            <form action="registrosaccionescorrectivas.php" method="post" class="form-horizontal jumbotron col-md-6 col-md-offset-3 col-xs-12">
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
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="codigose">Codigo del Safety Eyes:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <input id="codigose" class=" col-xs-12 col-md-12 form-control" type="text" name="idse" value="<?php echo $_POST['idSE']?>" readonly>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="obsse" >Observaciones del Safety Eyes:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <select id="obsse" class=" col-xs-12 col-md-12 form-control" name="observaciones" onchange="getdescobservaciones(this.value)">
                            <option>Seleccionar</option>
                            <?php
                            $result=mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE idSafetyEyes='".$_POST['idSE']."'");
                            while ($fila=mysqli_fetch_array($result)){
                                echo "
                                    <option value='".$fila['idObservacionesSE']."'>".$fila['idObservacionesSE']."-".substr($fila['descripcion'],0,45)."...</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12" id="descripcion">

                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="desc">Descripción:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <textarea rows="3" class=" col-xs-12 col-md-12 form-control" name="descripcionac" id="desc"></textarea>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="puesto">Puesto del Responsable:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <select id="puesto" class=" col-xs-12 col-md-12 form-control" name="puesto" onchange="getcolaboradores(this.value)">
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
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="resp">Responsable:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <select id="resp" class=" col-xs-12 col-md-12 form-control" name="responsable">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="datepicker1">Fecha Planeada:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <input id="datepicker1" class=" col-xs-12 col-md-12 form-control" name="fechaplaneada">
                    </div>
                </div>
                <br>
                <div class="form-group col-xs-12 col-md-12">
                    <input type="hidden" name="idSE" value="<?php echo $_POST['idSE']?>" readonly>
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" name="detalleRegACconID" class="btn btn-default col-md-10 col-md-offset-1 col-xs-12" formaction="detallesafetyeyes.php" value="Regresar">
                    </div>
                    <div class="spacer5"></div>
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" class="btn btn-success col-md-10 col-md-offset-1 col-xs-12" name="crearacseconidse" value="Registrar">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php
}elseif(isset($_POST['provieneOC'])) {
    ?>
    <section class="container">
        <div>
            <form action="registrosaccionescorrectivas.php" method="post"
                  class="form-horizontal jumbotron col-md-6 col-md-offset-3 col-xs-12">
                <script>
                    $(function () {
                        $('#datepicker').datepicker({dateFormat: 'dd/mm/yy'}).val()
                    });
                    $(function () {
                        $('#datepicker1').datepicker({dateFormat: 'dd/mm/yy'}).val()
                    });
                </script>
                <?php
                $fecha = date('d/m/Y');
                $clase = "AC";
                $idAC = idgen($clase);
                echo "
                    <input type='hidden' value='" . $fecha . "' name='fecharegistro'>
                    <input type='hidden' value='" . $idAC . "' name='idaccioncorrectiva'>
                ";
                ?>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="datepicker">Fecha de Registro:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <input id="datepicker" class=" col-xs-12 col-md-12 form-control" name="fecha"
                               onchange="getocurrencias(this.value)">
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="codigooc">Codigo de la Ocurrencia:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <select id="codigooc" class=" col-xs-12 col-md-12 form-control" name="idOCUR"
                                onchange="getdescripcion(this.value)">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12" id="descripcion">

                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="desc">Descripción:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <textarea rows="3" class=" col-xs-12 col-md-12 form-control" name="descripcionac" id="desc"></textarea>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="puesto">Puesto del Responsable:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <select id="puesto" class=" col-xs-12 col-md-12 form-control" name="puesto"
                                onchange="getcolaboradores(this.value)">
                            <option>Seleccionar</option>
                            <?php
                            $result = mysqli_query($link, "SELECT * FROM Puesto WHERE estado='1'");
                            while ($fila = mysqli_fetch_array($result)) {
                                echo "
                                    <option value='" . $fila['idPuesto'] . "'>" . $fila['descripcion'] . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="resp">Responsable:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <select id="resp" class=" col-xs-12 col-md-12 form-control" name="responsable">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="datepicker1">Fecha Planeada:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <input id="datepicker1" class=" col-xs-12 col-md-12 form-control" name="fechaplaneada">
                    </div>
                </div>
                <br>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" class="btn btn-default col-md-10 col-md-offset-1 col-xs-12" formaction="crearnuevaAC.php" value="Regresar">
                    </div>
                    <div class="spacer5"></div>
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" class="btn btn-success col-md-10 col-md-offset-1 col-xs-12" name="crearacoc" value="Registrar">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php
}elseif(isset($_POST['provieneOCconID'])) {
    ?>
    <section class="container">
        <div>
            <form action="registrosaccionescorrectivas.php" method="post" class="form-horizontal jumbotron col-md-6 col-md-offset-3 col-xs-12">
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
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="codigoOC">Codigo de la Ocurrencia:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <input id="codigoOC" class=" col-xs-12 col-md-12 form-control" type="text" name="idOCUR" value="<?php echo $_POST['idOCUR']?>" readonly>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12" id="descripcion">
                    <?php
                    $result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE idOcurrencias='".$_POST['idOCUR']."'");
                    while ($fila=mysqli_fetch_array($result)){
                        echo "
                        <div class=' col-xs-12 col-md-12'>
                            <div class='col-md-12 descripcionobs'>
                                <p style='font-size: 15px'>" .$fila['descripcion']."</p>
                            </div>
                        </div>
                    ";
                    }
                    ?>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="desc">Descripción:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <textarea rows="3" class=" col-xs-12 col-md-12 form-control" name="descripcionac" id="desc"></textarea>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="puesto">Puesto del Responsable:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <select id="puesto" class=" col-xs-12 col-md-12 form-control" name="puesto" onchange="getcolaboradores(this.value)">
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
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="resp">Responsable:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <select id="resp" class=" col-xs-12 col-md-12 form-control" name="responsable">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="datepicker1">Fecha Planeada:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <input id="datepicker1" class=" col-xs-12 col-md-12 form-control" name="fechaplaneada">
                    </div>
                </div>
                <br>
                <div class="form-group col-xs-12 col-md-12">
                    <input type="hidden" name="idOCUR" value="<?php echo $_POST['idOCUR']?>" readonly>
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" name="detalleRegACconID" class="btn btn-default col-md-10 col-md-offset-1 col-xs-12" formaction="detalleOcurrencia.php" value="Regresar">
                    </div>
                    <div class="spacer5"></div>
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" class="btn btn-success col-md-10 col-md-offset-1 col-xs-12" name="crearacocconid" value="Registrar">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php
}else{
    ?>
    <section class="container">
        <div class="col-md-6 col-md-offset-3 col-xs-12">
            <h4 class="text-center">Nueva Acción Correctiva</h4>
        </div>
    </section>
    <br>
    <section class="container">
        <div>
            <form action="crearnuevaAC.php" method="post" class="form-horizontal jumbotron col-md-6 col-md-offset-3 col-xs-12">
                <div class="form-group col-xs-12 col-md-12">
                    <div class=" col-xs-12 col-md-12">
                        <label for="tipo">Seleccione Proveniencia de la Acción Correctiva:</label>
                    </div>
                    <div class=" col-xs-12 col-md-12">
                        <select id="tipo" class="form-control col-md-12" name="provienede" onchange="gettiporeporte(this.value)">
                            <option>Seleccionar</option>
                            <option value="SE">Safety Eyes</option>
                            <option value="OC">Reporte de Ocurrencia</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12" id="botontipo">
                </div>
            </form>
        </div>
    </section>
    <br>
    <section class="container">
        <form action="registrosaccionescorrectivas.php" class="form-horizontal col-xs-12 col-md-12">
            <input type="submit" class="btn btn-default col-md-4 col-md-offset-4 col-xs-12" name="regresar" value="Regresar">
        </form>
    </section>
    <?php
}
?>

<script src="js/bootstrap.min.js"></script>

<footer class="panel-footer navbar-fixed-bottom hidden-xs">
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