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
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/Formatos.css" rel="stylesheet">
</head>

<body>
<header>
    <?php
    include_once('navbarmainAdmin.php');
    ?>
</header>
<?php
if (isset($_POST['aprobar'])){
    $aprobar="UPDATE CAP SET estado = 'Aprobado' WHERE idCAP = '".$_POST['idCAP']."'";
    $query=mysqli_query($link,$aprobar);
}
?>
<section class="container-fluid">
    <div class="container col-md-6 col-md-offset-3 col-xs-12 bordes">
        <div class="col-md-12">
            <div class="col-md-8 hidden-xs">
                <div class="col-md-12">
                    <img width="auto" height="80" src="image/Logo.png" style="margin-top: 5px; margin-bottom: 5px">
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="col-md-12">
                    <h4 class="titulo text-center">Reporte CAP</h4>
                </div>
                <div class="col-md-12">
                    <h5 class="desctitulo text-center"><?php echo $_POST['idCAP'];?></h5>
                </div>
            </div>
        </div>
        <hr>
        <?php
        $result=mysqli_query($link,"SELECT * FROM CAP WHERE idCAP='".$_POST['idCAP']."'");
        while ($fila=mysqli_fetch_array($result)) {
        ?>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th class="text-left" colspan="3">Datos de Reporte</th>
            </tr>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Año Fiscal</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $fila['fecha'];?></td>
                <td><?php echo $fila['hora'];?></td>
                <td><?php echo $fila['anoFiscal'];?></td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th class="text-left">Tipo de Comportamiento</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result1=mysqli_query($link,"SELECT * FROM Comportamiento WHERE idComportamiento='".$fila['idComportamiento']."'");
            while ($fila1=mysqli_fetch_array($result1)) {
                echo "
                <tr>
                    <td>".$fila1['descripcion']."</td>
                </tr>
            ";
            }
            ?>
            </tbody>
        </table>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th class="text-left" colspan="2">Involucrados</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $result1=mysqli_query($link,"SELECT * FROM InvolucradosCAP WHERE idCAP='".$fila['idCAP']."' AND idTipoParticipante ='4'");
            while ($fila1=mysqli_fetch_array($result1)) {
                $result2=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni ='".$fila1['dni']."'");
                while ($fila2=mysqli_fetch_array($result2)){
                    echo "
                        <tr>
                            <th>Reportado Por</th>
                            <td>".$fila2['nombre']." ".$fila2['apellidos']."</td>
                        </tr>
                    ";
                }
            }
            $result1=mysqli_query($link,"SELECT * FROM InvolucradosCAP WHERE idCAP='".$fila['idCAP']."' AND idTipoParticipante ='5'");
            while ($fila1=mysqli_fetch_array($result1)) {
                $result2=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni ='".$fila1['dni']."'");
                while ($fila2=mysqli_fetch_array($result2)){
                    echo "
                        <tr>
                            <th>Felicitando A</th>
                            <td>".$fila2['nombre']." ".$fila2['apellidos']."</td>
                        </tr>
                    ";
                }
            }
            ?>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-left">Descripción</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $result1=mysqli_query($link,"SELECT * FROM CAP WHERE idCAP='".$fila['idCAP']."'");
            while ($fila1=mysqli_fetch_array($result1)) {
                echo "
                    <tr>
                        <td class='text-justify'>".$fila1['descripcion']."</td>
                    </tr>
                ";
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
    }
    ?>
</section>
<hr>
<section class="container">
    <?php
    $result=mysqli_query($link,"SELECT * FROM CAP WHERE idCAP='".$_POST['idCAP']."'");
    while ($fila=mysqli_fetch_array($result)){
        if($fila['estado']==="Pendiente"){
            echo "
                <form method='post' action='aprobarCAP.php' class='form-horizontal col-md-12'>
                    <div class='form-group col-md-12 col-xs-12'>
                        <input type='hidden' name='idCAP' value=".$_POST['idCAP'].">
                        <div class='col-md-3 col-xs-12'>
                            <input type='submit' class='btn btn-default col-md-12 col-xs-12' value='Regresar' name='Regresar'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-3 col-xs-12'>
                            <input type='submit' class='btn btn-default col-md-12 col-xs-12' value='Rechazar' name='rechazar'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-3 col-xs-12'>
                            <input type='submit' class='btn btn-success col-md-12 col-xs-12' value='Aprobar' name='aprobar' formaction='detalleCAP.php'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-3 col-xs-12'>
                            <input type='submit' class='btn btn-primary col-md-12 col-xs-12' value='Generar PDF' name='pdf' formaction='detallesCAPpdf.php'>
                        </div>
                    </div>
                </form>
            ";
        }else{
            echo "
                <form method='post' action='registrosCAP.php' class='form-horizontal col-md-12'>
                    <div class='form-group col-md-12 col-xs-12'>
                        <input type='hidden' name='idCAP' value=" .$_POST['idCAP']. ">
                        <div class='col-md-6 col-xs-12'>
                            <input type='submit' class='btn btn-default col-md-12 col-xs-12' value='Regresar' name='Regresar'>
                        </div>
                        <div class=\"spacer5\"></div>
                        <div class='col-md-6 col-xs-12'>
                            <input type='submit' class='btn btn-primary col-md-12 col-xs-12' value='Generar PDF' name='pdf' formaction='detallesCAPpdf.php'>
                        </div>
                    </div>
                </form>
            ";
        }
    }
    ?>
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