<!DOCTYPE html>

<html lang="es">

<?php
include('funcionesApp.php');
include('session.php');
if(isset($_SESSION['login'])&&(($_SESSION['usertype']=='1')||($_SESSION['usertype']=='2')||($_SESSION['usertype']=='5'))){
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
        if($_SESSION['usertype']=='1'||$_SESSION['usertype']=='2'){
            include_once('navbarmainSupervisor.php');
        }elseif($_SESSION['usertype']=='5'){
            include_once('navbarmainOperario.php');
        }
        ?>
    </header>

    <?php
    if(isset($_POST['add'])){
        $query = mysqli_query($link,"SELECT * FROM Colaboradores WHERE usuario = '{$_SESSION['login']}'");
        while($row = mysqli_fetch_array($query)){
            $dni = $row['dni'];
            $query = mysqli_query($link,"INSERT INTO AccionesCorrectivas VALUES ('{$_POST['idaccioncorrectiva']}','{$dni}',5,'{$_POST['fecharegistro']}','{$_POST['descripcionac']}',null,null,'OC',null)");
            $query = mysqli_query($link, "INSERT INTO ACOCUR(idAccionesCorrectivas, idOcurrencias) VALUES ('{$_POST['idaccioncorrectiva']}','{$_POST['idOCUR']}')");
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
    <div class="container-fluid">
        <label>Código: <?php echo $_POST['idOCUR']?></label>
    </div>
    <section class="container">
        <div>
            <form action="#" method="post" class="form-horizontal jumbotron col-md-6 col-md-offset-3 col-xs-12">
                <div class="col-xs-12">
                    <h4 class="text-left">Registro de Acciones Correctivas Sugeridas</h4>
                </div>
                <?php
                $fecha = date('d/m/Y');
                $clase="AC";
                $idAC=idgen($clase);
                echo "
                    <input type='hidden' value='".$fecha."' name='fecharegistro'>
                    <input type='hidden' value='{$_POST['idOCUR']}' name='idOCUR'>
                    <input type='hidden' value='".$idAC."' name='idaccioncorrectiva'>
                ";
                ?>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-12 col-xs-12">
                        <label for="desc">Descripción de la Acción Correctiva:</label>
                    </div>
                    <div class="col-md-12 col-xs-12">
                        <textarea rows="3" class="col-md-12 form-control col-xs-12" name="descripcionac" id="desc"></textarea>
                    </div>
                </div>
                <br>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-md-6 col-xs-12">
                        <input type="submit" class="btn btn-success col-md-10 col-md-offset-1 col-xs-12" formaction="regOC_AccionCorrectiva.php" value="Guardar" name="add">
                    </div>
                    <?php
                    if(isset($_POST['modificarAC'])){
                        echo "
                            <input type='hidden' value='{$_POST['modificarAC']}' name='modificarAC' readonly>
                        ";
                        echo "
                            <div class='col-xs-12 col-md-6'>
                                <input type='submit' class='btn btn-primary col-xs-12 col-md-10 col-md-offset-1' formaction='regOC_RevisionFinal.php' name='siguiente' value='Guardar Cambios'>
                            </div>
                        ";
                    }else{
                        echo "
                            <div class='col-xs-12 col-md-6'>
                                <input type='submit' class='btn btn-primary col-xs-12 col-md-10 col-md-offset-1' formaction='regOC_DecisionMS.php' name='siguiente' value='Siguiente'>
                            </div>
                        ";
                    }
                    ?>
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