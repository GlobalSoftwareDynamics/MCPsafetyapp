<!DOCTYPE html>

<html lang="es">

<?php
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
    <?php
    include_once('navbarmainAdmin.php');
    ?>
</header>

<section class="container">
    <div>
        <form action="registroobservacionesSE.php" method="post" class="form-horizontal jumbotron col-md-12 col-xs-12">
            <div class="form-group col-md-4 col-xs-12">
                <div class="col-md-4 col-xs-12">
                    <label for="columna" class="control-label">Conlumna:</label>
                </div>
                <div class="col-md-8 col-xs-12">
                    <select id="columna" class="col-xs-12 form-control" name="columna" onchange="getinputbusqueda(this.value)">
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
    <form method="post" class="form-horizontal col-xs-12 col-md-12">
        <div class="form-group col-xs-12 col-md-12">
            <input type="submit" class="btn btn-default col-md-4 col-md-offset-4 col-xs-12" formaction="registrosSE.php" value="Regresar">
        </div>
    </form>
</section>
<hr>
<section class="container-fluid">
    <div>
        <table class="table table-hover text-center">
            <thead>
            <tr>
                <th>Código Obs.</th>
                <th>Código SE</th>
                <th>Categoría</th>
                <th>Clase</th>
                <th style="width: 30%">Descripción</th>
                <th>COP</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_POST['filtrar'])&&isset($_POST['columna'])&&isset($_POST['busqueda'])){
                if ($_POST['columna']==="idCategoria"||$_POST['columna']==="idClase"||$_POST['columna']==="idCOPs"){
                    $result0=mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE ".$_POST['columna']." ='".$_POST['busqueda']."' AND idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE estado = 'Aprobado')");
                    while ($fila0=mysqli_fetch_array($result0)){
                        echo "
                            <tr>
                        ";
                        echo "
                            <td>".$fila0['idObservacionesSE']."</td>
                            <td>".$fila0['idSafetyEyes']."</td>
                        ";
                        $result1=mysqli_query($link,"SELECT * FROM Categoria WHERE idCategoria='".$fila0['idCategoria']."'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <td>".$fila1['siglas']."</td>
                            ";
                        }
                        $result3=mysqli_query($link,"SELECT * FROM Clase WHERE idClase='".$fila0['idClase']."'");
                        while ($fila3=mysqli_fetch_array($result3)){
                            echo "
                                <td>".$fila3['siglas']."</td>
                            ";
                        }
                        echo "
                            <td class='text-left'>".$fila0['descripcion']."</td>
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
                                    <input type='submit' name='detalleRegObs' class='btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
                                </form>
                            </td>
                        ";
                        echo "
                            </tr>
                        ";
                    }
                }else{
                    $result0=mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE ".$_POST['columna']." LIKE '%".$_POST['busqueda']."%' AND idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE estado = 'Aprobado')");
                    while ($fila0=mysqli_fetch_array($result0)){
                        echo "
                            <tr>
                        ";
                        echo "
                            <td>".$fila0['idObservacionesSE']."</td>
                            <td>".$fila0['idSafetyEyes']."</td>
                        ";
                        $result1=mysqli_query($link,"SELECT * FROM Categoria WHERE idCategoria='".$fila0['idCategoria']."'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <td>".$fila1['siglas']."</td>
                            ";
                        }
                        $result3=mysqli_query($link,"SELECT * FROM Clase WHERE idClase='".$fila0['idClase']."'");
                        while ($fila3=mysqli_fetch_array($result3)){
                            echo "
                                <td>".$fila3['siglas']."</td>
                            ";
                        }
                        echo "
                            <td class='text-left'>".$fila0['descripcion']."</td>
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
                                    <input type='submit' name='detalleRegObs' class='btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
                                </form>
                            </td>
                        ";
                        echo "
                            </tr>
                        ";
                    }
                }
            }else{
                $result0=mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE estado = 'Aprobado')");
                while ($fila0=mysqli_fetch_array($result0)){
                    echo "
                        <tr>
                    ";
                    echo "
                            <td>".$fila0['idObservacionesSE']."</td>
                            <td>".$fila0['idSafetyEyes']."</td>
                        ";
                    $result1=mysqli_query($link,"SELECT * FROM Categoria WHERE idCategoria='".$fila0['idCategoria']."'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        echo "
                                <td>".$fila1['siglas']."</td>
                            ";
                    }
                    $result3=mysqli_query($link,"SELECT * FROM Clase WHERE idClase='".$fila0['idClase']."'");
                    while ($fila3=mysqli_fetch_array($result3)){
                        echo "
                                <td>".$fila3['siglas']."</td>
                            ";
                    }
                    echo "
                            <td class='text-left'>".$fila0['descripcion']."</td>
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
                                    <input type='submit' name='detalleRegObs' class='btn-link' value='Detalle' formaction='detallesafetyeyes.php'>
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