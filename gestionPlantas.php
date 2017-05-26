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
	$submit = mysqli_query($link, "INSERT INTO Planta(descripcion,estado) VALUES ('".$_POST['descripcionPlanta']."',1)");
}

if(isset($_POST['modify'])){
	$modify = mysqli_query($link, "UPDATE Planta SET descripcion = '".$_POST['descripcionPlanta']."' WHERE idPlanta = '".$_POST['planta']."'");
}

if(isset($_POST['delete'])){
	$delete = mysqli_query($link, "UPDATE Planta SET estado = 0 WHERE idPlanta = '".$_POST['planta']."'");
}
?>

<section class="container">
	<table class="table">
		<thead>
			<tr>
				<th class="text-center">Planta</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$query = mysqli_query($link, "SELECT * FROM Planta WHERE estado = 1");
			while($row = mysqli_fetch_array($query)){
				echo "<tr>";
				echo "<td class='text-center'>".$row['descripcion']."</td>";
				echo "<td class='text-center'>
						<form method='post' action='#'>
							<input type='submit' class='btn-link' value='Ver Ubicaciones' formaction='gestionUbicaciones.php'>
							<input type='hidden' value='".$row['idPlanta']."' name='planta'>
						</form>
					</td>";
				echo "<td class='text-center'>
						<form method='post' action='#'>
							<input type='submit' class='btn-link' value='Modificar' formaction='modificarPlantas.php'>
							<input type='hidden' value='".$row['idPlanta']."' name='planta'>
						</form>
					</td>";
				echo "<td class='text-center'>
						<form method='post' action='#'>
							<input type='submit' class='btn-link' value='Eliminar' formaction='#' name='delete'>
							<input type='hidden' value='".$row['idPlanta']."' name='planta'>
						</form>
					</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</section>

<section class="container">
	<div class="col-sm-6 col-sm-offset-3">
		<form method="post" action="#">
			<div class="form-group">
				<table class="table">
					<thead>
					<tr>
						<th class="text-center"><label for="descripcionPlanta">Nueva Planta</label></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td><input type="text" class="form-control" name="descripcionPlanta" id="descripcionPlanta"></td>
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