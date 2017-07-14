<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
if(isset($_SESSION['login'])&&($_SESSION['usertype']=='1')){
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
    <link href="css/sidenavbar.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/3c8c75239c.js"></script>
</head>

<body>
<header id="navmainadmin">
    <?php
    include_once('navbarmainAdmin.php');
    ?>
</header>

<div class="nav-side-menu">
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    <div class="menu-list">
        <ul id="menu-content" class="menu-content collapse out">
            <li>
                <a href="aprobarSE.php">
                    <i class="fa fa-group fa-lg"></i> &nbsp;Safety Eyes Pendientes:
                    <?php
                        $aux = 0;
                        $query = mysqli_query($link,"SELECT * FROM SafetyEyes WHERE estado = 'Pendiente'");
                        while($row = mysqli_fetch_array($query)){
                            $aux++;
                        }
                        echo $aux;
                    ?>
                </a>
            </li>
            <li>
                <a href="aprobarOCUR.php">
                    <i class="fa fa-info-circle fa-lg"></i> &nbsp;Ocurrencias Pendientes:
			        <?php
			        $aux = 0;
			        $query = mysqli_query($link,"SELECT * FROM Ocurrencias WHERE idClase != '8' AND estado = 'Pendiente'");
			        while($row = mysqli_fetch_array($query)){
				        $aux++;
			        }
			        echo $aux;
			        ?>
                </a>
            </li>
            <li>
                <a href="aprobarCAP.php">
                    <i class="fa fa-check-square fa-lg"></i> &nbsp;CAPs Pendientes:
			        <?php
			        $aux = 0;
			        $query = mysqli_query($link,"SELECT * FROM CAP WHERE estado = 'Pendiente'");
			        while($row = mysqli_fetch_array($query)){
				        $aux++;
			        }
			        echo $aux;
			        ?>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-warning fa-lg"></i> &nbsp;Incidentes Reportados:
			        <?php
			        $aux = 0;
			        $query = mysqli_query($link,"SELECT * FROM Incidentes WHERE estado = 'Reporte Preliminar'");
			        while($row = mysqli_fetch_array($query)){
				        $aux++;
			        }
			        echo $aux;
			        ?>
                </a>
            </li>
            <li  data-toggle="collapse" data-target="#accionescorrectivas" class="collapsed">
                <a href="#"><i class="fa fa-gears fa-lg"></i> &nbsp;Acciones Correctivas por Vencer <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="accionescorrectivas">
                <?php
                $datos = array();
                $date = date('d/m/Y');
                $datos = explode('/',$date);

                $query = mysqli_query($link,"SELECT * FROM AccionesCorrectivas");
                while($row = mysqli_fetch_array($query)){
                    $dateAC = $row['fechaPlan'];
                    $datosAC = explode('/',$dateAC);
                    if(($datos[1]<$datosAC[1])||(($datos[1]==$datosAC[1])&&($datos[0]>$datosAC[0]))){
                    }elseif($datosAC[2]==$datos[2]){
                        if($datos[0]<=24){
                            if($datos[1]==$datosAC[1]){
                                if(($datos[0]-$datosAC[0])<=7){
                                    echo "<li>{$row['idAccionesCorrectivas']}</li>";
                                }
                            }
                        }else{
                            if($datos[1]==$datosAC[1]){
	                            echo "<li>{$row['idAccionesCorrectivas']}</li>";
                            }elseif(($datosAC[1]-$datos[1])==1){
                                $diasrest = 31 - $datos[0];
                                if(($datosAC[0]+$diasrest)<=7){
	                                echo "<li>{$row['idAccionesCorrectivas']}</li>";
                                }
                            }
                        }
                    }
                }
                ?>
            </ul>
            <li  data-toggle="collapse" data-target="#accionescorrectivasvencidas" class="collapsed">
                <a href="#"><i class="fa fa-times-circle fa-lg"></i> &nbsp;Acciones Correctivas Vencidas <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="accionescorrectivasvencidas">
		        <?php
		        $datos = array();
		        $date = date('d/m/Y');
		        $datos = explode('/',$date);

		        $query = mysqli_query($link,"SELECT * FROM AccionesCorrectivas");
		        while($row = mysqli_fetch_array($query)){
			        $dateAC = $row['fechaPlan'];
			        $datosAC = explode('/',$dateAC);
			        if(($datos[1]<$datosAC[1])||(($datos[1]==$datosAC[1])&&($datos[0]>$datosAC[0]))){
				        echo "<li>{$row['idAccionesCorrectivas']}</li>";
			        }
		        }
		        ?>
            </ul>
        </ul>
    </div>
</div>

<section class="container">
    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-center">Bienvenido a GSD-Safe@Work</h3>
    </div>
</section>
<br>
<section class="container">
    <div class="col-md-6 col-md-offset-3 text-center">
        <img src="image/Logo.png" height="250">
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