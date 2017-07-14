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

	<?php
	if(isset($_POST['delete'])){
		$delete = mysqli_query($link, "DELETE FROM ObservacionesSE WHERE idObservacionesSE = '".$_POST['idObservacionSE']."' AND idSafetyEyes = '".$_POST['idSE']."'");
	}
	?>

	<section class="container">
		<div>
			<table class="table">
				<thead>
                <th class="text-center">Descripcion</th>
				<th class="text-center">Categoria</th>
				<th class="text-center">Clase</th>
				<th class="text-center">COP</th>
				<!--<th class="text-center">Detalle</th>-->
				<th></th>
				</thead>
				<tbody>
				<?php
				$query = mysqli_query($link, "SELECT * FROM ObservacionesSE WHERE idSafetyEyes = '".$_POST['idSE']."'");
				while($row = mysqli_fetch_array($query)){
					echo "<tr>";
					echo "<td class='text-center'>{$row['descripcion']}</td>";
					$query2 = mysqli_query($link, "SELECT * FROM Categoria WHERE idCategoria = '".$row['idCategoria']."'");
					while($row2 = mysqli_fetch_array($query2)){
						echo "<td class='text-center'>".$row2['siglas']."</td>";
					}
					$query2 = mysqli_query($link, "SELECT * FROM Clase WHERE idClase = '".$row['idClase']."'");
					while($row2 = mysqli_fetch_array($query2)){
						echo "<td class='text-center'>".$row2['siglas']."</td>";
					}
					$query2 = mysqli_query($link, "SELECT * FROM COPs WHERE idCOPs = '".$row['idCOPs']."'");
					while($row2 = mysqli_fetch_array($query2)){
						echo "<td class='text-center'>".$row2['siglas']."</td>";
					}
					/*echo "<td>".$row['descripcion']."</td>";*/
					echo "<td class='text-center'>
											<form method='post' action='verRegSE_Hallazgos.php'>
												<input type='submit' class='btn-link' value='Eliminar' name='delete'>
												<input type='hidden' value='" .$_POST['idSE']."' name='idSE'>
												<input type='hidden' value='".$row['idObservacionesSE']."' name='idObservacionSE'>";
                                                if(isset($_POST['addFinal'])){
                                                    echo "<input type='hidden' name='addFinal' value='{$_POST['addFinal']}'>";
                                                }
                                        echo "</form>
									  </td>";
					echo "</tr>";
				}
				?>
				</tbody>
			</table>
			<form method="post">
				<?php
				if(isset($_POST['addFinal'])){
					echo "<input type='hidden' name='addFinal' value='{$_POST['addFinal']}'>";
				}
				?>
				<div class="form-group">
					<input type="hidden" name="idSE" value="<?php echo $_POST['idSE'];?>">
					<div class="col-xs-12 col-md-6 col-md-offset-3">
						<input type="submit" class="btn btn-default col-xs-12 col-md-10 col-md-offset-1" formaction="regSE_Hallazgos.php" name="back" value="Regresar">
					</div>
				</div>
			</form>
		</div>
	</section>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<footer class="panel-footer navbar-fixed-bottom hidden-xs>
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