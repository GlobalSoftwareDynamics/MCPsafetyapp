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
        function getinputbusqueda(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'registrosSEcolumna':val},
                success: function(data){
                    $("#busqueda").html(data);
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

<section class="container">
    <div>
        <form action="registrosSE.php" method="post" class="form-horizontal jumbotron col-md-12 col-xs-12">
            <div class="form-group col-md-4 col-xs-12">
                <div class="col-md-4 col-xs-12">
                    <label for="columna" class="control-label">Columna:</label>
                </div>
                <div class="col-md-8 col-xs-12">
                    <select id="columna" class="form-control col-xs-12" name="columna" onchange="getinputbusqueda(this.value)">
                        <option>Seleccionar</option>
                        <option value="fecha">Fecha</option>
                        <option value="anoFiscal">Año Fiscal</option>
                        <option value="idSafetyEyes">Código</option>
                        <option value="lider">Líder</option>
                        <option value="planta">Planta</option>
                        <option value="idUbicacion">Ubicación</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4 col-xs-12">
                <div class="col-md-4 col-xs-12">
                    <label for="detalle" class="control-label">Busqueda:</label>
                </div>
                <div id="busqueda" class="col-md-8 col-xs-12">
                    <input type="text" class="form-control col-xs-12" name="busqueda" id="detalle">
                </div>
            </div>
            <div class="form-group col-md-4 col-xs-12">
                <div class="col-md-6 col-xs-12">
                    <input type="submit" class="btn btn-success col-xs-12" name="filtrar" value="Filtrar Tabla">
                </div>
                <div  class="col-md-6 col-xs-12">
                    <input type="submit" class="btn btn-default col-xs-12" name="eliminarFiltro" value="Quitar Filtro">
                </div>
            </div>
        </form>
    </div>
</section>
<section class="container">
    <form method="post" class="form-horizontal col-md-12 col-xs-12">
        <div class="form-group col-xs-12 col-md-12">
            <input type="submit" formaction="registroobservacionesSE.php" value="Ver Listado de Observaciones" class="btn btn-primary col-xs-12 col-md-4 col-md-offset-4">
        </div>
    </form>
</section>
<hr>
<section class="container-fluid">
    <div>
        <table class="table table-hover text-center">
            <thead>
                <tr class="text-center">
                    <th>Fecha</th>
                    <th class="hidden-xs">Código</th>
                    <th>Ubicación</th>
                    <th class="hidden-xs">Líder</th>
                    <th class="hidden-xs">Pers. Obs.</th>
                    <th class="hidden-xs">Pers. Ret.</th>
                    <th style="width: 30%">Actividad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_POST['filtrar'])&&isset($_POST['columna'])&&isset($_POST['busqueda'])){
                if ($_POST['columna']==="lider"){
                    echo "
                        <tr>
                    ";
                    $result0=mysqli_query($link,"SELECT * FROM Colaboradores WHERE apellidos LIKE '%".$_POST['busqueda']."%'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result=mysqli_query($link,"SELECT * FROM ParticipantesSE WHERE dni='".$fila0['dni']."' AND idTipoParticipante = '1'");
                        while ($fila=mysqli_fetch_array($result)){
                            $result1=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idSafetyEyes ='".$fila['idSafetyEyes']."' AND estado='Aprobado' ORDER BY fecha ASC");
                            while ($fila1=mysqli_fetch_array($result1)){
                                echo "
                                    <td>".$fila1['fecha']."</td>
                                    <td class='hidden-xs'>".$fila1['idSafetyEyes']."</td>
                                ";
                                $result2=mysqli_query($link,"SELECT * FROM Ubicacion WHERE idUbicacion='".$fila1['idUbicacion']."'");
                                while ($fila2=mysqli_fetch_array($result2)){
                                    echo "
                                    <td>".$fila2['descripcion']."</td>
                                    ";
                                }
                                    echo "
                                    <td class='hidden-xs'>".$fila0['nombre']." ".$fila0['apellidos']."</td>
                                    ";
                                echo "
                                    <td class='hidden-xs'>".$fila1['nropersobservadas']."</td>
                                    <td class='hidden-xs'>".$fila1['nropersretroalimentadas']."</td>
                                    <td class='text-left'>".$fila1['actividadObservada']."</td>
                                ";
                                echo "
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' value='".$fila['idSafetyEyes']."' name='idSE'>
                                            <input type='submit'  name='detalleRegSE' class='btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
                                        </form>
                                    </td>
                                ";
                                echo "
                                    </tr>
                                ";
                            }
                        }
                    }
                }elseif ($_POST['columna']==="planta"){
                    echo "
                        <tr>
                    ";
                    $result0=mysqli_query($link,"SELECT * FROM Planta WHERE idPlanta ='".$_POST['busqueda']."'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result1=mysqli_query($link,"SELECT * FROM Ubicacion WHERE idPlanta='".$fila0['idPlanta']."'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            $result2=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idUbicacion ='".$fila1['idUbicacion']."' AND estado='Aprobado' ORDER BY fecha ASC");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                    <td>".$fila2['fecha']."</td>
                                    <td>".$fila2['idSafetyEyes']."</td>
                                    <td>".$fila1['descripcion']."</td>
                                ";
                                $result3=mysqli_query($link,"SELECT * FROM ParticipantesSE WHERE idSafetyEyes='".$fila2['idSafetyEyes']."' AND idTipoParticipante ='1'");
                                while ($fila3=mysqli_fetch_array($result3)){
                                    $result4=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila3['dni']."'");
                                    while ($fila4=mysqli_fetch_array($result4)){
                                        echo "
                                            <td>".$fila4['nombre']." ".$fila4['apellidos']."</td>
                                        ";
                                    }
                                }
                                echo "
                                    <td>".$fila2['nropersobservadas']."</td>
                                    <td>".$fila2['nropersretroalimentadas']."</td>
                                    <td class='text-left'>".$fila2['actividadObservada']."</td>
                                ";
                                echo "
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' value='".$fila2['idSafetyEyes']."' name='idSE'>
                                            <input type='submit'  name='detalleRegSE' class='btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
                                        </form>
                                    </td>
                                ";
                                echo "
                                    </tr>
                                ";
                            }

                        }
                    }
                }elseif ($_POST['columna']==="idUbicacion"){
                    echo "
                        <tr>
                    ";
                    $result0=mysqli_query($link,"SELECT * FROM Ubicacion WHERE descripcion LIKE '%".$_POST['busqueda']."%'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result1=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idUbicacion ='".$fila0['idUbicacion']."' AND estado='Aprobado' ORDER BY fecha ASC");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <td>".$fila1['fecha']."</td>
                                <td>".$fila1['idSafetyEyes']."</td>
                                <td>".$fila0['descripcion']."</td>
                            ";
                            $result2=mysqli_query($link,"SELECT * FROM ParticipantesSE WHERE idSafetyEyes='".$fila1['idSafetyEyes']."' AND idTipoParticipante ='1'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila2['dni']."'");
                                while ($fila3=mysqli_fetch_array($result3)){
                                    echo "
                                        <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                                    ";
                                }
                            }
                            echo "
                                <td>".$fila1['nropersobservadas']."</td>
                                <td>".$fila1['nropersretroalimentadas']."</td>
                                <td class='text-left'>".$fila1['actividadObservada']."</td>
                            ";
                            echo "
                                <td>
                                    <form method='post'>
                                        <input type='hidden' value='".$fila1['idSafetyEyes']."' name='idSE'>
                                        <input type='submit'  name='detalleRegSE' class='btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
                                    </form>
                                </td>
                            ";
                            echo "
                                </tr>
                            ";
                        }
                    }
                }else{
                    echo "
                        <tr>
                    ";
                    $result0=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE ".$_POST['columna']." LIKE '%".$_POST['busqueda']."%' AND estado='Aprobado' ORDER BY fecha ASC");
                    while ($fila0=mysqli_fetch_array($result0)){
                        echo "
                            <td>".$fila0['fecha']."</td>
                            <td>".$fila0['idSafetyEyes']."</td>
                        ";
                        $result1=mysqli_query($link,"SELECT * FROM Ubicacion WHERE idUbicacion='".$fila0['idUbicacion']."'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <td>".$fila1['descripcion']."</td>
                            ";
                        }
                        $result2=mysqli_query($link,"SELECT * FROM ParticipantesSE WHERE idSafetyEyes='".$fila0['idSafetyEyes']."' AND idTipoParticipante ='1'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila2['dni']."'");
                            while ($fila3=mysqli_fetch_array($result3)){
                                echo "
                                    <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                                ";
                            }
                        }
                        echo "
                            <td>".$fila0['nropersobservadas']."</td>
                            <td>".$fila0['nropersretroalimentadas']."</td>
                            <td class='text-left'>".$fila0['actividadObservada']."</td>
                        ";
                        echo "
                            <td>
                                <form method='post'>
                                    <input type='hidden' value='".$fila0['idSafetyEyes']."' name='idSE'>
                                    <input type='submit'  name='detalleRegSE' class='btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
                                </form>
                            </td>
                        ";
                        echo "
                            </tr>
                        ";
                    }
                }
            }else{
                    echo "
                        <tr>
                    ";
                    $result0=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE estado='Aprobado' ORDER BY fecha ASC");
                    while ($fila0=mysqli_fetch_array($result0)){
                        echo "
                            <td>".$fila0['fecha']."</td>
                            <td>".$fila0['idSafetyEyes']."</td>
                        ";
                        $result1=mysqli_query($link,"SELECT * FROM Ubicacion WHERE idUbicacion='".$fila0['idUbicacion']."'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <td>".$fila1['descripcion']."</td>
                            ";
                        }
                        $result2=mysqli_query($link,"SELECT * FROM ParticipantesSE WHERE idSafetyEyes='".$fila0['idSafetyEyes']."' AND idTipoParticipante ='1'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila2['dni']."'");
                            while ($fila3=mysqli_fetch_array($result3)){
                                echo "
                                    <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                                ";
                            }
                        }
                        echo "
                            <td>".$fila0['nropersobservadas']."</td>
                            <td>".$fila0['nropersretroalimentadas']."</td>
                            <td class='text-left'>".$fila0['actividadObservada']."</td>
                        ";
                        echo "
                            <td>
                                <form method='post'>
                                    <input type='hidden' value='".$fila0['idSafetyEyes']."' name='idSE'>
                                    <input type='submit'  name='detalleRegSE' class='btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
                                </form>
                            </td>
                        ";
                        echo "
                            </tr>
                        ";
                    }
            }
            ?>
            </tbody>
        </table>
    </div>
</section>

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