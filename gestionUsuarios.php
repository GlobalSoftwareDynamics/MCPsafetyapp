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
    <link href="css/Formularios.css" rel="stylesheet">
    <link href="css/Tablas.css" rel="stylesheet">
    <script>
        function getUsuario(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:'gestionUsuarios_usuario='+val,
                success: function(data){
                    $("#usuario").html(data);
                }
            });
        }
        function getPassword(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:'gestionUsuarios_password='+val,
                success: function(data){
                    $("#password").html(data);
                }
            });
        }
        function getTipoUsuario(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:'gestionUsuarios_tipoUsuario='+val,
                success: function(data){
                    $("#tipoUsuario").html(data);
                }
            });
        }
    </script>
</head>

<body>
<header>
	<?php
	include_once('navbarMainAdminSistema.php');
	?>
</header>

<section class="container">
    <div>
        <h3>Interfaz de Gestión de Usuarios</h3>
    </div>
</section>

<br>

<section class="container">
    <div>
    <form method="post" action="#" class="form-horizontal jumbotron col-sm-12">
        <div class="form-group col-sm-4">
            <div class="col-sm-4">
                <label for="filtro" class="formlabels col-sm-12">Columna:</label>
            </div>
            <div class="col-sm-8">
                <select class="form-control ddselect-12" name="filtro" id="filtro">
                    <option>Seleccione el tipo de filtro</option>
                    <option value="dni">Por DNI:</option>
                    <option value="usuario">Por Usuario:</option>
                    <option value="idTipoUsuario">Por ID Tipo de Usuario:</option>
                </select>
            </div>
        </div>
        <div class="form-group col-sm-4">
            <div class="col-sm-4">
                <label for="valorFiltro" class="formlabels col-sm-12">Búsqueda:</label>
            </div>
            <div class="col-sm-8">
                <input type="text" class="textinput-12 form-control col-sm-12" name="valorFiltro" id="valorFiltro">
            </div>
        </div>
        <div class="form-group col-sm-4">
            <input type="submit" name="submitFiltro" class="btn btn-success col-sm-5 col-sm-offset-1 boton" value="Filtrar">
            <input type="submit" name="reset" class="btn btn-default col-sm-5 col-sm-offset-1 boton" value="Quitar Filtros">
        </div>
    </form>
    </div>
</section>

<hr>

<?php
if(isset($_POST['submit'])){
    $submit = mysqli_query($link,"UPDATE Colaboradores SET usuario = '".$_POST['Usuario']."', password = '".$_POST['Contraseña']."', idTipoUsuario = '".$_POST['tipoUsuario']."' WHERE dni = '".$_POST['dni']."'");
}

if(isset($_POST['modify'])){
    $modify = mysqli_query($link, "UPDATE Colaboradores SET usuario = '".$_POST['usuario']."', password = '".$_POST['password']."', idTipoUsuario = '".$_POST['tipoUsuario']."' WHERE dni = '".$_POST['dni']."'");
}

if(isset($_POST['delete'])){
    $delete = mysqli_query($link,"UPDATE Colaboradores SET usuario = null, password = null, idTipoUsuario = null WHERE dni = '".$_POST['dni']."'");
}

if(isset($_POST['submitFiltro'])){
    echo '
    <section class="container" id="filtered">
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">DNI</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Contraseña</th>
                    <th class="text-center">Tipo de Usuario</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    ';
                $query = mysqli_query($link,"SELECT * FROM Colaboradores WHERE estado = 1 AND ".$_POST['filtro']." LIKE '".$_POST['valorFiltro']."%' AND usuario IS NOT NULL");
                while($row = mysqli_fetch_array($query)){
                    echo "<tr>";
                    echo "<td class=\"text-center\">".$row['dni']."</td>";
                    echo "<td class=\"text-center\">".$row['usuario']."</td>";
                    echo "<td class=\"text-center\">".$row['password']."</td>";
                    $query2 = mysqli_query($link,"SELECT * FROM TipoUsuario WHERE idTipoUsuario = '".$row['idTipoUsuario']."'");
                    while($row2 = mysqli_fetch_array($query2)){
                        echo "<td class=\"text-center\">".$row2['descripcion']."</td>";
                    }
                    echo "
                                <form method='post' action='#' id='modify'>
                                    <td class='text-center'><input type='submit' class='btn-link' value='Modificar' name='Modificar' formaction='modificarUsuarios.php'></td>
                                    <input type='hidden' value='".$row['dni']."' name='dni'>
                                </form>
                                <form method='post' action='#'>
                                    <td class=\"text-center\"><input type=\"submit\" class=\"btn-link\" value=\"Eliminar\" name='delete'></td>
                                    <input type='hidden' value='".$row['dni']."' name='dni'>
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
                    <th class="text-center">DNI</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Contraseña</th>
                    <th class="text-center">Tipo de Usuario</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    ';
	$query = mysqli_query($link,"SELECT * FROM Colaboradores WHERE estado = 1 AND usuario IS NOT NULL");
	while($row = mysqli_fetch_array($query)){
		echo "<tr>";
		echo "<td class=\"text-center\">".$row['dni']."</td>";
		echo "<td class=\"text-center\">".$row['usuario']."</td>";
		echo "<td class=\"text-center\">".$row['password']."</td>";
		$query2 = mysqli_query($link,"SELECT * FROM TipoUsuario WHERE idTipoUsuario = '".$row['idTipoUsuario']."'");
		while($row2 = mysqli_fetch_array($query2)){
			echo "<td class=\"text-center\">".$row2['descripcion']."</td>";
		}
		echo "
					<form method='post' action='#' id='modify'>
						<td class='text-center'><input type='submit' class='btn-link' value='Modificar' name='Modificar' formaction='modificarUsuarios.php'></td>
						<input type='hidden' value='".$row['dni']."' name='dni'>
					</form>
					<form method='post' action='#'>
						<td class=\"text-center\"><input type=\"submit\" class=\"btn-link\" value=\"Eliminar\" name='delete'></td>
						<input type='hidden' value='".$row['dni']."' name='dni'>
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
    <button type="button" class="btn btn-primary col-sm-offset-5" data-toggle="modal" data-target="#myModal">
        Agregar Contratista
    </button>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="Nuevo Usuario" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Nuevo Usuario</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="#">
                        <div class="form-group">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center"><label for="dni">DNI</label></th>
                                    <th class="text-center"><label for="Usuario">Usuario</label></th>
                                    <th class="text-center"><label for="Contraseña">Contraseña</label></th>
                                    <th class="text-center"><label for="Tipo">Tipo de Usuario</label></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><select name="dni" id="dni" class="form-control" onchange="getUsuario(this.value);getPassword(this.value);getTipoUsuario(this.value)">
                                            <option selected="selected">Seleccionar</option>
						                    <?php
						                    $query = mysqli_query($link,"SELECT * FROM Colaboradores WHERE usuario IS NULL ORDER BY apellidos");
						                    while($row = mysqli_fetch_array($query)){
							                    echo "<option value='".$row['dni']."'>".$row['apellidos']." ".$row['nombre']." - ".$row['dni']."</option>";
						                    }
						                    ?>
                                        </select></td>
                                    <td><div id="usuario"><input type="text" class="form-control" name="Usuario" id="Usuario" value="Valor Automático" readonly></div></td>
                                    <td><div id="password"><input type="text" class="form-control" name="Contraseña" id="Contraseña" value="Valor Automático" readonly></div></td>
                                    <td><select class="form-control" id="tipoUsuario" name="tipoUsuario">
                                            <option>Seleccionar</option>
                                        </select></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Cerrar" name="close" data-dismiss="modal" class="btn btn-default col-sm-offset-4">
                            <input type="submit" value="Agregar" name="submit" class="btn btn-success col-sm-offset-2">
                            <br>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>



<section class="container">
    <div>
        <form method="post" action="#">

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