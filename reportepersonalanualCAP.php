<?php
include('session.php');
require('funcionesgraficasyear.php');

$año=explode('0',$_POST['anio']);
$datos=NumCAPxPersonaReportanteAño($_POST['dni'],$_POST['anio'],$link);
$datos1=NumCAPxPersonFelicitadoAño($_POST['dni'],$_POST['anio'],$link);
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
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }
        ]);
        var options = {
            title: "Número de CAP Reportados en el Año",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
            legend: {position: 'top'}
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica'));
        chart.draw(view, options);
    }
    google.charts.setOnLoadCallback(drawChart1);
    function drawChart1() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos1;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }
        ]);
        var options = {
            title: "Número de Felicitaciones (CAP) Recibidos en el Año",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
            legend: {position: 'top'}
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica1'));
        chart.draw(view, options);
    }

</script>
<section class="container">
    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-center">Reporte Anual Personal (CAP)</h3>
    </div>
</section>
<hr>
<section class="container">
    <table class="table">
        <tbody>
        <tr>
            <td>
                <div id="grafica">

                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div id="grafica1">

                </div>
            </td>
        </tr>
        </tbody>
    </table>
</section>
