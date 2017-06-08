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
</head>

<body>
<header>
	<?php
	include_once('navbarMainAdminRRHH.php');
	?>
</header>

<?php
if(isset($_POST['submit'])){
    $aux = 0;
    $search = mysqli_query($link,"SELECT * FROM Champions WHERE dni = '".$_POST['dni']."' AND idCOPs = '".$_POST['idCOPs']."'");
    while($row = mysqli_fetch_array($search)){
        $aux++;
    }
    if($aux!=0){
        $insert = mysqli_query($link, "UPDATE Champions SET estado = '1' WHERE dni = '".$_POST['dni']."' AND idCOPs = '".$_POST['idCOPs']."'");
    }else{
	    $insert = mysqli_query($link,"INSERT INTO Champions VALUES ('".$_POST['dni']."','".$_POST['idCOPs']."',1)");
    }
}

if(isset($_POST['delete'])){
    $delete = mysqli_query($link, "UPDATE Champions SET estado = '0' WHERE dni = '".$_POST['dni']."' AND idCOPs = '".$_POST['idCOPs']."'");
}
?>

<section class="container">
	<div>
		<table class="table">
			<thead>
				<tr>
					<th class='text-center'>DNI</th>
					<th class='text-center'>Champion</th>
					<th class='text-center'>Código de Práctica</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$query = mysqli_query($link,"SELECT * FROM Champions WHERE estado = 1");
				while($row = mysqli_fetch_array($query)){
					echo "<tr>";
						echo "<td class='text-center'>".$row['dni']."</td>";
						$query2 = mysqli_query($link, "SELECT * FROM Colaboradores WHERE dni = '".$row['dni']."'");
						while($row2 = mysqli_fetch_array($query2)){
						    echo "<td class='text-center'>".$row2['apellidos']." ".$row2['nombre']."</td>";
						}
                        $query2 = mysqli_query($link, "SELECT * FROM COPs WHERE idCOPs = '".$row['idCOPs']."'");
                        while($row2 = mysqli_fetch_array($query2)){
                            echo "<td class='text-center'>".$row2['descripcion']."</td>";
                        }
                        echo "
					    <form method='post' action='gestionChampions.php'>
						    <td class=\"text-center\"><input type=\"submit\" class=\"btn-link\" value=\"Eliminar\" name='delete'></td>
						    <input type='hidden' value='" . $row['dni'] . "' name='dni'>
						    <input type='hidden' value='" . $row['idCOPs'] . "' name='idCOPs'>
					    </form>
                        ";
					echo "</tr>";
				}
			?>
			</tbody>
		</table>
	</div>
</section>

<hr>

<section class="container">
    <button type="button" class="btn btn-success col-sm-2 col-sm-offset-5" data-toggle="modal" data-target="#myModal">Agregar Champion</button>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="Nuevo Champion" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Nuevo Champion</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="gestionChampions.php">
                        <div class="form-group">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center"><label for="dni">DNI</label></th>
                                    <th class="text-center"><label for="idCOPs">Usuario</label></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><select name="dni" id="dni" class="form-control">
                                            <option selected="selected">Seleccionar</option>
							                <?php
							                $query = mysqli_query($link,"SELECT * FROM Colaboradores WHERE estado = 1 ORDER BY apellidos");
							                while($row = mysqli_fetch_array($query)){
								                echo "<option value='".$row['dni']."'>".$row['apellidos']." ".$row['nombre']." - ".$row['dni']."</option>";
							                }
							                ?>
                                        </select></td>
                                    <td><select name="idCOPs" id="idCOPs" class="form-control">
                                            <option selected="selected">Seleccionar</option>
							                <?php
							                $query = mysqli_query($link,"SELECT * FROM COPs ORDER BY descripcion");
							                while($row = mysqli_fetch_array($query)){
								                echo "<option value='".$row['idCOPs']."'>".$row['siglas']." - ".$row['descripcion']."</option>";
							                }
							                ?>
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
                    </form>
                </div>
            </div>
        </div>
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