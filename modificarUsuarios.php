<!DOCTYPE html>

<html lang="es">

<?php
session_start();
$link = mysqli_connect("gsdynamicscom.ipagemysql.com", "gsdsafeatwork", "6DQ~kTpyHPn+Zs$^", "seapp");
mysqli_query($link,"SET NAMES 'utf8'");
//if(isset($_SESSION['login'])){
?>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GSD Safe@Work</title>
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/Formularios.css" rel="stylesheet">
</head>

<body>
<header>
	<?php
	include_once('navbarMainAdminSistema.php');
	?>
</header>

<section class="container">
	<?php
	$query = mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni = '".$_POST['dni']."'");
	while($row = mysqli_fetch_array($query)){
		$usuario = $row['usuario'];
		$pass = $row['password'];
		$tipoUsuario = $row['idTipoUsuario'];
	}
	?>
	<form class="col-sm-6 col-sm-offset-3" method="post" action="gestionUsuarios.php">
		<div class="form-group">
			<div>
				<label for="usuario">Nuevo Nombre de Usuario</label>
			</div>
			<div>
				<input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo $usuario;?>">
			</div>
		</div>
		<div class="form-group">
			<div>
				<label for="password">Nueva Contraseña</label>
			</div>
			<div>
				<input type="text" class="form-control" name="password" id="password" value="<?php echo $pass;?>">
			</div>
		</div>
		<div class="form-group">
			<div>
				<label for="tipoUsuario">Tipo de Usuario</label>
			</div>
			<div>
				<select name="tipoUsuario" id="tipoUsuario" class="form-control">
					<?php
					$query = mysqli_query($link, "SELECT * FROM TipoUsuario");
					while($row = mysqli_fetch_array($query)){
						if($tipoUsuario==$row['idTipoUsuario']){
							echo "<option selected='selected' value='".$tipoUsuario."'>".$row['descripcion']."</option>";
						}else{
							echo "<option value='".$row['idTipoUsuario']."'>".$row['descripcion']."</option>";
						}
					}
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<input type="hidden" value="<?php echo $_POST['dni']?>" name="dni">
			<input type="submit" class="btn btn-default col-sm-offset-3" value="Regresar">
			<input type="submit" class="btn btn-success col-sm-offset-2" value="Aceptar" name="modify">
		</div>
	</form>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<footer class="panel-footer navbar-fixed-bottom">
	<?php
	include_once('footercio.php');
	?>
</footer>
</body>

<?php
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>