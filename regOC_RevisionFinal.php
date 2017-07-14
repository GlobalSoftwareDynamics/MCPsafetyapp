<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
include('funcionesApp.php');
if(isset($_SESSION['login'])&&(($_SESSION['usertype']=='1')||($_SESSION['usertype']=='2')||($_SESSION['usertype']=='5'))){
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
        if($_SESSION['usertype']=='1'||$_SESSION['usertype']=='2'){
            include_once('navbarmainSupervisor.php');
        }elseif($_SESSION['usertype']=='5'){
            include_once('navbarmainOperario.php');
        }
        ?>
    </header>
    <?php
    if(isset($_POST['cambios'])){
        $cambiar=mysqli_query($link,"UPDATE Ocurrencias SET idClase = '{$_POST['clase']}' WHERE idOcurrencias = '{$_POST['idOCUR']}'");
        $cambiar=mysqli_query($link,"UPDATE Ocurrencias SET descripcion = '{$_POST['descripcion']}' WHERE idOcurrencias = '{$_POST['idOCUR']}'");
    }
    ?>

    <section class="container-fluid">
        <div class="container col-md-6 col-md-offset-3 col-xs-12 bordes">
            <div class="col-md-12 col-xs-12">
                <div class="col-xs-12 col-md-12">
                    <div class="col-md-12 col-xs-12">
                        <h4 class="titulo text-center">Reporte de Ocurrencias</h4>
                    </div>
                    <div class="col-md-12 col-xs-12">
                        <h5 class="desctitulo text-center"><?php echo $_POST['idOCUR'];?></h5>
                    </div>
                </div>
            </div>
            <hr>
            <form method="post" action="regOC_ConfirmacionFinal.php" class="form-horizontal">
                <input type="hidden" name="idOCUR" value="<?php echo $_POST['idOCUR']?>" readonly>
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
                    <td>
                        <select name="clase" class="form-control col-xs-12 col-md-12">
                    <?php
                    $result1=mysqli_query($link,"SELECT * FROM Clase WHERE idClase='".$fila['idClase']."'");
                    while ($fila1=mysqli_fetch_array($result1)) {
                        echo "
                            <option selected='selected' value='{$fila['idClase']}'>{$fila1['descripcion']}</option>\";
                        ";
                        $query=mysqli_query($link,"SELECT * FROM Clase WHERE categoria = 'OC'");
                        while ($row=mysqli_fetch_array($query)){
                            echo "
                                <option value='{$row['idClase']}'>{$row['descripcion']}</option>
                            ";
                        }
                    }
                    ?>
                        </select>
                    </td>
                </tr>
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
                <div class="form-group">
                    <input type="submit" formaction="regOC_Involucrados.php" class="btn btn-success col-xs-12 col-md-8 col-md-offset-2" name="modificarInvol" value="Modificar Involucrados">
                </div>
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
                            <td class='text-justify'>
                                <textarea class='form-control' name='descripcion' rows='4' cols='110'>{$fila['descripcion']}</textarea>
                            </td>
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
            <div class="form-group">
                <input type="submit" formaction="regOC_AccionInmediata.php" class="btn btn-success col-xs-12 col-md-8 col-md-offset-2" name="modificarAI" value="Modificar Acciones Inmediatas">
            </div>
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
                    echo "<tr><td><img src='Fotografias/Ocurrencias/{$_POST['idOCUR']}/{$_POST['idOCUR']}-{$j}.jpg' alt='Evidencia{$j}' style='width:304px;height:228px;margin-left: 4cm;margin-right: 4cm;'></td></tr>";
                }
                ?>
                </tbody>
            </table>
                <div class="form-group">
                    <input type="submit" formaction="regOC_Evidencias.php" class="btn btn-success col-xs-12 col-md-8 col-md-offset-2" name="modificarEvidencias" value="Agregar Fotos">
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-left">Acciones Correctivas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM ACOCUR WHERE idOcurrencias='".$fila['idOcurrencias']."'");
                        while ($fila1=mysqli_fetch_array($result1)) {
                            $result2=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE idAccionesCorrectivas = '{$fila1['idAccionesCorrectivas']}'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                    <tr>
                                        <td class='text-justify'>".$fila2['descripcion']."</td>
                                    </tr>
                                ";
                            }
                        }
                        ?>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <input type="submit" formaction="regOC_AccionCorrectiva.php" class="btn btn-success col-xs-12 col-md-8 col-md-offset-2" name="modificarAC" value="Modificar Acciones Correctivas">
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-left">Mejoras de Seguridad</th>
                    </tr>
                    </thead>
                    <tbody>

                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM MEOCUR WHERE idOcurrencias='".$fila['idOcurrencias']."'");
                        while ($fila1=mysqli_fetch_array($result1)) {
                            $result2=mysqli_query($link,"SELECT * FROM MejorasSeguridad WHERE idMejoras = '{$fila1['idMejoras']}'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                    <tr>
                                        <td class='text-justify'>".$fila2['descripcion']."</td>
                                    </tr>
                                ";
                            }
                        }
                        ?>

                    </tbody>
                </table>
                <div class="form-group">
                    <input type="submit" formaction="regOC_MejorasSeguridad.php" class="btn btn-success col-xs-12 col-md-8 col-md-offset-2" name="modificarME" value="Modificar Mejoras de Seguridad">
                </div>
                <div class="form-group">
                    <input type="submit" formaction="regOC_RevisionFinal.php" class="btn btn-success col-xs-12 col-md-8 col-md-offset-2" name="cambios" value="Guardar Cambios">
                    <input type="submit" class="btn btn-primary col-xs-12 col-md-8 col-md-offset-2" name="finalizar" value="Finalizar">
                </div>
            </form>
        </div>
    </section>
    <?php
    }
    ?>

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