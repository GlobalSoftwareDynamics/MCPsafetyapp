<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
include('funcionesApp.php');
if(isset($_SESSION['login'])&&(($_SESSION['usertype']=='1'))||($_SESSION['usertype']=='2')){
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
        <link href="css/styles.css" rel="stylesheet">
	</head>

	<body>
	<header>
		<?php
		include_once('navbarmainSupervisor.php');
		?>
	</header>

    <div class="container-fluid">
        <label>Código: <?php echo $_POST['idSE']?></label>
    </div>

	<?php
	if(isset($_POST['finalizar'])){
		$query = mysqli_query($link, "UPDATE SafetyEyes SET duracion = '{$_POST['duracion']}', nropersobservadas = '{$_POST['persobs']}', nropersretroalimentadas = '{$_POST['persretroalimentadas']}}' WHERE idSafetyEyes = '{$_POST['idSE']}'");
	}
	if(isset($_POST['modificarDescripcion'])){
		$query = mysqli_query($link, "UPDATE SafetyEyes SET actividadObservada = '{$_POST['descripcion']}', nropersobservadas = '{$_POST['personasobservadas']}', nropersretroalimentadas = '{$_POST['personasretroalimentadas']}' WHERE idSafetyEyes = '{$_POST['idSE']}'");
	}
	?>

	<section class="container-fluid">
			<div class="col-md-12">
				<h3 class="titulo text-center">Formulario Safety Eyes</h3>
			</div>
			<div class="col-md-12">
				<h4 class="desctitulo text-center"><?php echo $_POST['idSE'];?></h4>
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
		<section class="container">
			<div class="col-md-6">
				<div class="col-md-12">
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
			<div class="col-md-6">
				<div class="col-md-12">
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
		<section class="container">
			<form action="#" method="post">
				<input type="hidden" name="idSE" value="<?php echo $_POST['idSE']?>">
				<br>
				<div class="container descripcion col-md-12">
					<label for="descripcion"><b>Descripción:</b></label>
					<textarea id="descripcion" name="descripcion" class="form-control"><?php echo $fila['actividadObservada']?></textarea>
                    <br>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-offset-2">
					<div class="text-center">
						<br>
						<label for="persobs">Nro. Personas Observadas:</label>
						<input type="text" name="personasobservadas" id="persobs" value="<?php echo $fila['nropersobservadas']?>" class="form-control">
					</div>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-offset-2">
					<div class="text-center">
						<br>
						<label for="persret">Nro. Personas Retroalimentadas:</label>
						<input type="text" name="personasretroalimentadas" id="persret" value="<?php echo $fila['nropersretroalimentadas']?>" class="form-control">
					</div>
				</div>
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <input type="submit" name="modificarDescripcion" value="Guardar Cambios" class="form-control btn btn-success">
                    <br><br>
                </div>

			</form>
		</section>
		<section class="container bordes">
			<div>
				<h5>3. Equipo Observador</h5>
			</div>
		</section>
		<section class="container">
			<div class="col-md-6">
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
			<div class="col-md-6">
				<div class="text-center middlealign">
					<label for="observadores">Observadores:</label>
				</div>
				<div class="text-center middlealign">
						<?php
						$result1=mysqli_query($link,"SELECT * FROM ParticipantesSE WHERE idSafetyEyes='".$_POST['idSE']."' AND idTipoParticipante='2'");
						while ($fila1=mysqli_fetch_array($result1)){
							$result2=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni ='".$fila1['dni']."'");
							while ($fila2=mysqli_fetch_array($result2)){
								echo "<p>".$fila2['nombre']." ".$fila2['apellidos']."</p>";
							}
						}
						?>
				</div>
			</div>
			<div>
				<form method="post" class='form-horizontal col-md-12' action="regSE_EquipoObservacion.php">
					<div class="form-group col-xs-12 col-md-8 col-md-offset-2">
                        <input type="hidden" name="idSE" value="<?php echo $_POST['idSE']?>">
						<input type="submit" value="Modificar Equipo de Observación" name="addFinal" class="form-control btn btn-success">
					</div>
				</form>
			</div>
		</section>
		<section class="container bordes">
			<div>
				<h5>4. Resultados de la Observación</h5>
			</div>
		</section>
		<section class="container">
			<br>
			<div class="col-md-12">
				<table class="table table-bordered text-center">
					<thead>
					<tr>
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
						echo "<td class='text-left'>" . $fila0['descripcion'] . "</td>
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
				<div>
					<form method="post" class="form-horizontal col-md-12" action="regSE_Hallazgos.php">
						<div class="form-group col-xs-12 col-md-8 col-md-offset-2">
                            <input type="hidden" name="idSE" value="<?php echo $_POST['idSE']?>">
							<input type="submit" value="Modificar Hallazgos" name="addFinal" class="form-control btn btn-success">
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-6">
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
				<div class="col-md-6">
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
		<section class="container">
			<br>
			<div class="col-md-12">
				<table class="table table-bordered text-center">
					<thead>
					<tr>
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
			<div>
				<form method="post" class='form-horizontal col-md-12' action="regSE_AccionInmediata.php">
					<div class="form-group col-xs-12 col-md-8 col-md-offset-2">
                        <input type="hidden" name="idSE" value="<?php echo $_POST['idSE']?>">
						<input type="submit" value="Modificar Acciones Inmediatas" name="addFinal" class="btn btn-success form-control">
					</div>
				</form>
			</div>
		</section>
		<section class="container bordes">
			<div>
				<h5>6. Mejoras de Seguridad</h5>
			</div>
		</section>
		<section class="container">
			<br>
			<div class="col-md-12">
				<table class="table table-bordered text-center">
					<thead>
					<tr>
						<th>Descripción</th>
						<th>Propuesta Por</th>
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
					echo "
                    <div class='col-md-12'>
                        <form method='post' class='form-horizontal col-md-12' action='regSE_MejorasSeguridad.php'>
                            <div class='form-group'>
                                <input type='hidden' name='idSE' value='" .$_POST['idSE']. "'>
                                <input type='submit' class='btn btn-success col-xs-12 col-md-8 col-md-offset-2' name='addFinal' value='Modificar Mejoras de Seguridad'>
                            </div>
                        </form>
                    </div>
                ";
			?>
		</section>
		<section class="container bordes">
			<div>
				<h5>7. Acciones Correctivas</h5>
			</div>
		</section>
		<section class="container">
			<br>
			<div class="col-md-12">
				<table class="table table-bordered text-center">
					<thead>
					<tr>
						<th>Descripción</th>
						<th>Responsable</th>
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
					echo "
                    <div class='col-md-12'>
                        <form method='post' class='form-horizontal col-md-12' action='regSE_AccionCorrectiva.php'>
                            <div class='form-group'>
                                <input type='hidden' name='idSE' value='" .$_POST['idSE']. "'>
                                <input type='submit' class='btn btn-success col-xs-12 col-md-8 col-md-offset-2' name='addFinal' value='Modificar Acciones Correctivas'>
                            </div>
                        </form>
                    </div>
                ";
			?>
		</section>


		<section class="container bordes">
			<div>
				<h5>8. Evidencias Fotográficas:</h5>
			</div>
		</section>
		<section class="container">
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
			<?php
			echo "
                    <div class='col-md-12'>
                        <form method='post' class='form-horizontal col-md-12' action='regSE_Evidencias.php'>
                            <div class='form-group'>
                                <input type='hidden' name='idSE' value='" .$_POST['idSE']. "'>
                                <input type='submit' class='btn btn-success col-xs-12 col-md-8 col-md-offset-2' name='addFinal' value='Agregar Fotografías'>
                            </div>
                        </form>
                    </div>
                    <br><br>
                    <div class='col-md-12'>
                        <form method='post' class='form-horizontal col-md-12' action='regSE_ConfirmacionFinal.php'>
                            <div class='form-group'>
                                <input type='hidden' name='idSE' value='" .$_POST['idSE']. "'>
                                <input type='submit' class='btn btn-primary col-xs-12 col-md-8 col-md-offset-2' name='finalizar' value='Finalizar Reporte'>
                            </div>
                        </form>
                    </div>
                ";
			?>
		</section>
		<?php
	}
	?>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	</body>

	<?php
}else{
	echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>

</html>