<!DOCTYPE html>

<html lang="es">

<?php
include('funcionesApp.php');
include('session.php');
if(isset($_SESSION['login'])&&(($_SESSION['usertype']=='1')||($_SESSION['usertype']=='2')||($_SESSION['usertype']=='5'))){
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
            function getlesiones(val) {
                $.ajax({
                    type: "POST",
                    url: "getAjax.php",
                    data:{'regocurrrencialesiones':val},
                    success: function(data){
                        $("#les").html(data);
                    }
                });
            }
        </script>
    </head>

    <body>
    <header>
        <?php
        if($_SESSION['usertype']=='1'||$_SESSION['usertype']=='2'){
            include_once('navbarmainSupervisor.php');
        }elseif($_SESSION['usertype']=='5'){
            include_once('navbarmainOperario.php');
        }
        ?>
    </header>

    <section class="container">
        <div>
            <form action="regOC_Involucrados.php" method="post" class="form-horizontal jumbotron col-xs-12 col-md-6 col-md-offset-3">
                <div class="col-xs-12 col-md-12">
                    <h4 class="text-left">Datos Generales</h4>
                </div>
                <br>
                <?php
                $result=mysqli_query($link,"SELECT * FROM Colaboradores WHERE usuario ='".$_SESSION['login']."'");
                while ($fila=mysqli_fetch_array($result)){
                    $persona=$fila['dni'];
                }
                date_default_timezone_set('America/Lima');
                $hora = date('H:i:s');
                $fecha = date('d/m/Y');
                $fy=fiscalyear();
                $clase="OC";
                $idOCUR=idgen($clase);
                echo "
                <input type='hidden' name='idOCUR' value='".$idOCUR."' readonly>
                <input type='hidden' name='fecha' value='".$fecha."' readonly>
                <input type='hidden' name='hora' value='".$hora."' readonly>
                <input type='hidden' name='reportante' value='".$persona."' readonly>
                <input type='hidden' name='fy' value='".$fy."' readonly>";
                ?>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-12">
                        <label for="plant">Planta:</label>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <select id="plant" name="planta" class="form-control col-xs-12 col-md-12" onchange="getubicaciones(this.value)">
                            <option>Seleccionar</option>
                            <?php
                            $result1=mysqli_query($link,"SELECT * FROM Planta WHERE estado='1'");
                            while ($fila1=mysqli_fetch_array($result1)){
                                echo "
                                <option value=".$fila1['idPlanta'].">".$fila1['descripcion']."</option>
                            ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-12">
                        <label for="ubica">Ubicación:</label>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <select id="ubica" class="form-control col-xs-12 col-md-12" name="ubicacion">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-12">
                        <label for="desc">Descripción:</label>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <textarea name="descripcion" class="form-control col-xs-12 col-md-12" rows="3" id="desc"></textarea>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-12">
                        <label for="clas">Clase de Ocurrencia:</label>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <select id="clas" name="clase" class="form-control col-xs-12 col-md-12" onchange="getlesiones(this.value)">
                            <option>Seleccionar</option>
                            <?php
                            $result1=mysqli_query($link,"SELECT * FROM Clase WHERE categoria='OC'");
                            while ($fila1=mysqli_fetch_array($result1)){
                                echo "
                                <option value=".$fila1['idClase'].">".$fila1['descripcion']."</option>
                            ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12" id="les">

                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-12">
                        <label for="categ">Categoría:</label>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <select id="categ" name="categoria" class="form-control col-xs-12 col-md-12">
                            <option>Seleccionar</option>
                            <option>Seguridad</option>
                            <option>Medio Ambiente</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group col-xs-12 col-md-12">
                    <input type="submit" name="siguiente" value="Siguiente" class="btn btn-primary col-xs-12 col-md-6 col-md-offset-3" style="font-weight: bold; font-size: 15px">
                </div>
            </form>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
