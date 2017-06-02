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
	include_once('navbarMainAdminRRHH.php');
	?>
</header>

<section class="container">
    <div>
        <form method="post" action="#" class="jumbotron form-horizontal col-sm-12">
            <div class="form-group col-sm-4">
                <div class="col-sm-4">
                    <label for="filtro">Columna:</label>
                </div>
                <div class="col-sm-8">
                    <select class="form-control" name="filtro" id="filtro">
                        <option>Seleccionar</option>
                        <option value="dni">Por DNI:</option>
                        <option value="apellidos">Por Apellidos:</option>
                        <option value="idPuesto">Por Puesto:</option>
                        <option value="idTipoUsuario">Por ID Tipo de Usuario:</option>
                        <option value="ruc">Por Empresa:</option>
                        <option value="estado">Por Estado:</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-sm-4">
                <div class="col-sm-4">
                    <label for="valorFiltro">Búsqueda:</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="valorFiltro" id="valorFiltro">
                </div>
            </div>
            <div class="form-group col-sm-4">
                <div class="col-sm-6">
                    <input type="submit" name="submitFiltro" class="btn btn-success col-sm-12" value="Filtrar">
                </div>
                <div class="col-sm-6">
                    <input type="submit" name="reset" class="btn btn-default col-sm-12" value="Remover Filtros">
                </div>
            </div>
        </form>
    </div>
</section>

<hr>

<?php
if(isset($_POST['submit'])){
	$submit = mysqli_query($link,"INSERT INTO Colaboradores VALUES ('".$_POST['dni']."','".$_POST['puesto']."',null,'".$_POST['empresa']."','".$_POST['nombres']."','".$_POST['apellidos']."','".$_POST['email']."',null,null,1,'".$_POST['sctr']."')");
	$submit = mysqli_query($link,"INSERT INTO Telefono VALUES ('".$_POST['telefono']."')");
	$submit = mysqli_query($link,"INSERT INTO Telefono VALUES ('".$_POST['celular']."')");
	$submit = mysqli_query($link,"INSERT INTO TelefonoColaboradores VALUES ('".$_POST['telefono']."','".$_POST['dni']."',1)");
	$submit = mysqli_query($link,"INSERT INTO TelefonoColaboradores VALUES ('".$_POST['celular']."','".$_POST['dni']."',1)");
}

if(isset($_POST['modify'])){
	$modify = mysqli_query($link, "UPDATE Colaboradores SET nombre = '".$_POST['nombres']."', apellidos =  '".$_POST['apellidos']."', email = '".$_POST['email']."', ruc = '".$_POST['empresa']."', idPuesto = '".$_POST['puesto']."' WHERE dni = '".$_POST['dni']."'");
	$modify = mysqli_query($link, "SET foreign_key_checks = 0");
	$modify = mysqli_query($link, "UPDATE Telefono SET numero = '".$_POST['telefono']."' WHERE numero = '".$_POST['telefonoant']."'");
	$modify = mysqli_query($link, "UPDATE Telefono SET numero = '".$_POST['celular']."' WHERE numero = '".$_POST['celularant']."'");
	$modify = mysqli_query($link, "UPDATE TelefonoColaboradores SET numero = '".$_POST['telefono']."' WHERE dni = '".$_POST['dni']."' AND numero = '".$_POST['telefonoant']."'");
	$modify = mysqli_query($link, "UPDATE TelefonoColaboradores SET numero = '".$_POST['celular']."' WHERE dni = '".$_POST['dni']."' AND numero = '".$_POST['celularant']."'");
	$modify = mysqli_query($link, "SET foreign_key_checks = 1");
}

if(isset($_POST['delete'])){
    $query = mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni = '".$_POST['dni']."'");
    while($row = mysqli_fetch_array($query)){
        if($row['estado'] == 0){
	        $delete = mysqli_query($link,"UPDATE Colaboradores SET estado = 1 WHERE dni = '".$_POST['dni']."'");
        }else{
	        $delete = mysqli_query($link,"UPDATE Colaboradores SET estado = 0 WHERE dni = '".$_POST['dni']."'");
        }
    }
}

if(isset($_POST['submitFiltro'])){
    if($_POST['filtro']=='idPuesto'){
        $query = mysqli_query($link, "SELECT * FROM Puesto WHERE descripcion LIKE '".$_POST['valorFiltro']."%'");
        while($row = mysqli_fetch_array($query)){
            $_POST['valorFiltro']=$row['idPuesto'];
        }
    }elseif($_POST['filtro']=='idTipoUsuario'){
		$query = mysqli_query($link, "SELECT * FROM TipoUsuario WHERE descripcion LIKE '".$_POST['valorFiltro']."%'");
		while($row = mysqli_fetch_array($query)){
			$_POST['valorFiltro']=$row['idTipoUsuario'];
		}
	}elseif($_POST['filtro']=='ruc'){
		$query = mysqli_query($link, "SELECT * FROM Empresa WHERE razonSocial LIKE '".$_POST['valorFiltro']."%'");
		while($row = mysqli_fetch_array($query)){
			$_POST['valorFiltro']=$row['ruc'];
		}
	}elseif($_POST['filtro']=='estado'){
	    if(($_POST['valorFiltro']=='Inhabilitado')||($_POST['valorFiltro']=='inhabilitado')){
		    $_POST['valorFiltro']=0;
        }elseif(($_POST['valorFiltro']=='habilitado')||($_POST['valorFiltro']=='Habilitado')){
		    $_POST['valorFiltro']=1;
        }
    }
	echo '
    <section class="container">
    <div>
        <h3>Registro de Colaboradores</h3>
    </div>
    </section>
    
    <hr>
    
    <section class="container">
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">DNI</th>
                    <th class="text-center">Nombres</th>
                    <th class="text-center">Apellidos</th>
                    <th class="text-center">Puesto</th>
                    <th class="text-center">Tipo de Usuario</th>
                    <th class="text-center">Empresa</th>
                    <th class="text-center">Correo Electrónico</th>
                    <th class="text-center">Teléfono</th>
                    <th class="text-center">Celular</th>
                    <th class="text-center">Estado</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    ';

	$query = mysqli_query($link,"SELECT * FROM Colaboradores WHERE ".$_POST['filtro']." LIKE '".$_POST['valorFiltro']."%'");
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
			$aux2=1;
		}
		if($aux2==0){
			echo "<td class='text-center'>-</td>";
        }
		$query2 = mysqli_query($link, "SELECT * FROM Empresa WHERE ruc = '" . $row['ruc'] . "'");
		while ($row2 = mysqli_fetch_array($query2)) {
			echo "<td class=\"text-center\">" . $row2['siglas'] . "</td>";
		}
		echo "<td class=\"text-center\">" . $row['email'] . "</td>";
		$query2 = mysqli_query($link, "SELECT * FROM TelefonoColaboradores WHERE dni = '" . $row['dni'] . "' AND estado = 1");
		while ($row2 = mysqli_fetch_array($query2)) {
			if ($aux < 2) {
				echo "<td class=\"text-center\">" . $row2['numero'] . "</td>";
				$aux++;
			}
		}
		if ($row['estado'] == 0) {
			echo "<td class=\"text-center\">Inhabilitado</td>";
		} elseif ($row['estado'] == 1) {
			echo "<td class=\"text-center\">Habilitado</td>";
		}
		echo "
					<form method='post' action='#' id='modify'>
						<td class='text-center'><input type='submit' class='btn-link' value='Modificar' name='Modificar' formaction='modificarColaboradores.php'></td>
						<input type='hidden' value='" . $row['dni'] . "' name='dni'>
					</form>
					<form method='post' action='#'>
						<td class=\"text-center\"><input type=\"submit\" class=\"btn-link\" value=\"Modificar Estado\" name='delete'></td>
						<input type='hidden' value='" . $row['dni'] . "' name='dni'>
					</form>
			    </tr>";
	}
}else{
	echo '
    <section class="container">
    <div>
        <h3>Registro de Colaboradores</h3>
    </div>
    </section>
    
    <hr>
    
    <section class="container">
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">DNI</th>
                    <th class="text-center">Nombres</th>
                    <th class="text-center">Apellidos</th>
                    <th class="text-center">Puesto</th>
                    <th class="text-center">Tipo de Usuario</th>
                    <th class="text-center">Empresa</th>
                    <th class="text-center">Correo Electrónico</th>
                    <th class="text-center">Teléfono</th>
                    <th class="text-center">Celular</th>
                    <th class="text-center">Estado</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    ';

	$query = mysqli_query($link,"SELECT * FROM Colaboradores");
	while($row = mysqli_fetch_array($query)){
		$aux=0;
		$aux2=0;
		echo "<tr>";
		echo "<td class=\"text-center\">".$row['dni']."</td>";
		echo "<td class=\"text-center\">".$row['nombre']."</td>";
		echo "<td class=\"text-center\">".$row['apellidos']."</td>";
		$query2 = mysqli_query($link,"SELECT * FROM Puesto WHERE idPuesto = '".$row['idPuesto']."'");
		while($row2 = mysqli_fetch_array($query2)){
			echo "<td class=\"text-center\">".$row2['descripcion']."</td>";
		}
		$query2 = mysqli_query($link,"SELECT * FROM TipoUsuario WHERE idTipoUsuario = '".$row['idTipoUsuario']."'");
		while($row2 = mysqli_fetch_array($query2)){
			echo "<td class=\"text-center\">".$row2['descripcion']."</td>";
			$aux2=1;
		}
		if($aux2==0){
			echo "<td class='text-center'>-</td>";
        }
		$query2 = mysqli_query($link,"SELECT * FROM Empresa WHERE ruc = '".$row['ruc']."'");
		while($row2 = mysqli_fetch_array($query2)){
			echo "<td class=\"text-center\">".$row2['siglas']."</td>";
		}
		echo "<td class=\"text-center\">".$row['email']."</td>";
		$query2 = mysqli_query($link,"SELECT * FROM TelefonoColaboradores WHERE dni = '".$row['dni']."' AND estado = 1");
		while($row2 = mysqli_fetch_array($query2)){
			if($aux<2){
				echo "<td class=\"text-center\">".$row2['numero']."</td>";
				$aux++;
			}
		}
		if($row['estado']==0){
			echo "<td class=\"text-center\">Inhabilitado</td>";
        }elseif ($row['estado']==1){
			echo "<td class=\"text-center\">Habilitado</td>";
        }
		echo "
					<form method='post' action='#' id='modify'>
						<td class='text-center'><input type='submit' class='btn-link' value='Modificar' name='Modificar' formaction='modificarColaboradores.php'></td>
						<input type='hidden' value='".$row['dni']."' name='dni'>
					</form>
					<form method='post' action='#'>
						<td class=\"text-center\"><input type=\"submit\" class=\"btn-link\" value=\"Modificar Estado\" name='delete'></td>
						<input type='hidden' value='".$row['dni']."' name='dni'>
					</form>
			    </tr>";
	}
}

	echo '
        </tbody>
            </table>
        </div>
    </section>
	';
?>

<hr>

<section class="container">
    <div>
        <form method="post" action="#">
            <div class="form-group col-sm-offset-3">
                <input type="submit" class="btn btn-success col-sm-offset-1" value="Agregar Colaborador" formaction="addColaborador.php">
                <input type="submit" class="btn btn-primary col-sm-offset-2" value="Gestionar Champions" formaction="gestionChampions.php">
            </div>
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