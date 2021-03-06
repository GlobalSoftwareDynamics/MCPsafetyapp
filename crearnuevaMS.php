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
        function getdescripcion(val) {
            var crearnuevaMStiporeporte = document.getElementById('tipo').value;
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'crearnuevaMSdescripcion':val,'crearnuevaMStiporeporte':crearnuevaMStiporeporte},
                success: function(data){
                    $("#descripcionrepo").html(data);
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
            <form action="registromejorasseguridad.php" method="post" class="form-horizontal jumbotron col-md-6 col-md-offset-3 col-xs-12">
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
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-12">
                        <label for="tiporep">Reporte Seleccionado:</label>
                    </div>
                    <div class="col-md-12">
                        <input type="text" class=" col-xs-12 col-md-12 form-control" id="tiporep" name="idreporte" value="<?php echo $_POST['idSE']?>">
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-12">
                        <label for="desc">Descripción:</label>
                    </div>
                    <div class="col-md-12">
                        <textarea rows="3" class="col-md-12 form-control" name="descripcionms" id="desc"></textarea>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-12">
                        <label for="puesto">Puesto del Responsable:</label>
                    </div>
                    <div class="col-md-12">
                        <select id="puesto" class="col-md-12 form-control" name="puesto" onchange="getcolaboradores(this.value)">
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
                    <div class="col-md-12">
                        <label for="resp">Responsable:</label>
                    </div>
                    <div class="col-md-12">
                        <select id="resp" class="col-md-12 form-control" name="responsable">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group col-xs-12 col-md-12">
                    <input type="hidden" name="idSE" value="<?php echo $_POST['idSE']?>">
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" formaction="detallesafetyeyes.php" class="btn btn-default col-md-10 col-md-offset-1 col-xs-12" name="detalleRegMSconID" value="Regresar">
                    </div>
                    <div class="spacer5"></div>
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" class="btn btn-success col-md-10 col-md-offset-1 col-xs-12" name="crearmsconid" value="Registrar">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php
}else{
    ?>
    <section class="container">
        <div>
            <form action="registromejorasseguridad.php" method="post" class="form-horizontal jumbotron col-md-6 col-md-offset-3 col-xs-12">
                <div class="form-group col-xs-12 col-md-12">
                    <?php
                    $fecha = date('d/m/Y');
                    $clase="MS";
                    $idMS=idgen($clase);
                    echo "
                        <input type='hidden' value='".$fecha."' name='fecharegistro'>
                        <input type='hidden' value='".$idMS."' name='idmejora'>
                    ";
                    ?>
                    <div class="col-md-12">
                        <label for="tipo">Seleccione Proveniencia de la Mejora de Seguridad:</label>
                    </div>
                    <div class="col-md-12">
                        <select id="tipo" class="col-md-12 form-control" name="provienede" >
                            <option>Seleccionar</option>
                            <option value="SE">Safety Eyes</option>
                            <option value="OC">Reporte de Ocurrencia</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-12">
                        <label for="datepicker">Seleccione Fecha de Registro:</label>
                    </div>
                    <div id="date" class="col-md-12">
                        <input type="text" class="col-md-12 form-control" placeholder="dd/mm/yyyy" name="fechareporte" id="datepicker" onchange="gettiporeporte()">
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-12">
                        <label for="tiporep">Seleccione Reporte:</label>
                    </div>
                    <div class="col-md-12">
                        <select id="tiporep" class="col-md-12 form-control" name="idreporte" onchange="getdescripcion(this.value)">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12" id="descripcionrepo">

                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-12">
                        <label for="desc">Descripción:</label>
                    </div>
                    <div class="col-md-12">
                        <textarea rows="3" class="col-md-12 form-control" name="descripcionms" id="desc"></textarea>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-12">
                        <label for="puesto">Puesto del Responsable:</label>
                    </div>
                    <div class="col-md-12">
                        <select id="puesto" class="col-md-12 form-control" name="puesto" onchange="getcolaboradores(this.value)">
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
                    <div class="col-md-12">
                        <label for="resp">Responsable:</label>
                    </div>
                    <div class="col-md-12">
                        <select id="resp" class="col-md-12 form-control" name="responsable">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" class="btn btn-default col-md-10 col-md-offset-1 col-xs-12" formaction="registromejorasseguridad.php" name="regresar" value="Regresar">
                    </div>
                    <div class="spacer5"></div>
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" class="btn btn-success col-md-10 col-md-offset-1 col-xs-12" name="crearms" value="Registrar">
                    </div>
                </div>
            </form>
        </div>
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