<!DOCTYPE html>

<html lang="es">

<?php
require('funcionesApp.php');
include('session.php');
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
                data:{'registrosINCcolumna':val},
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
    <form action="registrosINC.php" method="post" class="form-horizontal jumbotron col-md-12 col-xs-12">
        <div class="form-group col-md-4 col-xs-12">
            <div class="col-md-4 col-xs-12">
                <label for="columna" class="control-label">Columna:</label>
            </div>
            <div class="col-md-8 col-xs-12">
                <select id="columna" name="columna" class="col-xs-12 form-control" onchange="getinputbusqueda(this.value)">
                    <option>Seleccionar</option>
                    <option value="fecha">Fecha</option>
                    <option value="anoFiscal">Año Fiscal</option>
                    <option value="idIncidentes">Código</option>
                    <option value="planta">Planta</option>
                    <option value="idUbicacion">Ubicación</option>
                    <option value="estado">Etapa</option>
                    <option value="consactual">Consecuencia Actual</option>
                    <option value="conspotencial">Consecuencia Potencial</option>
                    <option value="idTipoLesion">Tipo de Lesión</option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-4 col-xs-12">
            <div class="col-md-4 col-xs-12">
                <label for="detalle" class="control-label">Busqueda:</label>
            </div>
            <div id="busqueda" class="col-md-8 col-xs-12">
                <input type="text" name="busqueda" id="detalle" class="col-xs-12 form-control">
            </div>
        </div>
        <div class="form-group col-md-4 col-xs-12">
            <div class="col-md-6 col-xs-12">
                <input type="submit" class="btn btn-success col-md-12 col-xs-12" name="filtrar" value="Filtrar Tabla">
            </div>
            <div class="col-md-6 col-xs-12">
                <input type="submit" class="btn btn-default col-md-12 col-xs-12" name="eliminarFiltro" value="Quitar Filtro">
            </div>
        </div>
    </form>
</section>
<hr>
<section class="container-fluid">
    <div>
        <table class="table table-hover text-center">
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Código</th>
                <th>Cons. Actual</th>
                <th>Cons. Potencial</th>
                <th>Tipo de Lesión</th>
                <th>Ubicación</th>
                <th style="width: 30%">Descripción</th>
                <th>Etapa</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_POST['filtrar'])&&isset($_POST['columna'])&&isset($_POST['busqueda'])) {
                if ($_POST['columna'] === "planta") {
                    $result0=mysqli_query($link,"SELECT * FROM Planta WHERE idPlanta ='".$_POST['busqueda']."'");
                    while ($fila0=mysqli_fetch_array($result0)) {
                        $result1 = mysqli_query($link, "SELECT * FROM Ubicacion WHERE idPlanta='" . $fila0['idPlanta'] . "'");
                        while ($fila1 = mysqli_fetch_array($result1)) {
                            $result2 = mysqli_query($link, "SELECT * FROM Incidentes WHERE idUbicacion ='" . $fila1['idUbicacion'] . "' ORDER BY fecha DESC");
                            while ($fila2 = mysqli_fetch_array($result2)) {
                                echo "
                                    <tr>
                                ";
                                echo "
                                    <td>".$fila2['fecha']."</td>
                                    <td>".$fila2['idIncidentes']."</td>
                                ";
                                $result3=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes='".$fila2['idIncidentes']."' AND tipo = 'Actual'");
                                while ($fila3=mysqli_fetch_array($result3)){
                                    $result4=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila3['idConsecuencia']}'");
                                    while ($fila4=mysqli_fetch_array($result4)){
                                        echo "
                                            <td>".$fila4['siglas']."</td>
                                        ";
                                    }
                                }
                                $result3=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes='".$fila2['idIncidentes']."' AND tipo = 'Potencial'");
                                while ($fila3=mysqli_fetch_array($result3)){
                                    $result4=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila3['idConsecuencia']}'");
                                    while ($fila4=mysqli_fetch_array($result4)){
                                        echo "
                                            <td>".$fila4['siglas']."</td>
                                        ";
                                    }
                                }
                                $result3=mysqli_query($link,"SELECT * FROM TipoLesion WHERE idTipoLesion='".$fila2['idTipoLesion']."'");
                                while ($fila3=mysqli_fetch_array($result3)){
                                    echo "
                                        <td>".$fila3['siglas']."</td>
                                    ";
                                }
                                    echo "
                                        <td>".$fila1['descripcion']."</td>
                                    ";
                                echo "
                                    <td class='text-left'>".$fila2['descripcion']."</td>
                                    <td>".$fila2['estado']."</td>
                                ";
                                echo "
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' value='".$fila2['idIncidentes']."' name='idINC'>
                                            <input type='submit' class='btn-link' value='Detalle' formaction='detalleIncidente.php'>
                                        </form>
                                    </td>
                                ";
                                echo "
                                    </tr>
                                ";
                            }
                        }
                    }
                }elseif ($_POST['columna'] === "idUbicacion"){
                    $result0=mysqli_query($link,"SELECT * FROM Ubicacion WHERE descripcion LIKE '%".$_POST['busqueda']."%'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result1=mysqli_query($link,"SELECT * FROM Incidentes WHERE idUbicacion ='".$fila0['idUbicacion']."' ORDER BY fecha DESC");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <tr>
                            ";
                            echo "
                                    <td>".$fila1['fecha']."</td>
                                    <td>".$fila1['idIncidentes']."</td>
                                ";
                            $result3=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes='".$fila1['idIncidentes']."' AND tipo = 'Actual'");
                            while ($fila3=mysqli_fetch_array($result3)){
                                $result4=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila3['idConsecuencia']}'");
                                while ($fila4=mysqli_fetch_array($result4)){
                                    echo "
                                            <td>".$fila4['siglas']."</td>
                                        ";
                                }
                            }
                            $result3=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes='".$fila1['idIncidentes']."' AND tipo = 'Potencial'");
                            while ($fila3=mysqli_fetch_array($result3)){
                                $result4=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila3['idConsecuencia']}'");
                                while ($fila4=mysqli_fetch_array($result4)){
                                    echo "
                                            <td>".$fila4['siglas']."</td>
                                        ";
                                }
                            }
                            $result3=mysqli_query($link,"SELECT * FROM TipoLesion WHERE idTipoLesion='".$fila1['idTipoLesion']."'");
                            while ($fila3=mysqli_fetch_array($result3)){
                                echo "
                                        <td>".$fila3['siglas']."</td>
                                    ";
                            }
                            echo "
                                        <td>".$fila0['descripcion']."</td>
                                    ";
                            echo "
                                    <td class='text-left'>".$fila1['descripcion']."</td>
                                    <td>".$fila1['estado']."</td>
                                ";
                            echo "
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' value='".$fila1['idIncidentes']."' name='idINC'>
                                            <input type='submit' class='btn-link' value='Detalle' formaction='detalleIncidente.php'>
                                        </form>
                                    </td>
                                ";
                            echo "
                                    </tr>
                                ";
                        }
                    }
                }elseif ($_POST['columna'] === "consactual"){
                    $result0=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idConsecuencia = '{$_POST['busqueda']}' AND tipo = 'Actual'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result1=mysqli_query($link,"SELECT * FROM Incidentes WHERE idIncidentes ='".$fila0['idIncidentes']."' ORDER BY fecha DESC");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <tr>
                            ";
                            echo "
                                    <td>".$fila1['fecha']."</td>
                                    <td>".$fila1['idIncidentes']."</td>
                                ";
                            $result3=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes='".$fila1['idIncidentes']."' AND tipo = 'Actual'");
                            while ($fila3=mysqli_fetch_array($result3)){
                                $result4=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila3['idConsecuencia']}'");
                                while ($fila4=mysqli_fetch_array($result4)){
                                    echo "
                                            <td>".$fila4['siglas']."</td>
                                        ";
                                }
                            }
                            $result3=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes='".$fila1['idIncidentes']."' AND tipo = 'Potencial'");
                            while ($fila3=mysqli_fetch_array($result3)){
                                $result4=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila3['idConsecuencia']}'");
                                while ($fila4=mysqli_fetch_array($result4)){
                                    echo "
                                            <td>".$fila4['siglas']."</td>
                                        ";
                                }
                            }
                            $result3=mysqli_query($link,"SELECT * FROM TipoLesion WHERE idTipoLesion='".$fila1['idTipoLesion']."'");
                            while ($fila3=mysqli_fetch_array($result3)){
                                echo "
                                        <td>".$fila3['siglas']."</td>
                                    ";
                            }
                            $result2=mysqli_query($link,"SELECT * FROM Ubicacion WHERE idUbicacion='".$fila1['idUbicacion']."'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                    <td>".$fila2['descripcion']."</td>
                                ";
                            }
                            echo "
                                    <td class='text-left'>".$fila1['descripcion']."</td>
                                    <td>".$fila1['estado']."</td>
                                ";
                            echo "
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' value='".$fila1['idIncidentes']."' name='idINC'>
                                            <input type='submit' class='btn-link' value='Detalle' formaction='detalleIncidente.php'>
                                        </form>
                                    </td>
                                ";
                            echo "
                                    </tr>
                                ";
                        }
                    }
                }elseif ($_POST['columna'] === "conspotencial"){
                    $result0=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idConsecuencia = '{$_POST['busqueda']}' AND tipo = 'Potencial'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result1=mysqli_query($link,"SELECT * FROM Incidentes WHERE idIncidentes ='".$fila0['idIncidentes']."' ORDER BY fecha DESC");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <tr>
                            ";
                            echo "
                                    <td>".$fila1['fecha']."</td>
                                    <td>".$fila1['idIncidentes']."</td>
                                ";
                            $result3=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes='".$fila1['idIncidentes']."' AND tipo = 'Actual'");
                            while ($fila3=mysqli_fetch_array($result3)){
                                $result4=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila3['idConsecuencia']}'");
                                while ($fila4=mysqli_fetch_array($result4)){
                                    echo "
                                            <td>".$fila4['siglas']."</td>
                                        ";
                                }
                            }
                            $result3=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes='".$fila1['idIncidentes']."' AND tipo = 'Potencial'");
                            while ($fila3=mysqli_fetch_array($result3)){
                                $result4=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila3['idConsecuencia']}'");
                                while ($fila4=mysqli_fetch_array($result4)){
                                    echo "
                                            <td>".$fila4['siglas']."</td>
                                        ";
                                }
                            }
                            $result3=mysqli_query($link,"SELECT * FROM TipoLesion WHERE idTipoLesion='".$fila1['idTipoLesion']."'");
                            while ($fila3=mysqli_fetch_array($result3)){
                                echo "
                                        <td>".$fila3['siglas']."</td>
                                    ";
                            }
                            $result2=mysqli_query($link,"SELECT * FROM Ubicacion WHERE idUbicacion='".$fila1['idUbicacion']."'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                    <td>".$fila2['descripcion']."</td>
                                ";
                            }
                            echo "
                                    <td class='text-left'>".$fila1['descripcion']."</td>
                                    <td>".$fila1['estado']."</td>
                                ";
                            echo "
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' value='".$fila1['idIncidentes']."' name='idINC'>
                                            <input type='submit' class='btn-link' value='Detalle' formaction='detalleIncidente.php'>
                                        </form>
                                    </td>
                                ";
                            echo "
                                    </tr>
                                ";
                        }
                    }
                }else{
                    $result0=mysqli_query($link,"SELECT * FROM Incidentes WHERE ".$_POST['columna']." LIKE '%".$_POST['busqueda']."%' ORDER BY fecha DESC");
                    while ($fila0=mysqli_fetch_array($result0)){
                        echo "
                            <tr>
                        ";
                        echo "
                            <td>".$fila0['fecha']."</td>
                            <td>".$fila0['idIncidentes']."</td>
                        ";
                        $result2=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes='".$fila0['idIncidentes']."' AND tipo = 'Actual'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            $result1=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila2['idConsecuencia']}'");
                            while ($fila1=mysqli_fetch_array($result1)){
                                echo "
                                    <td>".$fila1['siglas']."</td>
                                ";
                            }
                        }
                        $result3=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes='".$fila0['idIncidentes']."' AND tipo = 'Potencial'");
                        while ($fila3=mysqli_fetch_array($result3)){
                            $result4=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila3['idConsecuencia']}'");
                            while ($fila4=mysqli_fetch_array($result4)){
                                echo "
                                    <td>".$fila4['siglas']."</td>
                                ";
                            }
                        }
                        $result2=mysqli_query($link,"SELECT * FROM TipoLesion WHERE idTipoLesion='".$fila0['idTipoLesion']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                <td>".$fila2['siglas']."</td>
                            ";
                        }
                        $result1=mysqli_query($link,"SELECT * FROM Ubicacion WHERE idUbicacion='".$fila0['idUbicacion']."'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <td>".$fila1['descripcion']."</td>
                            ";
                        }
                        echo "
                            <td class='text-left'>".$fila0['descripcion']."</td>
                            <td>".$fila0['estado']."</td>
                        ";
                        echo "
                            <td>
                                <form method='post'>
                                    <input type='hidden' value='".$fila0['idIncidentes']."' name='idINC'>
                                    <input type='submit' class='btn-link' value='Detalle' formaction='detalleIncidente.php'>
                                </form>
                            </td>
                        ";
                        echo "
                            </tr>
                        ";
                    }
                }
            }else{
                $result0=mysqli_query($link,"SELECT * FROM Incidentes ORDER BY fecha DESC");
                while ($fila0=mysqli_fetch_array($result0)){
                    echo "
                        <tr>
                    ";
                    echo "
                            <td>".$fila0['fecha']."</td>
                            <td>".$fila0['idIncidentes']."</td>
                        ";
                    $result2=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes='".$fila0['idIncidentes']."' AND tipo = 'Actual'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        $result1=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila2['idConsecuencia']}'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                            <td>".$fila1['siglas']."</td>
                        ";
                        }
                    }
                    $result3=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes='".$fila0['idIncidentes']."' AND tipo = 'Potencial'");
                    while ($fila3=mysqli_fetch_array($result3)){
                        $result4=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila3['idConsecuencia']}'");
                        while ($fila4=mysqli_fetch_array($result4)){
                            echo "
                            <td>".$fila4['siglas']."</td>
                        ";
                        }
                    }
                    $result2=mysqli_query($link,"SELECT * FROM TipoLesion WHERE idTipoLesion='".$fila0['idTipoLesion']."'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        echo "
                            <td>".$fila2['siglas']."</td>
                        ";
                    }
                    $result1=mysqli_query($link,"SELECT * FROM Ubicacion WHERE idUbicacion='".$fila0['idUbicacion']."'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        echo "
                                <td>".$fila1['descripcion']."</td>
                            ";
                    }
                    echo "
                            <td class='text-left'>".$fila0['descripcion']."</td>
                            <td>".$fila0['estado']."</td>
                        ";
                    echo "
                            <td>
                                <form method='post'>
                                    <input type='hidden' value='".$fila0['idIncidentes']."' name='idINC'>
                                    <input type='submit' class='btn-link' value='Detalle' formaction='detalleIncidente.php'>
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