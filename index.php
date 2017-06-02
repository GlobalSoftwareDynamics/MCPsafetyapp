<!DOCTYPE html>
<html lang="es">
<?php
ob_start();
$link = mysqli_connect("gsdynamicscom.ipagemysql.com", "gsdsafeatwork", "6DQ~kTpyHPn+Zs$^", "seapp");
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
mysqli_query($link,"SET NAMES 'utf8'");
session_unset();
session_destroy();
$bandera = false;
if(isset($_POST["user"])) {
	$datos=mysqli_query($link,"SELECT * FROM Colaboradores WHERE estado = 1");
	while($fila=mysqli_fetch_array($datos)){
		if($_POST["user"] == $fila['usuario'] && $_POST["password"] == $fila['password']) {
			switch($fila['idTipoUsuario']){
				case 1:
					echo "<script type='text/javascript'>window.location.href = 'http://gsdynamics.com/gsdsafeatwork/mainAdmin.php?user=".$_POST['user']."';</script>";
					exit();
					break;
				case 2:
					echo "<script type='text/javascript'>window.location.href = 'http://gsdynamics.com/gsdsafeatwork/mainSupervisor.php?user=".$_POST['user']."';</script>";
					exit();
					break;
				case 3:
					echo "<script type='text/javascript'>window.location.href = 'http://gsdynamics.com/gsdsafeatwork/mainSistemas.php?user=".$_POST['user']."';</script>";
					exit();
					break;
				case 4:
					echo "<script type='text/javascript'>window.location.href = 'http://gsdynamics.com/gsdsafeatwork/mainRRHH.php?user=".$_POST['user']."';</script>";
					exit();
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
    <link href="css/index.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>
<div class="container login">
    <div class="row">
        <div class="col-sm-12">
            <div class="wrap">
                <form class="login" method="post" action="#">
                    <img id="profile-img" class="profile-img-card" src="http://gsdynamics.com/gsdsafeatwork/image/Logo.png" />
                    <input type="text" placeholder="Usuario" name="user"/>
                    <input type="password" placeholder="Contraseña" name="password"/>
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
ob_end_flush();
?>
</html>