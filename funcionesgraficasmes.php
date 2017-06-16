<?php


function NumPersObsyPersRetTotalMes($mes,$link){
    $numpersobs=0;
    $numpersret=0;
    $result=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado'");
    while ($fila=mysqli_fetch_array($result)){
        $persobs=$fila['nropersobservadas'];
        $persret=$fila['nropersretroalimentadas'];
        $numpersobs=$numpersobs+$persobs;
        $numpersret=$numpersret+$persret;
    }
    $fragmento="['TipoPersona', 'Cantidad'],['Pers.Observadas', ".$numpersobs."],['Pers.Retroalimentadas', ".$numpersret."]";
    return $fragmento;
}

function NumPersObsyPersRetTotalPlantaUnicaMes($mes,$planta,$link){
    $numpersobs=0;
    $numpersret=0;
    $result=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')");
    while ($fila=mysqli_fetch_array($result)){
        $persobs=$fila['nropersobservadas'];
        $persret=$fila['nropersretroalimentadas'];
        $numpersobs=$numpersobs+$persobs;
        $numpersret=$numpersret+$persret;
    }
    $fragmento="['TipoPersona', 'Cantidad'],['Pers.Observadas', ".$numpersobs."],['Pers.Retroalimentadas', ".$numpersret."]";
    return $fragmento;
}

function NumTotalClaseMes($mes,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idClase, COUNT(*) AS numero FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado') GROUP BY idClase");
    while ($fila=mysqli_fetch_array($result)){
        $result1=mysqli_query($link,"SELECT * FROM Clase WHERE idClase ='".$fila['idClase']."'");
        while ($fila1=mysqli_fetch_array($result1)){
            $fragmento=",['".$fila1['siglas']."', ".$fila['numero']."]";
            $fragmento1=$fragmento.$fragmento1;
        }
    }
    $fragmento1="['Clase de Observación','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalClasePlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idClase, COUNT(*) AS numero FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) GROUP BY idClase");
    while ($fila=mysqli_fetch_array($result)){
        $result1=mysqli_query($link,"SELECT * FROM Clase WHERE idClase ='".$fila['idClase']."'");
        while ($fila1=mysqli_fetch_array($result1)){
            $fragmento=",['".$fila1['siglas']."', ".$fila['numero']."]";
            $fragmento1=$fragmento.$fragmento1;
        }
    }
    $fragmento1="['Clase de Observación','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalCOPMes($mes,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idCOPs, COUNT(*) AS numero FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado') GROUP BY idCOPs");
    while ($fila=mysqli_fetch_array($result)){
        $result1=mysqli_query($link,"SELECT * FROM COPs WHERE idCOPs ='".$fila['idCOPs']."'");
        while ($fila1=mysqli_fetch_array($result1)){
            $fragmento=",['".$fila1['siglas']."', ".$fila['numero']."]";
            $fragmento1=$fragmento.$fragmento1;
        }
    }
    $fragmento1="['Clase de Observación','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalCOPPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idCOPs, COUNT(*) AS numero FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) GROUP BY idCOPs");
    while ($fila=mysqli_fetch_array($result)){
        $result1=mysqli_query($link,"SELECT * FROM COPs WHERE idCOPs ='".$fila['idCOPs']."'");
        while ($fila1=mysqli_fetch_array($result1)){
            $fragmento=",['".$fila1['siglas']."', ".$fila['numero']."]";
            $fragmento1=$fragmento.$fragmento1;
        }
    }
    $fragmento1="['Clase de Observación','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalCategoriaMes($mes,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idCategoria, COUNT(*) AS numero FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado') GROUP BY idCategoria");
    while ($fila = mysqli_fetch_array($result)) {
        $result1 = mysqli_query($link, "SELECT * FROM Categoria WHERE idCategoria ='" . $fila['idCategoria'] . "'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $fragmento = ",['" . $fila1['siglas'] . "', " . $fila['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Categoria de Observación','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalCategoriaPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idCategoria, COUNT(*) AS numero FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) GROUP BY idCategoria");
    while ($fila = mysqli_fetch_array($result)) {
        $result1 = mysqli_query($link, "SELECT * FROM Categoria WHERE idCategoria ='" . $fila['idCategoria'] . "'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $fragmento = ",['" . $fila1['siglas'] . "', " . $fila['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Categoria de Observación','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalUbicacionMes($mes, $planta,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idUbicacion, COUNT(*) AS numero FROM SafetyEyes WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) GROUP BY idUbicacion");
    while ($fila = mysqli_fetch_array($result)) {
        $result1 = mysqli_query($link, "SELECT * FROM Ubicacion WHERE idUbicacion ='" . $fila['idUbicacion'] . "' AND estado='1'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $fragmento = ",['" . $fila1['descripcion'] . "', " . $fila['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Ubicación','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalLiderMes($mes,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM ParticipantesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado') AND idTipoParticipante ='1' GROUP BY dni");
    while ($fila = mysqli_fetch_array($result)) {
        $result1 = mysqli_query($link, "SELECT * FROM Colaboradores WHERE dni ='" . $fila['dni'] . "' AND estado='1'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $fragmento = ",['" . $fila1['nombre'] . " ".$fila1['apellidos']."', " . $fila['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Persona','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalLiderPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM ParticipantesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) AND idTipoParticipante ='1' GROUP BY dni");
    while ($fila = mysqli_fetch_array($result)) {
        $result1 = mysqli_query($link, "SELECT * FROM Colaboradores WHERE dni ='" . $fila['dni'] . "' AND estado='1'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $fragmento = ",['" . $fila1['nombre'] . " ".$fila1['apellidos']."', " . $fila['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Persona','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalPlantaMes($mes,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT * FROM Planta WHERE estado = '1'");
    while ($fila=mysqli_fetch_array($result)){
        $numero=0;
        $result1 = mysqli_query($link, "SELECT idUbicacion, COUNT(*) AS numero FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$fila['idPlanta']."')");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $numero=$numero+$fila1['numero'];
        }
        $fragmento = ",['" . $fila['descripcion'] . "', " . $numero . "]";
        $fragmento1 = $fragmento . $fragmento1;
    }
    $fragmento1="['Planta','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $numero=0;
    switch ($mes) {
        case "A":
            $aux1 = "Enero";
            break;
        case "B":
            $aux1 = "Febrero";
            break;
        case "C":
            $aux1 = "Marzo";
            break;
        case "D":
            $aux1 = "Abril";
            break;
        case "E":
            $aux1 = "Mayo";
            break;
        case "F":
            $aux1 = "Junio";
            break;
        case "G":
            $aux1 = "Julio";
            break;
        case "H":
            $aux1 = "Agosto";
            break;
        case "I":
            $aux1 = "Septiembre";
            break;
        case "J":
            $aux1 = "Octubre";
            break;
        case "K":
            $aux1 = "Noviembre";
            break;
        case "L":
            $aux1 = "Diciembre";
            break;
    }
    $result1 = mysqli_query($link, "SELECT idUbicacion, COUNT(*) AS numero FROM SafetyEyes WHERE idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta = '".$planta."') AND idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado'");
    while ($fila1 = mysqli_fetch_array($result1)) {
        $numero=$numero+$fila1['numero'];
        $result2=mysqli_query($link,"SELECT * FROM Planta WHERE idPlanta ='".$planta."' AND estado = '1'");
        while ($fila2=mysqli_fetch_array($result2)){
            $fragmento = ",['".$aux1."', ".$numero."]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Mes','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalSafetyEyesMes($mes,$link){
    $fragmento1="";
    switch ($mes) {
        case "A":
            $aux1 = "Enero";
            break;
        case "B":
            $aux1 = "Febrero";
            break;
        case "C":
            $aux1 = "Marzo";
            break;
        case "D":
            $aux1 = "Abril";
            break;
        case "E":
            $aux1 = "Mayo";
            break;
        case "F":
            $aux1 = "Junio";
            break;
        case "G":
            $aux1 = "Julio";
            break;
        case "H":
            $aux1 = "Agosto";
            break;
        case "I":
            $aux1 = "Septiembre";
            break;
        case "J":
            $aux1 = "Octubre";
            break;
        case "K":
            $aux1 = "Noviembre";
            break;
        case "L":
            $aux1 = "Diciembre";
            break;
    }
    $result=mysqli_query($link,"SELECT *, COUNT(*) AS numero FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado'");
    while ($fila=mysqli_fetch_array($result)){
        $fragmento=",['".$aux1."', ".$fila['numero']."]";
        $fragmento1=$fragmento.$fragmento1;
    }
    $fragmento1="['Nro de Safety Eyes','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumAccionesCorrectivasxEstadoPlantaMes($mes,$planta,$link) {
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idEstado, COUNT(*) AS numero FROM AccionesCorrectivas WHERE idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACSE WHERE idObservacionesSE IN (SELECT idObservacionesSE FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')))) GROUP BY idEstado");
    while ($fila=mysqli_fetch_array($result)){
        $result2=mysqli_query($link,"SELECT * FROM EstadoACMS WHERE idEstado ='".$fila['idEstado']."'");
        while ($fila2=mysqli_fetch_array($result2)){
            $fragmento = ",['" . $fila2['descripcion'] . "', " . $fila['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Estado','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumAccionesCorrectivasxEstadoMes($mes,$link) {
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idEstado, COUNT(*) AS numero FROM AccionesCorrectivas WHERE idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACSE WHERE idObservacionesSE IN (SELECT idObservacionesSE FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado'))) GROUP BY idEstado");
    while ($fila=mysqli_fetch_array($result)){
        $result2=mysqli_query($link,"SELECT * FROM EstadoACMS WHERE idEstado ='".$fila['idEstado']."'");
        while ($fila2=mysqli_fetch_array($result2)){
            $fragmento = ",['" . $fila2['descripcion'] . "', " . $fila['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Estado','Cantidad']".$fragmento1;
    return $fragmento1;
}
?>