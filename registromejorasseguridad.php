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
    <link href="css/Formularios.css" rel="stylesheet">
    <link href="css/Tablas.css" rel="stylesheet">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script>
        function getinputbusqueda(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'registrosMScolumna':val},
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
if (isset($_POST['crearms'])){
    $agregar="INSERT INTO mejorasseguridad(idMejoras, dni, fecharegistro, descripcion, fuente, fechaactualizacion, estado) VALUES (
    '".$_POST['idmejora']."','".$_POST['responsable']."','".$_POST['fecharegistro']."','".$_POST['descripcionms']."','SE','-','Pendiente'
    )";
    $query=mysqli_query($link,$agregar);
    $agregar="INSERT INTO mese(idSafetyEyes, idMejoras) VALUES (
    '".$_POST['idreporte']."','".$_POST['idmejora']."'
    )";
    $query=mysqli_query($link,$agregar);
}
if (isset($_POST['crearmsconid'])){
    $agregar="INSERT INTO mejorasseguridad(idMejoras, dni, fecharegistro, descripcion, fuente, fechaactualizacion, estado) VALUES (
    '".$_POST['idmejora']."','".$_POST['responsable']."','".$_POST['fecharegistro']."','".$_POST['descripcionms']."','SE','-','Pendiente'
    )";
    $query=mysqli_query($link,$agregar);
    $agregar="INSERT INTO mese(idSafetyEyes, idMejoras) VALUES (
    '".$_POST['idreporte']."','".$_POST['idmejora']."'
    )";
    $query=mysqli_query($link,$agregar);
}
if (isset($_POST['completar'])){
    date_default_timezone_set('America/Lima');
    $fecha = date('d/m/Y');
    $actualizar="UPDATE mejorasseguridad SET estado = 'Completa' WHERE idMejoras = '".$_POST['idME']."'";
    $query=mysqli_query($link,$actualizar);
    $actualizar="UPDATE mejorasseguridad SET fechaactualizacion = '".$fecha."' WHERE idMejoras = '".$_POST['idME']."'";
    $query=mysqli_query($link,$actualizar);
}
?>
<section class="container">
    <div>
        <form action="registromejorasseguridad.php" method="post" class="form-horizontal jumbotron col-sm-12">
            <div class="form-group col-sm-4">
                <div class="col-sm-4">
                    <label for="columna" class="formlabels col-sm-12">Columna:</label>
                </div>
                <div class="col-sm-8">
                    <select id="columna" class="ddselect-12 form-control" name="columna" onchange="getinputbusqueda(this.value)">
                        <option>Seleccionar</option>
                        <option value="fecharegistro">Fecha</option>
                        <option value="fuente">Fuente</option>
                        <option value="dni">Proponente</option>
                        <option value="descripcion">Descripción</option>
                        <option value="estado">Estado</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-sm-4">
                <div class="col-sm-4">
                    <label for="detalle" class="formlabels col-sm-12">Busqueda:</label>
                </div>
                <div id="busqueda" class="col-sm-8">
                    <input type="text" class="textinput-12 col-sm-12" name="busqueda" id="detalle">
                </div>
            </div>
            <div class="form-group col-sm-4">
                <input type="submit" class="btn btn-success col-sm-5 col-sm-offset-1 boton" name="filtrar" value="Filtrar Tabla">
                <input type="submit" class="btn btn-default col-sm-5 col-sm-offset-1 boton" name="eliminarFiltro" value="Quitar Filtro">
            </div>
        </form>
    </div>
</section>
<section class="container">
    <form method="post" class="form-horizontal col-sm-12">
        <div class="form-group">
            <input type="submit" formaction="crearnuevaMS.php" value="Registrar Nueva Mejora de Seguridad" class="btn btn-primary col-sm-4 col-sm-offset-4">
        </div>
    </form>
</section>
<hr>
<section class="container">
    <div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Fecha de Registro</th>
                <th>Fuente</th>
                <th>Descripción</th>
                <th>Proponente</th>
                <th>Estado</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_POST['filtrar'])&&isset($_POST['columna'])&&isset($_POST['busqueda'])){
                if ($_POST['columna']==="dni"){
                    echo "
                        <tr>
                    ";
                    $result0=mysqli_query($link,"SELECT * FROM colaboradores WHERE apellidos LIKE '%".$_POST['busqueda']."%'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result=mysqli_query($link,"SELECT * FROM mejorasseguridad WHERE dni='".$fila0['dni']."'");
                        while ($fila=mysqli_fetch_array($result)){
                            echo "
                                <td>".$fila['fecharegistro']."</td>
                            ";
                            if ($fila['fuente']==="SE"){
                                $result2=mysqli_query($link,"SELECT * FROM mese WHERE idMejoras='".$fila['idMejoras']."'");
                                while ($fila2=mysqli_fetch_array($result2)){
                                    echo "
                                        <td>
                                            <form method='post' action='detallesafetyeyes.php'>
                                                <input type='hidden' name='idSE' value='".$fila2['idSafetyEyes']."'>
                                                <input type='submit' name='detalle' value='".$fila2['idSafetyEyes']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                                }
                            }
                            if ($fila['fuente']==="OC"){
                                $result2=mysqli_query($link,"SELECT * FROM meocur WHERE idMejoras='".$fila['idMejoras']."'");
                                while ($fila2=mysqli_fetch_array($result2)){
                                    echo "
                                        <td>
                                            <form method='post'>
                                                <input type='hidden' name='idOC' value='".$fila2['idOcurrencias']."'>
                                                <input type='submit' name='detalle' value='".$fila2['idOcurrencias']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                                }
                            }
                            echo "
                                <td class='descripcion'>".$fila['descripcion']."</td>
                                <td>".$fila0['nombre']." ".$fila0['apellidos']."</td>
                                <td>".$fila['estado']."</td>
                            ";
                            echo "
                                <td>
                                    <form method='post'>
                                        <input type='hidden' value='".$fila['idMejoras']."' name='idME'>
                                        <input type='submit' name='completar' class='btn-link' value='Completar' formaction='registromejorasseguridad.php'>
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
                    $result0=mysqli_query($link,"SELECT * FROM mejorasseguridad WHERE ".$_POST['columna']." LIKE '%".$_POST['busqueda']."%'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        echo "
                            <td>".$fila0['fecharegistro']."</td>
                        ";
                        if ($fila0['fuente']==="SE"){
                            $result2=mysqli_query($link,"SELECT * FROM ,mese WHERE idMejoras='".$fila0['idMejoras']."'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                        <td>
                                            <form method='post' action='detallesafetyeyes.php'>
                                                <input type='hidden' name='idSE' value='".$fila2['idSafetyEyes']."'>
                                                <input type='submit' name='detalle' value='".$fila2['idSafetyEyes']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                            }
                        }
                        if ($fila0['fuente']==="OC"){
                            $result2=mysqli_query($link,"SELECT * FROM meocur WHERE idMejoras='".$fila0['idMejoras']."'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                        <td>
                                            <form method='post'>
                                                <input type='hidden' name='idOC' value='".$fila2['idOcurrencias']."'>
                                                <input type='submit' name='detalle' value='".$fila2['idOcurrencias']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                            }
                        }
                        echo "
                            <td class='descripcion'>".$fila0['descripcion']."</td>
                        ";
                        $result3=mysqli_query($link,"SELECT * FROM colaboradores WHERE dni='".$fila0['dni']."'");
                        while ($fila3=mysqli_fetch_array($result3)){
                            echo "
                            <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                        ";
                        }
                        echo "
                            <td>".$fila0['estado']."</td>
                        ";
                        echo "
                            <td>
                                <form method='post'>
                                    <input type='hidden' value='".$fila0['idMejoras']."' name='idME'>
                                    <input type='submit' name='completar' class='btn-link' value='Completar' formaction='registromejorasseguridad.php'>
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
                $result0=mysqli_query($link,"SELECT * FROM mejorasseguridad");
                while ($fila0=mysqli_fetch_array($result0)){
                    echo "
                            <td>".$fila0['fecharegistro']."</td>
                    ";
                    if ($fila0['fuente']==="SE"){
                        $result2=mysqli_query($link,"SELECT * FROM mese WHERE idMejoras='".$fila0['idMejoras']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                        <td>
                                            <form method='post' action='detallesafetyeyes.php'>
                                                <input type='hidden' name='idSE' value='".$fila2['idSafetyEyes']."'>
                                                <input type='submit' name='detalle' value='".$fila2['idSafetyEyes']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                        }
                    }
                    if ($fila0['fuente']==="OC"){
                        $result2=mysqli_query($link,"SELECT * FROM meocur WHERE idMejoras='".$fila0['idMejoras']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                        <td>
                                            <form method='post'>
                                                <input type='hidden' name='idOC' value='".$fila2['idOcurrencias']."'>
                                                <input type='submit' name='detalle' value='".$fila2['idOcurrencias']."' class='btn-link'>
                                            </form>
                                        </td>
                                    ";
                        }
                    }
                    echo "
                            <td class='descripcion'>".$fila0['descripcion']."</td>
                        ";
                    $result3=mysqli_query($link,"SELECT * FROM colaboradores WHERE dni='".$fila0['dni']."'");
                    while ($fila3=mysqli_fetch_array($result3)){
                        echo "
                            <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                        ";
                    }
                    echo "
                            <td>".$fila0['estado']."</td>
                        ";
                    echo "
                            <td>
                                <form method='post'>
                                    <input type='hidden' value='".$fila0['idMejoras']."' name='idME'>
                                    <input type='submit' name='completar' class='btn-link' value='Completar' formaction='registromejorasseguridad.php'>
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
    <div class="container col-sm-6 col-sm-offset-3 text-center">
        <span>© 2017 by Global Software Dynamics.<br>Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
    </div>
</footer>
</body>

<?php
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>