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
    <body class="cap" style="font-size: 11px">
        <div>
            <div class="col-xs-12">
                <div class="col-xs-5">
                    <img width="auto" height="60" src="image/Logo.png" style="margin-top: 5px; margin-bottom: 5px">
                </div>
                <div class="col-xs-4" style="padding-top: 0.3cm;">
                    <p class="text-center" style="font-size: 14px;"><b>Reporte CAP</b></p>
                    <p class="text-center" style="font-size: 11px;"><b>'.$_POST['idCAP'].'</b></p>
                </div>
            </div>
        </div>
        <div style="border-bottom: 1px solid black; margin-bottom: 0.3cm"></div>
        ';
        $result=mysqli_query($link,"SELECT * FROM CAP WHERE idCAP='".$_POST['idCAP']."'");
        while ($fila=mysqli_fetch_array($result)) {
            $html .='
                <table class="tabla text-center">
                    <thead>
                    <tr class="trborder">
                        <th class="text-left" colspan="3">Datos de Reporte</th>
                    </tr>
                    <tr class="trborder">
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Año Fiscal</th>
                    </tr>
                    </thead>
                    <tbody>
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
                        <th class="text-left">Tipo de Comportamiento</th>
                    </tr>
                    </thead>
                    <tbody>';
                    $result1=mysqli_query($link,"SELECT * FROM Comportamiento WHERE idComportamiento='".$fila['idComportamiento']."'");
                    while ($fila1=mysqli_fetch_array($result1)) {
                        $html .='
                            <tr class="trborder">
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
                    $result1=mysqli_query($link,"SELECT * FROM InvolucradosCAP WHERE idCAP='".$fila['idCAP']."' AND idTipoParticipante ='4'");
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
                    $result1=mysqli_query($link,"SELECT * FROM InvolucradosCAP WHERE idCAP='".$fila['idCAP']."' AND idTipoParticipante ='5'");
                    while ($fila1=mysqli_fetch_array($result1)) {
                        $result2=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni ='".$fila1['dni']."'");
                        while ($fila2=mysqli_fetch_array($result2)){
                            $html .='
                                <tr class="trborder">
                                    <th>Felicitando A</th>
                                    <td>'.$fila2['nombre'].' '.$fila2['apellidos'].'</td>
                                </tr>
                            ';
                        }
                    }
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
                    $result1=mysqli_query($link,"SELECT * FROM CAP WHERE idCAP='".$fila['idCAP']."'");
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
            </div>
            ';
        }
$html .='
        </div>
    </body>
';
$nombrearchivo=$_POST['idCAP'].'.pdf';
$mpdf = new mPDF('utf8',array(102,153),0,'',3,3,3,3,6,6);
// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output($nombrearchivo,'D');
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>