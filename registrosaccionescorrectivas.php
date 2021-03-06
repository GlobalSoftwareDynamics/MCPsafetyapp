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
                data:{'registrosACcolumna':val},
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
<?php
if (isset($_POST['crearacse'])){
    $agregar="INSERT INTO AccionesCorrectivas(idAccionesCorrectivas, dni, idEstado, fecharegistro, descripcion, fechaPlan, fechaReal, fuente, fechaactualizacion) VALUES (
    '".$_POST['idaccioncorrectiva']."','".$_POST['responsable']."','1','".$_POST['fecharegistro']."','".$_POST['descripcionac']."','".$_POST['fechaplaneada']."','-','SE','-'
    )";
    $query=mysqli_query($link,$agregar);
    $agregar="INSERT INTO ACSE(idObservacionesse, idAccionesCorrectivas) VALUES (
    '".$_POST['observaciones']."','".$_POST['idaccioncorrectiva']."'
    )";
    $query=mysqli_query($link,$agregar);
}
if (isset($_POST['crearacseconidse'])){
    $agregar="INSERT INTO AccionesCorrectivas(idAccionesCorrectivas, dni, idEstado, fecharegistro, descripcion, fechaPlan, fechaReal, fuente, fechaactualizacion) VALUES (
    '".$_POST['idaccioncorrectiva']."','".$_POST['responsable']."','1','".$_POST['fecharegistro']."','".$_POST['descripcionac']."','".$_POST['fechaplaneada']."','-','SE','-'
    )";
    $query=mysqli_query($link,$agregar);
    $agregar="INSERT INTO ACSE(idObservacionesse, idAccionesCorrectivas) VALUES (
    '".$_POST['observaciones']."','".$_POST['idaccioncorrectiva']."'
    )";
    $query=mysqli_query($link,$agregar);
}
if(isset($_POST['crearacoc'])){
    $agregar="INSERT INTO AccionesCorrectivas(idAccionesCorrectivas, dni, idEstado, fecharegistro, descripcion, fechaPlan, fechaReal, fuente, fechaactualizacion) VALUES (
    '".$_POST['idaccioncorrectiva']."','".$_POST['responsable']."','1','".$_POST['fecharegistro']."','".$_POST['descripcionac']."','".$_POST['fechaplaneada']."','-','OC','-'
    )";
    $query=mysqli_query($link,$agregar);
    $agregar="INSERT INTO ACOCUR(idAccionesCorrectivas, idOcurrencias) VALUES (
    '".$_POST['idaccioncorrectiva']."','".$_POST['idOCUR']."'
    )";
    $query=mysqli_query($link,$agregar);
}
if(isset($_POST['crearacocconid'])){
    $agregar="INSERT INTO AccionesCorrectivas(idAccionesCorrectivas, dni, idEstado, fecharegistro, descripcion, fechaPlan, fechaReal, fuente, fechaactualizacion) VALUES (
    '".$_POST['idaccioncorrectiva']."','".$_POST['responsable']."','1','".$_POST['fecharegistro']."','".$_POST['descripcionac']."','".$_POST['fechaplaneada']."','-','OC','-'
    )";
    $query=mysqli_query($link,$agregar);
    $agregar="INSERT INTO ACOCUR(idAccionesCorrectivas, idOcurrencias) VALUES (
    '".$_POST['idaccioncorrectiva']."','".$_POST['idOCUR']."'
    )";
    $query=mysqli_query($link,$agregar);
}
if (isset($_POST['actualizarestado'])){
    $fechaplaneada="";
    $result=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE idAccionesCorrectivas= '".$_POST['idAC']."'");
    while ($fila=mysqli_fetch_array($result)){
        $fechaplaneada=$fila['fechaPlan'];
    }
    if ($fechaplaneada>$_POST['fechaReal']||$fechaplaneada===$_POST['fechaReal']){
        $actualizar="UPDATE AccionesCorrectivas SET idEstado = '2' WHERE idAccionesCorrectivas = '".$_POST['idAC']."'";
        $query=mysqli_query($link,$actualizar);
        $actualizar="UPDATE AccionesCorrectivas SET fechaReal = '".$_POST['fechaReal']."' WHERE idAccionesCorrectivas = '".$_POST['idAC']."'";
        $query=mysqli_query($link,$actualizar);
        $actualizar="UPDATE AccionesCorrectivas SET fechaactualizacion = '".$_POST['fecha']."' WHERE idAccionesCorrectivas = '".$_POST['idAC']."'";
        $query=mysqli_query($link,$actualizar);
    }elseif ($_POST['fechaReal']>$fechaplaneada){
        $actualizar="UPDATE AccionesCorrectivas SET idEstado = '3' WHERE idAccionesCorrectivas = '".$_POST['idAC']."'";
        $query=mysqli_query($link,$actualizar);
        $actualizar="UPDATE AccionesCorrectivas SET fechaReal = '".$_POST['fechaReal']."' WHERE idAccionesCorrectivas = '".$_POST['idAC']."'";
        $query=mysqli_query($link,$actualizar);
        $actualizar="UPDATE AccionesCorrectivas SET fechaactualizacion = '".$_POST['fecha']."' WHERE idAccionesCorrectivas = '".$_POST['idAC']."'";
        $query=mysqli_query($link,$actualizar);
    }
}
?>
<section class="container">
    <div>
        <form action="registrosaccionescorrectivas.php" method="post" class="form-horizontal jumbotron col-md-12 col-xs-12">
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
                        <option value="estado">Estado</option>
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
                    <input type="submit" class="btn btn-success col-md-12 col-xs-12" name="filtrar" value="Filtrar Tabla">
                </div>
                <div class="col-md-6 col-xs-12">
                    <input type="submit" class="btn btn-default col-md-12 col-xs-12" name="eliminarFiltro" value="Quitar Filtro">
                </div>
            </div>
        </form>
    </div>
</section>
<section class="container">
    <form method="post" class="form-horizontal col-md-12 col-xs-12">
        <div class="form-group col-xs-12 col-md-12">
            <input type="submit" formaction="crearnuevaAC.php" value="Registrar Nueva Acción Correctiva" class="btn btn-primary col-xs-12 col-md-4 col-md-offset-4">
        </div>
    </form>
</section>
<hr>
<section class="container-fluid">
    <div>
        <table class="table table-hover text-center">
            <thead>
            <tr>
                <th>Fecha de Registro</th>
                <th>Fuente</th>
                <th style="width: 30%">Descripción</th>
                <th>Responsable</th>
                <th>Fecha Planeada</th>
                <th>Fecha Real</th>
                <th>Actualizada el</th>
                <th>Estado</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_POST['filtrar'])&&isset($_POST['columna'])&&isset($_POST['busqueda'])){
                if ($_POST['columna']==="dni"){
                    $result0=mysqli_query($link,"SELECT * FROM Colaboradores WHERE apellidos LIKE '%".$_POST['busqueda']."%'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE dni='".$fila0['dni']."'");
                        while ($fila=mysqli_fetch_array($result)){
                            echo "
                                <tr>
                            ";
                            echo "
                                <td>".$fila['fecharegistro']."</td>
                            ";
                            if ($fila0['fuente']==="SE"){
                                $result2=mysqli_query($link,"SELECT * FROM ACSE WHERE idAccionesCorrectivas='".$fila0['idAccionesCorrectivas']."'");
                                while ($fila2=mysqli_fetch_array($result2)){
                                    $result3=mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE idObservacionesSE ='".$fila2['idObservacionesSE']."'");
                                    while ($fila3=mysqli_fetch_array($result3)){
                                        echo "
                                        <td>
                                            <form method='post' action='detallesafetyeyes.php'>
                                                <input type='hidden' name='idSE' value='".$fila3['idSafetyEyes']."'>
                                                <input type='submit' name='detalleRegAC' value='".$fila3['idSafetyEyes']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                                    }
                                }
                            }
                            if ($fila['fuente']==="OC"){
                                $result2=mysqli_query($link,"SELECT * FROM ACOCUR WHERE idAccionesCorrectivas='".$fila['idAccionesCorrectivas']."'");
                                while ($fila2=mysqli_fetch_array($result2)){
                                    echo "
                                        <td>
                                            <form method='post' action='detalleOcurrencia.php'>
                                                <input type='hidden' name='idOCUR' value='".$fila2['idOcurrencias']."'>
                                                <input type='submit' name='detalleRegAC' value='".$fila2['idOcurrencias']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                                }
                            }
                            if ($fila['fuente']==="INC"){
                                $result2=mysqli_query($link,"SELECT * FROM ACINC WHERE idAccionesCorrectivas='".$fila['idAccionesCorrectivas']."'");
                                while ($fila2=mysqli_fetch_array($result2)){
                                    echo "
                                        <td>
                                            <form method='post' action='detalleIncidente.php'>
                                                <input type='hidden' name='idINC' value='".$fila2['idIncidentes']."'>
                                                <input type='submit' name='detalleRegAC' value='".$fila2['idIncidentes']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                                }
                            }
                            echo "
                                <td class='text-left'>".$fila['descripcion']."</td>
                                <td>".$fila0['nombre']." ".$fila0['apellidos']."</td>
                                <td>".$fila['fechaPlan']."</td>
                                <td>".$fila['fechaReal']."</td>
                                <td>".$fila['fechaactualizacion']."</td>
                            ";
                            $result2=mysqli_query($link,"SELECT * FROM EstadoACMS WHERE idEstado='".$fila['idEstado']."'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                    <td>".$fila2['descripcion']."</td>
                                ";
                            }
                            echo "
                                <td>
                                    <form method='post'>
                                        <input type='hidden' value='".$fila['idAccionesCorrectivas']."' name='idAC'>
                                        <input type='submit' class='btn-link' value='Seguimiento' formaction='seguimientoAC.php'>
                                    </form>
                                </td>
                            ";
                            echo "
                                </tr>
                            ";
                        }
                    }
                }else{
                    $result0=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE ".$_POST['columna']." LIKE '%".$_POST['busqueda']."%'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        echo "
                            <tr>
                        ";
                        echo "
                            <td>".$fila0['fecharegistro']."</td>
                        ";
                        if ($fila0['fuente']==="SE"){
                            $result2=mysqli_query($link,"SELECT * FROM ACSE WHERE idAccionesCorrectivas='".$fila0['idAccionesCorrectivas']."'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                $result3=mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE idObservacionesSE ='".$fila2['idObservacionesSE']."'");
                                while ($fila3=mysqli_fetch_array($result3)){
                                    echo "
                                        <td>
                                            <form method='post'  action='detallesafetyeyes.php'>
                                                <input type='hidden' name='idSE' value='".$fila3['idSafetyEyes']."'>
                                                <input type='submit' name='detalleRegAC' value='".$fila3['idSafetyEyes']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                                }
                            }
                        }
                        if ($fila0['fuente']==="OC"){
                            $result2=mysqli_query($link,"SELECT * FROM ACOCUR WHERE idAccionesCorrectivas='".$fila0['idAccionesCorrectivas']."'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                        <td>
                                            <form method='post' action='detalleOcurrencia.php'>
                                                <input type='hidden' name='idOCUR' value='".$fila2['idOcurrencias']."'>
                                                <input type='submit' name='detalleRegAC' value='".$fila2['idOcurrencias']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                            }
                        }
                        if ($fila0['fuente']==="INC"){
                            $result2=mysqli_query($link,"SELECT * FROM ACINC WHERE idAccionesCorrectivas='".$fila0['idAccionesCorrectivas']."'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                        <td>
                                            <form method='post' action='detalleIncidente.php'>
                                                <input type='hidden' name='idINC' value='".$fila2['idIncidentes']."'>
                                                <input type='submit' name='detalleRegAC' value='".$fila2['idIncidentes']."' class='btn-link'>
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
                            <td>".$fila0['fechaPlan']."</td>
                            <td>".$fila0['fechaReal']."</td>
                            <td>".$fila0['fechaactualizacion']."</td>
                        ";
                        $result2=mysqli_query($link,"SELECT * FROM EstadoACMS WHERE idEstado='".$fila0['idEstado']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                    <td>".$fila2['descripcion']."</td>
                                ";
                        }
                        echo "
                            <td>
                                <form method='post'>
                                    <input type='hidden' value='".$fila0['idAccionesCorrectivas']."' name='idAC'>
                                    <input type='submit' class='btn-link' value='Seguimiento' formaction='seguimientoAC.php'>
                                </form>
                            </td>
                        ";
                        echo "
                            </tr>
                        ";
                    }
                }
            }else{
                $result0=mysqli_query($link,"SELECT * FROM AccionesCorrectivas");
                while ($fila0=mysqli_fetch_array($result0)){
                    echo "
                        <tr>
                    ";
                    echo "
                            <td>".$fila0['fecharegistro']."</td>
                    ";
                    if ($fila0['fuente']==="SE"){
                        $result2=mysqli_query($link,"SELECT * FROM ACSE WHERE idAccionesCorrectivas='".$fila0['idAccionesCorrectivas']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            $result3=mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE idObservacionesSE ='".$fila2['idObservacionesSE']."'");
                            while ($fila3=mysqli_fetch_array($result3)){
                                echo "
                                        <td>
                                            <form method='post'  action='detallesafetyeyes.php'>
                                                <input type='hidden' name='idSE' value='".$fila3['idSafetyEyes']."'>
                                                <input type='submit' name='detalleRegAC' value='".$fila3['idSafetyEyes']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                            }
                        }
                    }
                    if ($fila0['fuente']==="OC"){
                        $result2=mysqli_query($link,"SELECT * FROM ACOCUR WHERE idAccionesCorrectivas='".$fila0['idAccionesCorrectivas']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                        <td>
                                            <form method='post' action='detalleOcurrencia.php'>
                                                <input type='hidden' name='idOCUR' value='".$fila2['idOcurrencias']."'>
                                                <input type='submit' name='detalleRegAC' value='".$fila2['idOcurrencias']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                        }
                    }
                    if ($fila0['fuente']==="INC"){
                        $result2=mysqli_query($link,"SELECT * FROM ACINC WHERE idAccionesCorrectivas='".$fila0['idAccionesCorrectivas']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                        <td>
                                            <form method='post' action='detalleIncidente.php'>
                                                <input type='hidden' name='idINC' value='".$fila2['idIncidentes']."'>
                                                <input type='submit' name='detalleRegAC' value='".$fila2['idIncidentes']."' class='btn-link'>
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
                            <td>".$fila0['fechaPlan']."</td>
                            <td>".$fila0['fechaReal']."</td>
                            <td>".$fila0['fechaactualizacion']."</td>
                        ";
                    $result2=mysqli_query($link,"SELECT * FROM EstadoACMS WHERE idEstado='".$fila0['idEstado']."'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        echo "
                                    <td>".$fila2['descripcion']."</td>
                                ";
                    }
                    echo "
                            <td>
                                <form method='post'>
                                    <input type='hidden' value='".$fila0['idAccionesCorrectivas']."' name='idAC'>
                                    <input type='submit' class='btn-link' value='Seguimiento' formaction='seguimientoAC.php'>
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