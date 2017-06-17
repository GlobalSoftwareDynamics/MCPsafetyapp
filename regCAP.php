<!DOCTYPE html>

<html lang="es">

<?php
include('session.php');
include('funcionesApp.php');
if(isset($_SESSION['login'])&&(($_SESSION['usertype']=='1'))||($_SESSION['usertype']=='2')){
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSD Safe@Work</title>
    <link href="css/bootstrap.css" rel="stylesheet">
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
    include_once('navbarmainSupervisor.php');
    ?>
</header>
<?php
if (isset($_POST['registrar'])){
    $agregar="INSERT INTO CAP(idCAP, idComportamiento, fecha, hora, anoFiscal, descripcion, estado) VALUES ('".$_POST['idCAP']."','".$_POST['comportamiento']."'
    ,'".$_POST['fecha']."','".$_POST['hora']."','".$_POST['fy']."','".$_POST['descripcion']."','Pendiente'
    )";
    echo $agregar;
    $agregar1=mysqli_query($link,$agregar);
    $agregar="INSERT INTO InvolucradosCAP(dni, idCAP, idTipoParticipante) VALUES('".$_POST['reportante']."','".$_POST['idCAP']."','4')";
    $agregar1=mysqli_query($link,$agregar);
    $agregar="INSERT INTO InvolucradosCAP(dni, idCAP, idTipoParticipante) VALUES('".$_POST['reportado']."','".$_POST['idCAP']."','5')";
    $agregar1=mysqli_query($link,$agregar);
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
        <form class="form-horizontal jumbotron col-xs-12 col-sm-6 col-sm-offset-3" method="post" action="regCAP.php">
            <div class="col-xs-12 col-sm-12">
                <h4>Reporte CAP</h4>
            </div>
            <br>
            <?php
            $result=mysqli_query($link,"SELECT * FROM Colaboradores WHERE usuario ='".$_SESSION['login']."'");
            while ($fila=mysqli_fetch_array($result)){
                $persona=$fila['dni'];
                echo "
                    <input type='hidden' name='reportante' value='".$persona."' readonly>
                ";
            }
            date_default_timezone_set('America/Lima');
            $hora = date('H:i:s');
            $fecha = date('d/m/Y');
            $fy=fiscalyear();
            $clase="CAP";
            $idCAP=idgen($clase);
            echo "
                <input type='hidden' name='idCAP' value='".$idCAP."' readonly>
                <input type='hidden' name='fecha' value='".$fecha."' readonly>
                <input type='hidden' name='hora' value='".$hora."' readonly>
                <input type='hidden' name='fy' value='".$fy."' readonly>
            ";
            ?>
            <div class="form-group">
                <div class="col-sm-12 col-xs-12">
                    <label for="desc">Descripción del Comportamiento:</label>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <textarea name="descripcion" class="form-control col-xs-12 col-sm-12" rows="3" id="desc"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-12">
                    <label for="comp" class="col-xs-12">Comportamiento:</label>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <select id="comp" name="comportamiento" class="form-control col-xs-12 col-sm-12">
                        <option>Seleccionar</option>
                        <?php
                        $result1=mysqli_query($link,"SELECT * FROM Comportamiento");
                        while ($fila1=mysqli_fetch_array($result1)){
                            echo "
                                <option value=".$fila1['idComportamiento'].">".$fila1['descripcion']."</option>                            ";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-12">
                    <label class="col-xs-12 col-sm-12">Datos del Reportado:</label>
                </div>
                <br>
                <div class="col-xs-12 col-sm-12">
                    <label for="empre" class="col-xs-12">Empresa:</label>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <select id="empre" name="empresa" class="form-control col-xs-12 col-sm-12" onchange="gettrabajadores(this.value)">
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
                <div class="col-xs-12 col-sm-12">
                    <label for="trabaja" class="col-xs-12">Nombre:</label>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <select id="trabaja" class="col-xs-12 form-control col-sm-12" name="reportado">
                        <option>Seleccionar</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="col-xs-12 col-sm-6">
                    <input type="submit" name="registrar" value="Registrar" class="btn btn-success col-sm-10 col-sm-offset-1 col-xs-12">
                </div>
                <div class="col-xs-12 col-sm-6">
                    <input type="submit" name="regresar" formaction="mainSupervisor.php" value="Regresar" class="btn btn-default col-sm-10 col-sm-offset-1 col-xs-12">
                </div>
            </div>
        </form>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<footer class="panel-footer navbar-fixed-bottom">
    <?php
    include_once('footercio.php');
    ?>
</footer>
</body>

<?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>

</html>