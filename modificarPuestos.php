<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
if(isset($_SESSION['login'])&&($_SESSION['usertype']=='3')){
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
</head>

<body>
<header>
	<?php
	include_once('navbarMainAdminSistema.php');
	?>
</header>

<section class="container">
	<?php
	$query = mysqli_query($link,"SELECT * FROM Puesto WHERE idPuesto = '".$_POST['Puesto']."'");
	while($row = mysqli_fetch_array($query)){
		$descripcion = $row['descripcion'];
	}
	?>
	<form class="col-sm-6 col-sm-offset-3" method="post" action="gestionPuestos.php">
		<div class="form-group">
			<div>
				<label for="descripcionPuesto">Nueva Descripción de Puesto</label>
			</div>
			<div>
				<input type="text" class="form-control" name="descripcionPuesto" id="descripcionPuesto" value="<?php echo $descripcion;?>">
			</div>
		</div>
		<div class="form-group">
				<div>
					<label for="tipoUsuario">Seleccione el Tipo de Usuario Predeterminado</label>
				</div>
				<div>
					<select class="form-control" id="tipoUsuario" name="tipoUsuario">
						<option>Seleccionar</option>
						<?php
						$query = mysqli_query($link,"SELECT * FROM TipoUsuario ORDER BY descripcion");
						while($row = mysqli_fetch_array($query)){
							echo "<option value='".$row['idTipoUsuario']."'>".$row['descripcion']."</option>";
						}
						?>
					</select>
				</div>
		</div>
		<div class="form-group">
			<input type="hidden" value="<?php echo $_POST['Puesto']?>" name="Puesto">
			<input type="submit" class="btn btn-default  col-sm-offset-3" value="Regresar">
			<input type="submit" class="btn btn-success col-sm-offset-2" value="Aceptar" name="modifyPuesto">
		</div>
	</form>
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