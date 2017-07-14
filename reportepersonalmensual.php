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
$datos4=NumSafetyEyesPersonalesLiderMes($_POST['dni'],"$mes1",$link);
$datos5=NumSafetyEyesPersonalesLiderMes($_POST['dni'],"$mes2",$link);
$datos=NumSafetyEyesPersonalesLiderMes($_POST['dni'],$_POST['mes'],$link);
$datos=explode(",",$datos);
$datos5=explode(",",$datos5);
$datos=$datos4.",".$datos5[2].",".$datos5[3].",".$datos[2].",".$datos[3];

$datos6=NumSafetyEyesPersonalesParticipanteMes($_POST['dni'],"$mes1",$link);
$datos7=NumSafetyEyesPersonalesParticipanteMes($_POST['dni'],"$mes2",$link);
$datos1=NumSafetyEyesPersonalesParticipanteMes($_POST['dni'],$_POST['mes'],$link);
$datos1=explode(",",$datos1);
$datos7=explode(",",$datos7);
$datos1=$datos6.",".$datos7[2].",".$datos7[3].",".$datos1[2].",".$datos1[3];

$datos2=NumAccionesCorrectivasPersonalesMes($_POST['dni'],$_POST['mes'],$link);
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
            title: "Número de Safety Eyes Registrados como Líder",
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
            title: "Número de Safety Eyes en los que Participó",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
            legend: { position: 'top'}
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica1'));
        chart.draw(view, options);
    }
    google.charts.setOnLoadCallback(drawChart3);
    function drawChart3() {
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
            title: "Estado de las Acciones Correctivas bajo su Responsabilidad",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('grafica2'));
        chart.draw(view, options);
    }
</script>

    <section class="container">
        <div class="col-sm-6 col-sm-offset-3">
            <h3 class="text-center">Reporte Mensual Personal (SE)</h3>
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
            <tr>
                <td>
                    <div class="col-sm-9 col-sm-offset-2">
                        <div id="grafica2">

                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</section>
<section class="container">

</section>
    <section class="container">
        <div class="col-sm-12">
            <h4 class="text-center">Mejoras de Seguridad Propuestas</h4>
        </div>
        <br>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>Fecha de Registro</th>
                <th>Fuente</th>
                <th style="width: 40%">Descripción</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            <?php
            echo "
            <tr>
        ";
            $result0=mysqli_query($link,"SELECT * FROM MejorasSeguridad WHERE fuente = 'SE' AND dni ='".$_POST['dni']."'");
            while ($fila0=mysqli_fetch_array($result0)){
                $result1=mysqli_query($link,"SELECT * FROM MESE WHERE idMejoras ='".$fila0['idMejoras']."' AND idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE estado ='Aprobado' AND idSafetyEyes LIKE 'SE%".$_POST['mes']."%')");
                while ($fila1=mysqli_fetch_array($result1)){
                    echo "
                            <td>".$fila0['fecharegistro']."</td>
                            <td>".$fila1['idSafetyEyes']."</td>
                    ";
                    echo "
                            <td class='text-left'>".$fila0['descripcion']."</td>
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
    </section>
    <section class="container">
        <div class="col-sm-12">
            <h4 class="text-center">Responsabilidad en Acciones Correctivas</h4>
        </div>
        <br>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>Fecha de Registro</th>
                <th>Fuente</th>
                <th style="width: 40%">Descripción</th>
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
            $result0=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE fuente = 'SE' AND dni ='".$_POST['dni']."'");
            while ($fila0=mysqli_fetch_array($result0)){
                $result1=mysqli_query($link,"SELECT * FROM ACSE WHERE idAccionesCorrectivas ='".$fila0['idAccionesCorrectivas']."' AND idObservacionesSE IN (SELECT idObservacionesSE FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE estado ='Aprobado' AND idSafetyEyes LIKE 'SE%".$_POST['mes']."%'))");
                while ($fila1=mysqli_fetch_array($result1)){
                    echo "
                            <td>".$fila0['fecharegistro']."</td>
                ";
                    $result=mysqli_query($link, "SELECT * FROM ObservacionesSE WHERE idObservacionesSE ='".$fila1['idObservacionesSE']."'");
                    while ($fila=mysqli_fetch_array($result)){
                        echo "
                        <td>".$fila['idSafetyEyes']."</td>
                    ";
                    }
                    echo "
                            <td class='text-left'>".$fila0['descripcion']."</td>
                        ";
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
    </section>
