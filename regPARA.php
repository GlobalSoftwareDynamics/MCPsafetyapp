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
    <form action="regPARA_ConfirmacionFinal.php" class="form-horizontal col-xs-12 col-md-6 col-md-offset-3" method="post">
        <?php
        $result=mysqli_query($link,"SELECT * FROM Colaboradores WHERE usuario ='".$_SESSION['login']."'");
        while ($fila=mysqli_fetch_array($result)){
            $persona=$fila['dni'];
        }
        date_default_timezone_set('America/Lima');
        $fecha = date('d/m/Y');
        $fy=fiscalyear();
        $clase="PARA";
        $idPARA=idgen($clase);
        echo "
                <input type='hidden' name='idPARA' value='".$idPARA."' readonly>
                <input type='hidden' name='fecha' value='".$fecha."' readonly>
                <input type='hidden' name='reportante' value='".$persona."' readonly>
                <input type='hidden' name='fy' value='".$fy."' readonly>";
        ?>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th colspan="2">Checklist PARA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th colspan="2" class="text-left">Planta:</th>
                </tr>
                <tr>
                    <td colspan="2">
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
                    </td>
                </tr>
                <tr>
                    <th colspan="2" class="text-left">Ubicación:</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <select id="ubica" class="form-control col-xs-12 col-md-12" name="ubicacion">
                            <option>Seleccionar</option>
                        </select>
                    </td>
                </tr>
                <tr>
                   <th colspan="2" class="text-left">Actividad:</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="actividad" class="form-control col-xs-12 col-md-12" rows="3" id="activ"></textarea>
                    </td>
                </tr>
                <tr>
                    <th colspan="2" class="text-left" style="font-size: 15px">PARA</th>
                </tr>
                <?php
                $aux=0;
                $result=mysqli_query($link,"SELECT * FROM Preguntas WHERE seccion = 'Para' ORDER BY idPreguntas");
                while ($fila=mysqli_fetch_array($result)){
                    $aux++;
                    echo "
                        <tr>
                            <th class='text-left' colspan='2'>{$fila['descripcion']}</th>
                        </tr>
                        <tr>
                            <td>
                                <div class='radio-inline col-xs-12' style='margin:0;'>
                                    <label>
                                        <input type='radio' name='respuesta{$aux}' id='optionsRadios1' value='1'>
                                        Si
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class='radio-inline col-xs-12' style='margin:0;'>
                                    <label>
                                        <input type='radio' name='respuesta{$aux}' id='optionsRadios2' value='0' checked>
                                        No
                                    </label>
                                </div>
                            </td>
                        </tr>
                    ";
                }
                ?>
                <tr>
                    <th colspan="2" class="text-left" style="font-size: 15px">ANALIZA</th>
                </tr>
                <?php
                $result=mysqli_query($link,"SELECT * FROM Preguntas WHERE seccion = 'Analiza' ORDER BY idPreguntas");
                while ($fila=mysqli_fetch_array($result)){
                    $aux++;
                    echo "
                        <tr>
                            <th class='text-left' colspan='2'>{$fila['descripcion']}</th>
                        </tr>
                        <tr>
                            <td>
                                <div class='radio-inline col-xs-12' style='margin:0;'>
                                    <label>
                                        <input type='radio' name='respuesta{$aux}' id='optionsRadios1' value='1'>
                                        Si
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class='radio-inline col-xs-12' style='margin:0;'>
                                    <label>
                                        <input type='radio' name='respuesta{$aux}' id='optionsRadios2' value='0' checked>
                                        No
                                    </label>
                                </div>
                            </td>
                        </tr>
                    ";
                }
                ?>
                <tr>
                    <th colspan="2" class="text-left" style="font-size: 15px">REFLEXIONA</th>
                </tr>
                <?php
                $result=mysqli_query($link,"SELECT * FROM Preguntas WHERE seccion = 'Reflexiona' ORDER BY idPreguntas");
                while ($fila=mysqli_fetch_array($result)){
                    $aux++;
                    echo "
                        <tr>
                            <th class='text-left' colspan='2'>{$fila['descripcion']}</th>
                        </tr>
                        <tr>
                            <td>
                                <div class='radio-inline col-xs-12' style='margin:0;'>
                                    <label>
                                        <input type='radio' name='respuesta{$aux}' id='optionsRadios1' value='1'>
                                        Si
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class='radio-inline col-xs-12' style='margin:0;'>
                                    <label>
                                        <input type='radio' name='respuesta{$aux}' id='optionsRadios2' value='0' checked>
                                        No
                                    </label>
                                </div>
                            </td>
                        </tr>
                    ";
                }
                ?>
                <tr>
                    <th colspan="2" class="text-left" style="font-size: 15px">ACTUA</th>
                </tr>
                <?php
                $result=mysqli_query($link,"SELECT * FROM Preguntas WHERE seccion = 'Actua' ORDER BY idPreguntas");
                while ($fila=mysqli_fetch_array($result)){
                    $aux++;
                    echo "
                        <tr>
                            <th class='text-left' colspan='2'>{$fila['descripcion']}</th>
                        </tr>
                        <tr>
                            <td>
                                <div class='radio-inline col-xs-12' style='margin:0;'>
                                    <label>
                                        <input type='radio' name='respuesta{$aux}' id='optionsRadios1' value='1'>
                                        Si
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class='radio-inline col-xs-12' style='margin:0;'>
                                    <label>
                                        <input type='radio' name='respuesta{$aux}' id='optionsRadios2' value='0' checked>
                                        No
                                    </label>
                                </div>
                            </td>
                        </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
        <div class="form-group">
            <input type="submit" class="btn btn-success col-xs-12 col-md-10 col-xs-offset-1" name="registrar" value="Registrar">
        </div>
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