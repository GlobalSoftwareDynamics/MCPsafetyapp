<?php
include('session.php');

$año=explode('0',$_POST['anio']);
$datos=NumSafetyEyesAnioxPlanta($_POST['anio'],$_POST['planta'],$link);
$datos1=NumClasexAnioxPlanta($_POST['anio'],$_POST['planta'],$link);
$labels1=multilabelconid('Clase','categoria','SE',$link);
$datos2=NumCategoriaxAnioxPlanta($_POST['anio'],$_POST['planta'],$link);
$labels2=multilabel('Categoria',$link);
$datos3=NumCOPxAnioxPlanta($_POST['anio'],$_POST['planta'],$link);
$labels3=multilabel('COPs',$link);
$datos4=NumAccionesCorrectivasxAnioxPlanta($_POST['anio'],$_POST['planta'],$link);
$labels4=multilabel('EstadoACMS',$link);

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
            width: '100%',
            height: 300,
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
            width: '100%',
            height: 300
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica2'));
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
            width: '100%',
            height: 400,
            legend: { position: 'top', axLines: 3 },
            bar: { groupWidth: '75%' },
            isStacked: true
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
            width: '100%',
            height: 300
        };
// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('grafica4'));
        chart.draw(view, options);
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
            <h3 class="titulo text-center">Reporte Anual por Planta</h3>
        </div>
        <div class="col-sm-12">
            <h4 class="desctitulo text-center">Observaciones Safety Eyes</h4>
        </div>
    </div>
</section>
<hr>
<section class="container-fluid">
    <div class="col-sm-6 col-sm-offset-3">
        <h3 class="text-center">Planta <?php echo $planta;?></h3>
    </div>
</section>
<br>
<section class="container-fluid">
    <div class="col-sm-12">
        <div class="col-sm-12">
            <h4 class="text-center">Número de Safety Eyes Registrados por Mes</h4>
        </div>
        <div class="col-sm-12">
            <div id="grafica">

            </div>
        </div>
    </div>
</section>
<section class="container">
    <div class="col-sm-12">
        <div class="col-sm-12">
            <h4 class="text-center">Número de Observaciones por Clase </h4>
        </div>
        <div class="col-sm-12">
            <div id="grafica1">

            </div>
        </div>
    </div>
</section>
<section class="container">
    <div class="col-sm-12">
        <div class="col-sm-12">
            <h4 class="text-center">Número de Observaciones por Categoría</h4>
        </div>
        <div class="col-sm-12">
            <div id="grafica2">

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
            <div id="grafica3">

            </div>
        </div>
    </div>
</section>
<section class="container">
    <div class="col-sm-12">
        <h4 class="text-center">Mejoras de Seguridad Provenientes de SE en el Año</h4>
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
            $result1=mysqli_query($link,"SELECT * FROM MESE WHERE idMejoras ='".$fila0['idMejoras']."' AND idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE estado ='Aprobado' AND idSafetyEyes LIKE 'SE".$año[1]."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta='".$_POST['planta']."'))");
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
        <h4 class="text-center">Acciones Correctivas Provenientes de SE en el Año</h4>
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
            $result1=mysqli_query($link,"SELECT * FROM ACSE WHERE idAccionesCorrectivas ='".$fila0['idAccionesCorrectivas']."' AND idObservacionesSE IN (SELECT idObservacionesSE FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE estado ='Aprobado' AND idSafetyEyes LIKE 'SE".$año[1]."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta='".$_POST['planta']."')))");
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
    <div class="container">
        <div class="col-sm-12">
            <div class="col-sm-12">
                <h4 class="text-center">Estado de las Acciones Correctivas</h4>
            </div>
            <div class="col-sm-12">
                <div id="grafica4">

                </div>
            </div>
        </div>
    </div>
</section>