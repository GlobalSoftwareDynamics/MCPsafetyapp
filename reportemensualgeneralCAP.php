<?php
include('session.php');
require('funcionesgraficasmes.php');
$datos1=NumTotalComportamientoCAPMes($_POST['mes'],$link);
switch ($_POST['mes']) {
    case "A":
        $mes1="K";
        $mes2="L";
        break;
    case "B":
        $mes1="L";
        $mes2="A";
        break;
    case "C":
        $mes1="A";
        $mes2="B";
        break;
    case "D":
        $mes1="B";
        $mes2="C";
        break;
    case "E":
        $mes1="C";
        $mes2="D";
        break;
    case "F":
        $mes1="D";
        $mes2="E";
        break;
    case "G":
        $mes1="E";
        $mes2="F";
        break;
    case "H":
        $mes1="F";
        $mes2="G";
        break;
    case "I":
        $mes1="G";
        $mes2="H";
        break;
    case "J":
        $mes1="H";
        $mes2="I";
        break;
    case "K":
        $mes1="I";
        $mes2="J";
        break;
    case "L":
        $mes1="J";
        $mes2="K";
        break;
}
$datos7=NumTotalCAPMes($mes1,$link);
$datos8=NumTotalCAPMes($mes2,$link);
$datos2=NumTotalCAPMes($_POST['mes'],$link);
$datos2=explode(",",$datos2);
$datos8=explode(",",$datos8);
$datos2=$datos7.",".$datos8[2].",".$datos8[3].",".$datos2[2].",".$datos2[3];
$datos3=NumTotalReportanteCAPMes($_POST['mes'],$link);
$datos4=NumTotalFelicitadoCAPMes($_POST['mes'],$link);
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
            title: "Número de CAPs por Comportamiento",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('grafica2'));
        chart.draw(view, options);
    }

    google.charts.setOnLoadCallback(drawChart2);
    function drawChart2() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos2;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" }
        ]);
        var options = {
            title: "Número de CAP Registrados",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
            legend: { position: 'top'}
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica5'));
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

<section class="container">
    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-center">Reporte Mensual General de Todas las Plantas (CAP)</h3>
    </div>
</section>
<hr>
<section class="container">
    <table class="table">
        <tbody>
        <tr>
            <td colspan="2">
                <div id="grafica5">

                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="col-sm-7 col-md-offset-3">
                    <div id="grafica2">

                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="col-md-8 col-md-offset-2">
                    <h5 style="font-size: 18px; color: black">Tabla de Personal Felicitado Durante el Mes</h5>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <div id="tabla1">

                    </div>
                </div>
            </td>
            <td>
                <div class="col-md-8 col-md-offset-2">
                    <h5 style="font-size: 18px; color: black">Tabla de Personal Reportante Durante el Mes</h5>
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
