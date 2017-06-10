<?php
session_start();
$link = mysqli_connect("gsdynamicscom.ipagemysql.com", "gsdsafeatwork", "6DQ~kTpyHPn+Zs$^", "seapp");
mysqli_query($link,"SET NAMES 'utf8'");
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
            <select name='busqueda' id='detalle' class='col-sm-12 form-control' >
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
            <input type='text' class='col-sm-12 form-control' id='detalle' name='busqueda' placeholder='Descripción o Fragmento'>
        ";
	}
	if ($_POST["registrosobservSEcolumna"]==="idCOPs"){
		echo "
            <select name='busqueda' id='detalle' class='col-sm-12 form-control' >
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
            <option value='".$fila['idObservacionesSE']."'>".$fila['idObservacionesSE']."</option>
        ";
	}
}

if(!empty($_POST["crearnuevaACdescobservaciones"])) {
	$result=mysqli_query($link,"SELECT * FROM ObservacionesSE WHERE idObservacionesSE='".$_POST['crearnuevaACdescobservaciones']."'");
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
                <option value='".$fila['idSafetyEyes']."'>".$fila['idSafetyEyes']."</option>
            ";
		}
	}
	if ($_POST['crearnuevaMStiporeporte']==="OC"){
		echo "<option>Seleccionar</option>";
		$result=mysqli_query($link,"SELECT * FROM Ocurrencias WHERE fecha ='".$_POST['crearnuevaMSfechatiporeporte']."'");
		while ($fila=mysqli_fetch_array($result)){
			echo "
                <option value='".$fila['idOcurrencias']."'>".$fila['idOcurrencias']."</option>
            ";
		}
	}else{}
}
if(!empty($_POST["generaciondereportesTipo"])) {
    if($_POST["generaciondereportesTipo"]==="rmensplant"){
        echo "
            <div class='form-group'>
                <div class='col-sm-12'>
                   <label for='plant' class='col-sm-12'>Seleccione la Planta:</label> 
                </div>
                <div class='col-sm-12'>
                   <select id='plant' class='form-control col-sm-12' name='planta'>
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
            <div class='form-group'>
                <div class='col-sm-12'>
                    <label class='col-sm-12' for='mens'>Seleccione el Mes:</label>
                </div>
                <div class='col-sm-12'>
                    <select name='mes' class='form-control col-sm-12' id='mens'>
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
            <div class='form-group'>
                <div class='col-sm-12'>
                    <label class='col-sm-12' for='mens'>Seleccione el Mes:</label>
                </div>
                <div class='col-sm-12'>
                    <select name='mes' class='form-control col-sm-12' id='mens'>
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
            <div class='form-group'>
                <div class='col-sm-12'>
                   <label for='plant' class='col-sm-12'>Seleccione la Planta:</label> 
                </div>
                <div class='col-sm-12'>
                   <select id='plant' class='form-control col-sm-12' name='planta'>
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
            <div class='form-group'>
                <div class='col-sm-12'>
                    <label class='col-sm-12' for='anio'>Especifique el Año:</label>
                </div>
                <div class='col-sm-12'>
                    <input type='text' name='anio' class='form-control col-sm-12' id='anio' placeholder='XX'>          
                </div>
            </div>
        ";
    }
    if($_POST["generaciondereportesTipo"]==="ran"){
        echo "
            <div class='form-group'>
                <div class='col-sm-12'>
                    <label class='col-sm-12' for='anio'>Especifique el Año:</label>
                </div>
                <div class='col-sm-12'>
                    <input type='text' name='anio' class='form-control col-sm-12' id='anio' placeholder='XXXX'>          
                </div>
            </div>
        ";
    }
    if($_POST["generaciondereportesTipo"]==="rendpersmen"){
        echo "
            <div class='form-group'>
                <div class='col-sm-12'>
                   <label for='idcol' class='col-sm-12'>Especifique los Apellidos:</label> 
                </div>
                <div class='col-sm-12'>
                   <input type='text' id='idcol' class='form-control col-sm-12' name='dni' placeholder='Apellidos'>
                </div>
            </div>
            <div class='form-group'>
                <div class='col-sm-12'>
                    <label class='col-sm-12' for='mens'>Seleccione el Mes:</label>
                </div>
                <div class='col-sm-12'>
                    <select name='mes' class='form-control col-sm-12' id='mens'>
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
            <div class='form-group'>
                <div class='col-sm-12'>
                   <label for='idcol' class='col-sm-12'>Especifique los Apellidos:</label> 
                </div>
                <div class='col-sm-12'>
                   <input type='text' id='idcol' class='form-control col-sm-12' name='dni' placeholder='Apellidos'>
                </div>
            </div>
            <div class='form-group'>
                <div class='col-sm-12'>
                    <label class='col-sm-12' for='anio'>Especifique el Año:</label>
                </div>
                <div class='col-sm-12'>
                    <input type='text' name='anio' class='form-control col-sm-12' id='anio' placeholder='XXXX'>          
                </div>
            </div>
        ";
    }
}
?>
