<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
if(isset($_SESSION['login'])&&($_SESSION['usertype']=='4')){
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
    <script>
        function getCiudad(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:'infoEmpresas_pais='+val,
                success: function(data){
                    $("#ciudad").html(data);
                }
            });
        }
    </script>
</head>

<body>
<header>
	<?php
	include_once('navbarMainAdminRRHH.php');
	?>
</header>

<?php
if(isset($_POST['submit'])){
	$insert = mysqli_query($link, "INSERT INTO Telefono VALUES ('".$_POST['telefono']."')");
    $insert = mysqli_query($link, "INSERT INTO Sede(ruc,idCiudad,telefono,direccion,estado) VALUES ('".$_POST['ruc']."','".$_POST['ciudad']."','".$_POST['telefono']."','".$_POST['direccion']."',1)");
}

if(isset($_POST['delete'])){
    $delete = mysqli_query($link, "UPDATE Sede SET estado = 0 WHERE idSede = '".$_POST['idSede']."'");
}

if(isset($_POST['modify'])){
	$modify = mysqli_query($link, "SET foreign_key_checks = 0");
    $modify = mysqli_query($link, "UPDATE Telefono SET numero = '".$_POST['telefono']."' WHERE numero = '".$_POST['telefonoant']."'");
    $modify = mysqli_query($link, "UPDATE Sede SET direccion = '".$_POST['direccion']."', telefono = '".$_POST['telefono']."' WHERE idSede = '".$_POST['idSede']."'");
	$modify = mysqli_query($link, "SET foreign_key_checks = 1");
}
?>

<section class="container">
    <div class="col-sm-4">
        <div class="col-sm-8">
            <h3 class="text-center">Ficha de Empresa</h3>
        </div>
        <div class="col-sm-12">
	        <?php
	        $query = mysqli_query($link,"SELECT * FROM Empresa WHERE ruc = '".$_POST['ruc']."'");
	        while($row = mysqli_fetch_array($query)){
		        $razonSocial = $row['razonSocial'];
		        $siglas = $row['siglas'];
		        $alcance = $row['detalleAlcance'];
		        $estado = $row['estado'];
		        $query2 = mysqli_query($link, "SELECT * FROM TipoEmpresa WHERE idTipoEmpresa = '".$row['idTipoEmpresa']."'");
		        while($row2 = mysqli_fetch_array($query2)){
			        $tipoEmpresa = $row2['descripcion'];
		        }
	        }
	        ?>
            <div>
                <p>&nbsp;RUC: <?php echo $_POST['ruc'];?></p>
                <p>&nbsp;Razón Social: <?php echo $razonSocial;?></p>
                <p>&nbsp;Siglas: <?php echo $siglas;?></p>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="col-sm-3 col-sm-offset-9">
            <br>
            <img width="auto" height="100" src="image/Logo.png"/>
        </div>
    </div>
</section>

<section class="container">

</section>

<hr>

<section class="container">
	<div>
		<div>
			<h4>Sedes de la Empresa</h4>
		</div>
		<div>
			<table class="table">
				<thead>
				<tr>
					<th class="text-center">Ciudad de Ubicación</th>
					<th class="text-center">Dirección</th>
					<th class="text-center">Teléfono</th>
					<th></th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				<?php
				$query = mysqli_query($link, "SELECT * FROM Sede WHERE ruc = '".$_POST['ruc']."' AND estado = 1");
				while($row = mysqli_fetch_array($query)){
				    $query2 = mysqli_query($link,"SELECT * FROM Ciudad WHERE idCiudad = '".$row['idCiudad']."'");
				    while($row2 = mysqli_fetch_array($query2)){
				        $ciudad = $row2['nombre'];
                    }
					echo "
                        <tr>
						<td class=\"text-center\">".$ciudad."</td>
						<td class=\"text-center\">".$row['direccion']."</td>
						<td class=\"text-center\">".$row['telefono']."</td>
						<form method='post' action='infoEmpresas.php' id='modify'>
							<td class='text-center'><input type='submit' class='btn-link' value='Modificar' name='Modificar' formaction='modificarSedes.php'></td>
							<input type='hidden' value='".$row['ruc']."' name='ruc'>
							<input type='hidden' value='".$row['idSede']."' name='idSede'>
						</form>
						<form method='post' action='infoEmpresas.php'>
							<td class=\"text-center\"><input type=\"submit\" class=\"btn-link\" value=\"Eliminar\" name='delete'></td>
							<input type='hidden' value='".$row['ruc']."' name='ruc'>
							<input type='hidden' value='".$row['idSede']."' name='idSede'>
						</form>
						</tr>
						";
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<section class="container">
    <button type="button" class="btn btn-success col-sm-2 col-sm-offset-5" data-toggle="modal" data-target="#myModal">Agregar Sede</button>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="Nueva Sede" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Nueva Sede</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="infoEmpresas.php">
                        <div class="form-group">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center"><label for="pais">País</label></th>
                                    <th class="text-center"><label for="ciudad">Ciudad</label></th>
                                    <th class="text-center"><label for="direccion">Dirección</label></th>
                                    <th class="text-center"><label for="telefono">Teléfono</label></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><select id="pais" name="ciudad" onchange="getCiudad(this.value);" class="form-control">
                                            <option>Seleccionar</option>
							                <?php
							                $query = mysqli_query($link,"SELECT * FROM Pais");
							                while($row = mysqli_fetch_array($query)){
								                echo "<option value='".$row['idPais']."'>".$row['nombre']."</option>";
							                }
							                ?>
                                        </select></td>
                                    <td><select id="ciudad" name="ciudad" class="form-control">
                                        </select></td>
                                    <td><input type="text" class="form-control" name="direccion" id="direccion"></td>
                                    <td><input type="text" class="form-control" name="telefono" id="telefono"></td>
                                    <input type="hidden" name="ruc" value="<?php echo $_POST['ruc']?>">
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Cerrar" name="close" data-dismiss="modal" class="btn btn-default col-sm-offset-4">
                            <input type="submit" value="Agregar" name="submit" class="btn btn-success col-sm-offset-2">
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<hr>

<section class="container">
	<div>
		<div>
			<h4>Listado de Colaboradores Habilitados</h4>
		</div>
		<div>
	        <table class="table">
	            <thead>
	                <tr>
	                    <th class="text-center">DNI</th>
	                    <th class="text-center">Nombres</th>
	                    <th class="text-center">Apellidos</th>
	                    <th class="text-center">Puesto</th>
	                    <th class="text-center">Tipo de Usuario</th>
	                    <th class="text-center">Correo Electrónico</th>
	                    <th class="text-center">Teléfono</th>
	                    <th class="text-center">Celular</th>
	                    <th></th>
	                    <th></th>
	                </tr>
	            </thead>
	            <tbody>
				    <?php
					$query = mysqli_query($link,"SELECT * FROM Colaboradores WHERE ruc = '".$_POST['ruc']."'");
					while($row = mysqli_fetch_array($query)) {
						$aux = 0;
						$aux2 = 0;
						echo "<tr>";
						echo "<td class=\"text-center\">" . $row['dni'] . "</td>";
						echo "<td class=\"text-center\">" . $row['nombre'] . "</td>";
						echo "<td class=\"text-center\">" . $row['apellidos'] . "</td>";
						$query2 = mysqli_query($link, "SELECT * FROM Puesto WHERE idPuesto = '" . $row['idPuesto'] . "'");
						while ($row2 = mysqli_fetch_array($query2)) {
							echo "<td class=\"text-center\">" . $row2['descripcion'] . "</td>";
						}
						$query2 = mysqli_query($link, "SELECT * FROM TipoUsuario WHERE idTipoUsuario = '" . $row['idTipoUsuario'] . "'");
						while ($row2 = mysqli_fetch_array($query2)) {
							echo "<td class=\"text-center\">" . $row2['descripcion'] . "</td>";
							$aux2 = 1;
						}
						if ($aux2 == 0) {
							echo "<td class='text-center'>-</td>";
						}
						echo "<td class=\"text-center\">" . $row['email'] . "</td>";
						$query2 = mysqli_query($link, "SELECT * FROM TelefonoColaboradores WHERE dni = '" . $row['dni'] . "' AND estado = 1");
						while ($row2 = mysqli_fetch_array($query2)) {
							if ($aux < 2) {
								echo "<td class=\"text-center\">" . $row2['numero'] . "</td>";
								$aux++;
							}
						}
						echo "</tr>";
					}
				    ?>
	            </tbody>
	        </table>
        </div>
	</div>
</section>

<section class="container">
    <form method="post" action="infoEmpresasPDF.php">
        <!--<input type="submit" value="Descargar PDF" class="btn btn-primary col-sm-2 col-sm-offset-5">-->
        <input type="hidden" name="ruc" value="<?php echo $_POST['ruc'];?>">
    </form>
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
