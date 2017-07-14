<!DOCTYPE html>

<html lang="es">

<?php
error_reporting(E_ALL);
include("resize-class.php");
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
    <div class="container-fluid">
        <label>Código: <?php echo $_POST['idOCUR']?></label>
    </div>
    <section class="container">
        <?php

        if(mkdir("Fotografias/Ocurrencias/{$_POST['idOCUR']}",0777,true)){
            //echo "Directorio creado.";
        }else{
            //echo "Directorio existente.";
        }
        $target_dir = "Fotografias/Ocurrencias/{$_POST['idOCUR']}/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        /*if (file_exists($target_file)) {
            echo "<div class='container'><span class='alert alert-danger col-md-8 col-md-offset-2'>Lo lamentamos, su fotografía ya ha sido agregada previamente.</span></div><br>";
            $uploadOk = 0;
        }*/
        if ($uploadOk == 0) {
            echo "<div class='container'><span class='alert alert-danger col-md-8 col-md-offset-2'>Su fotografía no fue subida.</span></div><br>";
        } else {
            $i = 0;
            $dir = "Fotografias/Ocurrencias/{$_POST['idOCUR']}/";
            if ($handle = opendir($dir)) {
                while (($file = readdir($handle)) !== false){
                    if (!in_array($file, array('.', '..')) && !is_dir($dir.$file))
                        $i++;
                }
            }
            $temp = explode(".", $_FILES["fileToUpload"]["name"]);
            $newfilename = $_POST['idOCUR']."-{$i}.jpg";
            $destination = $target_dir.$newfilename;

	        if ($_FILES["fileToUpload"]["size"] > 3000000) {
		        $uploadOk = 0;
	        }

	        if($uploadOk == 1){
		        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $destination)) {
			        echo "<div class='container'><span class='alert alert-success col-md-8 col-md-offset-2'>La fotografía fue registrada exitosamente.</span></div><br>";
		        } else {
			        echo "<div class='container'><span class='alert alert-danger col-md-8 col-md-offset-2'>Lo lamentamos, hubo un error subiendo su fotografía.</span></div><br>";
		        }
            }else{
		        echo "<div class='container'><span class='alert alert-danger col-md-8 col-md-offset-2'>Reduzca la resolución de la imagen.</span></div><br>";
	        }

            //indicate which file to resize (can be any type jpg/png/gif/etc...)

            $file = $destination;

            //indicate the path and name for the new resized file
            $resizedFile = $target_dir.$_POST['idOCUR']."-{$i}.jpg";

            //call the function (when passing path to pic)
            smart_resize_image($file , null, 500 , 1000 , true , $resizedFile , false , false ,50 );
        }


        ?>
    </section>

    <br>

    <section class="container">
        <form method="post" action="#" class="form-horizontal jumbotron col-xs-12 col-md-6 col-md-offset-3">
            <div class="form-group col-xs-12 col-md-12">
                <input type="hidden" name="idOCUR" value="<?php echo $_POST['idOCUR'];?>" readonly>
                <div class="col-md-6 col-md-offset-3 col-xs-12">
                    <input class="btn btn-success col-xs-12 col-md-12" type="submit" formaction="regOC_Evidencias.php" value="Añadir otra fotografía">
                </div>
                <?php
                if(isset($_POST['modificarEvidencias'])){
                    echo "
                            <input type='hidden' value='{$_POST['modificarEvidencias']}' name='modificarEvidencias' readonly>
                        ";
                    echo "
                            <div class='col-xs-12 col-md-6 col-md-offset-3'>
                                <input type='submit' class='btn btn-primary col-xs-12 col-md-12' formaction='regOC_RevisionFinal.php' name='siguiente' value='Guardar Cambios'>
                            </div>
                        ";
                }else{
                    echo "
                            <div class='col-xs-12 col-md-6 col-md-offset-3'>
                                <input type='submit' class='btn btn-primary col-xs-12 col-md-12' formaction='regOC_DecisionAI.php' name='finalizar' value='Siguiente'>
                            </div>
                        ";
                }
                ?>
            </div>
        </form>
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