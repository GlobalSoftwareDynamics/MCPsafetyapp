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
	<?php
	include_once('navbarMainAdminSistema.php');
	?>
</header>

<?php
if(isset($_POST['delete'])){
	$delete = mysqli_query($link,"UPDATE Ubicacion SET estado = 0 WHERE idUbicacion = '".$_POST['ubicacion']."'");
}

if(isset($_POST['submit'])){
	$insert = mysqli_query($link,"INSERT INTO Ubicacion(idPlanta,descripcion,estado) VALUES ('".$_POST['planta']."','".$_POST['descripcionUbicacion']."',1)");
}

if(isset($_POST['modify'])){
	$modify = mysqli_query($link, "UPDATE Ubicacion SET descripcion = '".$_POST['descripcionUbicacion']."' WHERE idUbicacion = '".$_POST['ubicacion']."'");
}
?>

<section class="container">
    <div>
        <h3>Gestión de Ubicaciones</h3>
    </div>
    <hr>
	<table class="table">
		<thead>
		<tr>
			<th class="text-center">Planta</th>
			<th class="text-center">Descripción de la Ubicación</th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<?php
		$query = mysqli_query($link, "SELECT * FROM Planta WHERE estado = 1 AND idPlanta = '".$_POST['planta']."'");
		while($row = mysqli_fetch_array($query)){
			$query2 = mysqli_query($link, "SELECT * FROM Ubicacion WHERE idPlanta = '".$row['idPlanta']."' AND estado = 1");
			while($row2 = mysqli_fetch_array($query2)){
				echo "<tr>";
					echo "<td class='text-center'>".$row['descripcion']."</td>";
					echo "<td class='text-center'>".$row2['descripcion']."</td>";
					echo "<td class='text-center'>
							<form method='post' action='#'>
								<input type='submit' class='btn-link' value='Modificar' formaction='modificarUbicaciones.php'>
								<input type='hidden' value='".$row2['idUbicacion']."' name='ubicacion'>
								<input type='hidden' value='".$_POST['planta']."' name='planta'>
							</form>
						</td>";
					echo "<td class='text-center'>
							<form method='post' action='#'>
								<input type='submit' class='btn-link' value='Eliminar' formaction='#' name='delete'>
								<input type='hidden' value='".$row2['idUbicacion']."' name='ubicacion'>
								<input type='hidden' value='".$_POST['planta']."' name='planta'>
							</form>
						</td>";
				echo "</tr>";
			}
		}
		?>
		</tbody>
	</table>
</section>

<section class="container">
    <form method="post" action="gestionPlantas.php">
        <input type="submit" class="btn btn-default col-sm-2 col-sm-offset-3" value="Regresar">
        <button type="button" class="btn btn-success col-sm-2 col-sm-offset-2" data-toggle="modal" data-target="#myModal">Agregar Planta</button>
    </form>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="Nuevo Puesto" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Nueva Planta</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="#">
                        <div class="form-group">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center"><label for="planta">Planta</label></th>
                                    <th class="text-center"><label for="descripcionUbicacion">Nueva Ubicación</label></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
					                <?php
					                $query = mysqli_query($link,"SELECT * FROM Planta WHERE estado = 1 AND idPlanta = '".$_POST['planta']."'");
					                while($row = mysqli_fetch_array($query)){
						                echo "<td class='col-sm-4'><input type='text' class='form-control' value='".$row['descripcion']."' readonly></td>";
					                }
					                ?>
                                    <td><input type="text" class="form-control" name="descripcionUbicacion" id="descripcionUbicacion"></td>
                                    <td><input type="submit" class="btn btn-success" name="submit" value="Agregar"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="planta" value="<?php echo $_POST['planta']?>">
                        <div class="form-group">
                            <input type="submit" value="Agregar" name="submit" class="btn btn-success col-sm-offset-4">
                            <input type="submit" value="Cerrar" name="close" data-dismiss="modal" class="btn btn-default col-sm-offset-1">
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container">
	<div class="col-sm-12 col-sm-offset-5">
		<form method="post" action="gestionPlantas.php">

		</form>
	</div>
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