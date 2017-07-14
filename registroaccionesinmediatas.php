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
                data:{'registrosAIcolumna':val},
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
        <form action="registroaccionesinmediatas.php" method="post" class="form-horizontal jumbotron col-md-12 col-xs-12">
            <div class="form-group col-md-4 col-xs-12">
                <div class="col-md-4 col-xs-12">
                    <label for="columna" class="control-label">Columna:</label>
                </div>
                <div class="col-md-8 col-xs-12">
                    <select id="columna" class="col-xs-12 form-control" name="columna" onchange="getinputbusqueda(this.value)">
                        <option>Seleccionar</option>
                        <option value="fecharegistro">Fecha</option>
                        <option value="fuente">Fuente</option>
                        <option value="dni">Responsable</option>
                        <option value="descripcion">Descripción</option>
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
                    <input type="submit" class="btn btn-success col-md-12" name="filtrar" value="Filtrar Tabla">
                </div>
                <div class="col-md-6 col-xs-12">
                    <input type="submit" class="btn btn-default col-md-12" name="eliminarFiltro" value="Quitar Filtro">
                </div>
            </div>
        </form>
    </div>
</section>
<hr>
<section class="container">
    <div>
        <table class="table table-hover text-center">
            <thead>
            <tr>
                <th>Fecha de Registro</th>
                <th>Fuente</th>
                <th style="width: 40%">Descripción</th>
                <th>Responsable</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_POST['filtrar'])&&isset($_POST['columna'])&&isset($_POST['busqueda'])){
                if ($_POST['columna']==="dni"){
                    $result0=mysqli_query($link,"SELECT * FROM Colaboradores WHERE apellidos LIKE '%".$_POST['busqueda']."%'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result=mysqli_query($link,"SELECT * FROM AccionesInmediatas WHERE dni='".$fila0['dni']."'");
                        while ($fila=mysqli_fetch_array($result)){
                            echo "
                                <tr>
                            ";
                            echo "
                                <td>".$fila['fecharegistro']."</td>
                            ";
                            if ($fila['fuente']==="SE"){
                                $result2=mysqli_query($link,"SELECT * FROM AISE WHERE idAccionesInmediatas='".$fila['idAccionesInmediatas']."'");
                                while ($fila2=mysqli_fetch_array($result2)){
                                    echo "
                                        <td>
                                            <form method='post' action='detallesafetyeyes.php'>
                                                <input type='hidden' name='idSE' value='".$fila2['idSafetyEyes']."'>
                                                <input type='submit' name='detalleRegAI' value='".$fila2['idSafetyEyes']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                                }
                            }
                            if ($fila['fuente']==="OC"){
                                $result2=mysqli_query($link,"SELECT * FROM AIOCUR WHERE idAccionesInmediatas='".$fila['idAccionesInmediatas']."'");
                                while ($fila2=mysqli_fetch_array($result2)){
                                    echo "
                                        <td>
                                            <form method='post' action='detalleOcurrencia.php'>
                                                <input type='hidden' name='idOCUR' value='".$fila2['idOcurrencias']."'>
                                                <input type='submit' name='detalleRegAI' value='".$fila2['idOcurrencias']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                                }
                            }
                            if ($fila['fuente']==="INC"){
                                $result2=mysqli_query($link,"SELECT * FROM AIINC WHERE idAccionesInmediatas='".$fila['idAccionesInmediatas']."'");
                                while ($fila2=mysqli_fetch_array($result2)){
                                    echo "
                                        <td>
                                            <form method='post' action='detalleIncidente.php'>
                                                <input type='hidden' name='idINC' value='".$fila2['idIncidentes']."'>
                                                <input type='submit' name='detalleRegAI' value='".$fila2['idIncidentes']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                                }
                            }
                            echo "
                                <td class='text-left'>".$fila['descripcion']."</td>
                                <td>".$fila0['nombre']." ".$fila0['apellidos']."</td>
                            ";
                            echo "
                                </tr>
                            ";
                        }
                    }
                }else{
                    $result0=mysqli_query($link,"SELECT * FROM AccionesInmediatas WHERE ".$_POST['columna']." LIKE '%".$_POST['busqueda']."%'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        echo "
                            <tr>
                        ";
                        echo "
                            <td>".$fila0['fecharegistro']."</td>
                        ";
                        if ($fila0['fuente']==="SE"){
                            $result2=mysqli_query($link,"SELECT * FROM AISE WHERE idAccionesInmediatas='".$fila0['idAccionesInmediatas']."'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                        <td>
                                            <form method='post' action='detallesafetyeyes.php'>
                                                <input type='hidden' name='idSE' value='".$fila2['idSafetyEyes']."'>
                                                <input type='submit' name='detalleRegAI' value='".$fila2['idSafetyEyes']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                            }
                        }
                        if ($fila0['fuente']==="OC"){
                            $result2=mysqli_query($link,"SELECT * FROM AIOCUR WHERE idAccionesInmediatas='".$fila0['idAccionesInmediatas']."'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                        <td>
                                            <form method='post' action='detalleOcurrencia.php'>
                                                <input type='hidden' name='idOCUR' value='".$fila2['idOcurrencias']."'>
                                                <input type='submit' name='detalleRegAI' value='".$fila2['idOcurrencias']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                            }
                        }
                        if ($fila0['fuente']==="INC"){
                            $result2=mysqli_query($link,"SELECT * FROM AIINC WHERE idAccionesInmediatas='".$fila0['idAccionesInmediatas']."'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                        <td>
                                            <form method='post' action='detalleIncidente.php'>
                                                <input type='hidden' name='idINC' value='".$fila2['idIncidentes']."'>
                                                <input type='submit' name='detalleRegAI' value='".$fila2['idIncidentes']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                            }
                        }
                        echo "
                            <td class='text-left'>".$fila0['descripcion']."</td>
                        ";
                        $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila0['dni']."'");
                        while ($fila3=mysqli_fetch_array($result3)){
                            echo "
                            <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                        ";
                        }
                        echo "
                            </tr>
                        ";
                    }
                }
            }else{
                $result0=mysqli_query($link,"SELECT * FROM AccionesInmediatas");
                while ($fila0=mysqli_fetch_array($result0)){
                    echo "
                        <tr>
                    ";
                    echo "
                            <td>".$fila0['fecharegistro']."</td>
                    ";
                    if ($fila0['fuente']==="SE"){
                        $result2=mysqli_query($link,"SELECT * FROM AISE WHERE idAccionesInmediatas='".$fila0['idAccionesInmediatas']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                        <td>
                                            <form method='post' action='detallesafetyeyes.php'>
                                                <input type='hidden' name='idSE' value='".$fila2['idSafetyEyes']."'>
                                                <input type='submit' name='detalleRegAI' value='".$fila2['idSafetyEyes']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                        }
                    }
                    if ($fila0['fuente']==="OC"){
                        $result2=mysqli_query($link,"SELECT * FROM AIOCUR WHERE idAccionesInmediatas='".$fila0['idAccionesInmediatas']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                        <td>
                                            <form method='post' action='detalleOcurrencia.php'>
                                                <input type='hidden' name='idOCUR' value='".$fila2['idOcurrencias']."'>
                                                <input type='submit' name='detalleRegAI' value='".$fila2['idOcurrencias']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                        }
                    }
                    if ($fila0['fuente']==="INC"){
                        $result2=mysqli_query($link,"SELECT * FROM AIINC WHERE idAccionesInmediatas='".$fila0['idAccionesInmediatas']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                        <td>
                                            <form method='post' action='detalleIncidente.php'>
                                                <input type='hidden' name='idINC' value='".$fila2['idIncidentes']."'>
                                                <input type='submit' name='detalleRegAI' value='".$fila2['idIncidentes']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                        }
                    }
                    echo "
                            <td class='text-left'>".$fila0['descripcion']."</td>
                        ";
                    $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila0['dni']."'");
                    while ($fila3=mysqli_fetch_array($result3)){
                        echo "
                            <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                        ";
                    }
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