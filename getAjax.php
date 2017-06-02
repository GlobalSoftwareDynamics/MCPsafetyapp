<?php
$link = mysqli_connect("gsdynamicscom.ipagemysql.com", "gsdsafeatwork", "6DQ~kTpyHPn+Zs$^", "seapp");
mysqli_query($link,"SET NAMES 'utf8'");
/*require('funciones.php');
require('funcionesApp.php')*/

if(!empty($_POST["regsafetyeyes1planta"])) {
    echo "<option>Seleccionar</option>";
    $planta =mysqli_query($link,"SELECT * FROM ubicacion WHERE idPlanta = '" . $_POST["regsafetyeyes1planta"] . "' AND estado='1'");
    while($result2=mysqli_fetch_array($planta)){
        echo "<option value=".$result2['idUbicacion'].">".$result2['descripcion']."</option>";
    }
}

if(!empty($_POST["regsafetyeyes2empresa"])) {
    echo "<option>Seleccionar</option>";
    $persona =mysqli_query($link,"SELECT * FROM colaboradores WHERE ruc = '" . $_POST["regsafetyeyes2empresa"] . "'  AND estado='1'");
    while($result2=mysqli_fetch_array($persona)){
        echo "<option value=".$result2['dni'].">".$result2['dni']."-".$result2['nombre']." ".$result2['apellidos']."</option>";
    }
}

if(!empty($_POST["registrosSEcolumna"])) {
    if ($_POST["registrosSEcolumna"]==="fecha"){
        echo "
            <script type='text/javascript'>
                $(function() {
                     $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' }).val()
                });
            </script>
            <input type='text' class='col-sm-12 form-control' placeholder='dd/mm/yyyy' id='datepicker' name='busqueda'>
        ";
    }
    if ($_POST["registrosSEcolumna"]==="anoFiscal"){
        echo "
            <input type='text' class='col-sm-12 form-control' placeholder='FYxx' id='detalle' name='busqueda'>
        ";
    }
    if ($_POST["registrosSEcolumna"]==="idSafetyEyes"){
        echo "
            <input type='text' class='col-sm-12 form-control' id='detalle' name='busqueda'>
        ";
    }
    if ($_POST["registrosSEcolumna"]==="lider"){
        echo "
            <input type='text' class='col-sm-12 form-control' id='detalle' name='busqueda' placeholder='Apellido'>
        ";
    }
    if ($_POST["registrosSEcolumna"]==="planta"){
        echo "
            <select name='busqueda' id='detalle' class='col-sm-12 form-control' >
                <option>Seleccionar</option> 
        ";
        $planta =mysqli_query($link,"SELECT * FROM planta WHERE estado='1'");
        while($result2=mysqli_fetch_array($planta)){
            echo "
                <option value=".$result2['idPlanta'].">".$result2['descripcion']."</option>
            ";
        }
        echo "
            </select>
        ";
    }
    if ($_POST["registrosSEcolumna"]==="idUbicacion"){
        echo "
            <input type='text' class='col-sm-12 form-control' id='detalle' name='busqueda' placeholder='Ubicación'>
        ";
    }
}

if(!empty($_POST["registrosobservSEcolumna"])) {
    if ($_POST["registrosobservSEcolumna"]==="idObservacionesSE"||$_POST["registrosobservSEcolumna"]==="idSafetyEyes"){
        echo "
            <input type='text' class='col-sm-12 form-control' id='detalle' name='busqueda'>
        ";
    }
    if ($_POST["registrosobservSEcolumna"]==="idCategoria"){
        echo "
            <select name='busqueda' id='detalle' class='col-sm-12 form-control' >
                <option>Seleccionar</option> 
        ";
        $planta =mysqli_query($link,"SELECT * FROM categoria");
        while($result2=mysqli_fetch_array($planta)){
            echo "
                <option value=".$result2['idCategoria'].">".$result2['siglas']."-".$result2['descripcion']."</option>
            ";
        }
        echo "
            </select>
        ";
    }
    if ($_POST["registrosobservSEcolumna"]==="idClase"){
        echo "
            <select name='busqueda' id='detalle' class='col-sm-12 form-control' >
                <option>Seleccionar</option> 
        ";
        $planta =mysqli_query($link,"SELECT * FROM clase WHERE categoria='SE'");
        while($result2=mysqli_fetch_array($planta)){
            echo "
                <option value=".$result2['idClase'].">".$result2['siglas']."-".$result2['descripcion']."</option>
            ";
        }
        echo "
            </select>
        ";
    }
    if ($_POST["registrosobservSEcolumna"]==="descripcion"){
        echo "
            <input type='text' class='col-sm-12 form-control' id='detalle' name='busqueda' placeholder='Descripción o Fragmento'>
        ";
    }
    if ($_POST["registrosobservSEcolumna"]==="idCOPs"){
        echo "
            <select name='busqueda' id='detalle' class='col-sm-12 form-control' >
                <option>Seleccionar</option> 
        ";
        $planta =mysqli_query($link,"SELECT * FROM cops");
        while($result2=mysqli_fetch_array($planta)){
            echo "
                <option value=".$result2['idCOPs'].">".$result2['descripcion']."</option>
            ";
        }
        echo "
            </select>
        ";
    }

}

if(!empty($_POST["registrosACcolumna"])) {
    if ($_POST["registrosACcolumna"]==="fecharegistro"){
        echo "
            <script type='text/javascript'>
                $(function() {
                     $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' }).val()
                });
            </script>
            <input type='text' class='col-sm-12 form-control' placeholder='dd/mm/yyyy' id='datepicker' name='busqueda'>
        ";
    }
    if ($_POST["registrosACcolumna"]==="fuente"){
        echo "
            <select id='detalle' name='busqueda' class='col-sm-12 form-control' >
                <option>Seleccionar</option>
                <option value='SE'>Safety Eyes</option>
                <option value='OC'>Reporte de Ocurrencia</option>
                <option value='INC'>Incidente</option>
            </select>
        ";
    }
    if ($_POST["registrosACcolumna"]==="dni"){
        echo "
            <input type='text' class='col-sm-12 form-control' id='detalle' name='busqueda' placeholder='Apellido'>
        ";
    }
    if ($_POST["registrosACcolumna"]==="descripcion"){
        echo "
            <input type='text' class='col-sm-12 form-control' id='detalle' name='busqueda' placeholder='Descripción o Fragmento'>
        ";
    }
    if ($_POST["registrosACcolumna"]==="estado"){
        echo "
            <select id='detalle' name='busqueda' class='col-sm-12 form-control' >
                <option>Seleccionar</option>
                <option>En Proceso</option>
                <option>Completa</option>
                <option>Vencida</option>
            </select>
        ";
    }
}

if(!empty($_POST["registrosAIcolumna"])) {
    if ($_POST["registrosAIcolumna"]==="fecharegistro"){
        echo "
            <script type='text/javascript'>
                $(function() {
                     $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' }).val()
                });
            </script>
            <input type='text' class='col-sm-12 form-control' placeholder='dd/mm/yyyy' id='datepicker' name='busqueda'>
        ";
    }
    if ($_POST["registrosAIcolumna"]==="fuente"){
        echo "
            <select id='detalle' name='busqueda' class='col-sm-12 form-control' >
                <option>Seleccionar</option>
                <option value='SE'>Safety Eyes</option>
                <option value='OC'>Reporte de Ocurrencia</option>
                <option value='INC'>Incidente</option>
            </select>
        ";
    }
    if ($_POST["registrosAIcolumna"]==="dni"){
        echo "
            <input type='text' class='col-sm-12 form-control' id='detalle' name='busqueda' placeholder='Apellido'>
        ";
    }
    if ($_POST["registrosAIcolumna"]==="descripcion"){
        echo "
            <input type='text' class='col-sm-12 form-control' id='detalle' name='busqueda' placeholder='Descripción o Fragmento'>
        ";
    }
}

if(!empty($_POST["registrosMScolumna"])) {
    if ($_POST["registrosMScolumna"]==="fecharegistro"){
        echo "
            <script type='text/javascript'>
                $(function() {
                     $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' }).val()
                });
            </script>
            <input type='text' class='col-sm-12 form-control' placeholder='dd/mm/yyyy' id='datepicker' name='busqueda'>
        ";
    }
    if ($_POST["registrosMScolumna"]==="fuente"){
        echo "
            <select id='detalle' name='busqueda' class='col-sm-12 form-control' >
                <option>Seleccionar</option>
                <option value='SE'>Safety Eyes</option>
                <option value='OC'>Reporte de Ocurrencia</option>
            </select>
        ";
    }
    if ($_POST["registrosMScolumna"]==="dni"){
        echo "
            <input type='text' class='col-sm-12 form-control' id='detalle' name='busqueda' placeholder='Apellido'>
        ";
    }
    if ($_POST["registrosMScolumna"]==="descripcion"){
        echo "
            <input type='text' class='col-sm-12 form-control' id='detalle' name='busqueda' placeholder='Descripción o Fragmento'>
        ";
    }
    if ($_POST["registrosMScolumna"]==="estado"){
        echo "
            <select id='detalle' name='busqueda' class='col-sm-12 form-control' >
                <option>Seleccionar</option>
                <option>Pendiente</option>
                <option>En Proceso</option>
                <option>Completa</option>
            </select>
        ";
    }
}

if(!empty($_POST["crearnuevaACtiporeporte"])) {
    if ($_POST['crearnuevaACtiporeporte']==="SE"){
        echo "
            <br>
            <input type='submit' class='btn btn-primary col-sm-6 col-sm-offset-3' name='provieneSE' value='Siguiente'>
        ";
    }
    if ($_POST['crearnuevaACtiporeporte']==="OC"){
        echo "
            <br>
            <input type='submit' class='btn btn-primary col-sm-6 col-sm-offset-3' name='provieneOC' value='Siguiente'>
        ";
    }
}

if(!empty($_POST["crearnuevaACsafetyeyes"])) {
    echo "<option>Seleccionar</option>";
    $result=mysqli_query($link,"SELECT * FROM safetyeyes WHERE fecha='".$_POST['crearnuevaACsafetyeyes']."' AND estado='Aprobado'");
    while ($fila=mysqli_fetch_array($result)){
        echo "
            <option value='".$fila['idSafetyEyes']."'>".$fila['idSafetyEyes']."</option>
        ";
    }
}

if(!empty($_POST["crearnuevaACobservaciones"])) {
    echo "<option>Seleccionar</option>";
    $result=mysqli_query($link,"SELECT * FROM observacionesse WHERE idSafetyEyes='".$_POST['crearnuevaACobservaciones']."'");
    while ($fila=mysqli_fetch_array($result)){
        echo "
            <option value='".$fila['idObservacionesSE']."'>".$fila['idObservacionesSE']."</option>
        ";
    }
}

if(!empty($_POST["crearnuevaACdescobservaciones"])) {
    $result=mysqli_query($link,"SELECT * FROM observacionesse WHERE idObservacionesSE='".$_POST['crearnuevaACdescobservaciones']."'");
    while ($fila=mysqli_fetch_array($result)){
        echo "
            <div class='col-sm-12'>
                <div class='col-sm-12 descripcionobs'>
                    <p style='font-size: 15px'>" .$fila['descripcion']."</p>
                </div>
            </div>
        ";
    }
}

if(!empty($_POST["crearnuevaACcolaboradores"])) {
    echo "<option>Seleccionar</option>";
    $result=mysqli_query($link,"SELECT * FROM colaboradores WHERE idPuesto='".$_POST['crearnuevaACcolaboradores']."' AND estado='1'");
    while ($fila=mysqli_fetch_array($result)){
        echo "
            <option value='".$fila['dni']."'>".$fila['nombre']." ".$fila['apellidos']."</option>
        ";
    }
}

if(!empty($_POST["crearnuevaMStiporeporte"])&&!empty($_POST["crearnuevaMSfechatiporeporte"])) {
    if ($_POST['crearnuevaMStiporeporte']==="SE") {
        echo "<option>Seleccionar</option>";
        $result=mysqli_query($link,"SELECT * FROM safetyeyes WHERE fecha ='".$_POST['crearnuevaMSfechatiporeporte']."'");
        while ($fila=mysqli_fetch_array($result)){
            echo "
                <option value='".$fila['idSafetyEyes']."'>".$fila['idSafetyEyes']."</option>
            ";
        }
    }
    if ($_POST['crearnuevaMStiporeporte']==="OC"){
        echo "<option>Seleccionar</option>";
        $result=mysqli_query($link,"SELECT * FROM ocurrencias WHERE fecha ='".$_POST['crearnuevaMSfechatiporeporte']."'");
        while ($fila=mysqli_fetch_array($result)){
            echo "
                <option value='".$fila['idOcurrencias']."'>".$fila['idOcurrencias']."</option>
            ";
        }
    }else{}
}
?>