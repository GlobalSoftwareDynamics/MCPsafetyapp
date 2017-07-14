<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
include('funcionesApp.php');
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
        <link href="css/styles.css" rel="stylesheet">
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

		<script>
            function getsafetyeyes(val) {
                $.ajax({
                    type: "POST",
                    url: "getAjax.php",
                    data:{'crearnuevaACsafetyeyes':val},
                    success: function(data){
                        $("#codigose").html(data);
                    }
                });
            }
            function getobservacionesse(val) {
                $.ajax({
                    type: "POST",
                    url: "getAjax.php",
                    data:{'crearnuevaACobservaciones':val},
                    success: function(data){
                        $("#obsse").html(data);
                    }
                });
            }
            function getdescobservaciones(val) {
                $.ajax({
                    type: "POST",
                    url: "getAjax.php",
                    data:{'crearnuevaACdescobservaciones':val},
                    success: function(data){
                        $("#descripcion").html(data);
                    }
                });
            }
            function getcolaboradores(val) {
                $.ajax({
                    type: "POST",
                    url: "getAjax.php",
                    data:{'crearnuevaACcolaboradores':val},
                    success: function(data){
                        $("#resp").html(data);
                    }
                });
            }
		</script>
	</head>

	<body>
	<header>
		<?php
		include_once('navbarmainAdmin.php');
		?>
	</header>

    <div class="container-fluid">
        <label>Código: <?php echo $_POST['idSE']?></label>
    </div>

	<?php
	if(isset($_POST['add'])){
	    $query = mysqli_query($link,"SELECT * FROM Colaboradores WHERE usuario = '{$_SESSION['login']}'");
	    while($row = mysqli_fetch_array($query)){
	        $dni = $row['dni'];
		    $query = mysqli_query($link,"INSERT INTO AccionesCorrectivas VALUES ('{$_POST['idaccioncorrectiva']}','{$dni}',5,'{$_POST['fecharegistro']}','{$_POST['descripcionac']}',null,null,'SE',null)");
		    $query = mysqli_query($link, "INSERT INTO ACSE(idObservacionesSE,idAccionesCorrectivas) VALUES ('{$_POST['observaciones']}','{$_POST['idaccioncorrectiva']}')");
        }
        echo "
            <section class='container'>
            <div class=\"alert alert-success\">
              <strong>Información ingresada exitosamente</strong>
            </div>
            </section>
        ";
	}
	?>

		<section class="container">
			<div>
				<form action="#" method="post" class="form-horizontal jumbotron col-md-6 col-md-offset-3">
					<div class="col-xs-12">
						<h4 class="text-left">Registro de Acciones Correctivas Sugeridas</h4>
					</div>
					<script>
                        $(function() {
                            $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' }).val()
                        });
                        $(function() {
                            $('#datepicker1').datepicker({ dateFormat: 'dd/mm/yy' }).val()
                        });
					</script>
					<?php
					$fecha = date('d/m/Y');
					$clase="AC";
					$idAC=idgen($clase);
					echo "
                    <input type='hidden' value='".$fecha."' name='fecharegistro'>
                    <input type='hidden' value='{$_POST['idSE']}' name='idSE'>
                    <input type='hidden' value='".$idAC."' name='idaccioncorrectiva'>
                ";
					?>
					<div class="form-group col-xs-12 col-md-12">
						<div class="col-md-12 col-xs-12">
							<label for="obsse">Seleccione el Hallazgo relacionado:</label>
						</div>
						<div class="col-md-12 col-xs-12">
							<select id="obsse" class="col-md-12 form-control col-xs-12" name="observaciones" onchange="getdescobservaciones(this.value)">
								<option>Seleccionar</option>
								<?php
								$query = mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE idSafetyEyes = '{$_POST['idSE']}'");
								while($row = mysqli_fetch_array($query)){
									echo "<option value='{$row['idObservacionesSE']}'>".substr($row['descripcion'],0,20)."...</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-12 col-xs-12">
						<label for="descripcion">Descripcion completa del Hallazgo seleccionado:</label>
					</div>
					<div class="form-group col-xs-12 col-md-12" id="descripcion">
					</div>
					<div class="form-group col-xs-12 col-md-12">
						<div class="col-md-12 col-xs-12">
							<label for="desc">Descripción de la Acción Correctiva:</label>
						</div>
						<div class="col-md-12 col-xs-12">
							<textarea rows="3" class="col-md-12 form-control col-xs-12" name="descripcionac" id="desc"></textarea>
						</div>
					</div>
					<br>
                    <?php
                    if(isset($_POST['addFinal'])){
                        echo '
                        <input type="hidden" name="addFinal" value="'.$_POST['addFinal']. '" readonly>
                        <div class="form-group col-xs-12 col-md-12">
						<div class="col-md-6 col-xs-12">
							<input type="submit" class="btn btn-success col-md-10 col-md-offset-1 col-xs-12" formaction="regSE_AccionCorrectiva.php" value="Guardar" name="add">
						</div>
						<div class="col-md-6 col-xs-12">
							<input type="submit" class="btn btn-default col-md-10 col-md-offset-1 col-xs-12" formaction="regSE_RevisionFinal.php" value="Siguiente">
						</div>
					</div>';
                    }else{
                      echo '<div class="form-group col-xs-12 col-md-12">
						<div class="col-md-6 col-xs-12">
							<input type="submit" class="btn btn-success col-md-10 col-md-offset-1 col-xs-12" formaction="regSE_AccionCorrectiva.php" value="Guardar" name="add">
						</div>
						<div class="col-md-6 col-xs-12">
							<input type="submit" class="btn btn-default col-md-10 col-md-offset-1 col-xs-12" formaction="regSE_DecisionMS.php" value="Siguiente">
						</div>
					</div>';
                    }
                    ?>
				</form>
			</div>
		</section>

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