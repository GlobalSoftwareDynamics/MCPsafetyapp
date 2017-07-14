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
		if($_SESSION['usertype']=='1'||$_SESSION['usertype']=='2'){
			include_once('navbarmainSupervisor.php');
		}elseif($_SESSION['usertype']=='5'){
			include_once('navbarmainOperario.php');
		}
		?>
	</header>

	<?php
	if(isset($_POST['next'])){
		$dni = 0;
		$query = mysqli_query($link,"SELECT * FROM Colaboradores WHERE usuario = '{$_SESSION['login']}'");
		while($row = mysqli_fetch_array($query)){
			$dni = $row['dni'];
		}
		$fecha = date('d/m/Y');
		$idChecklistDatos = idgen('CHKD');
		$query = mysqli_query($link,"INSERT INTO ChecklistDatos VALUES ('{$idChecklistDatos}','{$_POST['idChecklist']}','{$dni}','{$_POST['ubicacion']}','{$fecha}')");
		$query = mysqli_query($link, "SELECT * FROM PreguntasChecklist WHERE idChecklist = '{$_POST['idChecklist']}'");
		while($row = mysqli_fetch_array($query)){
			$cadena = "rspta".$row['idPreguntasChecklist'];
			$respuesta = $_POST[$cadena];
			$query2 = mysqli_query($link, "INSERT INTO LlenadoChecklist VALUES ('{$idChecklistDatos}','{$row['idPreguntasChecklist']}','{$respuesta}')");
		}
	}
	?>

	<section class="container">
		<div class="row text-center">
			<h3>Registro de Checklists Disponibles</h3>
			<br>
		</div>
	</section>

	<section class="container">
		<table class="table text-center">
			<thead>
			<tr>
				<th>Título</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<?php
			$aux=0;
			$query = mysqli_query($link,"SELECT * FROM TipoUsuarioChecklist WHERE idTipoUsuario = '{$_SESSION['usertype']}'");
			while($row2 = mysqli_fetch_array($query)){
				$query2 = mysqli_query($link, "SELECT * FROM Checklist WHERE idChecklist = '{$row2['idChecklist']}'");
				while($row = mysqli_fetch_array($query2)){
					$aux++;
					echo "<tr>";
					echo "<td>{$row['titulo']}</td>";
					echo "<td><form method='post' action='llenarChecklist.php'>
							<input type='submit' class='btn btn-success' value='Llenar' name='next'>
							<input type='hidden' value='{$row['idChecklist']}' name='idChecklist'></form></td>";
					echo "</tr>";
				}
			}
			?>
			</tbody>
		</table>
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