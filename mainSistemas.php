<!DOCTYPE html>

<html lang="es">

<?php
session_start();
$link = mysqli_connect("gsdynamicscom.ipagemysql.com", "gsdsafeatwork", "6DQ~kTpyHPn+Zs$^", "seapp");

if(isset($_SESSION['login'])){
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
	        include_once('navbarMainAdminSistema.php');
	        ?>
        </header>

        <section class="container">
            <div>
                <h3 class="text-center">Bienvenido a la interfaz de administración del sistema</h3>
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
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>

</html>