<!DOCTYPE html>

<html lang="es">

<?php
include('funcionesApp.php');
include('session.php');
if(isset($_SESSION['login'])&&(($_SESSION['usertype']=='1'))||($_SESSION['usertype']=='2')){
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
        </script>
    </head>

    <body>
    <header>
        <?php
        include_once('navbarmainAdmin.php');
        ?>
    </header>
    <?php
    /*if (isset($_POST['crearInc'])){
        $result=mysqli_query($link,"UPDATE Ocurrencias SET estado = 'Aprobado' WHERE idOcurrencias = '{$_POST['idOCUR']}'");
    }*/
    ?>
    <section class="container">
        <form method="post" action="regINC_Fotografias.php" class="form-horizontal jumbotron col-xs-12 col-md-6 col-md-offset-3">
            <div class="col-xs-12 col-md-12">
                <h4 class="text-left">Reporte Preliminar de Incidente</h4>
            </div>
            <br>
            <?php
            if(isset($_POST['crearInc'])) {
                ?>
                <?php
                $clase = "INC";
                $fy = fiscalyear();
                $idINC = idgen($clase);
                echo "
                <input type='hidden' name='idINC' value='{$idINC}' readonly>
                <input type='hidden' name='fy' value='{$fy}' readonly>
                <input type='hidden' name='idOCUR' value='{$_POST['idOCUR']}' readonly>";
                $result = mysqli_query($link, "SELECT * FROM Ocurrencias WHERE idOcurrencias = '{$_POST['idOCUR']}'");
                while ($fila = mysqli_fetch_array($result)) {
                    ?>
                    <div class="form-group col-xs-12 col-md-12">
                        <div class="col-xs-12 col-md-12">
                            <label for="titul">Título Sugerido:</label>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <input type="text" class="form-control col-xs-12 col-md-12" name="titulo" id="titul">
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-12">
                        <div class="col-xs-12 col-md-12">
                            <label for="plant">Planta:</label>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <?php
                            $result1 = mysqli_query($link, "SELECT * FROM Ubicacion WHERE idUbicacion = '{$fila['idUbicacion']}'");
                            while ($fila1 = mysqli_fetch_array($result1)) {
                                $result2 = mysqli_query($link, "SELECT * FROM Planta WHERE idPlanta ='{$fila1['idPlanta']}'");
                                while ($fila2 = mysqli_fetch_array($result2)) {
                                    echo "
                                        <input type='text' value='{$fila2['descripcion']}' class='form-control col-xs-12 col-md-12' name='planta' id='plant' readonly>
                                    ";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-12">
                        <div class="col-xs-12 col-md-12">
                            <label for="ubica">Ubicación:</label>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <?php
                            $result1 = mysqli_query($link, "SELECT * FROM Ubicacion WHERE idUbicacion = '{$fila['idUbicacion']}'");
                            while ($fila1 = mysqli_fetch_array($result1)) {
                                echo "
                                    <input type='text' value='{$fila1['descripcion']}' class='form-control col-xs-12 col-md-12' id='ubica' readonly>
                                    <input type='hidden' value='{$fila['idUbicacion']}' class='form-control col-xs-12 col-md-12' name='ubicacion' id='ubica' readonly>
                                ";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-12">
                        <div class="col-xs-12 col-md-12">
                            <label for="desc">Descripción:</label>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <textarea name="descripcion" class="form-control col-xs-12 col-md-12" rows="3" id="desc"><?php echo $fila['descripcion']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-12">
                        <div class="col-xs-12 col-md-12">
                            <label for="fech">Fecha:</label>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <input type="text" class="form-control col-xs-12 col-md-12" name="fecha" id="fech" value="<?php echo $fila['fecha']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-12">
                        <div class="col-xs-12 col-md-12">
                            <label for="hor">Hora:</label>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <input type="text" class="form-control col-xs-12 col-md-12" name="hora" id="hor" value="<?php echo $fila['hora']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-12">
                        <div class="col-xs-12 col-md-12">
                            <label for="consac">Consecuencia Actual:</label>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <select class='form-control col-xs-12 col-md-12' name='consecuenciaact' id='consac'>
                                <option>Seleccionar</option>
                                <?php
                                $result1 = mysqli_query($link, "SELECT * FROM Consecuencia ORDER BY idConsecuencia ASC");
                                while ($fila1 = mysqli_fetch_array($result1)) {
                                    echo "
                                    <option value='{$fila1['idConsecuencia']}'>" . $fila1['siglas'] . " - " . $fila1['descripcion'] . "</option>
                                ";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-12">
                        <div class="col-xs-12 col-md-12">
                            <label for="conspot">Consecuencia Potencial:</label>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <select class='form-control col-xs-12 col-md-12' name='consecuenciapot' id='conspot'>
                                <option>Seleccionar</option>
                                <?php
                                $result1 = mysqli_query($link, "SELECT * FROM Consecuencia ORDER BY idConsecuencia ASC");
                                while ($fila1 = mysqli_fetch_array($result1)) {
                                    echo "
                                    <option value='{$fila1['idConsecuencia']}'>" . $fila1['siglas'] . " - " . $fila1['descripcion'] . "</option>
                                ";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-12">
                        <div class="col-xs-12 col-md-12">
                            <label for="les">Tipo de Lesión:</label>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <?php
                            $result2 = mysqli_query($link, "SELECT * FROM TipoLesion WHERE idTipoLesion = '{$fila['idTipoLesion']}'");
                            while ($fila2 = mysqli_fetch_array($result2)) {
                                if($fila2['idTipoLesion']==="6"){
                                    echo "
                                        <select id='les' name='lesion' class='form-control col-xs-12 col-md-12'>
                                             <option>Seleccionar</option>";
                                    $result1=mysqli_query($link,"SELECT * FROM TipoLesion");
                                    while ($fila1=mysqli_fetch_array($result1)){
                                        echo "
                                            <option value=".$fila1['idTipoLesion'].">".$fila1['descripcion']."</option>
                                        ";
                                    }
                                    echo "
                                        </select>
                                    ";
                                }else{
                                    echo "
                                        <input type='hidden' class='form-control col-xs-12 col-md-12' name='lesion' value='" . $fila2['idTipoLesion'] . "' readonly>
                                        <input type='text' class='form-control col-xs-12 col-md-12' id='les' value='" . $fila2['descripcion'] . "' readonly>
                                    ";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-12">
                        <div class="col-xs-12 col-md-6">
                            <label for="intene">Hubo Intercambio de Enegía:</label>
                            <div class="radio col-xs-11 col-xs-offset-1 col-md-11 col-md-offset-1">
                                <label>
                                    <input type="radio" name="intercambioenergia" id="optionsRadios1" value="1">
                                    Si
                                </label>
                            </div>
                            <div class="radio col-xs-11 col-xs-offset-1 col-md-11 col-md-offset-1">
                                <label>
                                    <input type="radio" name="intercambioenergia" id="optionsRadios2" value="0" checked>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <label for="intene">Incidente Repetido:</label>
                            <div class="radio col-xs-11 col-xs-offset-1 col-md-11 col-md-offset-1">
                                <label>
                                    <input type="radio" name="repetido" id="optionsRadios1" value="1">
                                    Si
                                </label>
                            </div>
                            <div class="radio col-xs-11 col-xs-offset-1 col-md-11 col-md-offset-1">
                                <label>
                                    <input type="radio" name="repetido" id="optionsRadios2" value="0" checked>
                                    No
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <hr>
                <div class="form-group col-xs-12 col-md-12">
                    <input type="submit" name="siguiente" value="Siguiente" class="btn btn-primary col-xs-12 col-md-6 col-md-offset-3">
                </div>
                <?php
            }
            if (isset($_POST['crearcero'])) {
                $result=mysqli_query($link,"SELECT * FROM Colaboradores WHERE usuario ='".$_SESSION['login']."'");
                while ($fila=mysqli_fetch_array($result)){
                    $persona=$fila['dni'];
                }
                date_default_timezone_set('America/Lima');
                $hora = date('H:i:s');
                $fecha = date('d/m/Y');
                $clase = "INC";
                $fy = fiscalyear();
                $idINC = idgen($clase);
                echo "
                <input type='hidden' name='idINC' value='{$idINC}' readonly>
                <input type='hidden' name='fy' value='{$fy}' readonly>
                <input type='hidden' name='fecha' value='{$fecha}' readonly>
                <input type='hidden' name='hora' value='{$hora}' readonly>
                <input type='hidden' name='reportante' value='{$persona}' readonly>
                ";
                ?>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-12">
                        <label for="titul">Título Sugerido:</label>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <input type="text" class="form-control col-xs-12 col-md-12" name="titulo" id="titul">
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-12">
                        <label for="plant">Planta:</label>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <select id="plant" class='form-control col-xs-12 col-md-12' name="planta" onchange="getubicaciones(this.value)">
                            <option>Seleccionar</option>
                            <?php
                            $result2 = mysqli_query($link, "SELECT * FROM Planta");
                            while ($fila2 = mysqli_fetch_array($result2)) {
                                echo "
                                    <option value='{$fila2['idPlanta']}'>{$fila2['descripcion']}</option>
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
                        <select class='form-control col-xs-12 col-md-12' name='ubicacion' id='ubica'>
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
                        <label for="consac">Consecuencia Actual:</label>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <select class='form-control col-xs-12 col-md-12' name='consecuenciaact' id='consac'>
                            <option>Seleccionar</option>
                            <?php
                            $result1 = mysqli_query($link, "SELECT * FROM Consecuencia ORDER BY idConsecuencia ASC");
                            while ($fila1 = mysqli_fetch_array($result1)) {
                                echo "
                                    <option value='{$fila1['idConsecuencia']}'>" . $fila1['siglas'] . " - " . $fila1['descripcion'] . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-12">
                        <label for="conspot">Consecuencia Potencial:</label>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <select class='form-control col-xs-12 col-md-12' name='consecuenciapot' id='conspot'>
                            <option>Seleccionar</option>
                            <?php
                            $result1 = mysqli_query($link, "SELECT * FROM Consecuencia ORDER BY idConsecuencia ASC");
                            while ($fila1 = mysqli_fetch_array($result1)) {
                                echo "
                                    <option value='{$fila1['idConsecuencia']}'>" . $fila1['siglas'] . " - " . $fila1['descripcion'] . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-12">
                        <label for="les">Tipo de Lesión:</label>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <select class='form-control col-xs-12 col-md-12' name='lesion' id='les'>
                            <option>Seleccionar</option>
                            <?php
                            $result1 = mysqli_query($link, "SELECT * FROM TipoLesion ORDER BY idTipoLesion ASC");
                            while ($fila1 = mysqli_fetch_array($result1)) {
                                echo "
                                    <option value='{$fila1['idTipoLesion']}'>" . $fila1['siglas'] . " - " . $fila1['descripcion'] . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-6">
                        <label for="intene">Hubo Intercambio de Enegía:</label>
                        <div class="radio col-xs-11 col-xs-offset-1 col-md-11 col-md-offset-1">
                            <label>
                                <input type="radio" name="intercambioenergia" id="optionsRadios1" value="1">
                                Si
                            </label>
                        </div>
                        <div class="radio col-xs-11 col-xs-offset-1 col-md-11 col-md-offset-1">
                            <label>
                                <input type="radio" name="intercambioenergia" id="optionsRadios2" value="0" checked>
                                No
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label for="intene">Incidente Repetido:</label>
                        <div class="radio col-xs-11 col-xs-offset-1 col-md-11 col-md-offset-1">
                            <label>
                                <input type="radio" name="repetido" id="optionsRadios1" value="1">
                                Si
                            </label>
                        </div>
                        <div class="radio col-xs-11 col-xs-offset-1 col-md-11 col-md-offset-1">
                            <label>
                                <input type="radio" name="repetido" id="optionsRadios2" value="0" checked>
                                No
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group col-xs-12 col-md-12">
                    <input type="submit" name="siguientesinOC" value="Siguiente" class="btn btn-primary col-xs-12 col-md-6 col-md-offset-3">
                </div>
                <?php
            }
            ?>
        </form>
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
