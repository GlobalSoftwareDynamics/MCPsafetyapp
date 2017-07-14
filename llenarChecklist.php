<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
include('funcionesApp.php');
if(isset($_SESSION['login'])&&(($_SESSION['usertype']=='1'))||($_SESSION['usertype']=='2')||($_SESSION['usertype']=='5')){
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
		<script>
            function getubicaciones(val) {
                $.ajax({
                    type: "POST",
                    url: "getAjax.php",
                    data:{'regsafetyeyes1planta':val},
                    success: function(data){
                        $("#ubica").html(data);
                    }
                });
            }
		</script>
	</head>

	<body>
	<header>
        <?php
        if($_SESSION['usertype']=='1'||$_SESSION['usertype']=='2'){
            include_once('navbarmainSupervisor.php');
        }elseif($_SESSION['usertype']=='5'){
            include_once('navbarmainOperario.php');
        }
        ?>
	</header>

	<section class="container">
		<form method="post" action="regChecklists.php" class="form-horizontal col-xs-12 col-md-6 col-md-offset-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <?php
                        $query = mysqli_query($link, "SELECT * FROM Checklist WHERE idChecklist = '{$_POST['idChecklist']}'");
                        while($row = mysqli_fetch_array($query)){
                            echo "<th class='text-center' colspan='2'>{$row['titulo']}</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="2" class="text-left">
                            <label for="planta">Planta:</label>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <select class="form-control col-xs-12 col-md-12" name="planta" id="planta" onchange="getubicaciones(this.value)">
                                <option>Seleccionar</option>
                                <?php
                                $query = mysqli_query($link, "SELECT * FROM Planta WHERE estado = '1'");
                                while($row = mysqli_fetch_array($query)){
                                    echo "<option value='{$row['idPlanta']}'>{$row['descripcion']}</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-left">
                            <label for="ubica" class="col-xs-12 col-md-12">Ubicación:</label>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <select id="ubica" class="form-control col-xs-12 col-md-12" name="ubicacion">
                                <option>Seleccionar</option>
                            </select>
                        </td>
                    </tr>
                    <?php
                    $aux = 0;
                    $query = mysqli_query($link,"SELECT * FROM PreguntasChecklist WHERE idChecklist = '{$_POST['idChecklist']}'");
                    while($row = mysqli_fetch_array($query)){
                        echo "
                              <tr>
                                  <th colspan='2' class='text-left'><label class='col-xs-12 col-md-12'>".$row['descripcion']."</label></th>
                              </tr>
                        ";
                        if($row['tipoRespuesta']==='Abierta'){
                            echo "<tr><td colspan='2'><input type='text' name='rspta{$row['idPreguntasChecklist']}' class='form-control'></td></tr>";
                        }else{
                            echo "
                                <tr>
                                    <td>
                                        <div class='radio-inline col-xs-12' style='margin:0;'>
                                            <label>
                                                <input type='radio' name='rspta{$row['idPreguntasChecklist']}' value='Sí'>
                                                Si
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='radio-inline col-xs-12' style='margin:0;'>
                                            <label>
                                                <input type='radio' name='rspta{$row['idPreguntasChecklist']}' value='No' checked>
                                                No
                                            </label>
                                        </div>
                                    </td>
                                </tr>
						  ";
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="form-group col-xs-12 col-md-12">
	            <input type='submit' class='btn btn-default col-xs-12 col-md-12' value='Regresar' name='back'>
                <input type='submit' class='btn btn-success col-xs-12 col-md-12' value='Registrar' name='next'>
                <input type='hidden' value='<?php echo $_POST['idChecklist'];?>' name='idChecklist'>
            </div>
		</form>
	</section>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<footer class="panel-footer navbar-fixed-bottom hidden-xs">
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