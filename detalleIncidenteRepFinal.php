<?php
include('session.php');

$result=mysqli_query($link,"SELECT * FROM Incidentes WHERE idIncidentes = '{$_POST['idINC']}'");
while ($fila=mysqli_fetch_array($result)){
    ?>
    <section class="container">
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th><?php echo $fila['titulo'];?></th>
            </tr>
            </thead>
        </table>
        <div class="col-xs-12 col-md-12">
            <h4>Reporte</h4>
        </div>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <td>Consecuencia Actual</td>
                <td>Consecuencia Potencial</td>
                <td>Clasificación de la Lesión</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                $result1=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes = '{$_POST['idINC']}' AND tipo = 'Actual'");
                while ($fila1=mysqli_fetch_array($result1)){
                    $result2=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila1['idConsecuencia']}'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        echo "
                            <td>".$fila2['siglas']."</td>
                        ";
                    }
                }
                $result1=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes = '{$_POST['idINC']}' AND tipo = 'Potencial'");
                while ($fila1=mysqli_fetch_array($result1)){
                    $result2=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila1['idConsecuencia']}'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        echo "
                            <td>".$fila2['siglas']."</td>
                        ";
                    }
                }
                $result1=mysqli_query($link,"SELECT * FROM TipoLesion WHERE idTipoLesion = '{$fila['idTipoLesion']}'");
                while ($fila1=mysqli_fetch_array($result1)){
                    echo "
                        <td>".$fila1['siglas']."</td>
                    ";
                }
                ?>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered text-center">
            <tbody>
            <tr>
                <th>Fecha</th>
                <td><?php echo $fila['fecha']?></td>
                <th>Planta</th>
                <?php
                $result1=mysqli_query($link,"SELECT * FROM Ubicacion WHERE idUbicacion = '{$fila['idUbicacion']}'");
                while ($fila1=mysqli_fetch_array($result1)){
                    $result2=mysqli_query($link,"SELECT * FROM Planta WHERE idPlanta = '{$fila1['idPlanta']}'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        echo "
                            <td>".$fila2['descripcion']."</td>
                        ";
                    }
                }
                ?>
            </tr>
            <tr>
                <th>Hora</th>
                <td><?php echo $fila['hora']?></td>
                <th>Ubicación</th>
                <?php
                $result1=mysqli_query($link,"SELECT * FROM Ubicacion WHERE idUbicacion = '{$fila['idUbicacion']}'");
                while ($fila1=mysqli_fetch_array($result1)){
                    echo "
                        <td>".$fila1['descripcion']."</td>
                    ";
                }
                ?>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th colspan="4" class="text-left">Descripción</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="4" class="text-justify"><p><?php echo $fila['descripcion']?></p></td>
            </tr>
            <tr>
                <?php
                if($fila['intercambioenergia']==='1'){
                    echo "
                        <th>Intercambio de Energía</th>
                        <td>Si</td>
                    ";
                }elseif($fila['intercambioenergia']==='0') {
                    echo "
                        <th>Intercambio de Energía</th>
                        <td>No</td>
                    ";
                }
                if ($fila['repeticion']==='1'){
                    echo "
                        <th>Incidente Repetido</th>
                        <td>Si</td>
                    ";
                }elseif($fila['repeticion']==='0'){
                    echo "
                        <th>Incidente Repetido</th>
                        <td>No</td>
                    ";
                }else{
                    echo "
                        <th>Incidente Repetido</th>
                        <td>Sin Determinar</td>
                    ";
                }
                ?>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th class="text-left">Acciones Inmediatas</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class='text-justify'>
                <?php
                if($fila['fuente']=NULL){
                    $result2=mysqli_query($link,"SELECT * FROM AIINC WHERE idIncidentes = '{$_POST['idINC']}'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        $result3=mysqli_query($link,"SELECT * FROM AccionesInmediatas WHERE idAccionesInmediatas = '{$fila2['idAccionesInmediatas']}'");
                        while ($fila3=mysqli_fetch_array($result3)){
                            echo "
                                    <p>".$fila3['descripcion']."</p>
                                ";
                        }
                    }
                }else{
                    $result2=mysqli_query($link,"SELECT * FROM AIOCUR WHERE idOcurrencias = '{$fila['fuente']}'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        $result3=mysqli_query($link,"SELECT * FROM AccionesInmediatas WHERE idAccionesInmediatas = '{$fila2['idAccionesInmediatas']}'");
                        while ($fila3=mysqli_fetch_array($result3)){
                            echo "
                                    <p>".$fila3['descripcion']."</p>
                                ";
                        }
                    }
                    $result2=mysqli_query($link,"SELECT * FROM AIINC WHERE idIncidentes = '{$_POST['idINC']}'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        $result3=mysqli_query($link,"SELECT * FROM AccionesInmediatas WHERE idAccionesInmediatas = '{$fila2['idAccionesInmediatas']}'");
                        while ($fila3=mysqli_fetch_array($result3)){
                            echo "
                                    <p>".$fila3['descripcion']."</p>
                                ";
                        }
                    }
                }
                ?>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th colspan="4" class="text-left">Lesiones</th>
            </tr>
            <tr>
                <th>Trabajador</th>
                <th style="width:30%;">Descripción de la Lesión</th>
                <th>Parte del Cuerpo</th>
                <th>Días Perdídos</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query = mysqli_query($link, "SELECT * FROM InvolucradosIncidente WHERE idIncidentes = '".$_POST['idINC']."' AND idTipoParticipante = '7'");
            while($row = mysqli_fetch_array($query)){
                echo "<tr>";
                $query3 = mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni = '".$row['dni']."'");
                while($row3 = mysqli_fetch_array($query3)){
                    echo "<td>".$row3['dni']."-".$row3['nombre']." ".$row3['apellidos']."</td>";
                }
                echo "<td class='text-left'>".$row['descripcionLesion']."</td>";
                $result=mysqli_query($link,"SELECT * FROM InvolucradoParteCuerpo WHERE idInvolucradosIncidente = '{$row['idInvolucradosIncidente']}'");
                while ($fila=mysqli_fetch_array($result)){
                    $result1=mysqli_query($link,"SELECT * FROM ParteCuerpo WHERE idParteCuerpo = '{$fila['idParteCuerpo']}'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        echo "<td>".$fila1['descripcion']."</td>";
                    }
                }
                echo "<td class='text-left'>".$row['diasPerdidos']."</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Fotografías del Incidente</th>
            </tr>
            </thead>
            <tbody>
			    <?php
			    $i = 0;
			    $dir = "Fotografias/Ocurrencias/{$fila['fuente']}/";
			    if ($handle = opendir($dir)) {
				    while (($file = readdir($handle)) !== false){
					    if (!in_array($file, array('.', '..')) && !is_dir($dir.$file))
						    $i++;
				    }
			    }
			    for($j=0;$j<$i;$j++){
				    echo "<tr><td>";
				    echo "<img src='Fotografias/Ocurrencias/{$fila['fuente']}/{$fila['fuente']}-{$j}.jpg' alt='Evidencia{$j}' style='width:400px;height:330px;margin-bottom:20px;margin-left: 10px;margin-right: 65px;'>";
				    echo "</td></tr>";
			    }$i = 0;

			    $dir = "Fotografias/Incidentes/{$_POST['idINC']}/";
			    if ($handle = opendir($dir)) {
				    while (($file = readdir($handle)) !== false){
					    if (!in_array($file, array('.', '..')) && !is_dir($dir.$file))
						    $i++;
				    }
			    }
			    for($j=0;$j<$i;$j++){
				    echo "<tr><td>";
				    echo "<img src='Fotografias/Incidentes/{$_POST['idINC']}/{$_POST['idINC']}-{$j}.jpg' alt='Evidencia{$j}' style='width:400px;height:330px;margin-bottom:20px;margin-left: 10px;margin-right: 65px;'>";
				    echo "</td></tr>";
			    }
			    ?>
            </tr>
            </tbody>
        </table>
        <div class="col-xs-12 col-md-12">
            <h4>Investigación</h4>
        </div>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th colspan="2" class="text-left">Equipo de Investigación</th>
            </tr>
            <tr>
                <th>Persona</th>
                <th>Participación</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query = mysqli_query($link, "SELECT * FROM InvolucradosIncidente WHERE idIncidentes = '".$_POST['idINC']."' AND (idTipoParticipante='8' OR idTipoParticipante='9')");
            while($row = mysqli_fetch_array($query)){
                echo "<tr>";
                $query3 = mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni = '".$row['dni']."'");
                while($row3 = mysqli_fetch_array($query3)){
                    echo "<td>".$row3['dni']."-".$row3['nombre']." ".$row3['apellidos']."</td>";
                }
                $query3 = mysqli_query($link,"SELECT * FROM TipoParticipante WHERE idTipoParticipante = '".$row['idTipoParticipante']."'");
                while($row3 = mysqli_fetch_array($query3)){
                    echo "<td>".$row3['descripcion']."</td>";
                }
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-left">Causas del Incidente</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-justify">
                    <p style="font-weight: bold">Causas Principales</p>
                    <?php
                    $query = mysqli_query($link, "SELECT * FROM CausasIncidente WHERE idIncidentes = '".$_POST['idINC']."' AND tipo = '1'");
                    while($row = mysqli_fetch_array($query)){
                        $query3 = mysqli_query($link,"SELECT * FROM Causas WHERE idCausas = '".$row['idCausas']."'");
                        while($row3 = mysqli_fetch_array($query3)){
                            echo "<p><b>".$row3['descripcion'].": </b>".$row['descripcion']."</p>";
                        }
                    }
                    ?>
                    <p style="font-weight: bold">Causas Contributivas</p>
                    <?php
                    $query = mysqli_query($link, "SELECT * FROM CausasIncidente WHERE idIncidentes = '".$_POST['idINC']."' AND tipo = '2'");
                    while($row = mysqli_fetch_array($query)){
                        $query3 = mysqli_query($link,"SELECT * FROM Causas WHERE idCausas = '".$row['idCausas']."'");
                        while($row3 = mysqli_fetch_array($query3)){
                            echo "<p><b>".$row3['descripcion'].": </b>".$row['descripcion']."</p>";
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
                <th>Fotografías de la Investigación</th>
            </tr>
            </thead>
            <tbody>
			    <?php
			    $i = 0;
			    $dir = "Fotografias/Incidentes/{$_POST['idINC']}/Investigación/";
			    if ($handle = opendir($dir)) {
				    while (($file = readdir($handle)) !== false){
					    if (!in_array($file, array('.', '..')) && !is_dir($dir.$file))
						    $i++;
				    }
			    }
			    for($j=0;$j<$i;$j++){
				    echo "<tr><td>";
				    echo "<img src='Fotografias/Incidentes/{$_POST['idINC']}/Investigación/{$_POST['idINC']}Inv-{$j}.jpg' alt='Investigación{$j}' style='width:400px;height:330px;margin-bottom:20px;margin-left: 10px;margin-right: 65px;'>";
				    echo "</td></tr>";
			    }
			    ?>
            </tbody>
        </table>
        <div class="col-xs-12 col-md-12">
            <h4>Acciones Correctivas</h4>
        </div>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>Descripción</th>
                <th>Responsable</th>
                <th>Fecha Planeada</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-left" colspan="4">Acciones Correctivas Críticas</td>
            </tr>
            <?php
            $result0=mysqli_query($link,"SELECT * FROM ACINC WHERE idIncidentes = '{$_POST['idINC']}' AND tipoAC = 'CCA'");
            while ($fila0=mysqli_fetch_array($result0)){
                $result1=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE idAccionesCorrectivas = '{$fila0['idAccionesCorrectivas']}'");
                while ($fila1=mysqli_fetch_array($result1)){
                    echo "
                            <tr>
                        ";
                    echo "
                            <td class='text-left'>".$fila1['descripcion']."</td>
                        ";
                    $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila1['dni']."'");
                    while ($fila3=mysqli_fetch_array($result3)){
                        echo "
                            <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                        ";
                    }
                    echo "
                            <td>".$fila1['fechaPlan']."</td>
                        ";
                    $result2=mysqli_query($link,"SELECT * FROM EstadoACMS WHERE idEstado='".$fila1['idEstado']."'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        echo "
                                    <td>".$fila2['descripcion']."</td>
                                ";
                    }
                    echo "
                            </tr>
                        ";
                }
            }
            ?>
            <tr>
                <td class="text-left" colspan="4">Otras Acciones</td>
            </tr>
            <?php
            $result0=mysqli_query($link,"SELECT * FROM ACINC WHERE idIncidentes = '{$_POST['idINC']}' AND tipoAC = 'OA'");
            while ($fila0=mysqli_fetch_array($result0)){
                $result1=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE idAccionesCorrectivas = '{$fila0['idAccionesCorrectivas']}'");
                while ($fila1=mysqli_fetch_array($result1)){
                    echo "
                            <tr>
                        ";
                    echo "
                            <td class='text-left'>".$fila1['descripcion']."</td>
                        ";
                    $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila1['dni']."'");
                    while ($fila3=mysqli_fetch_array($result3)){
                        echo "
                            <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                        ";
                    }
                    echo "
                            <td>".$fila1['fechaPlan']."</td>
                        ";
                    $result2=mysqli_query($link,"SELECT * FROM EstadoACMS WHERE idEstado='".$fila1['idEstado']."'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        echo "
                                    <td>".$fila2['descripcion']."</td>
                                ";
                    }
                    echo "
                            </tr>
                        ";
                }
            }
            ?>
            </tbody>
        </table>
        <div class="col-xs-12 col-md-12">
            <h4>Seguimiento</h4>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-left">Evidencia de Cumplimiento de Acciones Correctivas</th>
            </tr>
            </thead>
            <tbody>
			    <?php
                $aux=0;
			    $query = mysqli_query($link, "SELECT * FROM ACINC WHERE idIncidentes = '{$_POST['idINC']}'");
			    while($row = mysqli_fetch_array($query)){
                    $result2=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE idAccionesCorrectivas = '{$row['idAccionesCorrectivas']}'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        $i = 0;
                        $aux++;
                        $dir = "Fotografias/Incidentes/{$_POST['idINC']}/Seguimiento/{$row['idAccionesCorrectivas']}/";
                        if ($handle = opendir($dir)) {
                            while (($file = readdir($handle)) !== false){
                                if (!in_array($file, array('.', '..')) && !is_dir($dir.$file))
                                    $i++;
                            }
                        }
                        echo "<tr><td>";
                        echo "<p class='text-justify'><b>".$aux.".</b> ".$fila2['descripcion']."</p>";
                        for($j=0;$j<$i;$j++){
                            echo "<img src='Fotografias/Incidentes/{$_POST['idINC']}/Seguimiento/{$row['idAccionesCorrectivas']}/{$_POST['idINC']}-{$row['idAccionesCorrectivas']}-{$j}.jpg' alt='SeguimientoAC{$j}' style='width:304px;height:228px;margin-bottom:20px;margin-left: 10px;margin-right: 65px;'>";
                        }
                        echo "</td></tr>";
                    }
			    }
			    ?>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th class="text-left">Responsable del Cierre del Reporte:</th>
                    <?php
                    $result1=mysqli_query($link,"SELECT * FROM InvolucradosIncidente WHERE idIncidentes = '{$_POST['idINC']}' AND idTipoParticipante = '10'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila1['dni']."'");
                        while ($fila3=mysqli_fetch_array($result3)){
                            echo "
                            <td class='text-left'>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                            ";
                        }
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </section>
    <?php
}
?>


