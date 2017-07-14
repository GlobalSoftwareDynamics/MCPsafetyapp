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
        <script>
            function gettrabajadores(val) {
                $.ajax({
                    type: "POST",
                    url: "getAjax.php",
                    data:{'regsafetyeyes2empresa':val},
                    success: function(data){
                        $("#trabaja").html(data);
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
    if (isset($_POST['agregar'])){
        /*echo $_POST['idAI'];*/
        $result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE idOcurrencias='".$_POST['idOCUR']."'");
        while ($fila=mysqli_fetch_array($result)){
            $fecharegistro=$fila['fecha'];
        }
        $agregar="INSERT INTO AccionesInmediatas(idAccionesInmediatas, dni, fecharegistro, descripcion, fuente) VALUES (
    '".$_POST['idAI']."','".$_POST['responsable']."','".$fecharegistro."','".$_POST['descripcion']."','OC'
    )";
        /*echo $agregar;*/
        $query=mysqli_query($link,$agregar);
        $agregar="INSERT INTO AIOCUR(idAccionesInmediatas, idOcurrencias) VALUES (
    '".$_POST['idAI']."','".$_POST['idOCUR']."'
    )";
        /*echo $agregar;*/
        $query=mysqli_query($link,$agregar);
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
            <form method="post" class="form-horizontal jumbotron col-xs-12 col-md-6 col-md-offset-3">
                <div class="col-xs-12">
                    <h4 class="text-left">Registro de Acciones Inmediatas</h4>
                </div>
                <br>
                <?php
                $clase="AI";
                $idAI=idgen($clase);
                echo "<input type='hidden' name='idAI' value='".$idAI."' readonly>";
                ?>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12">
                        <label for="desc">Descripción:</label>
                    </div>
                    <div class="col-xs-12">
                        <textarea rows="3" class="form-control col-xs-12" name="descripcion" id="desc"></textarea>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12">
                        <label for="empre">Empresa:</label>
                    </div>
                    <div class="col-xs-12">
                        <select id="empre" name="empresa" class="form-control col-xs-12" onchange="gettrabajadores(this.value)">
                            <option>Seleccionar</option>
                            <?php
                            $result1=mysqli_query($link,"SELECT * FROM Empresa WHERE estado='1'");
                            while ($fila1=mysqli_fetch_array($result1)){
                                echo "
                                <option value=".$fila1['ruc'].">".$fila1['siglas']."</option>                            ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <div class="col-xs-12">
                        <label for="trabaja">Responsable:</label>
                    </div>
                    <div class="col-xs-12">
                        <select id="trabaja" class="col-xs-12 form-control" name="responsable">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group col-xs-12 col-md-12">
                    <input type="hidden" name="idOCUR" value="<?php echo $_POST['idOCUR'];?>" readonly>
                    <div class="col-xs-12 col-md-6">
                        <input type="submit" class="btn btn-success col-xs-12 col-md-10 col-md-offset-1" formaction="regOC_AccionInmediata.php" name="agregar" value="Guardar">
                    </div>
                    <?php
                    if(isset($_POST['modificarAI'])){
                        echo "
                            <input type='hidden' value='{$_POST['modificarAI']}' name='modificarAI' readonly>
                        ";
                        echo "
                            <div class='col-xs-12 col-md-6 col-xs-12'>
                                 <input type='submit' class='btn btn-primary col-xs-12 col-md-10 col-md-offset-1' formaction='regOC_RevisionFinal.php' name='siguiente' value='Guardar Cambios'>
                            </div>
                        ";
                    }else{
                        $result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE idOcurrencias ='{$_POST['idOCUR']}'");
                        while ($fila=mysqli_fetch_array($result)){
                            if($fila['idClase']==="8"){
                                echo "
                                    <div class='col-xs-12 col-md-6'>
                                        <input type='submit' class='btn btn-primary col-xs-12 col-md-10 col-md-offset-1' formaction='regOC_RevisionFinal.php' name='siguiente' value='Siguiente'>
                                    </div>
                                ";
                            }else{
                                echo "
                                    <div class='col-xs-12 col-md-6'>
                                        <input type='submit' class='btn btn-primary col-xs-12 col-md-10 col-md-offset-1' formaction='regOC_DecisionAC.php' name='siguiente' value='Siguiente'>
                                    </div>
                                ";
                            }
                        }
                    }
                    ?>
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                        <input type="submit" class="btn btn-default col-xs-12 col-md-10 col-md-offset-1" formaction="verRegOC_AccionInmediata.php" name="revisar" value="Revisar Datos Ingresados">
                    </div>
                </div>
            </form>
        </div>
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