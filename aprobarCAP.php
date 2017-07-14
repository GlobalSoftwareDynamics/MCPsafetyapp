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
                data:{'registrosCAPcolumna':val},
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
if (isset($_POST['rechazar'])){
    $rechazo="DELETE FROM InvolucradosCAP WHERE idCAP = '".$_POST['idCAP']."'";
    $query=mysqli_query($link,$rechazo);
    $rechazo="DELETE FROM CAP WHERE idCAP = '".$_POST['idCAP']."'";
    $query=mysqli_query($link,$rechazo);
}
?>
<section class="container">
    <form action="aprobarCAP.php" method="post" class="form-horizontal jumbotron col-md-12 col-xs-12">
        <div class="form-group col-md-4">
            <div class="col-md-4">
                <label for="columna" class="control-label">Columna:</label>
            </div>
            <div class="col-md-8">
                <select id="columna" name="columna" class="col-xs-12 form-control" onchange="getinputbusqueda(this.value)">
                    <option>Seleccionar</option>
                    <option value="fecha">Fecha</option>
                    <option value="anoFiscal">Año Fiscal</option>
                    <option value="idCAP">Código</option>
                    <option value="reportante">Reportante</option>
                    <option value="felicitado">Felicitado</option>
                    <option value="idComportamiento">Comportamiento</option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-4">
            <div class="col-md-4">
                <label for="detalle" class="control-label">Busqueda:</label>
            </div>
            <div id="busqueda" class="col-md-8">
                <input type="text" name="busqueda" id="detalle" class="col-xs-12 form-control">
            </div>
        </div>
        <div class="form-group col-md-4">
            <div class="col-md-6">
                <input type="submit" class="btn btn-success col-md-12 col-xs-12" name="filtrar" value="Filtrar Tabla">
            </div>
            <div class="col-md-6">
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
                <th>Reportante</th>
                <th>Felicitado</th>
                <th style="width: 30%">Descripción</th>
                <th>Comportamiento</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_POST['filtrar'])&&isset($_POST['columna'])&&isset($_POST['busqueda'])){
                if ($_POST['columna']==="reportante"){
                    echo "
                        <tr>
                    ";
                    $result0=mysqli_query($link,"SELECT * FROM Colaboradores WHERE apellidos LIKE '%".$_POST['busqueda']."%'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result=mysqli_query($link,"SELECT * FROM InvolucradosCAP WHERE dni='".$fila0['dni']."' AND idTipoParticipante = '4'");
                        while ($fila=mysqli_fetch_array($result)){
                            $result1=mysqli_query($link,"SELECT * FROM CAP WHERE estado='Pendiente' AND idCAP = '".$fila['idCAP']."' ORDER BY fecha DESC");
                            while ($fila1=mysqli_fetch_array($result1)){
                                echo "
                                    <td>".$fila1['fecha']."</td>
                                    <td>".$fila1['idCAP']."</td>
                                ";
                                $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila['dni']."'");
                                while ($fila3=mysqli_fetch_array($result3)){
                                    echo "
                                        <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                                    ";
                                }
                                $result2=mysqli_query($link,"SELECT * FROM InvolucradosCAP WHERE idCAP='".$fila1['idCAP']."' AND idTipoParticipante ='5'");
                                while ($fila2=mysqli_fetch_array($result2)){
                                    $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila2['dni']."'");
                                    while ($fila3=mysqli_fetch_array($result3)){
                                        echo "
                                            <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                                        ";
                                    }
                                }
                                echo "
                                    <td class='text-left'>".$fila1['descripcion']."</d>
                                ";
                                $result2=mysqli_query($link,"SELECT * FROM Comportamiento WHERE idComportamiento ='".$fila1['idComportamiento']."'");
                                while ($fila=mysqli_fetch_array($result2)){
                                    echo "
                                        <td>".$fila['descripcion']."</td>
                                    ";
                                }
                                echo "
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' value='".$fila1['idCAP']."' name='idCAP'>
                                            <input type='submit' class='btn-link' value='Detalle' formaction='detalleCAP.php'>
                                        </form>
                                    </td>
                                ";
                                echo "
                                    </tr>
                                ";
                            }
                        }
                    }
                }elseif ($_POST['columna']==="felicitado"){
                    echo "
                        <tr>
                    ";
                    $result0=mysqli_query($link,"SELECT * FROM Colaboradores WHERE apellidos LIKE '%".$_POST['busqueda']."%'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result=mysqli_query($link,"SELECT * FROM InvolucradosCAP WHERE dni='".$fila0['dni']."' AND idTipoParticipante = '5'");
                        while ($fila=mysqli_fetch_array($result)){
                            $result1=mysqli_query($link,"SELECT * FROM CAP WHERE estado='Pendiente' AND idCAP = '".$fila['idCAP']."' ORDER BY fecha DESC");
                            while ($fila1=mysqli_fetch_array($result1)){
                                echo "
                                    <td>".$fila1['fecha']."</td>
                                    <td>".$fila1['idCAP']."</td>
                                ";
                                $result2=mysqli_query($link,"SELECT * FROM InvolucradosCAP WHERE idCAP='".$fila1['idCAP']."' AND idTipoParticipante ='4'");
                                while ($fila2=mysqli_fetch_array($result2)){
                                    $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila2['dni']."'");
                                    while ($fila3=mysqli_fetch_array($result3)){
                                        echo "
                                            <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                                        ";
                                    }
                                }
                                $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila['dni']."'");
                                while ($fila3=mysqli_fetch_array($result3)){
                                    echo "
                                        <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                                    ";
                                }
                                echo "
                                    <td class='text-left'>".$fila1['descripcion']."</d>
                                ";
                                $result2=mysqli_query($link,"SELECT * FROM Comportamiento WHERE idComportamiento ='".$fila1['idComportamiento']."'");
                                while ($fila=mysqli_fetch_array($result2)){
                                    echo "
                                        <td>".$fila['descripcion']."</td>
                                    ";
                                }
                                echo "
                                    <td>
                                        <form method='post'>
                                            <input type='hidden' value='".$fila1['idCAP']."' name='idCAP'>
                                            <input type='submit' class='btn-link' value='Detalle' formaction='detalleCAP.php'>
                                        </form>
                                    </td>
                                ";
                                echo "
                                    </tr>
                                ";
                            }
                        }
                    }
                }elseif ($_POST['columna']==="idComportamiento"){
                    echo "
                        <tr>
                    ";
                    $result0=mysqli_query($link,"SELECT * FROM Comportamiento WHERE idComportamiento = '".$_POST['busqueda']."'");
                    while ($fila0=mysqli_fetch_array($result0)){
                        $result1=mysqli_query($link,"SELECT * FROM CAP WHERE idComportamiento ='".$fila0['idComportamiento']."'  AND estado='Pendiente' ORDER BY fecha DESC");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <td>".$fila1['fecha']."</td>
                                <td>".$fila1['idCAP']."</td>
                            ";
                            $result2=mysqli_query($link,"SELECT * FROM InvolucradosCAP WHERE idCAP='".$fila1['idCAP']."' AND idTipoParticipante ='4'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila2['dni']."'");
                                while ($fila3=mysqli_fetch_array($result3)){
                                    echo "
                                    <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                                ";
                                }
                            }
                            $result2=mysqli_query($link,"SELECT * FROM InvolucradosCAP WHERE idCAP='".$fila1['idCAP']."' AND idTipoParticipante ='5'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila2['dni']."'");
                                while ($fila3=mysqli_fetch_array($result3)){
                                    echo "
                                    <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                                ";
                                }
                            }
                            echo "
                                <td class='text-left'>".$fila1['descripcion']."</td>
                                <td>".$fila0['descripcion']."</td>
                            ";
                            echo "
                                <td>
                                    <form method='post'>
                                        <input type='hidden' value='".$fila1['idCAP']."' name='idCAP'>
                                        <input type='submit' class='btn-link' value='Detalle' formaction='detalleCAP.php'>
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
                    $result0=mysqli_query($link,"SELECT * FROM CAP WHERE ".$_POST['columna']." LIKE '%".$_POST['busqueda']."%'  AND estado='Pendiente' ORDER BY fecha DESC");
                    while ($fila0=mysqli_fetch_array($result0)){
                        echo "
                            <td>".$fila0['fecha']."</td>
                            <td>".$fila0['idCAP']."</td>
                        ";
                        $result2=mysqli_query($link,"SELECT * FROM InvolucradosCAP WHERE idCAP='".$fila0['idCAP']."' AND idTipoParticipante ='4'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila2['dni']."'");
                            while ($fila3=mysqli_fetch_array($result3)){
                                echo "
                                    <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                                ";
                            }
                        }
                        $result2=mysqli_query($link,"SELECT * FROM InvolucradosCAP WHERE idCAP='".$fila0['idCAP']."' AND idTipoParticipante ='5'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila2['dni']."'");
                            while ($fila3=mysqli_fetch_array($result3)){
                                echo "
                                    <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                                ";
                            }
                        }
                        echo "
                            <td class='text-left'>".$fila0['descripcion']."</td>
                        ";
                        $result2=mysqli_query($link,"SELECT * FROM Comportamiento WHERE idComportamiento ='".$fila0['idComportamiento']."'");
                        while ($fila=mysqli_fetch_array($result2)){
                            echo "
                            <td>".$fila['descripcion']."</td>
                        ";
                        }
                        echo "
                            <td>
                                <form method='post'>
                                    <input type='hidden' value='".$fila0['idCAP']."' name='idCAP'>
                                    <input type='submit' class='btn-link' value='Detalle' formaction='detalleCAP.php'>
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
                $result0=mysqli_query($link,"SELECT * FROM CAP WHERE estado='Pendiente' ORDER BY fecha DESC");
                while ($fila0=mysqli_fetch_array($result0)){
                    echo "
                            <td>".$fila0['fecha']."</td>
                            <td>".$fila0['idCAP']."</td>
                        ";
                    $result2=mysqli_query($link,"SELECT * FROM InvolucradosCAP WHERE idCAP='".$fila0['idCAP']."' AND idTipoParticipante ='4'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila2['dni']."'");
                        while ($fila3=mysqli_fetch_array($result3)){
                            echo "
                                    <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                                ";
                        }
                    }
                    $result2=mysqli_query($link,"SELECT * FROM InvolucradosCAP WHERE idCAP='".$fila0['idCAP']."' AND idTipoParticipante ='5'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila2['dni']."'");
                        while ($fila3=mysqli_fetch_array($result3)){
                            echo "
                                    <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                                ";
                        }
                    }
                    echo "
                            <td class='text-left'>".$fila0['descripcion']."</td>
                        ";
                    $result2=mysqli_query($link,"SELECT * FROM Comportamiento WHERE idComportamiento ='".$fila0['idComportamiento']."'");
                    while ($fila=mysqli_fetch_array($result2)){
                        echo "
                            <td>".$fila['descripcion']."</td>
                        ";
                    }
                    echo "
                            <td>
                                <form method='post'>
                                    <input type='hidden' value='".$fila0['idCAP']."' name='idCAP'>
                                    <input type='submit' class='btn-link' value='Detalle' formaction='detalleCAP.php'>
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