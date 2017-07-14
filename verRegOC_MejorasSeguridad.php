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
    if(isset($_POST['delete'])){
        $delete = mysqli_query($link, "DELETE FROM MEOCUR WHERE idMejoras = '".$_POST['idME']."' AND idOcurrencias = '".$_POST['idOCUR']."'");
        $delete = mysqli_query($link, "DELETE FROM MejorasSeguridad WHERE idMejoras = '".$_POST['idME']."'");
    }
    ?>
    <div class="container-fluid">
        <label>Código: <?php echo $_POST['idOCUR']?></label>
    </div>
    <section class="container">
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center">Propuesto por</th>
                    <th class="text-center">Empresa</th>
                    <th class="text-center">Descripcion</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = mysqli_query($link, "SELECT * FROM MEOCUR WHERE idOcurrencias = '".$_POST['idOCUR']."'");
                while($row = mysqli_fetch_array($query)){
                    echo "<tr>";
                    $query2 = mysqli_query($link, "SELECT * FROM MejorasSeguridad WHERE idMejoras = '".$row['idMejoras']."'");
                    while($row2 = mysqli_fetch_array($query2)){
                        $query3 = mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni = '".$row2['dni']."'");
                        while($row3 = mysqli_fetch_array($query3)){
                            echo "<td class='text-center'>".$row3['dni']."-".$row3['nombre']." ".$row3['apellidos']."</td>";
                            $query4 = mysqli_query($link,"SELECT * FROM Empresa WHERE ruc = '".$row3['ruc']."'");
                            while($row4 = mysqli_fetch_array($query4)){
                                echo "<td class='text-center'>".$row4['razonSocial']."</td>";
                            }
                        }
                        echo "<td class='text-center'>".$row2['descripcion']."</td>";
                    }
                    echo "<td class='text-center'>
											<form method='post' action='verRegOC_MejorasSeguridad.php'>
												<input type='submit' class='btn-link' value='Eliminar' name='delete'>
												<input type='hidden' value='" .$_POST['idOCUR']."' name='idOCUR'>";
                                                if(isset($_POST['modificarME'])){
                                                    echo "
                                                        <input type='hidden' value='{$_POST['modificarME']}' name='modificarME' readonly>
                                                    ";
                                                }
                        echo "
												<input type='hidden' value='".$row['idMejoras']."' name='idME'>
											</form>
									  </td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
            <form method="post">
                <div class="form-group">
                    <input type="hidden" name="idOCUR" value="<?php echo $_POST['idOCUR'];?>">
                    <?php
                    if(isset($_POST['modificarME'])){
                        echo "
                            <input type='hidden' value='{$_POST['modificarME']}' name='modificarME' readonly>
                        ";
                    }
                    ?>
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                        <input type="submit" class="btn btn-default col-xs-12 col-md-10 col-md-offset-1" formaction="regOC_MejorasSeguridad.php" name="back" value="Regresar">
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