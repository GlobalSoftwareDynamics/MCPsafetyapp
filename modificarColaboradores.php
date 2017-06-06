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
	include_once('navbarMainAdminRRHH.php');
	?>
</header>

<section class="container">
	<?php
	$query = mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni = '".$_POST['dni']."'");
	while($row = mysqli_fetch_array($query)){
		$nombres = $row['nombre'];
		$apellidos = $row['apellidos'];
		$puesto = $row['idPuesto'];
		$empresa = $row['ruc'];
		$email = $row['email'];
		$estado = $row['estado'];
	}
	$telefonos = array();
	$i=0;
    $query = mysqli_query($link,"SELECT * FROM TelefonoColaboradores WHERE dni = '".$_POST['dni']."'");
	while($row = mysqli_fetch_array($query)){
	    $telefonos[$i] = $row['numero'];
	    $i++;
    }
	?>
	<form class="col-sm-6 col-sm-offset-3" method="post" action="gestionColaboradores.php">
		<div class="form-group">
			<div>
				<label for="nombres">Nombres</label>
			</div>
			<div>
				<input type="text" class="form-control" name="nombres" id="nombres" value="<?php echo $nombres;?>">
			</div>
		</div>
		<div class="form-group">
			<div>
				<label for="apellidos">Apellidos</label>
			</div>
			<div>
				<input type="text" class="form-control" name="apellidos" id="apellidos" value="<?php echo $apellidos;?>">
			</div>
		</div>
		<div class="form-group">
			<div>
				<label for="puesto">Puesto</label>
			</div>
			<div>
				<select name="puesto" id="puesto" class="form-control">
					<?php
					$query = mysqli_query($link, "SELECT * FROM Puesto");
					while($row = mysqli_fetch_array($query)){
						if($puesto==$row['idPuesto']){
							echo "<option selected='selected' value='".$puesto."'>".$row['descripcion']."</option>";
						}else{
							echo "<option value='".$row['idPuesto']."'>".$row['descripcion']."</option>";
						}
					}
					?>
				</select>
			</div>
		</div>
        <div class="form-group">
            <div>
                <label for="empresa">Empresa</label>
            </div>
            <div>
                <select name="empresa" id="empresa" class="form-control">
					<?php
					$query = mysqli_query($link, "SELECT * FROM Empresa");
					while($row = mysqli_fetch_array($query)){
						if($empresa==$row['ruc']){
							echo "<option selected='selected' value='".$empresa."'>".$row['razonSocial']."</option>";
						}else{
							echo "<option value='".$row['ruc']."'>".$row['razonSocial']."</option>";
						}
					}
					?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div>
                <label for="email">Correo Electrónico</label>
            </div>
            <div>
                <input type="text" class="form-control" name="email" id="email" value="<?php echo $email;?>">
            </div>
        </div>
        <div class="form-group">
            <div>
                <label for="telefono">Teléfono</label>
            </div>
            <div>
                <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $telefonos[0];?>">
            </div>
        </div>
        <div class="form-group">
            <div>
                <label for="celular">Celular</label>
            </div>
            <div>
                <input type="text" class="form-control" name="celular" id="celular" value="<?php echo $telefonos[1];?>">
            </div>
        </div>
		<div class="form-group">
			<input type="hidden" value="<?php echo $_POST['dni']?>" name="dni">
            <input type="hidden" value="<?php echo $telefonos[0]?>" name="telefonoant">
            <input type="hidden" value="<?php echo $telefonos[1]?>" name="celularant">
			<input type="submit" class="btn btn-default col-sm-offset-3" value="Regresar">
			<input type="submit" class="btn btn-success col-sm-offset-2" value="Aceptar" name="modify">
		</div>
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