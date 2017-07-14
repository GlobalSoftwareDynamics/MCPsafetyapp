<!DOCTYPE html>

<html lang="es">

<?php
include('funcionesApp.php');
include('session.php');
if(isset($_SESSION['login'])&&(($_SESSION['usertype']=='1'))){
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
        include_once('navbarmainAdmin.php');
        ?>
    </header>

    <?php
    if(isset($_POST['add'])){
        $query = mysqli_query($link,"INSERT INTO AccionesCorrectivas VALUES ('{$_POST['idaccioncorrectiva']}',
        '{$_POST['responsable']}',1,'{$_POST['fecharegistro']}','{$_POST['descripcionac']}','{$_POST['fechaplaneada']}',null,'INC',null)");
        $query = mysqli_query($link, "INSERT INTO ACINC(idAccionesCorrectivas, idIncidentes, tipoAC) VALUES ('{$_POST['idaccioncorrectiva']}','{$_POST['idINC']}','{$_POST['tipoac']}')");
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
            <form action="#" method="post" class="form-horizontal jumbotron col-md-6 col-md-offset-3 col-xs-12">
                <div class="col-xs-12">
                    <h4 class="text-left">Registro de Acciones Correctivas</h4>
                </div>
                <?php
                $fecha = date('d/m/Y');
                $clase="AC";
                $idAC=idgen($clase);
                echo "
                    <input type='hidden' value='".$fecha."' name='fecharegistro'>
                    <input type='hidden' value='{$_POST['idINC']}' name='idINC'>
                    <input type='hidden' value='".$idAC."' name='idaccioncorrectiva'>
                ";
                ?>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-12">
                        <label for="desc">Descripción de la Acción Correctiva:</label>
                    </div>
                    <div class="col-md-12">
                        <textarea rows="3" class="col-md-12 form-control" name="descripcionac" id="desc"></textarea>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-12">
                        <label for="puesto">Puesto del Responsable:</label>
                    </div>
                    <div class="col-md-12">
                        <select id="puesto" class="col-md-12 form-control" name="puesto" onchange="getcolaboradores(this.value)">
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
                    <div class="col-md-12">
                        <label for="resp">Responsable:</label>
                    </div>
                    <div class="col-md-12">
                        <select id="resp" class="col-md-12 form-control" name="responsable">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-12">
                        <label for="datepicker">Fecha Planeada:</label>
                    </div>
                    <div class="col-md-12">
                        <input id="datepicker" class="col-md-12 form-control" name="fechaplaneada">
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-12">
                        <label for="tip">Tipo de Acción Correctiva:</label>
                    </div>
                    <div class="col-md-12">
                        <select id="tip" class="col-md-12 form-control" name="tipoac">
                            <option>Seleccionar</option>
                            <option value="CCA">Acción Correctiva Crítica</option>
                            <option value="OA">Acción Correctiva Complementaria</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" class="btn btn-success col-md-10 col-md-offset-1 col-xs-12" formaction="regINC_AccionesCorrectivas.php" value="Guardar" name="add">
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" class="btn btn-primary col-md-10 col-md-offset-1 col-xs-12" formaction="detalleIncidente.php" value="Siguiente" name="siguienteAC">
                    </div>
                </div>
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