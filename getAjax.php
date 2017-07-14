<?php
include('session.php');
//if(isset($_SESSION['login'])) {
if (!empty($_POST["gestionUsuarios_usuario"])) {
    echo "<input type='text' class='form-control' name='Usuario' id='Usuario' value='" . $_POST['gestionUsuarios_usuario'] . "' readonly></td>";
    $dniselect = $_POST['gestionUsuarios_usuario'];
}

if (!empty($_POST["gestionUsuarios_password"])) {
    echo "<td><input type='text' class='form-control' name='Contraseña' id='Contraseña' value='" . rand(1111111, 9999999) . "' readonly></td>";
}

if (!empty($_POST["gestionUsuarios_tipoUsuario"])) {
    $query = mysqli_query($link, "SELECT * FROM Colaboradores WHERE dni =" . $_POST['gestionUsuarios_tipoUsuario']);
    while ($row = mysqli_fetch_array($query)) {
        $query2 = mysqli_query($link, "SELECT * FROM Puesto WHERE idPuesto = '" . $row['idPuesto'] . "'");
        while ($row2 = mysqli_fetch_array($query2)) {
            $query3 = mysqli_query($link, "SELECT * FROM TipoUsuario WHERE idTipoUsuario = '" . $row2['idTipoUsuario'] . "'");
            while ($row3 = mysqli_fetch_array($query3)) {
                echo "<option selected='selected' value='" . $row3['idTipoUsuario'] . "'>" . $row3['descripcion'] . "</option>";
                $default = $row3['idTipoUsuario'];
            }
        }
    }
    mysqli_data_seek($query, 0);
    $query = mysqli_query($link, "SELECT * FROM TipoUsuario ORDER BY descripcion");
    while ($row = mysqli_fetch_array($query)) {
        if ($row['idTipoUsuario'] == $default) {
        } else {
            echo "<option value='" . $row['idTipoUsuario'] . "'>" . $row['descripcion'] . "</option>";
        }
    }
}

if (!empty($_POST['infoEmpresas_pais'])) {
    echo "<option>Seleccionar</option>";
    $query = mysqli_query($link, "SELECT * FROM Ciudad WHERE idPais = '" . $_POST['infoEmpresas_pais'] . "'");
    while ($row = mysqli_fetch_array($query)) {
        echo "<option value='" . $row['idCiudad'] . "'>" . $row['nombre'] . "</option>";
    }
}

if(!empty($_POST["regsafetyeyes1planta"])) {
    echo "<option>Seleccionar</option>";
    $planta =mysqli_query($link,"SELECT * FROM Ubicacion WHERE idPlanta = '" . $_POST["regsafetyeyes1planta"] . "' AND estado='1'");
    while($result2=mysqli_fetch_array($planta)){
        echo "<option value=".$result2['idUbicacion'].">".$result2['descripcion']."</option>";
    }
}

if(!empty($_POST["regsafetyeyes2empresa"])) {
    echo "<option>Seleccionar</option>";
    $persona =mysqli_query($link,"SELECT * FROM Colaboradores WHERE ruc = '" . $_POST["regsafetyeyes2empresa"] . "'  AND estado='1'");
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
            <input type='text' class='col-md-12 form-control' placeholder='dd/mm/yyyy' id='datepicker' name='busqueda'>
        ";
    }
    if ($_POST["registrosSEcolumna"]==="anoFiscal"){
        echo "
            <input type='text' class='col-md-12 form-control' placeholder='FYxx' id='detalle' name='busqueda'>
        ";
    }
    if ($_POST["registrosSEcolumna"]==="idSafetyEyes"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda'>
        ";
    }
    if ($_POST["registrosSEcolumna"]==="lider"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Apellido'>
        ";
    }
    if ($_POST["registrosSEcolumna"]==="planta"){
        echo "
            <select name='busqueda' id='detalle' class='col-md-12 form-control' >
                <option>Seleccionar</option> 
        ";
        $planta =mysqli_query($link,"SELECT * FROM Planta WHERE estado='1'");
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
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Ubicación'>
        ";
    }
}

if(!empty($_POST["registrosobservSEcolumna"])) {
    if ($_POST["registrosobservSEcolumna"]==="idObservacionesSE"||$_POST["registrosobservSEcolumna"]==="idSafetyEyes"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda'>
        ";
    }
    if ($_POST["registrosobservSEcolumna"]==="idCategoria"){
        echo "
            <select name='busqueda' id='detalle' class='col-md-12 form-control' >
                <option>Seleccionar</option> 
        ";
        $planta =mysqli_query($link,"SELECT * FROM Categoria");
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
            <select name='busqueda' id='detalle' class='col-md-12 form-control' >
                <option>Seleccionar</option> 
        ";
        $planta =mysqli_query($link,"SELECT * FROM Clase WHERE categoria='SE'");
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
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Descripción o Fragmento'>
        ";
    }
    if ($_POST["registrosobservSEcolumna"]==="idCOPs"){
        echo "
            <select name='busqueda' id='detalle' class='col-md-12 form-control' >
                <option>Seleccionar</option> 
        ";
        $planta =mysqli_query($link,"SELECT * FROM COPs");
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
            <input type='text' class='col-md-12 form-control' placeholder='dd/mm/yyyy' id='datepicker' name='busqueda'>
        ";
    }
    if ($_POST["registrosACcolumna"]==="fuente"){
        echo "
            <select id='detalle' name='busqueda' class='col-md-12 form-control' >
                <option>Seleccionar</option>
                <option value='SE'>Safety Eyes</option>
                <option value='OC'>Reporte de Ocurrencia</option>
                <option value='INC'>Incidente</option>
            </select>
        ";
    }
    if ($_POST["registrosACcolumna"]==="dni"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Apellido'>
        ";
    }
    if ($_POST["registrosACcolumna"]==="descripcion"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Descripción o Fragmento'>
        ";
    }
    if ($_POST["registrosACcolumna"]==="estado"){
        echo "
            <select id='detalle' name='busqueda' class='col-md-12 form-control' >
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
            <input type='text' class='col-md-12 form-control' placeholder='dd/mm/yyyy' id='datepicker' name='busqueda'>
        ";
    }
    if ($_POST["registrosAIcolumna"]==="fuente"){
        echo "
            <select id='detalle' name='busqueda' class='col-md-12 form-control' >
                <option>Seleccionar</option>
                <option value='SE'>Safety Eyes</option>
                <option value='OC'>Reporte de Ocurrencia</option>
                <option value='INC'>Incidente</option>
            </select>
        ";
    }
    if ($_POST["registrosAIcolumna"]==="dni"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Apellido'>
        ";
    }
    if ($_POST["registrosAIcolumna"]==="descripcion"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Descripción o Fragmento'>
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
            <input type='text' class='col-md-12 form-control' placeholder='dd/mm/yyyy' id='datepicker' name='busqueda'>
        ";
    }
    if ($_POST["registrosMScolumna"]==="fuente"){
        echo "
            <select id='detalle' name='busqueda' class='col-md-12 form-control' >
                <option>Seleccionar</option>
                <option value='SE'>Safety Eyes</option>
                <option value='OC'>Reporte de Ocurrencia</option>
            </select>
        ";
    }
    if ($_POST["registrosMScolumna"]==="dni"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Apellido'>
        ";
    }
    if ($_POST["registrosMScolumna"]==="descripcion"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Descripción o Fragmento'>
        ";
    }
    if ($_POST["registrosMScolumna"]==="estado"){
        echo "
            <select id='detalle' name='busqueda' class='col-md-12 form-control' >
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
            <input type='submit' class='btn btn-primary col-xs-12 col-md-6 col-md-offset-3' name='provieneSE' value='Siguiente'>
        ";
    }
    if ($_POST['crearnuevaACtiporeporte']==="OC"){
        echo "
            <br>
            <input type='submit' class='btn btn-primary col-xs-12 col-md-6 col-md-offset-3' name='provieneOC' value='Siguiente'>
        ";
    }
}

if(!empty($_POST["crearnuevaACsafetyeyes"])) {
    echo "<option>Seleccionar</option>";
    $result=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE fecha='".$_POST['crearnuevaACsafetyeyes']."' AND estado='Aprobado'");
    while ($fila=mysqli_fetch_array($result)){
        echo "
            <option value='".$fila['idSafetyEyes']."'>".$fila['idSafetyEyes']."</option>
        ";
    }
}

if(!empty($_POST["crearnuevaACobservaciones"])) {
    echo "<option>Seleccionar</option>";
    $result=mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE idSafetyEyes='".$_POST['crearnuevaACobservaciones']."'");
    while ($fila=mysqli_fetch_array($result)){
        echo "
            <option value='{$fila['idObservacionesSE']}'>".$fila['idObservacionesSE']."-".substr($fila['descripcion'],0,20)."...</option>
        ";
    }
}

if(!empty($_POST["crearnuevaACdescobservaciones"])) {
    $result=mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE idObservacionesSE='".$_POST['crearnuevaACdescobservaciones']."'");
    while ($fila=mysqli_fetch_array($result)){
        echo "
            <div class='col-md-12'>
                <div class='col-md-12 descripcionobs'>
                    <p style='font-size: 15px'>" .$fila['descripcion']."</p>
                </div>
            </div>
        ";
    }
}

if(!empty($_POST["crearnuevaACcolaboradores"])) {
    echo "<option>Seleccionar</option>";
    $result=mysqli_query($link,"SELECT * FROM Colaboradores WHERE idPuesto='".$_POST['crearnuevaACcolaboradores']."' AND estado='1'");
    while ($fila=mysqli_fetch_array($result)){
        echo "
            <option value='".$fila['dni']."'>".$fila['nombre']." ".$fila['apellidos']."</option>
        ";
    }
}

if(!empty($_POST["crearnuevaMStiporeporte"])&&!empty($_POST["crearnuevaMSfechatiporeporte"])) {
    if ($_POST['crearnuevaMStiporeporte']==="SE") {
        echo "<option>Seleccionar</option>";
        $result=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE fecha ='".$_POST['crearnuevaMSfechatiporeporte']."'");
        while ($fila=mysqli_fetch_array($result)){
            echo "
                <option value='".$fila['idSafetyEyes']."'>".$fila['idSafetyEyes']."-".substr($fila['actividadObservada'],0,45)."...</option>
            ";
        }
    }
    if ($_POST['crearnuevaMStiporeporte']==="OC"){
        echo "<option>Seleccionar</option>";
        $result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE fecha ='".$_POST['crearnuevaMSfechatiporeporte']."'");
        while ($fila=mysqli_fetch_array($result)){
            echo "
                <option value='".$fila['idOcurrencias']."'>".$fila['idOcurrencias']."-".substr($fila['descripcion'],0,45)."...</option>
            ";
        }
    }else{}
}
if(!empty($_POST["generaciondereportesTipo"])) {
    if($_POST["generaciondereportesTipo"]==="rmensplant"){
        echo "
            <div class='form-group col-xs-12 col-md-12'>
                <div class='col-md-12'>
                   <label for='plant'>Seleccione la Planta:</label> 
                </div>
                <div class='col-md-12'>
                   <select id='plant' class='form-control col-xs-12 col-md-12' name='planta'>
                        <option>Seleccionar</option>";
        $result=mysqli_query($link, "SELECT * FROM Planta WHERE estado='1'");
        while ($fila=mysqli_fetch_array($result)){
            echo "
                <option value='".$fila['idPlanta']."'>".$fila['descripcion']."</option>
            ";
        }
        echo "
                    </select>
                </div>
            </div>
            <div class='form-group col-xs-12 col-md-12'>
                <div class='col-md-12'>
                    <label for='mens'>Seleccione el Mes:</label>
                </div>
                <div class='col-md-12'>
                    <select name='mes' class='form-control col-xs-12 col-md-12' id='mens'>
                        <option value='A'>Enero</option>
                        <option value='B'>Febrero</option>
                        <option value='C'>Marzo</option>
                        <option value='D'>Abril</option>
                        <option value='E'>Mayo</option>
                        <option value='F'>Junio</option>
                        <option value='G'>Julio</option>
                        <option value='H'>Agosto</option>
                        <option value='I'>Septiembre</option>
                        <option value='J'>Octubre</option>
                        <option value='K'>Noviembre</option>
                        <option value='L'>Diciembre</option>
                    </select>           
                </div>
            </div>
        ";
    }
    if($_POST["generaciondereportesTipo"]==="rmens"){
        echo "
            <div class='form-group col-xs-12 col-md-12'>
                <div class='col-md-12'>
                    <label for='mens'>Seleccione el Mes:</label>
                </div>
                <div class='col-md-12'>
                    <select name='mes' class='form-control col-xs-12 col-md-12' id='mens'>
                        <option value='A'>Enero</option>
                        <option value='B'>Febrero</option>
                        <option value='C'>Marzo</option>
                        <option value='D'>Abril</option>
                        <option value='E'>Mayo</option>
                        <option value='F'>Junio</option>
                        <option value='G'>Julio</option>
                        <option value='H'>Agosto</option>
                        <option value='I'>Septiembre</option>
                        <option value='J'>Octubre</option>
                        <option value='K'>Noviembre</option>
                        <option value='L'>Diciembre</option>
                    </select>           
                </div>
            </div>
        ";
    }
    if($_POST["generaciondereportesTipo"]==="ranplant"){
        echo "
            <div class='form-group col-xs-12 col-md-12'>
                <div class='col-md-12'>
                   <label for='plant'>Seleccione la Planta:</label> 
                </div>
                <div class='col-md-12'>
                   <select id='plant' class='form-control col-xs-12 col-md-12' name='planta'>
                        <option>Seleccionar</option>";
        $result=mysqli_query($link, "SELECT * FROM Planta WHERE estado='1'");
        while ($fila=mysqli_fetch_array($result)){
            echo "
                <option value='".$fila['idPlanta']."'>".$fila['descripcion']."</option>
            ";
        }
        echo "
                    </select>
                </div>
            </div>
            <div class='form-group col-xs-12 col-md-12'>
                <div class='col-md-12'>
                    <label for='anio'>Especifique el Año:</label>
                </div>
                <div class='col-md-12'>
                    <input type='text' name='anio' class='form-control col-xs-12 col-md-12' id='anio' placeholder='XX'>          
                </div>
            </div>
        ";
    }
    if($_POST["generaciondereportesTipo"]==="ran"){
        echo "
            <div class='form-group col-xs-12 col-md-12'>
                <div class='col-md-12'>
                    <label for='anio'>Especifique el Año:</label>
                </div>
                <div class='col-md-12'>
                    <input type='text' name='anio' class='form-control col-xs-12 col-md-12' id='anio' placeholder='XX'>          
                </div>
            </div>
        ";
    }
    if($_POST["generaciondereportesTipo"]==="rendpersmen"){
        echo "
            <div class='form-group col-xs-12 col-md-12'>
                <div class='col-md-12'>
                   <label for='idcol'>Especifique los Apellidos:</label> 
                </div>
                <div class='col-md-12'>
                   <input type='text' id='idcol' class='form-control col-xs-12 col-md-12' name='dni' placeholder='Apellidos' oninput='getnombrecompleto(this.value)'>
                </div>
            </div>
            <div id='selecnombrecomp'></div>
            <div class='form-group col-xs-12 col-md-12'>
                <div class='col-md-12'>
                    <label for='mens'>Seleccione el Mes:</label>
                </div>
                <div class='col-md-12'>
                    <select name='mes' class='form-control col-xs-12 col-md-12' id='mens'>
                        <option value='A'>Enero</option>
                        <option value='B'>Febrero</option>
                        <option value='C'>Marzo</option>
                        <option value='D'>Abril</option>
                        <option value='E'>Mayo</option>
                        <option value='F'>Junio</option>
                        <option value='G'>Julio</option>
                        <option value='H'>Agosto</option>
                        <option value='I'>Septiembre</option>
                        <option value='J'>Octubre</option>
                        <option value='K'>Noviembre</option>
                        <option value='L'>Diciembre</option>
                    </select>           
                </div>
            </div>
        ";
    }
    if($_POST["generaciondereportesTipo"]==="rendpersan"){
        echo "
            <div class='form-group col-xs-12 col-md-12'>
                <div class='col-md-12'>
                   <label for='idcol'>Especifique los Apellidos:</label> 
                </div>
                <div class='col-md-12'>
                   <input type='text' id='idcol' class='form-control col-xs-12 col-md-12' name='dni' placeholder='Apellidos' oninput='getnombrecompleto(this.value)'>
                </div>
            </div>
            <div id='selecnombrecomp'></div>
            <div class='form-group col-xs-12 col-md-12'>
                <div class='col-md-12'>
                    <label for='anio'>Especifique el Año:</label>
                </div>
                <div class='col-md-12'>
                    <input type='text' name='anio' class='form-control col-xs-12 col-md-12' id='anio' placeholder='XX'>          
                </div>
            </div>
        ";
    }
}
if(!empty($_POST["generaciondereportesNombreCompleto"])){
    echo "
        <div class='form-group col-xs-12 col-md-12'>
            <div class='col-md-12'>
                <label for='nombrecomp'>Seleccione Nombre Completo:</label> 
            </div>
            <div class='col-md-12'>
                <select name='dni' class='form-control col-xs-12 col-md-12' id='nombrecomp'>
                    <option>Seleccionar</option>
    ";
    $result=mysqli_query($link,"SELECT * FROM Colaboradores WHERE apellidos LIKE '%".$_POST["generaciondereportesNombreCompleto"]."%'");
    while ($fila=mysqli_fetch_array($result)){
        echo "
            <option value='".$fila['dni']."'>".$fila['nombre']." ".$fila['apellidos']."</option>
        ";
    }
    echo "
                </select>
            </div>
        </div>
    ";
}
if(!empty($_POST["registrosCAPcolumna"])) {
    if ($_POST["registrosCAPcolumna"]==="fecha"){
        echo "
            <script type='text/javascript'>
                $(function() {
                     $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' }).val()
                });
            </script>
            <input type='text' class='col-md-12 form-control' placeholder='dd/mm/yyyy' id='datepicker' name='busqueda'>
        ";
    }
    if ($_POST["registrosCAPcolumna"]==="anoFiscal"){
        echo "
            <input type='text' class='col-md-12 form-control' placeholder='FYxx' id='detalle' name='busqueda'>
        ";
    }
    if ($_POST["registrosCAPcolumna"]==="idCAP"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda'>
        ";
    }
    if ($_POST["registrosCAPcolumna"]==="reportante"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Apellido'>
        ";
    }
    if ($_POST["registrosCAPcolumna"]==="felicitado"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Apellido'>
        ";
    }
    if ($_POST["registrosCAPcolumna"]==="idComportamiento"){
        echo "
            <select name='busqueda' id='detalle' class='col-md-12 form-control' >
                <option>Seleccionar</option> 
        ";
        $planta =mysqli_query($link,"SELECT * FROM Comportamiento");
        while($result2=mysqli_fetch_array($planta)){
            echo "
                <option value=".$result2['idComportamiento'].">".$result2['descripcion']."</option>
            ";
        }
        echo "
            </select>
        ";
    }
}
if(!empty($_POST["registrosOCURcolumna"])) {
    if ($_POST["registrosOCURcolumna"]==="fecha"){
        echo "
            <script type='text/javascript'>
                $(function() {
                     $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' }).val()
                });
            </script>
            <input type='text' class='col-md-12 form-control' placeholder='dd/mm/yyyy' id='datepicker' name='busqueda'>
        ";
    }
    if ($_POST["registrosOCURcolumna"]==="anoFiscal"){
        echo "
            <input type='text' class='col-md-12 form-control' placeholder='FYxx' id='detalle' name='busqueda'>
        ";
    }
    if ($_POST["registrosOCURcolumna"]==="idOcurrencias"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda'>
        ";
    }
    if ($_POST["registrosOCURcolumna"]==="reportante"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Apellido'>
        ";
    }
    if ($_POST["registrosOCURcolumna"]==="planta"){
        echo "
            <select name='busqueda' id='detalle' class='col-md-12 form-control' >
                <option>Seleccionar</option> 
        ";
        $planta =mysqli_query($link,"SELECT * FROM Planta WHERE estado='1'");
        while($result2=mysqli_fetch_array($planta)){
            echo "
                <option value=".$result2['idPlanta'].">".$result2['descripcion']."</option>
            ";
        }
        echo "
            </select>
        ";
    }
    if ($_POST["registrosOCURcolumna"]==="idUbicacion"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Ubicación'>
        ";
    }
    if ($_POST["registrosOCURcolumna"]==="descripcion"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Fragmento de la descripción'>
        ";
    }
    if ($_POST["registrosOCURcolumna"]==="idClase"){
        echo "
            <select name='busqueda' id='detalle' class='col-md-12 form-control' >
                <option>Seleccionar</option> 
        ";
        $planta =mysqli_query($link,"SELECT * FROM Clase WHERE categoria='OC'");
        while($result2=mysqli_fetch_array($planta)){
            echo "
                <option value=".$result2['idClase'].">".$result2['descripcion']."</option>
            ";
        }
        echo "
            </select>
        ";
    }
}
if(!empty($_POST["crearnuevaACocurrencia"])) {
    echo "<option>Seleccionar</option>";
    $result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE fecha='".$_POST['crearnuevaACocurrencia']."' AND estado='Aprobado'");
    while ($fila=mysqli_fetch_array($result)){
        echo "
            <option value='".$fila['idOcurrencias']."'>".$fila['idOcurrencias']."-".substr($fila['descripcion'],0,20)."...</option>
        ";
    }
}
if(!empty($_POST["crearnuevaACdescripcion"])) {
    $result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE idOcurrencias='".$_POST['crearnuevaACdescripcion']."'");
    while ($fila=mysqli_fetch_array($result)){
        echo "
            <div class='col-md-12'>
                <div class='col-md-12 descripcionobs'>
                    <p style='font-size: 15px'>" .$fila['descripcion']."</p>
                </div>
            </div>
        ";
    }
}
if(!empty($_POST["crearnuevaMSdescripcion"])&&!empty($_POST["crearnuevaMStiporeporte"])) {
    if($_POST["crearnuevaMStiporeporte"]==="SE"){
        $result=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idSafetyEyes='".$_POST['crearnuevaMSdescripcion']."'");
        while ($fila=mysqli_fetch_array($result)){
            echo "
            <div class='col-md-12'>
                <div class='col-md-12 descripcionobs'>
                    <p style='font-size: 15px'>" .$fila['actividadObservada']."</p>
                </div>
            </div>
        ";
        }
    }
    if($_POST["crearnuevaMStiporeporte"]==="OC"){
        $result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE idOcurrencias='".$_POST['crearnuevaMSdescripcion']."'");
        while ($fila=mysqli_fetch_array($result)){
            echo "
            <div class='col-md-12'>
                <div class='col-md-12 descripcionobs'>
                    <p style='font-size: 15px'>" .$fila['descripcion']."</p>
                </div>
            </div>
        ";
        }
    }
}
if (!empty($_POST['generaciondereportesReportes'])){
    if ($_POST['generaciondereportesReportes']==="CAP"){
        echo "
            <option>Seleccionar</option>
            <option value='rmens'>Reporte Mensual General (Todas las Plantas)</option>
            <option value='ran'>Reporte Anual General (Todas las Plantas)</option>
            <option value='rendpersmen'>Reporte de Rendimiento Personal Mensual</option>
            <option value='rendpersan'>Reporte de Rendimiento Personal Anual</option>
        ";
    }elseif($_POST['generaciondereportesReportes']==="INC"){
        echo "
            <option>Seleccionar</option>
            <option value='rmensplant'>Reporte Mensual por Planta</option>
            <option value='rmens'>Reporte Mensual General (Todas las Plantas)</option>
            <option value='ranplant'>Reporte Anual por Planta</option>
            <option value='ran'>Reporte Anual General (Todas las Plantas)</option>
        ";
    }
    else{
        echo "
            <option>Seleccionar</option>
            <option value='rmensplant'>Reporte Mensual por Planta</option>
            <option value='rmens'>Reporte Mensual General (Todas las Plantas)</option>
            <option value='ranplant'>Reporte Anual por Planta</option>
            <option value='ran'>Reporte Anual General (Todas las Plantas)</option>
            <option value='rendpersmen'>Reporte de Rendimiento Personal Mensual</option>
            <option value='rendpersan'>Reporte de Rendimiento Personal Anual</option>
        ";
    }
}
if (!empty($_POST['regocurrrencialesiones'])){
    if($_POST['regocurrrencialesiones']==="8"){
        echo "
        <div class='col-xs-12 col-md-12'>
            <label for='lesi'>Tipo de Lesión:</label>
        </div>
        <div class='col-xs-12 col-md-12'>
            <select id='lesi' name='lesion' class='form-control col-xs-12 col-md-12'>
                 <option>Seleccionar</option>";
        $result1=mysqli_query($link,"SELECT * FROM TipoLesion");
        while ($fila1=mysqli_fetch_array($result1)){
            echo "
            <option value=".$fila1['idTipoLesion'].">".$fila1['descripcion']."</option>
        ";
        }
        echo "
            </select>
        </div>
    ";
    }else{}
}
if(!empty($_POST["regINC_SeguimientoidAC"])) {
    $result=mysqli_query($link,"SELECT * FROM AccionesCorrectivas WHERE idAccionesCorrectivas='".$_POST['regINC_SeguimientoidAC']."'");
    while ($fila=mysqli_fetch_array($result)){
        echo "
            <div class='col-md-12'>
                <div class='col-md-12 descripcionobs'>
                    <p style='font-size: 15px'>" .$fila['descripcion']."</p>
                </div>
            </div>
        ";
    }
}
if(!empty($_POST["registrosINCcolumna"])) {
    if ($_POST["registrosINCcolumna"]==="fecha"){
        echo "
            <script type='text/javascript'>
                $(function() {
                     $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' }).val()
                });
            </script>
            <input type='text' class='col-md-12 form-control' placeholder='dd/mm/yyyy' id='datepicker' name='busqueda'>
        ";
    }
    if ($_POST["registrosINCcolumna"]==="anoFiscal"){
        echo "
            <input type='text' class='col-md-12 form-control' placeholder='FYxx' id='detalle' name='busqueda'>
        ";
    }
    if ($_POST["registrosINCcolumna"]==="idIncidentes"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda'>
        ";
    }
    if ($_POST["registrosINCcolumna"]==="planta"){
        echo "
            <select name='busqueda' id='detalle' class='col-md-12 form-control' >
                <option>Seleccionar</option> 
        ";
        $planta =mysqli_query($link,"SELECT * FROM Planta WHERE estado='1'");
        while($result2=mysqli_fetch_array($planta)){
            echo "
                <option value=".$result2['idPlanta'].">".$result2['descripcion']."</option>
            ";
        }
        echo "
            </select>
        ";
    }
    if ($_POST["registrosINCcolumna"]==="idUbicacion"){
        echo "
            <input type='text' class='col-md-12 form-control' id='detalle' name='busqueda' placeholder='Ubicación'>
        ";
    }
    if ($_POST["registrosINCcolumna"]==="estado"){
        echo "
            <select name='busqueda' id='detalle' class='col-md-12 form-control' >
                <option>Seleccionar</option> 
                <option value='Reporte Preliminar'>Reporte Preliminar</option>
                <option value='Lesiones'>Lesiones</option>
                <option value='Investigación'>Investigación</option>
                <option value='Acciones Correctivas'>Acciones Correctivas</option>
                <option value='Seguimiento'>Seguimiento</option>
                <option value='Cerrado'>Cierre</option>
            </select>
        ";
    }
    if ($_POST["registrosINCcolumna"]==="consactual"||$_POST["registrosINCcolumna"]==="conspotencial"){
        echo "
            <select name='busqueda' id='detalle' class='col-md-12 form-control' >
                <option>Seleccionar</option> 
        ";
        $planta =mysqli_query($link,"SELECT * FROM Consecuencia ORDER BY idConsecuencia DESC");
        while($result2=mysqli_fetch_array($planta)){
            echo "
                <option value=".$result2['idConsecuencia'].">".$result2['siglas']."</option>
            ";
        }
        echo "
            </select>
        ";
    }
    if ($_POST["registrosINCcolumna"]==="idTipoLesion"){
        echo "
            <select name='busqueda' id='detalle' class='col-md-12 form-control' >
                <option>Seleccionar</option> 
        ";
        $planta =mysqli_query($link,"SELECT * FROM TipoLesion ORDER BY idTipoLesion DESC");
        while($result2=mysqli_fetch_array($planta)){
            if($result2['siglas']==="SD"){

            }else{
                echo "
                    <option value=".$result2['idTipoLesion'].">".$result2['siglas']."</option>
                ";
            }
        }
        echo "
            </select>
        ";
    }
}
?>
