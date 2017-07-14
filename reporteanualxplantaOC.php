<?php
include('session.php');
require('funcionesgraficasyear.php');
$año=explode('0',$_POST['anio']);
$datos=NumOcurrenciasAnioxPlanta($_POST['anio'],$_POST['planta'],$link);
$datos1=NumClaseOCxAnioxPlanta($_POST['anio'],$_POST['planta'],$link);
$labels1=multilabelconid('Clase','categoria','OC',$link);
$datos2=NumAccionesCorrectivasOCxAnioxPlanta($_POST['anio'],$_POST['planta'],$link);
$labels2=multilabel('EstadoACMS',$link);
$datos3=NumTotalUbicacionOCAño($_POST['anio'],$_POST['planta'],$link);
$result=mysqli_query($link, "SELECT * FROM Planta WHERE idPlanta ='".$_POST['planta']."'");
while ($fila=mysqli_fetch_array($result)){
    $planta=$fila['descripcion'];
}
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
            title: "Número de Ocurrencias Reportadas por Mes",
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
        view.setColumns(<?php echo $labels1;?>);
        var options = {
            title: "Número de Ocurrencias por Clase",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300
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
        view.setColumns(<?php echo $labels2;?>);
        var options = {
            title: "Estado de las Acciones Correctivas",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica4'));
        chart.draw(view, options);
    }

    google.charts.setOnLoadCallback(drawChart4);
    function drawChart4() {
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
            title: "Número de Ocurrencias Reportadas por Ubicación en el Año",
            titleTextStyle: {fontSize: 18, bold: true},
            width: '100%',
            height: 300,
            legend: { position: 'top'}
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica2'));
        chart.draw(view, options);
    }
</script>

<section class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-center">Reporte Anual por Planta <?php echo $planta;?> (SE)</h3>
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
                <div id="grafica2">

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
<section class="container">
    <div class="col-md-12">
        <h4 class="text-center">Mejoras de Seguridad Provenientes de OC en el Año</h4>
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
            $result1=mysqli_query($link,"SELECT * FROM MEOCUR WHERE idMejoras ='".$fila0['idMejoras']."' AND idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE estado ='Aprobado' AND idOcurrencias LIKE 'OC".$año[1]."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta='".$_POST['planta']."'))");
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
        <h4 class="text-center">Acciones Correctivas Provenientes de OC en el Año</h4>
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
            $result1=mysqli_query($link,"SELECT * FROM ACOCUR WHERE idAccionesCorrectivas ='".$fila0['idAccionesCorrectivas']."' AND idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE estado ='Aprobado' AND idOcurrencias LIKE 'OC".$año[1]."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta='".$_POST['planta']."'))");
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
                <div id="grafica4">

                </div>
            </td>
        </tr>
        </tbody>
    </table>
</section>