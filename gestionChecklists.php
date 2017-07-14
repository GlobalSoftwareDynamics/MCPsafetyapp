<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
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
		<div class="row text-center">
			<h3>Gestión de Checklists</h3>
			<br>
		</div>
	</section>

	<section class="container">
		<table class="table text-center">
			<thead>
			<tr>
				<th>Nro.</th>
				<th>Título</th>
				<th>Siglas</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<?php
			$aux=0;
			$query = mysqli_query($link,"SELECT * FROM Checklist");
			while($row = mysqli_fetch_array($query)){
				$aux++;
				echo "<tr>";
					echo "<td>{$aux}</td>";
					echo "<td>{$row['titulo']}</td>";
					echo "<td>{$row['siglas']}</td>";
					echo "<td><form method='post' action='modificarChecklist.php'>
							<input type='submit' class='btn-link' value='Modificar' name='modify'>
							<input type='hidden' value='{$row['idChecklist']}' name='idChecklist'></form></td>";
				echo "</tr>";
			}
			?>
			</tbody>
		</table>
		<form method="post" action="crearChecklist.php">
			<div class="form-group col-md-4 col-md-offset-4 col-xs-12">
				<input type="submit" class="btn btn-success form-control" value="Crear Nuevo Checklist">
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