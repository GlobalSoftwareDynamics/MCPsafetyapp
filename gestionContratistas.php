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
	<nav>
	</nav>
</header>

<section class="container">
	<div>
		<h3>Interfaz de Gestión de Contratistas</h3>
	</div>
	<hr>
	<div class="col-sm-12">
		<form method="post" action="#">
			<div class="form-group col-sm-3">
				<select class="form-control" name="filtro">
					<option>Seleccione el tipo de filtro</option>
					<option value="ruc">Por RUC:</option>
					<option value="razonSocial">Por Razón Social:</option>
					<option value="idTipoEmpresa">Por Tipo de Contratista:</option>
				</select>
			</div>
			<div class="form-group col-sm-5">
				<input type="text" class="form-control" name="valorFiltro">
			</div>
			<div class="form-group col-sm-4">
				<input type="submit" name="submitFiltro" class="btn btn-success" value="Filtrar">
				<input type="submit" name="reset" class="btn btn-danger col-sm-offset-1" value="Remover Filtros">
			</div>
		</form>
	</div>
</section>

<hr>

<?php
if(isset($_POST['submit'])){
	$aux = 0;
	$search = mysqli_query($link,"SELECT * FROM Empresa WHERE ruc = '".$_POST['ruc']."'");
	while($row = mysqli_fetch_array($search)){
		$aux++;
	}
	if($aux!=0){
		$insert = mysqli_query($link, "UPDATE Empresa SET estado = 1 WHERE ruc = '".$_POST['ruc']."'");
	}else{
		$insert = mysqli_query($link,"INSERT INTO Empresa VALUES ('".$_POST['ruc']."','".$_POST['tipoEmpresa']."','".$_POST['razonSocial']."','".$_POST['siglas']."','".$_POST['alcance']."',1)");
	}
}

if(isset($_POST['modify'])){
	$modify = mysqli_query($link, "UPDATE Empresa SET idTipoEmpresa = '".$_POST['tipoEmpresa']."', razonSocial = '".$_POST['razonSocial']."', siglas = '".$_POST['siglas']."', detalleAlcance = '".$_POST['alcance']."' WHERE ruc = '".$_POST['ruc']."'");
}

if(isset($_POST['delete'])){
	$delete = mysqli_query($link,"UPDATE Empresa SET estado = 0 WHERE ruc = '".$_POST['ruc']."'");
}

if(isset($_POST['submitFiltro'])){
	if($_POST['filtro']=='idTipoEmpresa'){
        $query = mysqli_query($link, "SELECT * FROM TipoEmpresa WHERE descripcion LIKE '".$_POST['valorFiltro']."%'");
        while($row = mysqli_fetch_array($query)){
            $_POST['valorFiltro']=$row['idTipoEmpresa'];
        }
    }
	echo '
    <section class="container" id="filtered">
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">RUC</th>
                    <th class="text-center">Razón Social</th>
                    <th class="text-center">Siglas</th>
                    <th class="text-center">Tipo de Contratista</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    ';
	$query = mysqli_query($link,"SELECT * FROM Empresa WHERE estado = 1 AND ".$_POST['filtro']." LIKE '".$_POST['valorFiltro']."%'");
	while($row = mysqli_fetch_array($query)){
		echo "<tr>";
		echo "<td class=\"text-center\">".$row['ruc']."</td>";
		echo "<td class=\"text-center\">".$row['razonSocial']."</td>";
		echo "<td class=\"text-center\">".$row['siglas']."</td>";
		$query2 = mysqli_query($link,"SELECT * FROM TipoEmpresa WHERE idTipoEmpresa = '".$row['idTipoEmpresa']."'");
		while($row2 = mysqli_fetch_array($query2)){
			echo "<td class=\"text-center\">".$row2['descripcion']."</td>";
		}
		echo "
								<form method='post' action='#' id='info'>
                                    <td class='text-center'><input type='submit' class='btn-link' value='Informacion Adicional' name='info' formaction='infoEmpresas.php'></td>
                                    <input type='hidden' value='".$row['ruc']."' name='ruc'>
                                </form>
                                <form method='post' action='#' id='modify'>
                                    <td class='text-center'><input type='submit' class='btn-link' value='Modificar' name='Modificar' formaction='modificarEmpresas.php'></td>
                                    <input type='hidden' value='".$row['ruc']."' name='ruc'>
                                </form>
                                <form method='post' action='#'>
                                    <td class=\"text-center\"><input type=\"submit\" class=\"btn-link\" value=\"Eliminar\" name='delete'></td>
                                    <input type='hidden' value='".$row['ruc']."' name='ruc'>
                                </form>
                            </tr>";
	}
	echo '
        </tbody>
            </table>
        </div>
    </section>
	';
}else{
	echo '
    <section class="container">
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">RUC</th>
                    <th class="text-center">Razón Social</th>
                    <th class="text-center">Siglas</th>
                    <th class="text-center">Tipo de Contratista</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    ';
	$query = mysqli_query($link,"SELECT * FROM Empresa WHERE estado = 1");
	while($row = mysqli_fetch_array($query)){
		echo "<tr>";
		echo "<td class=\"text-center\">".$row['ruc']."</td>";
		echo "<td class=\"text-center\">".$row['razonSocial']."</td>";
		echo "<td class=\"text-center\">".$row['siglas']."</td>";
		$query2 = mysqli_query($link,"SELECT * FROM TipoEmpresa WHERE idTipoEmpresa = '".$row['idTipoEmpresa']."'");
		while($row2 = mysqli_fetch_array($query2)){
			echo "<td class=\"text-center\">".$row2['descripcion']."</td>";
		}
		echo "
								<form method='post' action='#' id='info'>
                                    <td class='text-center'><input type='submit' class='btn-link' value='Informacion Adicional' name='info' formaction='infoEmpresas.php'></td>
                                    <input type='hidden' value='".$row['ruc']."' name='ruc'>
                                </form>
                                <form method='post' action='#' id='modify'>
                                    <td class='text-center'><input type='submit' class='btn-link' value='Modificar' name='Modificar' formaction='modificarEmpresas.php'></td>
                                    <input type='hidden' value='".$row['ruc']."' name='ruc'>
                                </form>
                                <form method='post' action='#'>
                                    <td class=\"text-center\"><input type=\"submit\" class=\"btn-link\" value=\"Eliminar\" name='delete'></td>
                                    <input type='hidden' value='".$row['ruc']."' name='ruc'>
                                </form>
                            </tr>";
	}
	echo '
        </tbody>
            </table>
        </div>
    </section>
	';
}
?>

<hr>

<section class="container">
	<div>
		<form method="post" action="#">
			<div class="form-group">
				<table class="table">
					<thead>
					<tr>
						<th class="text-center"><label for="ruc">RUC</label></th>
						<th class="text-center"><label for="razonSocial">Razón Social</label></th>
						<th class="text-center"><label for="siglas">Siglas</label></th>
						<th class="text-center"><label for="tipoEmpresa">Tipo de Empresa</label></th>
						<th class="text-center"><label for="alcance">Descripción del Alcance</label></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td><input type="text" class="form-control" name="ruc"></td>
						<td><input type="text" class="form-control" name="razonSocial"></td>
						<td><input type="text" class="form-control" name="siglas"></td>
						<td><select class="form-control" name="tipoEmpresa">
								<option>Seleccionar</option>
								<?php
								$query = mysqli_query($link, "SELECT * FROM TipoEmpresa");
								while($row = mysqli_fetch_array($query)){
									echo "<option value='".$row['idTipoEmpresa']."'>".$row['descripcion']."</option>";
								}
								?>
							</select></td>
						<td><textarea name="alcance" rows="5" cols="50" class="form-control"></textarea></td>
						<td><input type="submit" class="btn btn-success" name="submit" value="Agregar"></td>
					</tr>
					</tbody>
				</table>
			</div>
		</form>
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