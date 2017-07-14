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
    </head>

    <body>
    <header>
        <?php
        include_once('navbarmainAdmin.php');
        ?>
    </header>

    <?php
    if(isset($_POST['delete'])){
        $delete = mysqli_query($link, "DELETE FROM CausasIncidente WHERE idCausasIncidente = '".$_POST['idCauInc']."'");
    }
    ?>

    <section class="container">
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center">Causa</th>
                    <th class="text-center" style="width: 30%">Descripción</th>
                    <th class="text-center">Tipo</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = mysqli_query($link, "SELECT * FROM CausasIncidente WHERE idIncidentes = '".$_POST['idINC']."'");
                while($row = mysqli_fetch_array($query)){
                    echo "<tr>";
                    $query3 = mysqli_query($link,"SELECT * FROM Causas WHERE idCausas = '".$row['idCausas']."'");
                    while($row3 = mysqli_fetch_array($query3)){
                        echo "<td class='text-center'>".$row3['descripcion']."</td>";
                    }
                    echo "<td class='text-left'>".$row['descripcion']."</td>";
                    if($row['tipo']==='1'){
                        echo "<td class='text-center'>Raíz</td>";
                    }
                    if($row['tipo']==='2'){
                        echo "<td class='text-center'>Contributiva</td>";
                    }
                    echo "<td class='text-center'>
											<form method='post' action='verRegINC_Causas.php'>
												<input type='submit' class='btn-link' value='Eliminar' name='delete'>
												<input type='hidden' value='" .$_POST['idINC']."' name='idINC'>
												<input type='hidden' value='".$row['idCausasIncidente']."' name='idCauInc'>
											</form>
									  </td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
            <form method="post">
                <div class="form-group">
                    <input type="hidden" name="idINC" value="<?php echo $_POST['idINC'];?>">
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                        <input type="submit" class="btn btn-default col-xs-12 col-md-10 col-md-offset-1" formaction="regINC_Causas.php" name="back" value="Regresar">
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