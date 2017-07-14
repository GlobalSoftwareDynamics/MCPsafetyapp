<?php
include('session.php');
require('funcionesgraficasyear.php');
$año=explode('0',$_POST['anio'],$link);
$datos1=NumIncidentesAnio($_POST['anio'],$link);
$datos2=NumIncidentesAnioxPlantaComparacion($_POST['anio'],$link);
$labels2=multilabel('Planta',$link);
$datos3=NumConsActIncxAnio($_POST['anio'],$link);
$labels3=multilabel('Consecuencia',$link);
$datos4=NumConsPotIncxAnio($_POST['anio'],$link);
$labels4=multilabel('Consecuencia',$link);
$datos5=NumLesionIncxAnio($_POST['anio'],$link);
$labels5=multilabeltipolesion($link);
$datos6=NumIntEnergiaIncAnio($_POST['anio'],$link);
$datos7=NumRepeticionIncAnio($_POST['anio'],$link);
$datos8=NumTotalParteCuerpoIncAnio($_POST['anio'],$link);
$labels8=multilabel('ParteCuerpo',$link);
$datos9=NumAccionesCorrectivasIncxAnio($_POST['anio'],$link);
$labels9=multilabel('EstadoACMS',$link);
?>

<script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});
    // Set a callback to run when the Google Visualization API is loaded.

    google.charts.setOnLoadCallback(drawChart1);
    function drawChart1() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos1;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" }
        ]);
        var options = {
            title: "Número de Incidentes Reportados por Mes",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
            legend: { position: 'top'}
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica1'));
        chart.draw(view, options);
    }

    google.charts.setOnLoadCallback(drawChart2);
    function drawChart2() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos2;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns(<?php echo $labels2;?>);
        var options = {
            title: "Comparación del Número de Incidentes Reportados por Planta",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
            legend: { position: 'top'}
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('grafica2'));
        chart.draw(view, options);
    }

    google.charts.setOnLoadCallback(drawChart3);
    function drawChart3() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos3;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns(<?php echo $labels3;?>);
        var options = {
            title: "Número de Incidentes por Consecuencia Actual",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica3'));
        chart.draw(view, options);
    }

    google.charts.setOnLoadCallback(drawChart4);
    function drawChart4() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos4;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns(<?php echo $labels4;?>);
        var options = {
            title: "Número de Incidentes por Consecuencia Potencial",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica4'));
        chart.draw(view, options);
    }

    google.charts.setOnLoadCallback(drawChart5);
    function drawChart5() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos5;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns(<?php echo $labels5;?>);
        var options = {
            title: "Número de Incidentes por Tipo de Lesión",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica5'));
        chart.draw(view, options);
    }

    google.charts.setOnLoadCallback(drawChart6);
    function drawChart6() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos6;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" }
        ]);
        var options = {
            title: "Intercambio de Energía en Incidentes",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('grafica6'));
        chart.draw(view, options);
    }

    google.charts.setOnLoadCallback(drawChart7);
    function drawChart7() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos7;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" }
        ]);
        var options = {
            title: "Repetición de Incidentes",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('grafica7'));
        chart.draw(view, options);
    }

    google.charts.setOnLoadCallback(drawChart8);
    function drawChart8() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos8;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" }
        ]);
        var options = {
            title: "Parte del Cuerpo Afectada",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
            legend: { position: 'top'}
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica8'));
        chart.draw(view, options);
    }

    google.charts.setOnLoadCallback(drawChart9);
    function drawChart9() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos9;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns(<?php echo $labels3;?>);
        var options = {
            title: "Estado de las Acciones Correctivas",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica9'));
        chart.draw(view, options);
    }
</script>

<section class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-center">Reporte Anual para Todas las Plantas (Incidentes)</h3>
    </div>
</section>
<hr>
<section class="container">
    <table class="table">
        <tbody>
        <tr>
            <td>
                <div id="grafica1">

                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div id="grafica2">

                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div id="grafica3">

                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div id="grafica4">

                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div id="grafica5">

                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="col-sm-7 col-md-offset-3">
                    <div id="grafica6">

                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="col-sm-7 col-md-offset-3">
                    <div id="grafica7">

                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div id="grafica8">

                </div>
            </td>
        </tr>
        </tbody>
    </table>
</section>

<section class="container">
    <div class="col-md-12">
        <h4 class="text-center">Acciones Correctivas Provenientes de Incidentes en el Año</h4>
    </div>
    <br>
    <table class="table table-bordered text-center">
        <thead>
        <tr>
            <th>Fecha de Registro</th>
            <th>Fuente</th>
            <th style="width: 40%">Descripción</th>
            <th>Responsable</th>
            <th>Fecha Planeada</th>
            <th>Fecha Real</th>
            <th>Estado</th>
        </tr>
        </thead>
        <tbody>
        <?php
        echo "
            <tr>
        ";
        $result0=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE fuente = 'INC'");
        while ($fila0=mysqli_fetch_array($result0)){
            $result1=mysqli_query($link,"SELECT * FROM ACINC WHERE idAccionesCorrectivas ='".$fila0['idAccionesCorrectivas']."' AND idIncidentes  LIKE 'INC".$año[1]."%'");
            while ($fila1=mysqli_fetch_array($result1)){
                echo "
                            <td>".$fila0['fecharegistro']."</td>
                ";
                $result=mysqli_query($link, "SELECT * FROM Incidentes WHERE idIncidentes ='".$fila1['idIncidentes']."'");
                while ($fila=mysqli_fetch_array($result)){
                    echo "
                        <td>".$fila['idIncidentes']."</td>
                    ";
                }
                echo "
                            <td class='text-left'>".$fila0['descripcion']."</td>
                        ";
                $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila0['dni']."'");
                while ($fila3=mysqli_fetch_array($result3)){
                    echo "
                     <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                ";
                }
                echo "
                <td>".$fila0['fechaPlan']."</td>
                <td>".$fila0['fechaReal']."</td>
            ";
                $result2=mysqli_query($link,"SELECT * FROM EstadoACMS WHERE idEstado ='".$fila0['idEstado']."'");
                while ($fila2=mysqli_fetch_array($result2)){
                    echo "
                        <td>".$fila2['descripcion']."</td>
                    ";
                }
            }
            echo "
                </tr>
            ";
        }
        ?>
        </tbody>
    </table>
    <table class="table">
        <tbody>
        <tr>
            <td>
                <div id="grafica9">

                </div>
            </td>
        </tr>
        </tbody>
    </table>
</section>