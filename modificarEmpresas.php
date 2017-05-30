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

<section class="container">
	<?php
	$query = mysqli_query($link,"SELECT * FROM Empresa WHERE ruc = '".$_POST['ruc']."'");
	while($row = mysqli_fetch_array($query)){
		$ruc = $row['ruc'];
		$razonSocial = $row['razonSocial'];
		$siglas = $row['siglas'];
		$tipoEmpresa = $row['idTipoEmpresa'];
		$alcance = $row['detalleAlcance'];
	}
	?>
	<form class="col-sm-6 col-sm-offset-3" method="post" action="gestionContratistas.php">
		<div class="form-group">
			<div>
				<label for="ruc">RUC</label>
			</div>
			<div>
				<input type="text" class="form-control" name="ruc" id="ruc" value="<?php echo $ruc;?>" readonly>
			</div>
		</div>
		<div class="form-group">
			<div>
				<label for="razonSocial">Razón Social</label>
			</div>
			<div>
				<input type="text" class="form-control" name="razonSocial" id="razonSocial" value="<?php echo $razonSocial;?>">
			</div>
		</div>
		<div class="form-group">
			<div>
				<label for="siglas">Siglas</label>
			</div>
			<div>
				<input type="text" class="form-control" name="siglas" id="siglas" value="<?php echo $siglas;?>">
			</div>
		</div>
		<div class="form-group">
			<div>
				<label for="tipoEmpresa">Tipo de Empresa</label>
			</div>
			<div>
				<select name="tipoEmpresa" id="tipoEmpresa" class="form-control">
					<?php
					$query = mysqli_query($link, "SELECT * FROM TipoEmpresa");
					while($row = mysqli_fetch_array($query)){
						if($tipoEmpresa==$row['idTipoEmpresa']){
							echo "<option selected='selected' value='".$tipoEmpresa."'>".$row['descripcion']."</option>";
						}else{
							echo "<option value='".$row['idTipoEmpresa']."'>".$row['descripcion']."</option>";
						}
					}
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div>
				<label for="alcance">Siglas</label>
			</div>
			<div>
				<textarea id="alcance" name="alcance" class="form-control" rows="5" cols="50"><?php echo $alcance;?></textarea>
			</div>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-danger col-sm-offset-3" value="Regresar">
			<input type="submit" class="btn btn-success col-sm-offset-2" value="Aceptar" name="modify">
		</div>
	</form>
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