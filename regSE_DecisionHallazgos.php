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

	<section class="container">
		<div>
			<form method="post" class="form-horizontal jumbotron col-xs-12 col-md-6 col-md-offset-3">
				<h4 class="text-center">¿Se registraron Hallazgos de carácter negativo?</h4>
				<div class="form-group col-xs-12 col-md-12">
					<input type="hidden" name="idSE" value="<?php echo $_POST['idSE'];?>" readonly>
					<div class="col-xs-12 col-md-6">
						<input type="submit" class="btn btn-success col-xs-12 col-md-10 col-md-offset-1" formaction="regSE_AccionInmediata.php" name="siguiente" value="Sí">
					</div>
					<div class="col-xs-12 col-md-6">
						<input type="submit" class="btn btn-primary col-xs-12 col-md-10 col-md-offset-1" formaction="regSE_DecisionMS.php" name="siguiente" value="No">
					</div>
				</div>
			</form>
		</div>
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