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
    <body class="ocurrencia" style="font-size: 11px">
        <div>
            <div class="col-xs-12">
                <div class="col-xs-5">
                    <img width="auto" height="60" src="image/Logo.png" style="margin-top: 5px; margin-bottom: 5px">
                </div>
                <div class="col-xs-4" style="padding-top: 0.3cm;">
                    <p class="text-center" style="font-size: 14px;"><b>Reporte de Ocurrencia</b></p>
                    <p class="text-center" style="font-size: 11px;"><b>'.$_POST['idOCUR'].'</b></p>
                </div>
            </div>
        </div>
        <div style="border-bottom: 1px solid black; margin-bottom: 0.3cm"></div>
        ';
        $result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE idOcurrencias='".$_POST['idOCUR']."'");
        while ($fila=mysqli_fetch_array($result)) {
            $html .='
            <table class="tabla text-center">
                <thead>
                <tr class="trborder">
                    <th class="text-left" colspan="3">Datos de Reporte</th>
                </tr>
                </thead>
                <tbody>
                <tr class="trborder">
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Año Fiscal</th>
                </tr>
                <tr class="trborder">
                    <td>'.$fila['fecha'].'</td>
                    <td>'.$fila['hora'].'</td>
                    <td>'.$fila['anoFiscal'].'</td>
                </tr>
                </tbody>
            </table>
            <table class="tabla text-center">
                <thead>
                <tr class="trborder">
                    <th>Ubicación</th>
                    <th>Planta</th>
                </tr>
                </thead>
                <tbody>
                <tr class="trborder">';
                    $result1=mysqli_query($link,"SELECT * FROM Ubicacion WHERE idUbicacion = '{$fila['idUbicacion']}'");
                    while ($fila1=mysqli_fetch_array($result1)){
                        $result2=mysqli_query($link,"SELECT * FROM Planta WHERE idPlanta ='{$fila1['idPlanta']}'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            $html .='
                                        <td>'.$fila1['descripcion'].'</td>
                                        <td>'.$fila2['descripcion'].'</td>
                                    ';
                        }
                    }
            $html .='
                </tr>
                </tbody>
            </table>
            <table class="tabla text-center">
                <tbody>
                <tr class="trborder">
                    <th>Clase</th>';
                    $result1=mysqli_query($link,"SELECT * FROM Clase WHERE idClase='".$fila['idClase']."'");
                    while ($fila1=mysqli_fetch_array($result1)) {
                        $html .='
                            <td>'.$fila1['descripcion'].'</td>
                        </tr>
                    ';
                    }
            $html .='
                </tbody>
            </table>
            <table class="tabla text-center">
                <thead>
                <tr class="trborder">
                    <th class="text-left" colspan="2">Involucrados</th>
                </tr>
                </thead>
                <tbody>';
                $result1=mysqli_query($link,"SELECT * FROM InvolucradosOCUR WHERE idOcurrencias='".$fila['idOcurrencias']."' AND idTipoParticipante ='4'");
                while ($fila1=mysqli_fetch_array($result1)) {
                    $result2=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni ='".$fila1['dni']."'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        $html .='
                                <tr class="trborder">
                                    <th>Reportado Por</th>
                                    <td>'.$fila2['nombre'].' '.$fila2['apellidos'].'</td>
                                </tr>
                            ';
                    }
                }
                $html .='
                            <tr class="trborder">
                                <th>Reportando A:</th>
                                <td>
                    ';
                $fragmento="";
                $result1=mysqli_query($link,"SELECT * FROM InvolucradosOCUR WHERE idOcurrencias='".$fila['idOcurrencias']."' AND idTipoParticipante ='6'");
                while ($fila1=mysqli_fetch_array($result1)) {
                    $result2=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni ='".$fila1['dni']."'");
                    while ($fila2=mysqli_fetch_array($result2)){
                        $html .='<p>'.$fila2['nombre'].' '.$fila2['apellidos'].'</p>';
                    }
                }
                $html .='
                            </td>
                        </tr>
                    ';
            $html .='
                </tbody>
            </table>
            <table class="tabla">
                <thead>
                <tr class="trborder">
                    <th class="text-left">Descripción</th>
                </tr>
                </thead>
                <tbody>';
                $result1=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE idOcurrencias='".$fila['idOcurrencias']."'");
                while ($fila1=mysqli_fetch_array($result1)) {
                    $html .='
                            <tr class="trborder">
                                <td class="text-justify">'.$fila1['descripcion'].'</td>
                            </tr>
                        ';
                }
            $html .='
                </tbody>
            </table>
            <table class="tabla">
                <thead>
                <tr class="trborder">
                    <th class="text-left">Acciones Inmediatas</th>
                </tr>
                </thead>
                <tbody>
                <tr class="trborder">
                    <td class="text-justify">';
                        $result1=mysqli_query($link,"SELECT * FROM AIOCUR WHERE idOcurrencias='".$fila['idOcurrencias']."'");
                        while ($fila1=mysqli_fetch_array($result1)) {
                            $result2=mysqli_query($link,"SELECT * FROM AccionesInmediatas WHERE idAccionesInmediatas = '{$fila1['idAccionesInmediatas']}'");
                            while ($fila2=mysqli_fetch_array($result2)){
                                $html .='
                                <p>'.$fila2['descripcion'].'</p>
                                ';
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
                    <th class="text-left">Fotografias</th>
                </tr>
            </thead>
            <tbody>';
            $i = 0;
            $dir = "Fotografias/Ocurrencias/{$_POST['idOCUR']}/";
            if ($handle = opendir($dir)) {
                while (($file = readdir($handle)) !== false){
                    if (!in_array($file, array('.', '..')) && !is_dir($dir.$file))
                        $i++;
                }
            }
            for($j=0;$j<$i;$j++){
                $html .='<tr class="trborder"><td><img src="Fotografias/Ocurrencias/'.$_POST['idOCUR'].'/'.$_POST['idOCUR'].'-'.$j.'.jpg" alt="Evidencia'.$j.'" style="width:350px;height:260px;margin-left: 3cm;margin-right: 3cm;"></td></tr>';
            }
            $html .='
            </tbody>
        </table>';
        }
$html .=' 
    </body>
';
$nombrearchivo=$_POST['idOCUR'].'.pdf';
$mpdf = new mPDF('utf8',array(127,187),0,'',3,3,3,3,6,6);
// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output($nombrearchivo,'D');
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>