<?php
include('session.php');

if(isset($_POST['modify'])){
    $i=0;
	$query = mysqli_query($link, "UPDATE IncidentesConsecuencia SET  idConsecuencia = '{$_POST['ConsecuenciaActual']}' WHERE idIncidentes = '{$_POST['idINC']}' AND tipo = 'Actual'");
	$query = mysqli_query($link, "UPDATE IncidentesConsecuencia SET  idConsecuencia = '{$_POST['ConsecuenciaPotencial']}' WHERE idIncidentes = '{$_POST['idINC']}' AND tipo = 'Potencial'");
	$query = mysqli_query($link, "UPDATE Incidentes SET  idTipoLesion = '{$_POST['ClasificacionLesion']}' WHERE idIncidentes = '{$_POST['idINC']}'");
	$query = mysqli_query($link, "UPDATE Incidentes SET  descripcion = '{$_POST['DescripcionIncidente']}' WHERE idIncidentes = '{$_POST['idINC']}'");
	$query = mysqli_query($link, "UPDATE Incidentes SET  repeticion = '{$_POST['repetido']}' WHERE idIncidentes = '{$_POST['idINC']}'");

	$query = mysqli_query($link, "SELECT * FROM InvolucradosIncidente WHERE idIncidentes = '".$_POST['idINC']."' AND idTipoParticipante = '7'");
	while($row = mysqli_fetch_array($query)){
	    $i = $row['idInvolucradosIncidente'];
	    $variable = "descripcionLesion".$i;
	    $variable2 = "diasPerdidos".$i;
	    $query2 = mysqli_query($link, "UPDATE InvolucradosIncidente SET descripcionLesion = '{$_POST[$variable]}', diasPerdidos = '{$_POST[$variable2]}' WHERE idInvolucradosIncidente = '{$i}'");
	    $query3 = mysqli_query($link, "SELECT * FROM InvolucradoParteCuerpo WHERE idInvolucradosIncidente = '{$i}'");
	    while($row2 = mysqli_fetch_array($query3)){
	        $j = $row2['idInvolucradoParteCuerpo'];
	        $variable3 = "parteCuerpo".$j;
	        $query4 = mysqli_query($link, "UPDATE InvolucradoParteCuerpo SET idParteCuerpo = '{$_POST[$variable3]}' WHERE idInvolucradoParteCuerpo = '{$j}'");
        }
    }

	echo "
    <section class='container'>
        <div class=\"alert alert-success\">
            <strong>Información ingresada exitosamente</strong>
        </div>
    </section>
    ";
}

$result=mysqli_query($link,"SELECT * FROM Incidentes WHERE idIncidentes = '{$_POST['idINC']}'");
while ($fila=mysqli_fetch_array($result)){
    ?>
    <section class="container">
        <form method="post" action="#">
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th><?php echo $fila['titulo'];?></th>
            </tr>
            </thead>
        </table>
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
                            <td>
                                <select name='ConsecuenciaActual' class='form-control'>
                                    <option selected='selected' value='{$fila2['idConsecuencia']}'>{$fila2['siglas']}</option>";
			            $query = mysqli_query($link,"SELECT * FROM Consecuencia");
			            while($row = mysqli_fetch_array($query)){
				            echo "<option value='{$row['idConsecuencia']}'>{$row['siglas']}</option>";
			            }
			            echo "  </select>
                            </td>
                        ";
		            }
	            }
	            $result1=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes = '{$_POST['idINC']}' AND tipo = 'Potencial'");
	            while ($fila1=mysqli_fetch_array($result1)){
		            $result2=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila1['idConsecuencia']}'");
		            while ($fila2=mysqli_fetch_array($result2)){
			            echo "
                            <td>
                                <select name='ConsecuenciaPotencial' class='form-control'>
                                    <option selected='selected' value='{$fila2['idConsecuencia']}'>{$fila2['siglas']}</option>";
			            $query = mysqli_query($link,"SELECT * FROM Consecuencia");
			            while($row = mysqli_fetch_array($query)){
				            echo "<option value='{$row['idConsecuencia']}'>{$row['siglas']}</option>";
			            }
			            echo "  </select>
                            </td>
                        ";
		            }
	            }
	            $result1=mysqli_query($link,"SELECT * FROM TipoLesion WHERE idTipoLesion = '{$fila['idTipoLesion']}'");
	            while ($fila1=mysqli_fetch_array($result1)){
		            echo "
                        <td>
                            <select name='ClasificacionLesion' class='form-control'>
                                <option selected='selected' value='{$fila['idTipoLesion']}'>{$fila1['siglas']}</option>";
		            $query = mysqli_query($link,"SELECT * FROM TipoLesion");
		            while($row = mysqli_fetch_array($query)){
			            echo "<option value='{$row['idTipoLesion']}'>{$row['siglas']}</option>";
		            }
		            echo   "</select>
                        </td>
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
                <td colspan="4" class="text-justify"><textarea class="form-control" name="DescripcionIncidente" rows="4" cols="110"><?php echo $fila['descripcion']?></textarea></td>
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
                echo "<th>Incidente Repetido</th>
                        <td><select name='repetido' class='form-control'>
                            <option selected='selected' value='{$fila['repeticion']}'>";
                if ($fila['repeticion']==='1'){
	                echo "Si";
                }elseif($fila['repeticion']==='0'){
	                echo "No";
                }else{
	                echo "Sin Determinar";
                }
                echo "</option>
                                    <option value='1'>Sí</option>
                                    <option value='0'>No</option>
                                    <option value='TBD'>Sin Determinar</option>
                        </select></td>";
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
                if($fila['fuente'] === NULL){
                    $result1=mysqli_query($link,"SELECT * FROM AIINC WHERE idIncidentes = '{$_POST['idINC']}'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        $result2=mysqli_query($link,"SELECT * FROM AccionesInmediatas WHERE idAccionesInmediatas = '{$fila1['idAccionesInmediatas']}'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                    <p>".$fila2['descripcion']."</p>
                                ";
                        }
                    }
                }else{
                    $result1=mysqli_query($link,"SELECT * FROM AIOCUR WHERE idOcurrencias = '{$fila['fuente']}'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        $result2=mysqli_query($link,"SELECT * FROM AccionesInmediatas WHERE idAccionesInmediatas = '{$fila1['idAccionesInmediatas']}'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                    <p>".$fila2['descripcion']."</p>
                                ";
                        }
                    }
                    $result1=mysqli_query($link,"SELECT * FROM AIINC WHERE idIncidentes = '{$_POST['idINC']}'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        $result2=mysqli_query($link,"SELECT * FROM AccionesInmediatas WHERE idAccionesInmediatas = '{$fila1['idAccionesInmediatas']}'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            echo "
                                    <p>".$fila2['descripcion']."</p>
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
            $i = 0;
            $j = 0;
            $query = mysqli_query($link, "SELECT * FROM InvolucradosIncidente WHERE idIncidentes = '".$_POST['idINC']."' AND idTipoParticipante = '7'");
            while($row = mysqli_fetch_array($query)){
                $i = $row['idInvolucradosIncidente'];
                echo "<tr>";
                $query3 = mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni = '".$row['dni']."'");
                while($row3 = mysqli_fetch_array($query3)){
                    echo "<td>".$row3['nombre']." ".$row3['apellidos']."</td>";
                }
                echo "<td><textarea name='descripcionLesion{$i}' class='form-control'>{$row['descripcionLesion']}</textarea></td>";
                $result=mysqli_query($link,"SELECT * FROM InvolucradoParteCuerpo WHERE idInvolucradosIncidente = '{$row['idInvolucradosIncidente']}'");
                while ($fila=mysqli_fetch_array($result)){
                    $j = $fila['idInvolucradoParteCuerpo'];
                    $result1=mysqli_query($link,"SELECT * FROM ParteCuerpo WHERE idParteCuerpo = '{$fila['idParteCuerpo']}'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        echo "<td><select name='parteCuerpo{$j}' class='form-control'>
                                <option selected='selected' value='{$fila['idParteCuerpo']}'>{$fila1['descripcion']}</option>";
                                $query2 = mysqli_query($link,"SELECT * FROM ParteCuerpo");
                                while($row2 = mysqli_fetch_array($query2)){
                                    echo "<option value='{$row2['idParteCuerpo']}'>{$row2['descripcion']}</option>";
                                }
                        echo "</select></td>";
                    }
                }
                echo "<td><input type='text' name='diasPerdidos{$i}' value='{$row['diasPerdidos']}' class='form-control'></td>";
	            echo "<input type='hidden' name='idINC' value='{$_POST['idINC']}'>";
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
            </tbody>
        </table>
            <div class="form-group col-xs-12 col-md-12">
                <div class="col-md-4 col-md-offset-4 col-xs-12">
                    <input type="hidden" name="idINC" value="<?php echo $_POST['idINC'];?>">
                    <input type="submit" class="btn btn-success col-md-8 col-md-offset-2 col-xs-12" name="modify" value="Aceptar Cambios">
                    <div><br><br><br></div>
                </div>
            </div>
        </form>
    </section>
    <?php
}
?>


