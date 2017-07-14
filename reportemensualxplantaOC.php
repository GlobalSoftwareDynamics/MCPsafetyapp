<?php
include('session.php');
require('funcionesgraficasmes.php');
$datos1=NumTotalClaseOCPlantaUnicaMes($_POST['mes'],$_POST['planta'],$link);
$datos2=NumAccionesCorrectivasxEstadoOCPlantaMes($_POST['mes'],$_POST['planta'],$link);
$datos3=NumTotalUbicacionOCMes($_POST['mes'],$_POST['planta'],$link);
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
$datos7=NumTotalOcurrenciasPlantaUnicaMes($mes1,$_POST['planta'],$link);
$datos8=NumTotalOcurrenciasPlantaUnicaMes($mes2,$_POST['planta'],$link);
$datos4=NumTotalOcurrenciasPlantaUnicaMes($_POST['mes'],$_POST['planta'],$link);
$datos4=explode(",",$datos4);
$datos8=explode(",",$datos8);
$datos4=$datos7.",".$datos8[2].",".$datos8[3].",".$datos4[2].",".$datos4[3];
$datos5=NumTotalReportanteOCPlantaUnicaMes($_POST['mes'],$_POST['planta'],$link);
$datos6=NumTotalReportadoOCPlantaUnicaMes($_POST['mes'],$_POST['planta'],$link);
$datos7=NumOcurrenciasHorarioMesxPlanta($_POST['mes'],$_POST['planta'],$link);
$result=mysqli_query($link,"SELECT * FROM Planta WHERE idPlanta='".$_POST['planta']."'");
while ($fila=mysqli_fetch_array($result)){
    $planta=$fila['descripcion'];
}
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
        var options = {
            title: "Número de Ocurrencias por Clase",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('grafica2'));
        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawChart2);
    function drawChart2() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos2;?>
        ]);
        var options = {
            title: "Estado de las Acciones Correctivas",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('grafica4'));
        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawChart3);
    function drawChart3() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos3;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" }
        ]);
        var options = {
            title: "Número de Ocurrencias por Ubicación",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
            legend: 'none'
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica5'));
        chart.draw(view, options);
    }

    google.charts.setOnLoadCallback(drawChart4);
    function drawChart4() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos4;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" }
        ]);
        var options = {
            title: "Número de Ocurrencias Registradas",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
            legend: 'none'
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica6'));
        chart.draw(view, options);
    }

    google.charts.setOnLoadCallback(drawChart5);
    function drawChart5() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos5;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" }
        ]);
        var options = {
            title: "Número de Ocurrencias Reportadas por Persona",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
            legend: 'none'
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica7'));
        chart.draw(view, options);

        google.charts.setOnLoadCallback(drawChart6);
        function drawChart6() {
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
                title: "Número de Ocurrencias por Horario",
                titleTextStyle: {fontSize: 18, bold: true},
                width: '100%',
                height: 400,
                legend: 'none'
            };
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.ColumnChart(document.getElementById('grafica8'));
            chart.draw(view, options);
        }
    }

</script>


<section class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-center">Reporte Mensual para Planta <?php echo $planta?> (OC)</h3>
    </div>
</section>
<hr>
<section class="container">
    <table class="table">
        <tbody>
        <tr>
            <td>
                <div id="grafica6">

                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div id="grafica8">

                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div id="grafica7">

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
                    <div id="grafica2">

                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</section>
<section class="container">
    <div class="col-md-12">
        <h4 class="text-center">Mejoras de Seguridad Provenientes de OC en el Mes</h4>
    </div>
    <br>
    <table class="table table-bordered text-center">
        <thead>
        <tr>
            <th>Fecha de Registro</th>
            <th>Fuente</th>
            <th style="width: 40%">Descripción</th>
            <th>Proponente</th>
            <th>Estado</th>
        </tr>
        </thead>
        <tbody>
        <?php
        echo "
            <tr>
        ";
        $result0=mysqli_query($link,"SELECT * FROM MejorasSeguridad WHERE fuente = 'OC'");
        while ($fila0=mysqli_fetch_array($result0)){
            $result1=mysqli_query($link,"SELECT * FROM MEOCUR WHERE idMejoras ='".$fila0['idMejoras']."' AND idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE estado ='Aprobado' AND idOcurrencias LIKE 'OC___%".$_POST['mes']."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta='".$_POST['planta']."'))");
            while ($fila1=mysqli_fetch_array($result1)){
                echo "
                            <td>".$fila0['fecharegistro']."</td>
                            <td>".$fila1['idOcurrencias']."</td>
                    ";
                echo "
                            <td class='text-left'>".$fila0['descripcion']."</td>
                        ";
                $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila0['dni']."'");
                while ($fila3=mysqli_fetch_array($result3)){
                    echo "
                     <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                ";
                }
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
    <div class="col-md-12">
        <h4 class="text-center">Acciones Correctivas Provenientes de OC en el Mes</h4>
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
        $result0=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE fuente = 'OC'");
        while ($fila0=mysqli_fetch_array($result0)){
            $result1=mysqli_query($link,"SELECT * FROM ACOCUR WHERE idAccionesCorrectivas ='".$fila0['idAccionesCorrectivas']."' AND idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE estado ='Aprobado' AND idOcurrencias LIKE 'OC___%".$_POST['mes']."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta='".$_POST['planta']."'))");
            while ($fila1=mysqli_fetch_array($result1)){
                echo "
                            <td>".$fila0['fecharegistro']."</td>
                ";
                $result=mysqli_query($link, "SELECT * FROM Ocurrencias WHERE idOcurrencias ='".$fila1['idOcurrencias']."'");
                while ($fila=mysqli_fetch_array($result)){
                    echo "
                        <td>".$fila['idOcurrencias']."</td>
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
                <div class="col-sm-7 col-md-offset-3">
                    <div id="grafica4">

                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</section>