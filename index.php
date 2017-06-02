<!DOCTYPE html>

<html lang="es">

<?php
$link = mysqli_connect("localhost", "root", "", "seapp");

mysqli_query($link,"SET NAMES 'utf8'");

?>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>             PLACEHOLDER         </title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="smartphone-icon-152-185337.png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="smartphone-icon-152-185337.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="smartphone-icon-144-185337.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="smartphone-icon-120-185337.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="smartphone-icon-114-185337.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="smartphone-icon-72-185337.png">
    <link rel="apple-touch-icon-precomposed" href="smartphone-icon-57-185337.png">
    <link rel="icon" href="smartphone-icon-32-185337.png" sizes="32x32">
    <link href="css/index.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
</head>

<?php
session_start();
session_unset();
session_destroy();
$bandera = false;
if(isset($_POST["user"])) {
	$datos=mysqli_query($link,"SELECT * FROM Colaboradores WHERE estado = 1");
	while($fila=mysqli_fetch_array($datos)){
		if($_POST["user"] == $fila['usuario'] && $_POST["password"] == $fila['password']) {
			session_start();
			$_SESSION['login'] = $_POST["user"];
			$_SESSION['nombre']	= $fila['nombre'];

			if(isset($_POST['verifica'])) {
				setcookie("user", $_POST['user'], time()+30);
			}
			switch($fila['idTipoUsuario']){
				case 1:
					header("Location: mainAdmin.php");
					break;
				case 2:
					header("Location: mainSupervisor.php");
					break;
				case 3:
					header("Location: mainSistemas.php");
					break;
				case 4:
					header("Location: mainRRHH.php");
					break;
			}
			$bandera = false;
			break;
		}else {
			$bandera = true;
		}
	}
}
?>

<body>

<div class="container login">
    <div class="row">
        <div class="col-sm-12">
            <div class="wrap">
                <form class="login" method="post" action="#">
                    <img id="profile-img" class="profile-img-card" src="image/logo.png" />
                    <input type="text" value="<?php if(isset($_COOKIE ['user'])) {echo $_COOKIE ['user'];}else{echo "Usuario";}?>" name="user"/>
                    <input type="password" value="Contraseña" name="password"/>
                    <input type="submit" value="Iniciar Sesión" class="btn btn-success btn-sm" />
	                <?php
	                if($bandera) {
		                echo "<br>";
		                echo "<br>";

		                echo "<div class='container'>";
		                echo 	"<p style='color: white'> <strong>Usuario o contraseña incorrecto</strong></p>";
		                echo " </div>";
	                }
	                ?>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

<?php
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>