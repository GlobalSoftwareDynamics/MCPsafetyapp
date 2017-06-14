<?php
include('session.php');
require('funcionesgraficasmes.php');
$datos0=NumTotalCOPMes($_POST['mes'],$link);
$datos=NumPersObsyPersRetTotalMes($_POST['mes'],$link);
$datos1=NumTotalClaseMes($_POST['mes'],$link);
$datos2=NumTotalCategoriaMes($_POST['mes'],$link);
$datos3=NumAccionesCorrectivasxEstadoMes($_POST['mes'],$link);
$datos4=NumTotalSafetyEyesMes($_POST['mes'],$link);
$datos5=NumTotalLiderMes($_POST['mes'],$link);
$datos6=NumTotalPlantaMes($_POST['mes'],$link);
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

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('grafica'));
        chart.draw(data, {width: 400, height: 240});
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
            width: '100%',
            height: 300
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('grafica3'));
        chart.draw(view, options);
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
            width: '100%',
            height: 300
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('grafica4'));
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
            width: '100%',
            height: 300,
            legend: { position: 'top'}
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica5'));
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
            width: '100%',
            height: 300,
            legend: { position: 'top'}
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica6'));
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
            width: '100%',
            height: 300,
            legend: { position: 'top'}
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica7'));
        chart.draw(view, options);
    }
    google.charts.setOnLoadCallback(drawChart7);
    function drawChart7() {
        var data = google.visualization.arrayToDataTable([
            <?php echo $datos0;?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" }
        ]);
        var options = {
            width: '100%',
            height: 300,
            legend: { position: 'top'}
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica0'));
        chart.draw(view, options);
    }
</script>

<section class="container">
    <div class="col-sm-8">
        <div class="col-sm-12">
            <img width="auto" height="100" src="image/Logo.png"/>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="col-sm-12">
            <h3 class="titulo text-center">Reporte Mensual General</h3>
        </div>
        <div class="col-sm-12">
            <h4 class="desctitulo text-center">Observaciones Safety Eyes</h4>
        </div>
    </div>
</section>
<hr>
<section class="container">
    <div class="col-sm-6 col-sm-offset-3">
        <h3 class="text-center">Todas las Plantas</h3>
    </div>
</section>
<br>
<section class="container">
    <div class="col-sm-5">
        <div class="col-sm-12">
            <h4 class="text-center">Número de Safety Eyes Registrados</h4>
        </div>
        <div class="col-sm-12">
            <div id="grafica5">

            </div>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="col-sm-12">
            <h4 class="text-center">Número de Safety Eyes Registrados por Planta</h4>
        </div>
        <div class="col-sm-12">
            <div id="grafica7">

            </div>
        </div>
    </div>
</section>
<section class="container">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="col-sm-12">
            <h4 class="text-center">Número de Safety Eyes Registrados por Persona</h4>
        </div>
        <div class="col-sm-12">
            <div id="grafica6">

            </div>
        </div>
    </div>
</section>
<section class="container">
    <div class="col-sm-6">
        <div class="col-sm-12">
            <h4 class="text-center">Número de Observaciones por Clase </h4>
        </div>
        <div class="col-sm-12">
            <div id="grafica2">

            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="col-sm-12">
            <h4 class="text-center">Número de Observaciones por Categoría</h4>
        </div>
        <div class="col-sm-12">
            <div id="grafica3">

            </div>
        </div>
    </div>
</section>
<section class="container">
    <div class="col-sm-12">
        <div class="col-sm-12">
            <h4 class="text-center">Número de Observaciones por COP </h4>
        </div>
        <div class="col-sm-12">
            <div id="grafica0">

            </div>
        </div>
    </div>
</section>
<section class="container">
    <div class="col-sm-12">
        <h4 class="text-center">Mejoras de Seguridad Provenientes de SE en el Mes</h4>
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
        $result0=mysqli_query($link,"SELECT * FROM MejorasSeguridad WHERE fuente = 'SE'");
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
                $result3=mysqli_query($link,"SELECT * FROM Colaboradores WHERE dni='".$fila0['dni']."'");
                while ($fila3=mysqli_fetch_array($result3)){
                    echo "
                     <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                ";
                }
                $result2=mysqli_query($link,"SELECT * FROM EstadoACMS WHERE idEstado='".$fila0['idEstado']."'");
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
        <h4 class="text-center">Acciones Correctivas Provenientes de SE en el Mes</h4>
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
        $result0=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE fuente = 'SE'");
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
                $result2=mysqli_query($link,"SELECT * FROM EstadoACMS WHERE idEstado='".$fila0['idEstado']."'");
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
    <div class="container">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="col-sm-10 col-sm-offset-1">
                <h4 class="text-center">Estado de las Acciones Correctivas</h4>
            </div>
            <div class="col-sm-10 col-sm-offset-1">
                <div id="grafica4">

                </div>
            </div>
        </div>
    </div>
</section>