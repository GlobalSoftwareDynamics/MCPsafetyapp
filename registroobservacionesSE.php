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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

    <script>
        function getinputbusqueda(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:{'registrosobservSEcolumna':val},
                success: function(data){
                    $("#busqueda").html(data);
                }
            });
        }
    </script>

</head>

<body>
<header>
    <nav>
    </nav>
</header>

<section class="container">
    <div>
        <form action="registroobservacionesSE.php" method="post" class="form-horizontal">
            <div class="form-group">
                <div>
                    <label for="columna">Conlumna:</label>
                </div>
                <div>
                    <select id="columna" name="columna" onchange="getinputbusqueda(this.value)">
                        <option>Seleccionar</option>
                        <option value="idObservacionesSE">Código Obs.</option>
                        <option value="idSafetyEyes">Código SE</option>
                        <option value="idCategoria">Categoría</option>
                        <option value="idClase">Clase</option>
                        <option value="descripcion">Descripción</option>
                        <option value="idCOPs">COP</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="detalle">Busqueda:</label>
                </div>
                <div id="busqueda">
                    <input type="text" name="busqueda" id="detalle">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" name="filtrar" value="Filtrar Tabla">
                <input type="submit" class="btn btn-success" name="eliminarFiltro" value="Quitar Filtro">
            </div>
        </form>
    </div>
</section>
<section class="container">
    <form method="post" class="form-horizontal">
        <div class="form-group">
            <input type="submit" formaction="registrosSE.php" value="Regresar" class="btn btn-default">
        </div>
    </form>
</section>
<hr>
<section class="container">
    <div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Código Obs.</th>
                <th>Código SE</th>
                <th>Categoría</th>
                <th>Clase</th>
                <th>Descripción</th>
                <th>COP</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_POST['filtrar'])&&isset($_POST['columna'])&&isset($_POST['busqueda'])){
                if ($_POST['columna']==="idCategoria"||$_POST['columna']==="idClase"||$_POST['columna']==="idCOPs"){
                    echo "
                        <tr>
                    ";
                    $result0=mysqli_query($link,"SELECT * FROM observacionesse WHERE ".$_POST['columna']." ='".$_POST['busqueda']."'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        echo "
                            <td>".$fila0['idObservacionesSE']."</td>
                            <td>".$fila0['idSafetyEyes']."</td>
                        ";
                        $result1=mysqli_query($link,"SELECT * FROM categoria WHERE idCategoria='".$fila0['idCategoria']."'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <td>".$fila1['siglas']."</td>
                            ";
                        }
                        $result3=mysqli_query($link,"SELECT * FROM clase WHERE idClase='".$fila0['idClase']."'");
                        while ($fila3=mysqli_fetch_array($result3)){
                            echo "
                                <td>".$fila3['siglas']."</td>
                            ";
                        }
                        echo "
                            <td>".$fila0['descripcion']."</td>
                        ";
                        $result2=mysqli_query($link,"SELECT * FROM COPs WHERE idCOPs='".$fila0['idCOPs']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                <td>".$fila2['descripcion']."</td>
                            ";
                        }
                        echo "
                            <td>
                                <form method='post'>
                                    <input type='hidden' value='".$fila0['idSafetyEyes']."' name='idSE'>
                                    <input type='submit' class='btn btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
                                </form>
                            </td>
                        ";
                        echo "
                            </tr>
                        ";
                    }
                }else{
                    echo "
                        <tr>
                    ";
                    $result0=mysqli_query($link,"SELECT * FROM observacionesse WHERE ".$_POST['columna']." LIKE '%".$_POST['busqueda']."%'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        echo "
                            <td>".$fila0['idObservacionesSE']."</td>
                            <td>".$fila0['idSafetyEyes']."</td>
                        ";
                        $result1=mysqli_query($link,"SELECT * FROM categoria WHERE idCategoria='".$fila0['idCategoria']."'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <td>".$fila1['siglas']."</td>
                            ";
                        }
                        $result3=mysqli_query($link,"SELECT * FROM clase WHERE idClase='".$fila0['idClase']."'");
                        while ($fila3=mysqli_fetch_array($result3)){
                            echo "
                                <td>".$fila3['siglas']."</td>
                            ";
                        }
                        echo "
                            <td>".$fila0['descripcion']."</td>
                        ";
                        $result2=mysqli_query($link,"SELECT * FROM COPs WHERE idCOPs='".$fila0['idCOPs']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                <td>".$fila2['descripcion']."</td>
                            ";
                        }
                        echo "
                            <td>
                                <form method='post'>
                                    <input type='hidden' value='".$fila0['idSafetyEyes']."' name='idSE'>
                                    <input type='submit' class='btn btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
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
                $result0=mysqli_query($link,"SELECT * FROM observacionesse");
                while ($fila0=mysqli_fetch_array($result0)){
                    echo "
                            <td>".$fila0['idObservacionesSE']."</td>
                            <td>".$fila0['idSafetyEyes']."</td>
                        ";
                    $result1=mysqli_query($link,"SELECT * FROM categoria WHERE idCategoria='".$fila0['idCategoria']."'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        echo "
                                <td>".$fila1['siglas']."</td>
                            ";
                    }
                    $result3=mysqli_query($link,"SELECT * FROM clase WHERE idClase='".$fila0['idClase']."'");
                    while ($fila3=mysqli_fetch_array($result3)){
                        echo "
                                <td>".$fila3['siglas']."</td>
                            ";
                    }
                    echo "
                            <td>".$fila0['descripcion']."</td>
                        ";
                    $result2=mysqli_query($link,"SELECT * FROM COPs WHERE idCOPs='".$fila0['idCOPs']."'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        echo "
                             <td>".$fila2['descripcion']."</td>
                        ";
                    }
                    echo "
                            <td>
                                <form method='post'>
                                    <input type='hidden' value='".$fila0['idSafetyEyes']."' name='idSE'>
                                    <input type='submit' class='btn btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
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
</footer>
</body>

<?php
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>