<?php
include('session.php');
require('funcionesgraficasyear.php');
$año=explode('0',$_POST['anio'],$link);
$datos=NumCAPAnio($_POST['anio'],$link);
$datos2=NumComportamientoxAnio($_POST['anio'],$link);
$labels2=multilabel('Comportamiento',$link);
$datos3=NumTotalReportanteCAPAño($_POST['anio'],$link);
$datos4=NumTotalFelicitadoCAPAño($_POST['anio'],$link);
?>

<script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});
    // Set a callback to run when the Google Visualization API is loaded.

    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" }
        ]);
        var options = {
            title: "Número de CAP Reportados por Mes",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
            legend: { position: 'top'}
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica'));
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
            title: "Número de CAP por Comportamiento",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica2'));
        chart.draw(view, options);
    }

    google.charts.load('current', {'packages':['table']});
    google.charts.setOnLoadCallback(drawTable1);

    function drawTable1() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos3;?>
        ]);

        var table = new google.visualization.Table(document.getElementById('tabla2'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
    }

    google.charts.setOnLoadCallback(drawTable);

    function drawTable() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos4;?>
        ]);

        var table = new google.visualization.Table(document.getElementById('tabla1'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
    }

</script>

<section class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-center">Reporte Anual para Todas las Plantas (CAP)</h3>
    </div>
</section>
<hr>
<section class="container">
    <table class="table">
        <tbody>
        <tr>
            <td colspan="2">
                <div id="grafica">

                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div id="grafica2">

                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="col-md-8 col-md-offset-2">
                    <h5 style="font-size: 18px; color: black">Tabla de Personal Felicitado Durante el Año</h5>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <div id="tabla1">

                    </div>
                </div>
            </td>
            <td>
                <div class="col-md-8 col-md-offset-2">
                    <h5 style="font-size: 18px; color: black">Tabla de Personal Reportante Durante el Año</h5>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <div id="tabla2">

                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</section>
