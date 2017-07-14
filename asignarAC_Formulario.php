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
        $(function() {
            $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' }).val()
        });
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
    include_once('navbarmainSupervisor.php');
    ?>
</header>

<section class="container">
    <form class="form-horizontal jumbotron col-xs-12 col-md-6 col-md-offset-3" method="post" action="asignarAC.php">
        <div class="form-group col-xs-12 col-md-12">
            <h4>Asignación de Acción Correctiva</h4>
        </div>
        <div class="form-group col-xs-12 col-md-12">
            <div class="col-xs-12 col-md-12">
                <label for="idac" class="col-xs-12 col-md-12">Código:</label>
            </div>
            <div class="col-xs-12 col-md-12">
                <input id="idac" type="text" name="idAC" class="form-control col-xs-12" value="<?php echo $_POST['idAC']?>">
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-12">
            <div class="col-xs-12 col-md-12">
                <label id="desc" class="col-xs-12 col-md-12">Descripción:</label>
            </div>
            <div class="col-xs-12 col-md-12">
                <textarea name="descripcion" class="form-control col-xs-12 col-md-12" rows="5" id="desc"><?php echo $_POST['descripcion']?></textarea>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-12">
            <div class="col-xs-12 col-md-12">
                <label for="puesto" class="col-xs-12 col-md-12">Puesto del Responsable:</label>
            </div>
            <div class="col-xs-12 col-md-12">
                <select id="puesto" class="col-xs-12 col-md-12 form-control" name="puesto" onchange="getcolaboradores(this.value)">
                    <option>Seleccionar</option>
                    <?php
                    $result=mysqli_query($link,"SELECT * FROM Puesto WHERE estado='1'");
                    while ($fila=mysqli_fetch_array($result)){
                        echo "
                                    <option value='".$fila['idPuesto']."'>".$fila['descripcion']."</option>
                                ";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-12">
            <div class="col-xs-12 col-md-12">
                <label for="resp" class="col-xs-12 col-md-12">Responsable:</label>
            </div>
            <div class="col-xs-12 col-md-12">
                <select id="resp" class="col-xs-12 col-md-12 form-control" name="responsable">
                    <option>Seleccionar</option>
                </select>
            </div>
        </div>
        <div class="form-group col-xs-12 col-md-12">
            <div class="col-xs-12 col-md-12">
                <label for="datepicker" class="col-xs-12 col-md-12">Fecha Planeada:</label>
            </div>
            <div class="col-xs-12 col-md-12">
                <input id="datepicker" class="col-xs-12 col-md-12 form-control" name="fechaplaneada">
            </div>
        </div>
        <br>
        <div class="form-group col-xs-12 col-md-12">
            <div class="col-xs-12 col-md-6">
                <input type="submit" class="btn btn-default col-xs-12 col-md-10 col-md-offset-1" formaction="asignarAC.php" value="Regresar">
            </div>
            <div class="spacer5"></div>
            <div class="col-xs-12 col-md-6">
                <input type="submit" class="btn btn-success col-xs-12 col-md-10 col-md-offset-1" name="actualizarac" value="Registrar Datos">
            </div>
        </div>
    </form>
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