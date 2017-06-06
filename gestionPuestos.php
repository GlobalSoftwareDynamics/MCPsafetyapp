<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
if(isset($_SESSION['login'])){
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
</head>

<body>
<header>
	<?php
	include_once('navbarMainAdminSistema.php');
	?>
</header>

<?php
if(isset($_POST['submit'])){
	$insert = mysqli_query($link, "INSERT INTO Puesto (descripcion, idTipoUsuario,estado) VALUES ('".$_POST['puesto']."','".$_POST['tipoUsuario']."','1')");
}

if(isset($_POST['modifyPuesto'])){
    $update = mysqli_query($link,"UPDATE Puesto SET descripcion = '".$_POST['descripcionPuesto']."', idTipoUsuario = '".$_POST['tipoUsuario']."' WHERE idPuesto = '".$_POST['Puesto']."'");
}

if(isset($_POST['delete'])){
    $delete = mysqli_query($link, "UPDATE Puesto SET estado = '0' WHERE idPuesto = '".$_POST['Puesto']."'");
}
?>

<section class="container">
	<div>
		<h3>Registro de Puestos/Posiciones de Trabajo</h3>
	</div>
	<hr>
	<div>
		<table class="table">
			<thead>
			<tr>
				<th class="text-center">Puesto</th>
				<th class="text-center">Tipo de Usuario por defecto</th>
				<th class="text-center"></th>
				<th class="text-center"></th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<?php
				$query = mysqli_query($link,"SELECT * FROM Puesto WHERE estado = '1' ORDER BY descripcion");
				while($row = mysqli_fetch_array($query)){
				    $descripcion = "'".$row['descripcion']."'";
					echo "<tr>";
					echo "<td class=\"text-center\">".$row['descripcion']."</td>";
					$query2 = mysqli_query($link,"SELECT * FROM TipoUsuario WHERE idTipoUsuario = '".$row['idTipoUsuario']."'");
					while($row2 = mysqli_fetch_array($query2)){
						echo "<td class=\"text-center\">".$row2['descripcion']."</td>";
					}
					echo "
					<form method='post' action='gestionPuestos.php' id='modify'>
						<td class='text-center'><input type='submit' class='btn btn-link' value='Modificar' name='Modificar' formaction='modificarPuestos.php'></td>
						<input type='hidden' value='".$row['idPuesto']."' name='Puesto'>
					</form>
					<form method='post' action='gestionPuestos.php'>
						<td class=\"text-center\"><input type=\"submit\" class=\"btn btn-link\" value=\"Eliminar\" name='delete'></td>
						<input type='hidden' value='".$row['idPuesto']."' name='Puesto'>
					</form>
					</tr>";
				}
				?>

			</tbody>
		</table>
	</div>
</section>

<hr>

<section class="container">
    <button type="button" class="btn btn-success col-sm-2 col-sm-offset-5" data-toggle="modal" data-target="#myModal">Agregar Puesto</button>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="Nuevo Puesto" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Nuevo Puesto</h5>
                </div>
                <div class="modal-body">
                        <form method="post" action="gestionPuestos.php">
                            <div class="form-group">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-center"><label for="puesto">Nuevo Puesto</label></th>
                                        <th class="text-center"><label for="tipoUsuario">Tipo de Usuario por Defecto</label></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="text" class="form-control" name="puesto" id="puesto"></td>
                                        <td><select class="form-control" id="tipoUsuario" name="tipoUsuario">
                                                <option>Seleccionar</option>
								                <?php
								                $query = mysqli_query($link,"SELECT * FROM TipoUsuario ORDER BY descripcion");
								                while($row = mysqli_fetch_array($query)){
									                echo "<option value='".$row['idTipoUsuario']."'>".$row['descripcion']."</option>";
								                }
								                ?>
                                            </select></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <input type="submit" value="Cerrar" name="close" data-dismiss="modal" class="btn btn-default col-sm-offset-4">
                                    <input type="submit" value="Agregar" name="submit" class="btn btn-success col-sm-offset-1">
                                    <br>
                                </div>
                            </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="container">

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