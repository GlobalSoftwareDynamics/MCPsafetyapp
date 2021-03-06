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
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
<header>
	<?php
	include_once('navbarMainAdminRRHH.php');
	?>
</header>

<section class="container">
	<div>
		<form method="post" action="gestionContratistas.php" class="form-horizontal jumbotron col-md-12">
			<div class="form-group col-md-4">
                <div class="col-md-4">
                    <label for="filtro">Columna:</label>
                </div>
                <div class="col-md-8">
                    <select class="form-control" name="filtro" id="filtro">
                        <option>Seleccionar</option>
                        <option value="ruc">Por RUC:</option>
                        <option value="razonSocial">Por Razón Social:</option>
                        <option value="idTipoEmpresa">Por Tipo de Contratista:</option>
                    </select>
                </div>
			</div>
			<div class="form-group col-md-4">
                <div class="col-md-4">
                    <label for="valorFiltro">Búsqueda:</label>
                </div>
                <div class="col-md-8">
				    <input type="text" class="form-control" name="valorFiltro">
                </div>
			</div>
			<div class="form-group col-md-4">
                <div class="col-md-6">
				    <input type="submit" name="submitFiltro" class="btn btn-success col-md-12" value="Filtrar">
                </div>
                <div class="col-md-6">
				    <input type="submit" name="reset" class="btn btn-default col-md-12" value="Remover Filtros">
                </div>
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
		$insert = mysqli_query($link, "UPDATE Empresa SET estado = '1' WHERE ruc = '".$_POST['ruc']."'");
	}else{
		$insert = mysqli_query($link,"INSERT INTO Empresa VALUES ('".$_POST['ruc']."','".$_POST['tipoEmpresa']."','".$_POST['razonSocial']."','".$_POST['siglas']."','".$_POST['alcance']."',1)");
	}
}

if(isset($_POST['modify'])){
	$modify = mysqli_query($link, "UPDATE Empresa SET idTipoEmpresa = '".$_POST['tipoEmpresa']."', razonSocial = '".$_POST['razonSocial']."', siglas = '".$_POST['siglas']."', detalleAlcance = '".$_POST['alcance']."' WHERE ruc = '".$_POST['ruc']."'");
}

if(isset($_POST['delete'])){
	$delete = mysqli_query($link,"UPDATE Empresa SET estado = '0' WHERE ruc = '".$_POST['ruc']."'");
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
		<h3>Registro de Contratistas</h3>
	</div>
	<hr>
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
	$query = mysqli_query($link,"SELECT * FROM Empresa WHERE estado = '1' AND ".$_POST['filtro']." LIKE '".$_POST['valorFiltro']."%'");
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
								<form method='post' action='gestionContratistas.php' id='info'>
                                    <td class='text-center'><input type='submit' class='btn-link' value='Informacion Adicional' name='info' formaction='infoEmpresas.php'></td>
                                    <input type='hidden' value='".$row['ruc']."' name='ruc'>
                                </form>
                                <form method='post' action='modificarEmpresas.php' id='modify'>
                                    <td class='text-center'><input type='submit' class='btn-link' value='Modificar' name='Modificar' formaction='modificarEmpresas.php'></td>
                                    <input type='hidden' value='".$row['ruc']."' name='ruc'>
                                </form>
                                <form method='post' action='gestionContratistas.php'>
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
		<h3>Registro de Contratistas</h3>
	</div>
	<hr>
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
	$query = mysqli_query($link,"SELECT * FROM Empresa WHERE estado = '1'");
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
								<form method='post' action='gestionContratistas.php' id='info'>
                                    <td class='text-center'><input type='submit' class='btn-link' value='Informacion Adicional' name='info' formaction='infoEmpresas.php'></td>
                                    <input type='hidden' value='".$row['ruc']."' name='ruc'>
                                </form>
                                <form method='post' action='gestionContratistas.php' id='modify'>
                                    <td class='text-center'><input type='submit' class='btn-link' value='Modificar' name='Modificar' formaction='modificarEmpresas.php'></td>
                                    <input type='hidden' value='".$row['ruc']."' name='ruc'>
                                </form>
                                <form method='post' action='gestionContratistas.php'>
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
    <button type="button" class="btn btn-success col-sm-2 col-sm-offset-5" data-toggle="modal" data-target="#myModal">Agregar Contratista</button>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="Nuevo Champion" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Nuevo Contratista</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="gestionContratistas.php">
                        <div class="form-group">
                            <div>
                                <label for="ruc">RUC</label>
                            </div>
                            <div>
                                <input type="text" class="form-control" name="ruc">
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="razonSocial">Razón Social</label>
                            </div>
                            <div>
                                <input type="text" class="form-control" name="razonSocial">
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="siglas">Siglas</label>
                            </div>
                            <div>
                                <input type="text" class="form-control" name="siglas">
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="tipoEmpresa">Tipo de Empresa</label>
                            </div>
                            <div>
                                <select class="form-control" name="tipoEmpresa">
                                                <option>Seleccionar</option>
                                                <?php
                                                $query = mysqli_query($link, "SELECT * FROM TipoEmpresa");
                                                while($row = mysqli_fetch_array($query)){
                                                    echo "<option value='".$row['idTipoEmpresa']."'>".$row['descripcion']."</option>";
                                                }
                                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="alcance">Descripción del Alcance</label>
                            </div>
                            <div>
                                <textarea name="alcance" rows="5" cols="50" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Cerrar" name="close" data-dismiss="modal" class="btn btn-default col-md-offset-4">
                            <input type="submit" value="Agregar" name="submit" class="btn btn-success col-md-offset-2">
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container">
	<div>

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