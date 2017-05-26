<!DOCTYPE html>

<html lang="es">

<?php
/*require('funciones.php');
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
if(isset($_POST['submit'])){
	$insert = mysqli_query($link, "INSERT INTO Puesto (descripcion, idTipoUsuario,estado) VALUES ('".$_POST['puesto']."','".$_POST['tipoUsuario']."','1')");
}

if(isset($_POST['modifyPuesto'])){
    $update = mysqli_query($link,"UPDATE Puesto SET descripcion = '".$_POST['descripcionPuesto']."', idTipoUsuario = '".$_POST['tipoUsuario']."' WHERE idPuesto = '".$_POST['Puesto']."'");
}

if(isset($_POST['delete'])){
    $delete = mysqli_query($link, "UPDATE Puesto SET estado = 0 WHERE idPuesto = '".$_POST['Puesto']."'");
}
?>

<section class="container">
	<div>
		<h3>Interfaz de Gestión de Puestos</h3>
	</div>
	<hr>
	<div>
		<table class="table">
			<thead>
			<tr>
				<th class="text-center">Puesto</th>
				<th class="text-center">Tipo de Usuario por defecto</th>
				<th class="text-center"></th>
				<th class="text-center"></th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<?php
				$query = mysqli_query($link,"SELECT * FROM Puesto WHERE estado = 1 ORDER BY descripcion");
				while($row = mysqli_fetch_array($query)){
				    $descripcion = "'".$row['descripcion']."'";
					echo "<tr>";
					echo "<td class=\"text-center\">".$row['descripcion']."</td>";
					$query2 = mysqli_query($link,"SELECT * FROM TipoUsuario WHERE idTipoUsuario = '".$row['idTipoUsuario']."'");
					while($row2 = mysqli_fetch_array($query2)){
						echo "<td class=\"text-center\">".$row2['descripcion']."</td>";
					}
					echo "
					<form method='post' action='#' id='modify'>
						<td class='text-center'><input type='submit' class='btn btn-link' value='Modificar' name='Modificar' formaction='modificarPuestos.php'></td>
						<input type='hidden' value='".$row['idPuesto']."' name='Puesto'>
					</form>
					<form method='post' action='#'>
						<td class=\"text-center\"><input type=\"submit\" class=\"btn btn-link\" value=\"Eliminar\" name='delete'></td>
						<input type='hidden' value='".$row['idPuesto']."' name='Puesto'>
					</form>
					</tr>";
				}
				?>

			</tbody>
		</table>
	</div>
</section>

<hr>

<section class="container">
	<div class="col-sm-6 col-sm-offset-3">
		<form method="post" action="#">
			<div class="form-group">
				<table class="table">
					<thead>
					<tr>
						<th class="text-center"><label for="puesto">Nuevo Puesto</label></th>
						<th class="text-center"><label for="tipoUsuario">Tipo de Usuario por Defecto</label></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td><input type="text" class="form-control" name="puesto" id="puesto"></td>
						<td><select class="form-control" id="tipoUsuario" name="tipoUsuario">
								<option>Seleccionar</option>
								<?php
								$query = mysqli_query($link,"SELECT * FROM TipoUsuario ORDER BY descripcion");
								while($row = mysqli_fetch_array($query)){
									echo "<option value='".$row['idTipoUsuario']."'>".$row['descripcion']."</option>";
								}
								?>
							</select></td>
						<td><input type="submit" class="btn btn-success" name="submit" value="Agregar"></td>
					</tr>
					</tbody>
				</table>
			</div>
		</form>
	</div>
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