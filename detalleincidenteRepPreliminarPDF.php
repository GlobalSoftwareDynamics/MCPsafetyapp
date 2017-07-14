<?php
require_once __DIR__ . '/lib/mpdf/mpdf.php';

include('session.php');
include('funcionesApp.php');
if(isset($_SESSION['login'])&&($_SESSION['usertype']=='1')){

    $html='
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/Formatospdf.css" rel="stylesheet">
    </head>
    <body class="portrait">';

    $result=mysqli_query($link,"SELECT * FROM Incidentes WHERE idIncidentes = '{$_POST['idINC']}'");
    while ($fila=mysqli_fetch_array($result)){

        $html .='
        <section class="container">
            <table class="tabla text-center">
                <thead>
                <tr class="trborder">
                    <th>'.$fila['titulo'].'</th>
                </tr>
                </thead>
            </table>
            <table class="tabla text-center">
                <thead>
                <tr class="trborder">
                    <td>Consecuencia Actual</td>
                    <td>Consecuencia Potencial</td>
                    <td>Clasificación de la Lesión</td>
                </tr>
                </thead>
                <tbody>
                <tr class="trborder">';
                    $result1=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes = '{$_POST['idINC']}' AND tipo = 'Actual'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        $result2=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila1['idConsecuencia']}'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            $html .='
                                <td>'.$fila2['siglas'].'</td>
                            ';
                        }
                    }
                    $result1=mysqli_query($link,"SELECT * FROM IncidentesConsecuencia WHERE idIncidentes = '{$_POST['idINC']}' AND tipo = 'Potencial'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        $result2=mysqli_query($link,"SELECT * FROM Consecuencia WHERE idConsecuencia = '{$fila1['idConsecuencia']}'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            $html .='
                                <td>'.$fila2['siglas'].'</td>
                            ';
                        }
                    }
                    $result1=mysqli_query($link,"SELECT * FROM TipoLesion WHERE idTipoLesion = '{$fila['idTipoLesion']}'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        $html .='
                            <td>'.$fila1['siglas'].'</td>
                        ';
                    }
        $html .='
                </tr>
                </tbody>
            </table>
            <table class="tabla text-center">
                <tbody>
                <tr class="trborder">
                    <th>Fecha</th>
                    <td>'.$fila['fecha'].'</td>
                    <th>Planta</th>';
                    $result1=mysqli_query($link,"SELECT * FROM Ubicacion WHERE idUbicacion = '{$fila['idUbicacion']}'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        $result2=mysqli_query($link,"SELECT * FROM Planta WHERE idPlanta = '{$fila1['idPlanta']}'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            $html .='
                                <td>'.$fila2['descripcion'].'</td>
                            ';
                        }
                    }
        $html .='
                </tr>
                <tr class="trborder">
                    <th>Hora</th>
                    <td>'.$fila['hora'].'</td>
                    <th>Ubicación</th>';
                    $result1=mysqli_query($link,"SELECT * FROM Ubicacion WHERE idUbicacion = '{$fila['idUbicacion']}'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        $html .='
                            <td>'.$fila1['descripcion'].'</td>
                        ';
                    }
        $html .='
                </tr>
                </tbody>
            </table>
            <table class="tabla text-center">
                <thead>
                <tr class="trborder">
                    <th colspan="4" class="text-left">Descripción</th>
                </tr>
                </thead>
                <tbody>
                <tr class="trborder">
                    <td colspan="4" class="text-justify">'.$fila['descripcion'].'</td>
                </tr>
                <tr class="trborder">';
                    if($fila['intercambioenergia']==='1'){
                        $html .='
                            <th>Intercambio de Energía</th>
                            <td>Si</td>
                        ';
                    }elseif($fila['intercambioenergia']==='0') {
                        $html .='
                            <th>Intercambio de Energía</th>
                            <td>No</td>
                        ';
                    }
                    if ($fila['repeticion']==='1'){
                        $html .='
                            <th>Incidente Repetido</th>
                            <td>Si</td>
                        ';
                    }elseif($fila['repeticion']==='0'){
                        $html .='
                            <th>Incidente Repetido</th>
                            <td>No</td>
                        ';
                    }else{
                        $html .='
                            <th>Incidente Repetido</th>
                            <td>Sin Determinar</td>
                        ';
                    }
        $html .='
                </tr>
                </tbody>
            </table>
            <table class="tabla text-center">
                <thead>
                <tr class="trborder">
                    <th class="text-left">Acciones Inmediatas</th>
                </tr>
                </thead>
                <tbody>
                <tr class="trborder">
                <td class="text-justify">';
        if($fila['fuente'] = NULL){
            $result1=mysqli_query($link,"SELECT * FROM AIINC WHERE idIncidentes = '{$_POST['idINC']}'");
            while ($fila1=mysqli_fetch_array($result1)){
                $result2=mysqli_query($link,"SELECT * FROM AccionesInmediatas WHERE idAccionesInmediatas = '{$fila1['idAccionesInmediatas']}'");
                while ($fila2=mysqli_fetch_array($result2)){
                    $html .='
                                                <p>'.$fila2['descripcion'].'</p>
                                            ';
                }
            }
        }else{
            $result1=mysqli_query($link,"SELECT * FROM AIOCUR WHERE idOcurrencias = '{$fila['fuente']}'");
            while ($fila1=mysqli_fetch_array($result1)){
                $result2=mysqli_query($link,"SELECT * FROM AccionesInmediatas WHERE idAccionesInmediatas = '{$fila1['idAccionesInmediatas']}'");
                while ($fila2=mysqli_fetch_array($result2)){
                    $html .='
                                                <p>'.$fila2['descripcion'].'</p>
                                            ';
                }
            }
            $result1=mysqli_query($link,"SELECT * FROM AIINC WHERE idIncidentes = '{$_POST['idINC']}'");
            while ($fila1=mysqli_fetch_array($result1)){
                $result2=mysqli_query($link,"SELECT * FROM AccionesInmediatas WHERE idAccionesInmediatas = '{$fila1['idAccionesInmediatas']}'");
                while ($fila2=mysqli_fetch_array($result2)){
                    $html .='
                                                <p>'.$fila2['descripcion'].'</p>
                                            ';
                }
            }
        }
        $html .='
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="tabla">
                <thead>
                    <tr class="trborder">
                        <th>Fotografías del Incidente</th>
                    </tr>
                </thead>
                <tbody>';
                        $i = 0;
                        $dir = "Fotografias/Ocurrencias/{$fila['fuente']}/";
                        if ($handle = opendir($dir)) {
                            while (($file = readdir($handle)) !== false){
                                if (!in_array($file, array('.', '..')) && !is_dir($dir.$file))
                                    $i++;
                            }
                        }
                        for($j=0;$j<$i;$j++){
                            $html .='<tr class="trborder"><td>';
                            $html .='<img src="Fotografias/Ocurrencias/'.$fila['fuente'].'/'.$fila['fuente'].'-'.$j.'.jpg" alt="Evidencia'.$j.'" style="width:400px;height:330px;margin-bottom:20px;margin-left: 10px;margin-right: 65px;">';
                            $html .='</td></tr>';
                        }$i = 0;

                        $dir = "Fotografias/Incidentes/{$_POST['idINC']}/";
                        if ($handle = opendir($dir)) {
                            while (($file = readdir($handle)) !== false){
                                if (!in_array($file, array('.', '..')) && !is_dir($dir.$file))
                                    $i++;
                            }
                        }
                        for($j=0;$j<$i;$j++){
                            $html .='<tr class="trborder"><td>';
                            $html .='<img src="Fotografias/Incidentes/'.$_POST['idINC'].'/'.$_POST['idINC'].'-'.$j.'.jpg" alt="Evidencia'.$j.'" style="width:400px;height:330px;margin-bottom:20px;margin-left: 10px;margin-right: 65px;">';
                            $html .='</td></tr>';
                        }
        $html .='
                </tbody>
            </table>
        </section>';
    }
    $html .='
        </body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    ';
    $htmlheader='
        <header>
            <div id="descripcionbrand">
                <img style="margin-top: 20px" width="auto" height="70" src="image/Logo.png"/>
            </div>
            <div id="tituloreporte">
                <div class="titulo">
                    <h4>Reporte de Incidente</h4><br>
                    <h4 class="desctitulo" style="font-size: 15px">'.$_POST['idINC'].'</h4>
                </div>
            </div>
        </header>
    ';
    $htmlfooter='
          <div class="footer">
                <span style="font-size: 10px;">GSD-Safe@Work</span>
                                   
                                 
                              
                <span style="font-size: 10px">© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
          </div>
    ';
    $nombrearchivo=$_POST['idINC'].'.pdf';
    $mpdf = new mPDF('','A4',0,'','15',15,35,15,6,6);

// Write some HTML code:
    $mpdf->SetHTMLHeader($htmlheader);
    $mpdf->SetHTMLFooter($htmlfooter);
    $mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
    $mpdf->Output($nombrearchivo,'D');
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>