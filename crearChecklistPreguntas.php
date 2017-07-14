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

	<?php
	if(isset($_POST['next'])){
		$query = mysqli_query($link, "INSERT INTO Checklist(idChecklist,idCategoriaChecklist,titulo,siglas) VALUES ('{$_POST['idChecklist']}','{$_POST['categoria']}','{$_POST['titulo']}','{$_POST['siglas']}')");
		switch ($_POST['tipoUsuario']){
			case 1:
				$query = mysqli_query($link, "INSERT INTO TipoUsuarioChecklist VALUES ('{$_POST['idChecklist']}',1)");
				break;
			case 2:
				$query = mysqli_query($link, "INSERT INTO TipoUsuarioChecklist VALUES ('{$_POST['idChecklist']}',1)");
				$query = mysqli_query($link, "INSERT INTO TipoUsuarioChecklist VALUES ('{$_POST['idChecklist']}',2)");
				break;
			case 5:
				$query = mysqli_query($link, "INSERT INTO TipoUsuarioChecklist VALUES ('{$_POST['idChecklist']}',1)");
				$query = mysqli_query($link, "INSERT INTO TipoUsuarioChecklist VALUES ('{$_POST['idChecklist']}',2)");
				$query = mysqli_query($link, "INSERT INTO TipoUsuarioChecklist VALUES ('{$_POST['idChecklist']}',5)");
				break;
		}
	}

	if(isset($_POST['delete'])){
		$query = mysqli_query($link,"DELETE FROM PreguntasChecklist WHERE idPreguntasChecklist = '{$_POST['idPregunta']}'");
	}

	if(isset($_POST['addPregunta'])){
		$query = mysqli_query($link, "INSERT INTO PreguntasChecklist (idChecklist, descripcion, tipoRespuesta) VALUES ('{$_POST['idChecklist']}','{$_POST['pregunta']}','{$_POST['tipoRespuesta']}')");
	}
	?>

	<section class="container">
		<form method="post" action="gestionChecklists.php" class="form-horizontal jumbotron col-xs-12 col-md-6 col-md-offset-3">
			<div class="form-group col-xs-12 col-md-12">
				<label for="pregunta">Pregunta:</label>
				<input type="text" id="pregunta" name="pregunta" placeholder="Escriba su pregunta..." class="form-control col-xs-12 col-md-12">
			</div>
			<div class="form-group col-xs-12 col-md-12">
				<label for="tipoRespuesta">Tipo de pregunta:</label>
				<input type="radio" name="tipoRespuesta" id="tipoRespuesta" value="Abierta"> Abierta
				<input type="radio" name="tipoRespuesta" id="tipoRespuesta" value="Cerrada" checked> Cerrada
			</div>
			<div class="form-group col-xs-12 col-md-12">
				<input type="hidden" name="idChecklist" value="<?php echo $_POST['idChecklist'];?>">
                <div class="col-md-4 col-xs-12">
                    <input type="submit" class="btn btn-success col-xs-12 col-md-12" value="Agregar" name="addPregunta" formaction="#">
                </div>
                <div class="spacer5"></div>
                <div class="col-md-4 col-xs-12">
                    <input type="submit" class="btn btn-primary col-xs-12 col-md-12" value="Finalizar" name="next" formaction="gestionChecklists.php">
                </div>
                <div class="spacer5"></div>
                <div class="col-md-4 col-xs-12">
                    <input type="submit" class="btn btn-default col-xs-12 col-md-12" value="Regresar" name="back">
                </div>
			</div>
		</form>
	</section>

	<section class="container">
		<table class="table text-center">
			<thead>
			<tr>
				<th>Nro.</th>
				<th>Pregunta</th>
				<th>Tipo</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<?php
			$aux = 0;
			$query = mysqli_query($link,"SELECT * FROM PreguntasChecklist WHERE idChecklist = '{$_POST['idChecklist']}'");
			while($row = mysqli_fetch_array($query)){
				$aux++;
				echo "<tr>";
					echo "<td>{$aux}</td>";
					echo "<td>{$row['descripcion']}</td>";
					echo "<td>{$row['tipoRespuesta']}</td>";
					echo "<td><form method='post' action='#'>
							<input type='submit' class='btn-link' value='Eliminar' name='delete'>
							<input type='hidden' name='idChecklist' value='{$_POST['idChecklist']}'>
							<input type='hidden' value='{$row['idPreguntasChecklist']}' name='idPregunta'></form></td>";
				echo "</tr>";
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