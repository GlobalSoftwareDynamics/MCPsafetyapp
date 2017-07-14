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
    <link href="css/Formatos.css" rel="stylesheet">
</head>

<body>
<header>
    <?php
    include_once('navbarmainAdmin.php');
    ?>
</header>
<?php
if (isset($_POST['aprobar'])){
    $aprobar="UPDATE Ocurrencias SET estado = 'Aprobado' WHERE idOcurrencias = '".$_POST['idOCUR']."'";
    $query=mysqli_query($link,$aprobar);
}
?>
<section class="container-fluid">
    <div class="container col-md-6 col-md-offset-3 col-xs-12 bordes">
        <div class="col-md-12">
            <div class="col-md-8 hidden-xs">
                <div class="col-md-12">
                    <img width="auto" height="80" src="image/Logo.png" style="margin-top: 5px; margin-bottom: 5px">
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="col-md-12">
                    <h4 class="titulo text-center">Reporte de Ocurrencias</h4>
                </div>
                <div class="col-md-12">
                    <h5 class="desctitulo text-center"><?php echo $_POST['idOCUR'];?></h5>
                </div>
            </div>
        </div>
        <hr>
        <?php
        $result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE idOcurrencias='".$_POST['idOCUR']."'");
        while ($fila=mysqli_fetch_array($result)) {
        ?>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th class="text-left" colspan="3">Datos de Reporte</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Año Fiscal</th>
            </tr>
            <tr>
                <td><?php echo $fila['fecha'];?></td>
                <td><?php echo $fila['hora'];?></td>
                <td><?php echo $fila['anoFiscal'];?></td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>Ubicación</th>
                <th>Planta</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $result1=mysqli_query($link,"SELECT * FROM Ubicacion WHERE idUbicacion = '{$fila['idUbicacion']}'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        $result2=mysqli_query($link,"SELECT * FROM Planta WHERE idPlanta ='{$fila1['idPlanta']}'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                <td>".$fila1['descripcion']."</td>
                                <td>".$fila2['descripcion']."</td>
                            ";
                        }
                    }
                    ?>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered text-center">
            <tbody>
            <tr>
                <th>Clase</th>
            <?php
            $result1=mysqli_query($link,"SELECT * FROM Clase WHERE idClase='".$fila['idClase']."'");
            while ($fila1=mysqli_fetch_array($result1)) {
                echo "
                    <td>".$fila1['descripcion']."</td>
                </tr>
            ";
            }
            ?>
            </tbody>
        </table>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th class="text-left" colspan="2">Involucrados</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result1=mysqli_query($link,"SELECT * FROM InvolucradosOCUR WHERE idOcurrencias='".$fila['idOcurrencias']."' AND idTipoParticipante ='4'");
            while ($fila1=mysqli_fetch_array($result1)) {
                $result2=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni ='".$fila1['dni']."'");
                while ($fila2=mysqli_fetch_array($result2)){
                    echo "
                        <tr>
                            <th>Reportado Por</th>
                            <td>".$fila2['nombre']." ".$fila2['apellidos']."</td>
                        </tr>
                    ";
                }
            }
            echo "
                    <tr>
                        <th>Reportando A:</th>
                        <td>
            ";
            $fragmento="";
            $result1=mysqli_query($link,"SELECT * FROM InvolucradosOCUR WHERE idOcurrencias='".$fila['idOcurrencias']."' AND idTipoParticipante ='6'");
            while ($fila1=mysqli_fetch_array($result1)) {
                $result2=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni ='".$fila1['dni']."'");
                while ($fila2=mysqli_fetch_array($result2)){
                    echo "<p>".$fila2['nombre']." ".$fila2['apellidos']."</p>";
                }
            }
            echo "
                    </td>
            ";
            echo "
                </tr>
            ";
            ?>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-left">Descripción</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result1=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE idOcurrencias='".$fila['idOcurrencias']."'");
            while ($fila1=mysqli_fetch_array($result1)) {
                echo "
                    <tr>
                        <td class='text-justify'>".$fila1['descripcion']."</td>
                    </tr>
                ";
            }
            ?>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-left">Acciones Inmediatas</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
            <?php
            $result1=mysqli_query($link,"SELECT * FROM AIOCUR WHERE idOcurrencias='".$fila['idOcurrencias']."'");
            while ($fila1=mysqli_fetch_array($result1)) {
                $result2=mysqli_query($link,"SELECT * FROM AccionesInmediatas WHERE idAccionesInmediatas = '{$fila1['idAccionesInmediatas']}'");
                while ($fila2=mysqli_fetch_array($result2)){
                    echo "
                        <p class='text-justify'>".$fila2['descripcion']."</p>
                ";
                }
            }
            ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-left">Fotografias</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            $dir = "Fotografias/Ocurrencias/{$_POST['idOCUR']}/";
            if ($handle = opendir($dir)) {
                while (($file = readdir($handle)) !== false){
                    if (!in_array($file, array('.', '..')) && !is_dir($dir.$file))
                        $i++;
                }
            }
            for($j=0;$j<$i;$j++){
                echo "<tr><td><img src='Fotografias/Ocurrencias/{$_POST['idOCUR']}/{$_POST['idOCUR']}-{$j}.jpg' alt='Evidencia{$j}' style='width:304px;height:228px;margin-bottom:20px;margin-left: 10px;margin-right: 65px;'></td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</section>
<?php
if($fila['idClase']==="6"&&$fila['estado']==="Pendiente"){
    echo "
                <br>
                <section class='container'>
                    <form action='crearRepInc.php' method='post' class='col-md-12 col-xs-12 form-horizontal'>
                        <input type='hidden' name='idOCUR' value='{$_POST['idOCUR']}'>
                        <input type='submit' value='Escalar a Incidente' name='escalar' class='btn btn-success col-md-4 col-md-offset-4 col-xs-12'>
                    </form>
                </section>
            ";
}
}
?>
<hr>
<section class="container">
    <?php
    $result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE idOcurrencias='".$_POST['idOCUR']."'");
    while ($fila=mysqli_fetch_array($result)){
        if($fila['estado']==="Pendiente"){
            echo "
                <form method='post' action='aprobarOCUR.php' class='form-horizontal col-md-12'>
                    <div class='form-group col-xs-12 col-md-12'>
                        <input type='hidden' name='idOCUR' value=".$_POST['idOCUR']. ">
                        <div class='col-md-3 col-xs-12'>
                            <input type='submit' class='btn btn-default col-md-12 col-xs-12' value='Regresar' name='Regresar'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-3 col-xs-12'>
                            <input type='submit' class='btn btn-default col-md-12 col-xs-12' value='Rechazar' name='rechazar'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-3 col-xs-12'>
                            <input type='submit' class='btn btn-success col-md-12 col-xs-12' value='Aprobar' name='aprobar' formaction='detalleOcurrencia.php'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-3 col-xs-12'>
                            <input type='submit' class='btn btn-primary col-md-12 col-xs-12' value='Generar PDF' name='pdf' formaction='detallesOcurrenciapdf.php'>
                        </div>
                    </div>
                </form>
            ";
        }else{
            echo "
                <form method='post' class='form-horizontal col-md-12'>
                    <div class='form-group col-xs-12 col-md-12'>
                        <input type='hidden' name='idOCUR' value=".$_POST['idOCUR'].">
                        ";
                if(isset($_POST['detalleRegOcur'])){
                    echo "
                        <div class='col-md-4 col-xs-12'>
                            <input type='submit' formaction='registrosOCUR.php' class='btn btn-default col-md-10 col-md-offset-1 col-xs-12' value='Regresar' name='Regresar'>
                        </div>
                    ";
                }
                if(isset($_POST['detalleRegAI'])){
                    echo "
                        <div class='col-md-4 col-xs-12'>
                            <input type='submit' formaction='registroaccionesinmediatas.php' class='btn btn-default col-md-10 col-md-offset-1 col-xs-12' value='Regresar' name='Regresar'>
                        </div>
                    ";
                }
                if(isset($_POST['detalleRegAC'])){
                    echo "
                        <div class='col-md-4 col-xs-12'>
                            <input type='submit' formaction='registrosaccionescorrectivas.php' class='btn btn-default col-md-10 col-md-offset-1 col-xs-12' value='Regresar' name='Regresar'>
                        </div>
                    ";
                }
                if(isset($_POST['detalleRegMS'])){
                    echo "
                        <div class='col-md-4 col-xs-12'>
                            <input type='submit' formaction='registromejorasseguridad.php' class='btn btn-default col-md-10 col-md-offset-1 col-xs-12' value='Regresar' name='Regresar'>
                        </div>
                    ";
                }
                if(isset($_POST['detalleRegMSconID'])){
                    echo "
                        <div class='col-md-4 col-xs-12'>
                            <input type='submit' formaction='registrosOCUR.php' class='btn btn-default col-md-10 col-md-offset-1 col-xs-12' value='Regresar' name='Regresar'>
                        </div>
                    ";
                }
                if(isset($_POST['detalleRegACconID'])){
                    echo "
                        <div class='col-md-4 col-xs-12'>
                            <input type='submit' formaction='registrosOCUR.php' class='btn btn-default col-md-10 col-md-offset-1 col-xs-12' value='Regresar' name='Regresar'>
                        </div>
                    ";
                }
                echo "
                        <div class=\"spacer5\"></div>
                        <div class='col-md-4 col-xs-12'>
                            <input type='submit' formaction='crearnuevaAC.php' class='btn btn-success col-md-10 col-md-offset-1 col-xs-12' value='Agregar Acciones Correctivas' name='provieneOCconID'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-4 col-xs-12'>
                            <input type='submit' class='btn btn-primary col-md-10 col-md-offset-1 col-xs-12' value='Generar PDF' name='pdf' formaction='detallesOcurrenciapdf.php'>
                        </div>
                    </div>
                </form>
            ";
        }
    }
    ?>
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