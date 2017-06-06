<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
if(isset($_SESSION['login'])){
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
	include_once('navbarMainAdminRRHH.php');
	?>
</header>

<section class="container">
	<div class="col-sm-6 col-sm-offset-3">
	<form method="post" action="gestionColaboradores.php">
		<div class="form-group">
			<div>
				<label for="dni">DNI:</label>
			</div>
			<div>
				<input type="text" name="dni" class="form-control" id="dni">
			</div>
		</div>
		<div class="form-group">
			<div>
				<label for="nombres">Nombres:</label>
			</div>
			<div>
				<input type="text" name="nombres" class="form-control" id="nombres">
			</div>
		</div>
		<div class="form-group">
			<div>
				<label for="apellidos">Apellidos:</label>
			</div>
			<div>
				<input type="text" name="apellidos" class="form-control" id="apellidos">
			</div>
		</div>
		<div class="form-group">
			<div>
				<label for="email">Correo Electrónico:</label>
			</div>
			<div>
				<input type="text" name="email" class="form-control" id="email">
			</div>
		</div>
		<div class="form-group">
			<div>
				<label for="empresa">Empresa:</label>
			</div>
			<div>
				<select id="empresa" name="empresa" class="form-control">
					<?php
					$query = mysqli_query($link,"SELECT * FROM Empresa WHERE estado = 1");
					while($row = mysqli_fetch_array($query)){
						echo "<option value='".$row['ruc']."'>".$row['razonSocial']."</option>";
					}
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div>
				<label for="puesto">Puesto:</label>
			</div>
			<div>
				<select id="puesto" name="puesto" class="form-control">
					<?php
					$query = mysqli_query($link,"SELECT * FROM Puesto WHERE estado = 1");
					while($row = mysqli_fetch_array($query)){
						echo "<option value='".$row['idPuesto']."'>".$row['descripcion']."</option>";
					}
					?>
				</select>
			</div>
		</div>
        <div class="form-group">
            <div>
                <label for="telefono">Número Telefónico (Anexo):</label>
            </div>
            <div>
                <input type="text" name="telefono" class="form-control" id="telefono">
            </div>
        </div>
        <div class="form-group">
            <div>
                <label for="celular">Celular:</label>
            </div>
            <div>
                <input type="text" name="celular" class="form-control" id="celular">
            </div>
        </div>
		<div class="form-group">
			<div>
				<label for="sctr">Estado de SCTR:</label>
			</div>
			<div>
				<input type="text" name="sctr" class="form-control" id="sctr">
			</div>
		</div>
		<div class="form-group">
			<div>
				<input type="submit" value="Regresar" class="btn btn-default col-sm-offset-3">
				<input type="submit" name="submit" value="Agregar" class="btn btn-success col-sm-offset-2">
			</div>
		</div>
	</form>
	</div>
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