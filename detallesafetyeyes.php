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
</head>

<body>
<header>
    <nav>
    </nav>
</header>
<?php
if (isset($_POST['aprobar'])){
    $persona='46815198';
    /*$nombre =$_SESSION['nombre'];
            $result=mysqli_query($link,"SELECT * FROM colaboradores WHERE nombre ='".$nombre."'");
            while ($fila=mysqli_fetch_array($result)){
                $persona=$fila['dni'];
            }*/
    $aprobar="UPDATE safetyeyes SET estado = 'Aprobado' WHERE idSafetyEyes = '".$_POST['idSE']."'";
    $query=mysqli_query($link,$aprobar);
    $revisor="INSERT INTO participantesse(dni, idSafetyEyes, idTipoParticipante) VALUES (
    '".$persona."','".$_POST['idSE']."','3'
    )";
    $query=mysqli_query($link,$revisor);
}
?>
<section class="container-fluid">
    <div class="col-sm-4">
        <div>
            <img style="margin-top:25px" width="auto" height="70" src="image/Moly-Cop.jpg"/>
        </div>
    </div>
    <div class="col-sm-8">
        <div>
            <h4>Formulario Safety Eyes</h4>
        </div>
        <div>
            <h4><?php echo $_POST['idSE'];?></h4>
        </div>
    </div>
</section>
<hr>
<?php
$result=mysqli_query($link,"SELECT * FROM safetyeyes WHERE idSafetyEyes='".$_POST['idSE']."'");
while ($fila=mysqli_fetch_array($result)) {
    ?>
    <section class="container">
        <div>
            <h4>1. Datos de Ubicación</h4>
        </div>
        <div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Planta</th>
                    <th>Ubicación</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    echo "
                        <tr>
                    ";
                    $result1 = mysqli_query($link, "SELECT * FROM ubicacion WHERE idUbicacion='" . $fila['idUbicacion'] . "'");
                    while ($fila1 = mysqli_fetch_array($result1)) {
                        $result2 = mysqli_query($link, "SELECT * FROM planta WHERE idPlanta='" . $fila1['idPlanta'] . "'");
                        while ($fila2 = mysqli_fetch_array($result2)) {
                            echo "
                            <td>" . $fila2['descripcion'] . "</td>
                            <td>" . $fila1['descripcion'] . "</td>
                        ";
                        }
                    }
                    echo "
                        </tr>
                    ";
                ?>
                </tbody>
            </table>
        </div>
    </section>
    <section class="container">
        <div>
            <h4>2. Datos de Actividad</h4>
        </div>
        <div>
            <p>Descripción: <?php  echo $fila['actividadObservada'];?></p>
        </div>
        <div>
            <div>
                <label for="persobs">Nro. Personas Observadas:</label>
            </div>
            <div>
                <span id="persobs"><?php  echo $fila['nropersobservadas'];?></span>
            </div>
        </div>
        <div>
            <div>
                <label for="persret">Nro. Personas Retroalimentadas:</label>
            </div>
            <div>
                <span id="persret"><?php  echo $fila['nropersretroalimentadas'];?></span>
            </div>
        </div>
    </section>
    <section class="container">
        <div>
            <h4>3. Equipo Observador</h4>
        </div>
        <div>
            <div>
               <label for="lider">Líder del Equipo:</label>
            </div>
            <div>
                <span id="lider">
                    <?php
                    $result1=mysqli_query($link,"SELECT * FROM participantesse WHERE idSafetyEyes='".$_POST['idSE']."' AND idTipoParticipante='1'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        $result2=mysqli_query($link,"SELECT * FROM colaboradores WHERE dni ='".$fila1['dni']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo $fila2['nombre']." ".$fila2['apellidos'];
                        }
                    }
                    ?>
                </span>
            </div>
            <div>
                <div>
                    <label for="observadores">Observadores:</label>
                </div>
                <div>
                    <ul>
                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM participantesse WHERE idSafetyEyes='".$_POST['idSE']."' AND idTipoParticipante='2'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            $result2=mysqli_query($link,"SELECT * FROM colaboradores WHERE dni ='".$fila1['dni']."'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "<li>".$fila2['nombre']." ".$fila2['apellidos']."</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="container">
        <div>
            <h4>4. Resultados de la Observación</h4>
        </div>
        <div>
            <table class="table table-bordered">
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
                echo "
                    <tr>
                ";
                $aux=0;
                $result0=mysqli_query($link,"SELECT * FROM observacionesse WHERE idSafetyEyes='".$_POST['idSE']."'");
                while ($fila0=mysqli_fetch_array($result0)) {
                    $aux++;
                    echo "
                        <td>" . $aux . "</td>
                        <td>" . $fila0['descripcion'] . "</td>
                    ";
                    $result1 = mysqli_query($link, "SELECT * FROM categoria WHERE idCategoria='" . $fila0['idCategoria'] . "'");
                    while ($fila1 = mysqli_fetch_array($result1)) {
                        echo "
                            <td>" . $fila1['siglas'] . "</td>
                        ";
                    }
                    $result3 = mysqli_query($link, "SELECT * FROM clase WHERE idClase='" . $fila0['idClase'] . "'");
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
        <div>
            <div>
                <div>
                    <label>Categorías:</label>
                </div>
                <div>
                    <ul>
                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM categoria");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                            <li>".$fila1['siglas']." - ".$fila1['descripcion']."</li>
                        ";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div>
                <div>
                    <label>Clases</label>
                </div>
                <div>
                    <ul>
                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM clase WHERE categoria='SE'");
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
    <section class="container">
        <div>
            <h4>5. Acciones Inmediatas Tomadas</h4>
        </div>
        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nro.</th>
                        <th>Acción Inmediata</th>
                        <th>Responsable</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                echo "
                    <tr>
                ";
                $aux=0;
                $result0=mysqli_query($link,"SELECT * FROM aise WHERE idSafetyEyes='".$_POST['idSE']."'");
                while ($fila0=mysqli_fetch_array($result0)) {
                    $aux++;
                    echo "<td>".$aux."</td>";
                    $result1=mysqli_query($link,"SELECT * FROM accionesinmediatas WHERE idAccionesInmediatas='".$fila0['idAccionesInmediatas']."'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        echo "
                            <td>".$fila1['descripcion']."</td>
                        ";
                        $result2=mysqli_query($link,"SELECT * FROM colaboradores WHERE dni ='".$fila1['dni']."'");
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
    <section class="container">
        <div>
            <h4>6. Mejoras de Seguridad</h4>
        </div>
        <div>
            <table class="table table-bordered">
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
                echo "
                    <tr>
                ";
                $aux=0;
                $result0=mysqli_query($link,"SELECT * FROM mese WHERE idSafetyEyes='".$_POST['idSE']."'");
                while ($fila0=mysqli_fetch_array($result0)) {
                    $aux++;
                    echo "<td>" . $aux . "</td>";
                    $result1 = mysqli_query($link, "SELECT * FROM mejorasseguridad WHERE idMejoras='" . $fila0['idMejoras'] . "'");
                    while ($fila1 = mysqli_fetch_array($result1)) {
                        echo "
                            <td>" . $fila1['descripcion'] . "</td>
                        ";
                        $result2 = mysqli_query($link, "SELECT * FROM colaboradores WHERE dni ='" . $fila1['dni'] . "'");
                        while ($fila2 = mysqli_fetch_array($result2)) {
                            echo "
                                <td>" . $fila2['nombre'] . " " . $fila2['apellidos'] . "</td>
                            ";
                        }
                        echo "
                            <td>" . $fila1['estado'] . "</td>
                        ";
                    }
                    echo "
                        <tr>
                    ";
                }
                ?>
                }
                </tbody>
            </table>
        </div>
        <?php
        $result=mysqli_query($link,"SELECT * FROM safetyeyes WHERE idSAfetyEyes='".$_POST['idSE']."'");
        while ($fila=mysqli_fetch_array($result)){
            if($fila['estado']==="Pendiente"){
            }else{
                echo "
                    <div>
                        <form method='post' class='form-horizontal' action='crearnuevaMS.php'>
                            <div class='form-group'>
                                <input type='hidden' name='idSE' value='".$_POST['idSE']."'>
                                <input type='submit' name='provieneSEconidMS' value='Agregar Mejoras de Seguridad'>
                            </div>
                        </form>
                    </div>
                ";
            }
        }
        ?>
    </section>
    <section class="container">
        <div>
            <h4>7. Acciones Correctivas</h4>
        </div>
        <div>
            <table class="table table-bordered">
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
                echo "
                    <tr>
                ";
                $aux=0;
                $result0=mysqli_query($link,"SELECT * FROM observacionesse WHERE idSafetyEyes='".$_POST['idSE']."'");
                while ($fila0=mysqli_fetch_array($result0)) {
                    $result3=mysqli_query($link,"SELECT * FROM acse WHERE idObservacionesSE='".$fila0['idObservacionesSE']."'");
                    while ($fila3=mysqli_fetch_array($result3)){
                        $aux++;
                        echo "<td>".$aux."</td>";
                        $result1=mysqli_query($link,"SELECT * FROM accionescorrectivas WHERE idAccionesCorrectivas='".$fila3['idAccionesCorrectivas']."'");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                            <td>".$fila1['descripcion']."</td>
                        ";
                            $result2=mysqli_query($link,"SELECT * FROM colaboradores WHERE dni ='".$fila1['dni']."'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                echo "
                                <td>".$fila2['nombre']." ".$fila2['apellidos']."</td>
                            ";
                            }
                            echo "
                            <td>".$fila1['fechaPlan']."</td>
                            <td>".$fila1['fechaReal']."</td>
                            <td>".$fila1['estado']."</td>
                        ";
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
        $result=mysqli_query($link,"SELECT * FROM safetyeyes WHERE idSAfetyEyes='".$_POST['idSE']."'");
        while ($fila=mysqli_fetch_array($result)){
            if($fila['estado']==="Pendiente"){
            }else{
                echo "
                    <div>
                        <form method='post' class='form-horizontal' action='crearnuevaAC.php'>
                            <div class='form-group'>
                                <input type='hidden' name='idSE' value='".$_POST['idSE']."'>
                                <input type='submit' name='provieneSEconidAC' value='Agregar Acciones Correctivas'>
                            </div>
                        </form>
                    </div>
                ";
            }
        }
        ?>
    </section>
    <section class="container">
        <div>
            <label for="revisor">Nombre del Revisor:</label>
        </div>
        <div>
            <span id="revisor">
                <?php
                $result1=mysqli_query($link,"SELECT * FROM participantesse WHERE idSafetyEyes='".$_POST['idSE']."' AND idTipoParticipante='3'");
                while ($fila1=mysqli_fetch_array($result1)){
                    $result2=mysqli_query($link,"SELECT * FROM colaboradores WHERE dni ='".$fila1['dni']."'");
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
    $result=mysqli_query($link,"SELECT * FROM safetyeyes WHERE idSAfetyEyes='".$_POST['idSE']."'");
    while ($fila=mysqli_fetch_array($result)){
        if($fila['estado']==="Pendiente"){
            echo "
                <form method='post' action='registrosSE.php' class='form-horizontal'>
                    <div class='form-group'>
                        <input type='hidden' name='idSE' value=".$_POST['idSE'].">
                        <input type='submit' value='Regresar' name='Regresar'>
                        <input type='submit' value='Aprobar' name='aprobar' formaction='detallesafetyeyes.php'>
                        <input type='submit' value='Generar PDF' name='pdf' formaction='detallesafetyeyespdf.php'>
                    </div>
                </form>
            ";
        }else{
            echo "
                <form method='post' action='registrosSE.php' class='form-horizontal'>
                    <div class='form-group'>
                        <input type='hidden' name='idSE' value=".$_POST['idSE'].">
                        <input type='submit' value='Regresar' name='Regresar'>
                        <input type='submit' value='Generar PDF' name='pdf' formaction='detallesafetyeyespdf.php'>
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
</footer>
</body>

<?php
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>