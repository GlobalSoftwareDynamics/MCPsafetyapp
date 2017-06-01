<!DOCTYPE html>

<html lang="es">

<?php
/*require('funciones.php');
require('funcionesApp.php');
session_start();
if(isset($_SESSION['login'])){
*/
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
        <form action="aprobarSE.php" method="post" class="form-horizontal jumbotron col-sm-12">
            <div class="form-group col-sm-4">
                <div class="col-sm-4">
                    <label for="columna" class="col-sm-12">Columna:</label>
                </div>
                <div class="col-sm-8">
                    <select id="columna" name="columna" class="col-sm-12 form-control" onchange="getinputbusqueda(this.value)">
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
            <div class="form-group col-sm-4">
                <div class="col-sm-4">
                    <label for="detalle" class="col-sm-12">Busqueda:</label>
                </div>
                <div id="busqueda" class="col-sm-8">
                    <input type="text" name="busqueda" id="detalle" class="col-sm-12 form-control">
                </div>
            </div>
            <div class="form-group col-sm-4">
                <div class="col-sm-6">
                    <input type="submit" class="btn btn-success col-sm-10 col-sm-offset-1" name="filtrar" value="Filtrar Tabla">
                </div>
                <div class="col-sm-6">
                    <input type="submit" class="btn btn-default col-sm-10 col-sm-offset-1" name="eliminarFiltro" value="Quitar Filtro">
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
                <th>Ubicación</th>
                <th>Líder</th>
                <th>Pers. Obs.</th>
                <th>Pers. Ret.</th>
                <th>Actividad</th>
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
                    $result0=mysqli_query($link,"SELECT * FROM colaboradores WHERE apellidos LIKE '%".$_POST['busqueda']."%'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result=mysqli_query($link,"SELECT * FROM participantesse WHERE dni='".$fila0['dni']."' AND idTipoParticipante = '1'");
                        while ($fila=mysqli_fetch_array($result)){
                            $result1=mysqli_query($link,"SELECT * FROM safetyeyes WHERE idSafetyEyes ='".$fila['idSafetyEyes']."' AND estado='Pendiente'");
                            while ($fila1=mysqli_fetch_array($result1)){
                                echo "
                                    <td>".$fila1['fecha']."</td>
                                    <td>".$fila1['idSafetyEyes']."</td>
                                ";
                                $result2=mysqli_query($link,"SELECT * FROM ubicacion WHERE idUbicacion='".$fila1['idUbicacion']."'");
                                while ($fila2=mysqli_fetch_array($result2)){
                                    echo "
                                    <td>".$fila2['descripcion']."</td>
                                    ";
                                }
                                echo "
                                    <td>".$fila0['nombre']." ".$fila0['apellidos']."</td>
                                    ";
                                echo "
                                    <td>".$fila1['nropersobservadas']."</td>
                                    <td>".$fila1['nropersretroalimentadas']."</td>
                                    <td class='text-left'>".$fila1['actividadObservada']."</td>
                                ";
                                echo "
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' value='".$fila['idSafetyEyes']."' name='idSE'>
                                            <input type='submit' class='btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
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
                    $result0=mysqli_query($link,"SELECT * FROM planta WHERE idPlanta ='".$_POST['busqueda']."'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result1=mysqli_query($link,"SELECT * FROM ubicacion WHERE idPlanta='".$fila0['idPlanta']."'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            $result2=mysqli_query($link,"SELECT * FROM safetyeyes WHERE idUbicacion ='".$fila1['idUbicacion']."'  AND estado='Pendiente'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                    <td>".$fila2['fecha']."</td>
                                    <td>".$fila2['idSafetyEyes']."</td>
                                    <td>".$fila1['descripcion']."</td>
                                ";
                                $result3=mysqli_query($link,"SELECT * FROM participantesse WHERE idSafetyEyes='".$fila2['idSafetyEyes']."' AND idTipoParticipante ='1'");
                                while ($fila3=mysqli_fetch_array($result3)){
                                    $result4=mysqli_query($link,"SELECT * FROM colaboradores WHERE dni='".$fila3['dni']."'");
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
                                            <input type='submit' class='btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
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
                    $result0=mysqli_query($link,"SELECT * FROM ubicacion WHERE descripcion LIKE '%".$_POST['busqueda']."%'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result1=mysqli_query($link,"SELECT * FROM safetyeyes WHERE idUbicacion ='".$fila0['idUbicacion']."'  AND estado='Pendiente'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <td>".$fila1['fecha']."</td>
                                <td>".$fila1['idSafetyEyes']."</td>
                                <td>".$fila0['descripcion']."</td>
                            ";
                            $result2=mysqli_query($link,"SELECT * FROM participantesse WHERE idSafetyEyes='".$fila1['idSafetyEyes']."' AND idTipoParticipante ='1'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                $result3=mysqli_query($link,"SELECT * FROM colaboradores WHERE dni='".$fila2['dni']."'");
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
                                        <input type='submit' class='btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
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
                    $result0=mysqli_query($link,"SELECT * FROM safetyeyes WHERE ".$_POST['columna']." LIKE '%".$_POST['busqueda']."%'  AND estado='Pendiente'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        echo "
                            <td>".$fila0['fecha']."</td>
                            <td>".$fila0['idSafetyEyes']."</td>
                        ";
                        $result1=mysqli_query($link,"SELECT * FROM ubicacion WHERE idUbicacion='".$fila0['idUbicacion']."'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <td>".$fila1['descripcion']."</td>
                            ";
                        }
                        $result2=mysqli_query($link,"SELECT * FROM participantesse WHERE idSafetyEyes='".$fila0['idSafetyEyes']."' AND idTipoParticipante ='1'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            $result3=mysqli_query($link,"SELECT * FROM colaboradores WHERE dni='".$fila2['dni']."'");
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
                                    <input type='submit' class='btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
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
                $result0=mysqli_query($link,"SELECT * FROM safetyeyes WHERE estado='Pendiente'");
                while ($fila0=mysqli_fetch_array($result0)){
                    echo "
                            <td>".$fila0['fecha']."</td>
                            <td>".$fila0['idSafetyEyes']."</td>
                        ";
                    $result1=mysqli_query($link,"SELECT * FROM ubicacion WHERE idUbicacion='".$fila0['idUbicacion']."'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        echo "
                                <td>".$fila1['descripcion']."</td>
                            ";
                    }
                    $result2=mysqli_query($link,"SELECT * FROM participantesse WHERE idSafetyEyes='".$fila0['idSafetyEyes']."' AND idTipoParticipante ='1'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        $result3=mysqli_query($link,"SELECT * FROM colaboradores WHERE dni='".$fila2['dni']."'");
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
                                    <input type='submit' class='btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
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
    include_once('footercio.php');
    ?>
</footer>
</body>

<?php
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>