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
    $nombre =$_SESSION['login'];
    $result=mysqli_query($link,"SELECT * FROM Colaboradores WHERE usuario ='".$nombre."'");
    while ($fila=mysqli_fetch_array($result)){
        $persona=$fila['dni'];
    }
    $aprobar="UPDATE SafetyEyes SET estado = 'Aprobado' WHERE idSafetyEyes = '".$_POST['idSE']."'";
    $query=mysqli_query($link,$aprobar);
    $revisor="INSERT INTO ParticipantesSE(dni, idSafetyEyes, idTipoParticipante) VALUES (
    '".$persona."','".$_POST['idSE']."','3'
    )";
    $query=mysqli_query($link,$revisor);
}
?>
<section class="container-fluid">
    <div class="col-sm-8">
        <div class="col-sm-12">
            <img width="auto" height="100" src="image/Logo.png"/>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="col-sm-12">
            <h3 class="titulo text-center">Formulario Safety Eyes</h3>
        </div>
        <div class="col-sm-12">
            <h4 class="desctitulo text-center"><?php echo $_POST['idSE'];?></h4>
        </div>
    </div>
</section>
<hr>
<?php
$result=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idSafetyEyes='".$_POST['idSE']."'");
while ($fila=mysqli_fetch_array($result)) {
    ?>
    <section class="container bordes">
        <div>
            <h5>1. Datos de Ubicación</h5>
        </div>
    </section>
    <section class="container bordeslados">
            <div class="col-sm-6">
                <div class="col-sm-12">
                    <label for="planta">Planta:</label>
                    <span id="planta">
                        <?php
                        $result1 = mysqli_query($link, "SELECT * FROM Ubicacion WHERE idUbicacion='" . $fila['idUbicacion'] . "'");
                        while ($fila1 = mysqli_fetch_array($result1)) {
                            $result2 = mysqli_query($link, "SELECT * FROM Planta WHERE idPlanta='" . $fila1['idPlanta'] . "'");
                            while ($fila2 = mysqli_fetch_array($result2)) {
                                echo $fila2['descripcion'];
                            }
                        }
                        ?>
                    </span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-12">
                    <label for='ubicacion'>Ubicación:</label>
                    <span id="ubicacion">
                        <?php
                        $result1 = mysqli_query($link, "SELECT * FROM Ubicacion WHERE idUbicacion='" . $fila['idUbicacion'] . "'");
                        while ($fila1 = mysqli_fetch_array($result1)) {
                            echo $fila1['descripcion'];
                        }
                        ?>
                    </span>
                </div>
            </div>
    </section>
    <section class="container bordes">
        <div>
            <h5>2. Datos de Actividad</h5>
        </div>
    </section>
    <section class="container bordeslados">
        <br>
        <div class="container descripcion col-sm-12">
            <p><b>Descripción:</b><br><br>
               <?php  echo $fila['actividadObservada'];?></p>
        </div>
        <div class="col-sm-6">
            <div class="col-sm-12 text-center">
                <br>
                <label for="persobs">Nro. Personas Observadas:</label>
                <span id="persobs"><?php  echo $fila['nropersobservadas'];?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="col-sm-12 text-center">
                <br>
                <label for="persret">Nro. Personas Retroalimentadas:</label>
                <span id="persret"><?php  echo $fila['nropersretroalimentadas'];?></span>
            </div>
        </div>
    </section>
    <section class="container bordes">
        <div>
            <h5>3. Equipo Observador</h5>
        </div>
    </section>
    <section class="container bordeslados">
        <div class="col-sm-6">
            <div class="middlealign text-center">
                <label for="lider">Líder del Equipo:</label>
            </div>
            <div class="middlealign text-center">
                <span id="lider">
                    <?php
                    $result1=mysqli_query($link,"SELECT * FROM ParticipantesSE WHERE idSafetyEyes='".$_POST['idSE']."' AND idTipoParticipante='1'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        $result2=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni ='".$fila1['dni']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo $fila2['nombre']." ".$fila2['apellidos'];
                        }
                    }
                    ?>
                </span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="text-center middlealign">
                <label for="observadores">Observadores:</label>
            </div>
            <div>
                <ul class="margenizquierdo">
                    <?php
                    $result1=mysqli_query($link,"SELECT * FROM ParticipantesSE WHERE idSafetyEyes='".$_POST['idSE']."' AND idTipoParticipante='2'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        $result2=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni ='".$fila1['dni']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "<li>".$fila2['nombre']." ".$fila2['apellidos']."</li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </section>
    <section class="container bordes">
        <div>
            <h5>4. Resultados de la Observación</h5>
        </div>
    </section>
    <section class="container bordeslados">
        <br>
        <div class="col-sm-12">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Nro.</th>
                        <th>Observación</th>
                        <th>Categoría</th>
                        <th>Clase</th>
                        <th>COP</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $aux=0;
                $result0=mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE idSafetyEyes='".$_POST['idSE']."'");
                while ($fila0=mysqli_fetch_array($result0)) {
                    echo "
                        <tr>
                    ";
                    $aux++;
                    echo "
                        <td>" . $aux . "</td>
                        <td class='text-left'>" . $fila0['descripcion'] . "</td>
                    ";
                    $result1 = mysqli_query($link, "SELECT * FROM Categoria WHERE idCategoria='" . $fila0['idCategoria'] . "'");
                    while ($fila1 = mysqli_fetch_array($result1)) {
                        echo "
                            <td>" . $fila1['siglas'] . "</td>
                        ";
                    }
                    $result3 = mysqli_query($link, "SELECT * FROM Clase WHERE idClase='" . $fila0['idClase'] . "'");
                    while ($fila3 = mysqli_fetch_array($result3)) {
                        echo "
                            <td>" . $fila3['siglas'] . "</td>
                        ";
                    }
                    $result2 = mysqli_query($link, "SELECT * FROM COPs WHERE idCOPs='" . $fila0['idCOPs'] . "'");
                    while ($fila2 = mysqli_fetch_array($result2)) {
                        echo "
                            <td>" . $fila2['siglas'] . "</td>
                        ";
                    }
                    echo "
                        </tr>
                    ";
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-6">
                <div>
                    <label>Categorías:</label>
                </div>
                <div>
                    <ul>
                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM Categoria");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                            <li>".$fila1['siglas']." - ".$fila1['descripcion']."</li>
                        ";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6">
                <div>
                    <label>Clases</label>
                </div>
                <div>
                    <ul>
                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM Clase WHERE categoria='SE'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                            <li>".$fila1['siglas']." - ".$fila1['descripcion']."</li>
                        ";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="container bordes">
        <div>
            <h5>5. Acciones Inmediatas Tomadas</h5>
        </div>
    </section>
    <section class="container bordeslados">
        <br>
        <div class="col-sm-12">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Nro.</th>
                        <th>Acción Inmediata</th>
                        <th>Responsable</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $aux=0;
                $result0=mysqli_query($link,"SELECT * FROM AISE WHERE idSafetyEyes='".$_POST['idSE']."'");
                while ($fila0=mysqli_fetch_array($result0)) {
                    echo "
                        <tr>
                    ";
                    $aux++;
                    echo "<td>".$aux."</td>";
                    $result1=mysqli_query($link,"SELECT * FROM AccionesInmediatas WHERE idAccionesInmediatas='".$fila0['idAccionesInmediatas']."'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        echo "
                            <td class='text-left'>".$fila1['descripcion']."</td>
                        ";
                        $result2=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni ='".$fila1['dni']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                <td>".$fila2['nombre']." ".$fila2['apellidos']."</td>
                            ";
                        }
                    }
                    echo "
                        <tr>
                    ";
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>
    <section class="container bordes">
        <div>
            <h5>6. Mejoras de Seguridad</h5>
        </div>
    </section>
    <section class="container bordeslados">
        <br>
        <div class="col-sm-12">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Nro.</th>
                        <th>Descripción</th>
                        <th>Propuesta Por</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $aux=0;
                $result0=mysqli_query($link,"SELECT * FROM MESE WHERE idSafetyEyes='".$_POST['idSE']."'");
                while ($fila0=mysqli_fetch_array($result0)) {
                    echo "
                        <tr>
                    ";
                    $aux++;
                    echo "<td>" . $aux . "</td>";
                    $result1 = mysqli_query($link, "SELECT * FROM MejorasSeguridad WHERE idMejoras='" . $fila0['idMejoras'] . "'");
                    while ($fila1 = mysqli_fetch_array($result1)) {
                        echo "
                            <td class='text-left'>" . $fila1['descripcion'] . "</td>
                        ";
                        $result2 = mysqli_query($link, "SELECT * FROM Colaboradores WHERE dni ='" . $fila1['dni'] . "'");
                        while ($fila2 = mysqli_fetch_array($result2)) {
                            echo "
                                <td>" . $fila2['nombre'] . " " . $fila2['apellidos'] . "</td>
                            ";
                        }
                        $result2=mysqli_query($link,"SELECT * FROM EstadoACMS WHERE idEstado ='".$fila1['idEstado']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                    <td>".$fila2['descripcion']."</td>
                                ";
                        }
                    }
                    echo "
                        <tr>
                    ";
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
        $result=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idSAfetyEyes='".$_POST['idSE']."'");
        while ($fila=mysqli_fetch_array($result)){
            if($fila['estado']==="Pendiente"){
            }else{
                echo "
                    <div class='col-sm-12'>
                        <form method='post' class='form-horizontal col-sm-12' action='crearnuevaMS.php'>
                            <div class='form-group'>
                                <input type='hidden' name='idSE' value='".$_POST['idSE']."'>
                                <input type='submit' class='btn btn-primary col-sm-4 col-sm-offset-4' name='provieneSEconidMS' value='Agregar Mejoras de Seguridad'>
                            </div>
                        </form>
                    </div>
                ";
            }
        }
        ?>
    </section>
    <section class="container bordes">
        <div>
            <h5>7. Acciones Correctivas</h5>
        </div>
    </section>
    <section class="container bordeslados">
        <br>
        <div class="col-sm-12">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Nro.</th>
                        <th>Descripción</th>
                        <th>Responsable</th>
                        <th>Fecha Planeada</th>
                        <th>Fecha Real</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $aux=0;
                $result0=mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE idSafetyEyes='".$_POST['idSE']."'");
                while ($fila0=mysqli_fetch_array($result0)) {
                    $result3=mysqli_query($link,"SELECT * FROM ACSE WHERE idObservacionesSE='".$fila0['idObservacionesSE']."'");
                    while ($fila3=mysqli_fetch_array($result3)){
                        echo "
                            <tr>
                        ";
                        $aux++;
                        echo "<td>".$aux."</td>";
                        $result1=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE idAccionesCorrectivas='".$fila3['idAccionesCorrectivas']."'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                            <td class='text-left'>".$fila1['descripcion']."</td>
                        ";
                            $result2=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni ='".$fila1['dni']."'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                <td>".$fila2['nombre']." ".$fila2['apellidos']."</td>
                            ";
                            }
                            echo "
                            <td>".$fila1['fechaPlan']."</td>
                            <td>".$fila1['fechaReal']."</td>
                        ";
			$result2=mysqli_query($link,"SELECT * FROM EstadoACMS WHERE idEstado ='".$fila1['idEstado']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                    <td>".$fila2['descripcion']."</td>
                                ";
                        }
                        }
                    echo "
                        <tr>
                    ";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
        $result=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idSAfetyEyes='".$_POST['idSE']."'");
        while ($fila=mysqli_fetch_array($result)){
            if($fila['estado']==="Pendiente"){
            }else{
                echo "
                    <div class='col-sm-12'>
                        <form method='post' class='form-horizontal col-sm-12' action='crearnuevaAC.php'>
                            <div class='form-group'>
                                <input type='hidden' name='idSE' value='".$_POST['idSE']."'>
                                <input type='submit' class='btn btn-primary col-sm-4 col-sm-offset-4' name='provieneSEconidAC' value='Agregar Acciones Correctivas'>
                            </div>
                        </form>
                    </div>
                ";
            }
        }
        ?>
    </section>


    <section class="container bordes">
        <div>
            <h5>8. Evidencias Fotográficas:</h5>
        </div>
    </section>
    <section class="container bordeslados">
        <br>
        <?php
        $i = 0;
        $dir = "Fotografias/SafetyEyes/{$_POST['idSE']}/";
        if ($handle = opendir($dir)) {
	        while (($file = readdir($handle)) !== false){
		        if (!in_array($file, array('.', '..')) && !is_dir($dir.$file))
			        $i++;
	        }
        }
        for($j=0;$j<$i;$j++){
	        echo "<img src='Fotografias/SafetyEyes/{$_POST['idSE']}/{$_POST['idSE']}-{$j}.jpg' alt='Evidencia{$j}' style='width:304px;height:228px;margin-bottom:20px;margin-left: 10px;margin-right: 65px;'>";
        }
        ?>
    </section>
    <section class="container bordes">
        <div>
            <label for="revisor" style="color: #333333;font-size:14px;">Nombre del Revisor:</label>
            <span id="revisor">
                <?php
                $result1=mysqli_query($link,"SELECT * FROM ParticipantesSE WHERE idSafetyEyes='".$_POST['idSE']."' AND idTipoParticipante='3'");
                while ($fila1=mysqli_fetch_array($result1)){
	                $result2=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni ='".$fila1['dni']."'");
	                while ($fila2=mysqli_fetch_array($result2)){
		                echo $fila2['nombre']." ".$fila2['apellidos'];
	                }
                }
                ?>
            </span>
        </div>
    </section>
	<?php
}
?>

<hr>
<section class="container">
    <?php
    $result=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idSafetyEyes='".$_POST['idSE']."'");
    while ($fila=mysqli_fetch_array($result)){
        if($fila['estado']==="Pendiente"){
            echo "
                <form method='post' action='aprobarSE.php' class='form-horizontal col-sm-12'>
                    <div class='form-group'>
                        <input type='hidden' name='idSE' value=".$_POST['idSE'].">
                        <div class='col-sm-3'>
                            <input type='submit' class='btn btn-default col-sm-12' value='Regresar' name='Regresar'>
                        </div>
                        <div class='col-sm-3'>
                            <input type='submit' class='btn btn-default col-sm-12' value='Rechazar' name='rechazar'>
                        </div>
                        <div class='col-sm-3'>
                            <input type='submit' class='btn btn-success col-sm-12' value='Aprobar' name='aprobar' formaction='detallesafetyeyes.php'>
                        </div>
                        <div class='col-sm-3'>
                            <input type='submit' class='btn btn-primary col-sm-12' value='Generar PDF' name='pdf' formaction='detallesafetyeyespdf.php'>
                        </div>
                    </div>
                </form>
            ";
        }else{
            echo "
                <form method='post' action='registrosSE.php' class='form-horizontal col-sm-12'>
                    <div class='form-group'>
                        <input type='hidden' name='idSE' value=".$_POST['idSE'].">
                        <div class='col-sm-6'>
                            <input type='submit' class='btn btn-default col-sm-8 col-sm-offset-2' value='Regresar' name='Regresar'>
                        </div>
                        <div class='col-sm-6'>
                            <input type='submit' class='btn btn-primary col-sm-8 col-sm-offset-2' value='Generar PDF' name='pdf' formaction='detallesafetyeyespdf.php'>
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
