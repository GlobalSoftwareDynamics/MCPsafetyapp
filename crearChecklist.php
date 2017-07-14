<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
include('funcionesApp.php');
if(isset($_SESSION['login'])&&(($_SESSION['usertype']=='1'))||($_SESSION['usertype']=='2')||($_SESSION['usertype']=='5')){
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
        <link href="css/styles.css" rel="stylesheet">
	</head>

	<body>
	<header>
		<?php
		include_once('navbarmainAdmin.php');
		?>
	</header>

	<section class="container">
		<form method="post" action="gestionChecklists.php" class="form-horizontal jumbotron col-xs-12 col-md-6 col-md-offset-3">
			<div class="form-group col-xs-12 col-md-12">
				<label for="titulo">Título:</label>
				<input type="text" id="titulo" name="titulo" placeholder="Determine un título para el Checklist." class="form-control">
			</div>
			<div class="form-group col-xs-12 col-md-12">
				<label for="siglas">Siglas:</label>
				<input type="text" id="siglas" name="siglas" placeholder="Indique las siglas del Checklist" class="form-control">
			</div>
			<div class="form-group col-xs-12 col-md-12">
				<label for="categoria">Categoría:</label>
				<select class="form-control" name="categoria" id="categoria">
					<option>Seleccionar</option>
					<?php
					$query = mysqli_query($link, "SELECT * FROM CategoriaChecklist");
					while($row = mysqli_fetch_array($query)){
						echo "<option value='{$row['idCategoriaChecklist']}'>{$row['descripcion']}</option>";
					}
					$idChecklist = idgen('CHK');
					?>
				</select>
			</div>
			<div class="form-group col-xs-12 col-md-12">
				<label for="tipoUsuario">Accesibilidad:</label>
				<select class="form-control" name="tipoUsuario" id="tipoUsuario">
					<option>Seleccionar</option>
					<option value='1'>Gerencia</option>
					<option value='2'>Supervisores</option>
					<option value='5'>Operarios</option>
				</select>
			</div>
			<div class="form-group col-xs-12 col-md-12">
                <input type="hidden" name="idChecklist" value="<?php echo $idChecklist;?>">
                <div class="col-md-6 col-xs-12">
                    <input type="submit" class="btn btn-primary col-xs-12 col-md-12" value="Siguiente" name="next" formaction="crearChecklistPreguntas.php">
                </div>
                <div class="spacer5"></div>
                <div class="col-md-6 col-xs-12">
                    <input type="submit" class="btn btn-default col-xs-12 col-md-12" value="Regresar" name="back">
                </div>
			</div>
		</form>
	</section>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<footer class="panel-footer navbar-fixed-bottom hidden-xs">
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