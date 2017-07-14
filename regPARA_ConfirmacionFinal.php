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
    if(isset($_POST['registrar'])){
        $agregar="INSERT INTO PARA(idPARA, dni, idUbicacion, fecha, anoFiscal, tarea) VALUES(
        '{$_POST['idPARA']}','{$_POST['reportante']}','{$_POST['ubicacion']}','{$_POST['fecha']}','{$_POST['fy']}','{$_POST['actividad']}'
        )";
        $query=mysqli_query($link,$agregar);
        $aux=0;
        $result=mysqli_query($link,"SELECT * FROM Preguntas WHERE seccion = 'Para' ORDER BY idPreguntas");
        while ($fila=mysqli_fetch_array($result)){
            $aux++;
            $respuesta="respuesta".$aux;
            $agregar="INSERT INTO PreguntasPARA(idPARA, idPreguntas, respuestas) VALUES (
            '{$_POST['idPARA']}','{$fila['idPreguntas']}','{$_POST[$respuesta]}'
            )";
        }
        $result=mysqli_query($link,"SELECT * FROM Preguntas WHERE seccion = 'Analiza' ORDER BY idPreguntas");
        while ($fila=mysqli_fetch_array($result)){
            $aux++;
            $respuesta="respuesta".$aux;
            $agregar="INSERT INTO PreguntasPARA(idPARA, idPreguntas, respuestas) VALUES (
            '{$_POST['idPARA']}','{$fila['idPreguntas']}','{$_POST[$respuesta]}'
            )";
        }
        $result=mysqli_query($link,"SELECT * FROM Preguntas WHERE seccion = 'Reflexiona' ORDER BY idPreguntas");
        while ($fila=mysqli_fetch_array($result)){
            $aux++;
            $respuesta="respuesta".$aux;
            $agregar="INSERT INTO PreguntasPARA(idPARA, idPreguntas, respuestas) VALUES (
            '{$_POST['idPARA']}','{$fila['idPreguntas']}','{$_POST[$respuesta]}'
            )";
        }
        $result=mysqli_query($link,"SELECT * FROM Preguntas WHERE seccion = 'Actua' ORDER BY idPreguntas");
        while ($fila=mysqli_fetch_array($result)){
            $aux++;
            $respuesta="respuesta".$aux;
            $agregar="INSERT INTO PreguntasPARA(idPARA, idPreguntas, respuestas) VALUES (
            '{$_POST['idPARA']}','{$fila['idPreguntas']}','{$_POST[$respuesta]}'
            )";
        }
        $contador=0;
        $result=mysqli_query($link,"SELECT * FROM PreguntasPARA WHERE idPARA = '{$_POST['idPARA']}' ORDER BY idPreguntas");
        while ($fila=mysqli_fetch_array($result)){
            if($fila['respuestas']==='0'){
                $contador++;
            }else{}
        }
        if ($contador!==0){
            echo "
                <section class='container'>
                    <div class='alert alert-danger'>
                        <strong>PARA! Antes de comenzar con el desarrollo de la actividad conversa con un supervisor sobre las implicaciones de la misma, evaluen los peligros y riesgos asociados y determinen juntos si es posible empezar a realizarla.</strong>
                    </div>
                </section>
            ";
        }
    }
    ?>
    <section class="container">
        <div>
            <form method="post" class="form-horizontal jumbotron col-xs-12 col-md-6 col-md-offset-3">
                <div class="col-xs-12">
                    <h4 class="text-center">PARA registrado exitosamente</h4>
                </div>
                <br>
                <hr>
                <div class="form-group">
                    <input type="hidden" name="idPARA" value="<?php echo $_POST['idPARA'];?>" readonly>
                    <?php
                    if($_SESSION['usertype']=='1'||$_SESSION['usertype']=='2'){
                        echo "
                            <div class='col-xs-12'>
                                <input type='submit' class='btn btn-primary col-xs-12 col-md-6 col-md-offset-3' formaction='mainSupervisor.php' name='finalizar' value='Finalizar'>
                            </div>
                        ";
                    }elseif($_SESSION['usertype']=='5'){
                        echo "
                            <div class='col-xs-12'>
                                <input type='submit' class='btn btn-primary col-xs-12 col-md-6 col-md-offset-3' formaction='mainOperario.php' name='finalizar' value='Finalizar'>
                            </div>
                        ";
                    }
                    ?>
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