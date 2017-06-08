<?php
$link = mysqli_connect("gsdynamicscom.ipagemysql.com", "gsdsafeatwork", "6DQ~kTpyHPn+Zs$^", "seapp");
require('funcionesgraficasmes.php');
mysqli_query($link,"SET NAMES 'utf8'");

$datos=NumPersObsyPersRetTotalPlantaUnicaMes($_POST['mes'],$_POST['planta']);
$datos1=NumTotalClasePlantaUnicaMes($_POST['mes'],$_POST['planta']);
$datos2=NumTotalCategoriaPlantaUnicaMes($_POST['mes'],$_POST['planta']);
$datos3=NumAccionesCorrectivasxEstadoPlantaMes($_POST['mes'],$_POST['planta']);
$datos4=NumTotalUbicacionMes($_POST['mes'],$_POST['planta']);
$datos5=NumTotalPlantaUnicaMes($_POST['mes'],$_POST['planta']);
$datos6=NumTotalLiderPlantaUnicaMes($_POST['mes'],$_POST['planta']);
$result=mysqli_query($link,"SELECT * FROM Planta WHERE idPlanta='".$_POST['planta']."'");
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

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('grafica'));
            chart.draw(data, {width: 400, height: 240});
        }

        google.charts.setOnLoadCallback(drawChart1);
        function drawChart1() {
            var data = google.visualization.arrayToDataTable([
                <?php echo $datos1;?>
            ]);
            var options = {
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
                width: '100%',
                height: 300
            };
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('grafica3'));
            chart.draw(data, options);
        }

        google.charts.setOnLoadCallback(drawChart3);
        function drawChart3() {
            var data = google.visualization.arrayToDataTable([
                <?php echo $datos3;?>
            ]);
            var options = {
                width: '100%',
                height: 300
            };
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('grafica4'));
            chart.draw(data, options);
        }

        google.charts.setOnLoadCallback(drawChart4);
        function drawChart4() {
            var data = google.visualization.arrayToDataTable([
                <?php echo $datos4;?>
            ]);
            var options = {
                width: '100%',
                height: 300,
                legend: 'none'
            };
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.ColumnChart(document.getElementById('grafica5'));
            chart.draw(data, options);
        }

        google.charts.setOnLoadCallback(drawChart5);
        function drawChart5() {
            var data = google.visualization.arrayToDataTable([
                <?php echo $datos5;?>
            ]);
            var options = {
                width: '100%',
                height: 300,
                legend: 'none'
            };
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.ColumnChart(document.getElementById('grafica6'));
            chart.draw(data, options);
        }

        google.charts.setOnLoadCallback(drawChart6);
        function drawChart6() {
            var data = google.visualization.arrayToDataTable([
                <?php echo $datos6;?>
            ]);
            var options = {
                width: '100%',
                height: 300,
                legend: 'none'
            };
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.ColumnChart(document.getElementById('grafica7'));
            chart.draw(data, options);
        }
    </script>

<section class="container-fluid">
    <div class="col-sm-8">
        <div class="col-sm-12">
            <img width="auto" height="100" src="image/Logo.png"/>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="col-sm-12">
            <h3 class="titulo text-center">Reporte Mensual por Planta</h3>
        </div>
        <div class="col-sm-12">
            <h4 class="desctitulo text-center">Observaciones Safety Eyes</h4>
        </div>
    </div>
</section>
<hr>
<section class="container-fluid">
    <div class="col-sm-6 col-sm-offset-3">
        <h3 class="text-center">Planta <?php echo $planta?></h3>
    </div>
</section>
<br>
<section class="container-fluid">
    <div class="col-sm-5">
        <div class="col-sm-12">
            <h4 class="text-center">Número de Safety Eyes Registrados</h4>
        </div>
        <div class="col-sm-12">
            <div id="grafica6">

            </div>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="col-sm-12">
            <h4 class="text-center">Número de Safety Eyes Registrados por Persona</h4>
        </div>
        <div class="col-sm-12">
            <div id="grafica7">

            </div>
        </div>
    </div>
</section>
<section class="container-fluid">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="col-sm-12">
            <h4 class="text-center">Número de Safety Eyes por Ubicación</h4>
        </div>
        <div class="col-sm-12">
            <div id="grafica5">

            </div>
        </div>
    </div>
</section>
<section class="container-fluid">
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
            $result1=mysqli_query($link,"SELECT * FROM MESE WHERE idMejoras ='".$fila0['idMejoras']."' AND idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE estado ='Aprobado' AND idSafetyEyes LIKE 'SE%".$_POST['mes']."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta='".$_POST['planta']."'))");
            while ($fila1=mysqli_fetch_array($result1)){
                echo "
                            <td>".$fila0['fecharegistro']."</td>
                            <td>".$fila1['idSafetyEyes']."</td>
                    ";
                echo "
                            <td class='text-left'>".$fila0['descripcion']."</td>
                        ";
                $result3=mysqli_query($link,"SELECT * FROM colaboradores WHERE dni='".$fila0['dni']."'");
                while ($fila3=mysqli_fetch_array($result3)){
                    echo "
                     <td>".$fila3['nombre']." ".$fila3['apellidos']."</td>
                ";
                }
                echo "
                <td>".$fila0['estado']."</td>
            ";
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
            $result1=mysqli_query($link,"SELECT * FROM ACSE WHERE idAccionesCorrectivas ='".$fila0['idAccionesCorrectivas']."' AND idObservacionesSE IN (SELECT idObservacionesSE FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE estado ='Aprobado' AND idSafetyEyes LIKE 'SE%".$_POST['mes']."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta='".$_POST['planta']."')))");
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
                <td>".$fila0['estado']."</td>
            ";
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