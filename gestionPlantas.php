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
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
<header>
	<?php
	include_once('navbarMainAdminSistema.php');
	?>
</header>

<?php
if(isset($_POST['submit'])){
	$submit = mysqli_query($link, "INSERT INTO Planta(descripcion,estado) VALUES ('".$_POST['descripcionPlanta']."','1')");
}

if(isset($_POST['modify'])){
	$modify = mysqli_query($link, "UPDATE Planta SET descripcion = '".$_POST['descripcionPlanta']."' WHERE idPlanta = '".$_POST['planta']."'");
}

if(isset($_POST['delete'])){
	$delete = mysqli_query($link, "UPDATE Planta SET estado = '0' WHERE idPlanta = '".$_POST['planta']."'");
}
?>

<section class="container">
    <div>
        <h3>Gestión de Plantas</h3>
    </div>
    <hr>
	<table class="table">
		<thead>
			<tr>
				<th class="text-center">Denominación de Planta</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$query = mysqli_query($link, "SELECT * FROM Planta WHERE estado = '1'");
			while($row = mysqli_fetch_array($query)){
				echo "<tr>";
				echo "<td class='text-center'>".$row['descripcion']."</td>";
				echo "<td class='text-center'>
						<form method='post' action='gestionPlantas.php'>
							<input type='submit' class='btn-link' value='Ver Ubicaciones' formaction='gestionUbicaciones.php'>
							<input type='hidden' value='".$row['idPlanta']."' name='planta'>
						</form>
					</td>";
				echo "<td class='text-center'>
						<form method='post' action='gestionPlantas.php'>
							<input type='submit' class='btn-link' value='Modificar' formaction='modificarPlantas.php'>
							<input type='hidden' value='".$row['idPlanta']."' name='planta'>
						</form>
					</td>";
				echo "<td class='text-center'>
						<form method='post' action='gestionPlantas.php'>
							<input type='submit' class='btn-link' value='Eliminar' formaction='gestionPlantas.php' name='delete'>
							<input type='hidden' value='".$row['idPlanta']."' name='planta'>
						</form>
					</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</section>

<section class="container">
    <button type="button" class="btn btn-success col-sm-2 col-sm-offset-5" data-toggle="modal" data-target="#myModal">Agregar Planta</button>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="Nuevo Puesto" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Nueva Planta</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="gestionPlantas.php">
                        <div class="form-group">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center"><label for="descripcionPlanta">Nombre de Planta</label></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" name="descripcionPlanta" id="descripcionPlanta"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Cerrar" name="close" data-dismiss="modal" class="btn btn-default col-md-offset-4">
                            <input type="submit" value="Agregar" name="submit" class="btn btn-success col-md-offset-1">
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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