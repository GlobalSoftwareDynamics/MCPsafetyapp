<?php
include('session.php');
require('funcionesgraficasmes.php');

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
$datos4=NumCAPPersonalesReportanteMes($_POST['dni'],"$mes1",$link);
$datos5=NumCAPPersonalesReportanteMes($_POST['dni'],"$mes2",$link);
$datos=NumCAPPersonalesReportanteMes($_POST['dni'],$_POST['mes'],$link);
$datos=explode(",",$datos);
$datos5=explode(",",$datos5);
$datos=$datos4.",".$datos5[2].",".$datos5[3].",".$datos[2].",".$datos[3];

$datos6=NumCAPPersonalesFelicitadoMes($_POST['dni'],"$mes1",$link);
$datos7=NumCAPPersonalesFelicitadoMes($_POST['dni'],"$mes2",$link);
$datos1=NumCAPPersonalesFelicitadoMes($_POST['dni'],$_POST['mes'],$link);
$datos1=explode(",",$datos1);
$datos7=explode(",",$datos7);
$datos1=$datos6.",".$datos7[2].",".$datos7[3].",".$datos1[2].",".$datos1[3];
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
            title: "Número de CAP Reportados",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
            legend: { position: 'top'}
        };
        // Instantiate and draw our chart, passing in some options.
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
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" }
        ]);
        var options = {
            title: "Número de Felicitaciones (CAP) recibidos",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
            legend: { position: 'top'}
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica1'));
        chart.draw(view, options);
    }
</script>

<section class="container">
    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-center">Reporte Mensual Personal (CAP)</h3>
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

