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
	<nav>
	</nav>
</header>

<?php
if(isset($_POST['submit'])){
	$insert = mysqli_query($link, "INSERT INTO Telefono VALUES ('".$_POST['telefono']."')");
    $insert = mysqli_query($link, "INSERT INTO Sede(ruc,idCiudad,telefono,direccion,estado) VALUES ('".$_POST['ruc']."','".$_POST['ciudad']."','".$_POST['telefono']."','".$_POST['direccion']."',1)");
}
?>

<section class="container">
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
		<p>RUC: <?php echo $_POST['ruc'];?></p>
		<p>Razón Social: <?php echo $razonSocial;?></p>
		<p>Siglas: <?php echo $siglas;?></p>
	</div>
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
				$query = mysqli_query($link, "SELECT * FROM Sede WHERE ruc = '".$_POST['ruc']."'");
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
						<form method='post' action='#' id='modify'>
							<td class='text-center'><input type='submit' class='btn-link' value='Modificar' name='Modificar' formaction='modificarSedes.php'></td>
							<input type='hidden' value='".$row['ruc']."' name='ruc'>
						</form>
						<form method='post' action='#'>
							<td class=\"text-center\"><input type=\"submit\" class=\"btn-link\" value=\"Eliminar\" name='delete'></td>
							<input type='hidden' value='".$row['ruc']."' name='ruc'>
						</form>
						</tr>
						";
				}
				?>
				</tbody>
			</table>
		</div>
		<div class="col-sm-4 col-sm-offset-5">
			<form method="post" action="#">
				<input type="submit" value="Agregar Sede" class="btn btn-success">
                <input type="hidden" value="<?php echo $_POST['ruc']?>" name="ruc">
			</form>
		</div>
	</div>
</section>

<hr>

<section class="container">
    <div>
        <form method="post" action="#">
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
                        <td><input type="submit" class="btn btn-success" name="submit" value="Agregar"></td>
                        <input type="hidden" name="ruc" value="<?php echo $_POST['ruc']?>">
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<footer class="panel-footer navbar-fixed-bottom">
</footer>
</body>

<?php
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>
