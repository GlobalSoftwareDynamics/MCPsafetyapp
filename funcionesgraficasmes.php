<?php

/*Safety Eyes*/
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
function NumSafetyEyesPersonalesLiderMes($dni,$mes,$link){
    $frag="";
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
    $result=mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM ParticipantesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado = 'Aprobado') AND dni = '".$dni."' AND idTipoParticipante ='1'");
    while ($fila=mysqli_fetch_array($result)){
        $frag=",['$aux1',".$fila['numero']."]";
    }
    $fragmento1="['Mes','Cantidad']".$frag;
    return $fragmento1;
}

function NumSafetyEyesPersonalesParticipanteMes($dni,$mes,$link){
    $frag="";
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
    $result=mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM ParticipantesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado = 'Aprobado') AND dni = '".$dni."' AND idTipoParticipante != '3'");
    while ($fila=mysqli_fetch_array($result)){
        $frag=",['$aux1',".$fila['numero']."]";
    }
    $fragmento1="['Mes','Cantidad']".$frag;
    return $fragmento1;
}
function NumAccionesCorrectivasPersonalesMes($dni,$mes,$link){
    $frag="";
    $result=mysqli_query($link, "SELECT idEstado, COUNT(*) AS numero FROM AccionesCorrectivas WHERE dni = '".$dni."' AND idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACSE WHERE idObservacionesSE IN (SELECT idObservacionesSE FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE___%".$mes."%' AND estado ='Aprobado'))) GROUP BY idEstado");
    while ($fila=mysqli_fetch_array($result)){
        $result1=mysqli_query($link,"SELECT * FROM EstadoACMS WHERE idEstado ='".$fila['idEstado']."'");
        while ($fila1=mysqli_fetch_array($result1)){
            $frag=",['".$fila1['descripcion']."',".$fila['numero']."]";
        }
        $fragmento1="['Estado','Cantidad']".$frag;
    }
    return $fragmento1;
}

/*Ocurrencias*/
function NumTotalOcurrenciasMes($mes,$link){
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
    $result=mysqli_query($link,"SELECT *, COUNT(*) AS numero FROM Ocurrencias WHERE idOcurrencias LIKE 'OC___%".$mes."%' AND estado ='Aprobado'");
    while ($fila=mysqli_fetch_array($result)){
        $fragmento=",['".$aux1."', ".$fila['numero']."]";
        $fragmento1=$fragmento.$fragmento1;
    }
    $fragmento1="['Nro de Ocurrencias','Cantidad']".$fragmento1;
    return $fragmento1;
}
function NumTotalOcurrenciasPlantaUnicaMes($mes,$planta,$link){
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
    $result1 = mysqli_query($link, "SELECT idUbicacion, COUNT(*) AS numero FROM Ocurrencias WHERE idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta = '".$planta."') AND idOcurrencias LIKE 'OC___%".$mes."%' AND estado ='Aprobado'");
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
function NumOcurrenciasHorarioMes($mes,$link){
    $fragmento="";
    for ($i = 0; $i < 24; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $hora="01:00 - 02:00 Hrs";
                break;
            case 2:
                $aux1 = "B";
                $hora="02:00 - 03:00 Hrs";
                break;
            case 3:
                $aux1 = "C";
                $hora="03:00 - 04:00 Hrs";
                break;
            case 4:
                $aux1 = "D";
                $hora="04:00 - 05:00 Hrs";
                break;
            case 5:
                $aux1 = "E";
                $hora="05:00 - 06:00 Hrs";
                break;
            case 6:
                $aux1 = "F";
                $hora="06:00 - 07:00 Hrs";
                break;
            case 7:
                $aux1 = "G";
                $hora="07:00 - 08:00 Hrs";
                break;
            case 8:
                $aux1 = "H";
                $hora="08:00 - 09:00 Hrs";
                break;
            case 9:
                $aux1 = "I";
                $hora="09:00 - 10:00 Hrs";
                break;
            case 10:
                $aux1 = "J";
                $hora="10:00 - 11:00 Hrs";
                break;
            case 11:
                $aux1 = "K";
                $hora="11:00 - 12:00 Hrs";
                break;
            case 12:
                $aux1 = "L";
                $hora="12:00 - 13:00 Hrs";
                break;
            case 13:
                $aux1 = "M";
                $hora="13:00 - 14:00 Hrs";
                break;
            case 14:
                $aux1 = "N";
                $hora="14:00 - 15:00 Hrs";
                break;
            case 15:
                $aux1 = "O";
                $hora="15:00 - 16:00 Hrs";
                break;
            case 16:
                $aux1 = "P";
                $hora="16:00 - 17:00 Hrs";
                break;
            case 17:
                $aux1 = "Q";
                $hora="17:00 - 18:00 Hrs";
                break;
            case 18:
                $aux1 = "R";
                $hora="18:00 - 19:00 Hrs";
                break;
            case 19:
                $aux1 = "S";
                $hora="19:00 - 20:00 Hrs";
                break;
            case 20:
                $aux1 = "T";
                $hora="20:00 - 21:00 Hrs";
                break;
            case 21:
                $aux1 = "U";
                $hora="21:00 - 22:00 Hrs";
                break;
            case 22:
                $aux1 = "V";
                $hora="22:00 - 23:00 Hrs";
                break;
            case 23:
                $aux1 = "W";
                $hora="23:00 - 00:00 Hrs";
                break;
            case 0:
                $aux1 = "X";
                $hora="00:00 - 01:00 Hrs";
                break;
        }
        $result=mysqli_query($link, "SELECT idOcurrencias, COUNT(*) AS numero FROM Ocurrencias WHERE idOcurrencias LIKE 'OC%".$aux1."%".$mes."%' AND estado = 'Aprobado'");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$hora."',".$fila['numero']."]";
        }
    }
    $fragmento="['Horario','Cantidad']".$fragmento;
    return $fragmento;
}

function NumOcurrenciasHorarioMesxPlanta($mes,$planta,$link){
    $fragmento="";
    for ($i = 0; $i < 24; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $hora="01:00 - 02:00 Hrs";
                break;
            case 2:
                $aux1 = "B";
                $hora="02:00 - 03:00 Hrs";
                break;
            case 3:
                $aux1 = "C";
                $hora="03:00 - 04:00 Hrs";
                break;
            case 4:
                $aux1 = "D";
                $hora="04:00 - 05:00 Hrs";
                break;
            case 5:
                $aux1 = "E";
                $hora="05:00 - 06:00 Hrs";
                break;
            case 6:
                $aux1 = "F";
                $hora="06:00 - 07:00 Hrs";
                break;
            case 7:
                $aux1 = "G";
                $hora="07:00 - 08:00 Hrs";
                break;
            case 8:
                $aux1 = "H";
                $hora="08:00 - 09:00 Hrs";
                break;
            case 9:
                $aux1 = "I";
                $hora="09:00 - 10:00 Hrs";
                break;
            case 10:
                $aux1 = "J";
                $hora="10:00 - 11:00 Hrs";
                break;
            case 11:
                $aux1 = "K";
                $hora="11:00 - 12:00 Hrs";
                break;
            case 12:
                $aux1 = "L";
                $hora="12:00 - 13:00 Hrs";
                break;
            case 13:
                $aux1 = "M";
                $hora="13:00 - 14:00 Hrs";
                break;
            case 14:
                $aux1 = "N";
                $hora="14:00 - 15:00 Hrs";
                break;
            case 15:
                $aux1 = "O";
                $hora="15:00 - 16:00 Hrs";
                break;
            case 16:
                $aux1 = "P";
                $hora="16:00 - 17:00 Hrs";
                break;
            case 17:
                $aux1 = "Q";
                $hora="17:00 - 18:00 Hrs";
                break;
            case 18:
                $aux1 = "R";
                $hora="18:00 - 19:00 Hrs";
                break;
            case 19:
                $aux1 = "S";
                $hora="19:00 - 20:00 Hrs";
                break;
            case 20:
                $aux1 = "T";
                $hora="20:00 - 21:00 Hrs";
                break;
            case 21:
                $aux1 = "U";
                $hora="21:00 - 22:00 Hrs";
                break;
            case 22:
                $aux1 = "V";
                $hora="22:00 - 23:00 Hrs";
                break;
            case 23:
                $aux1 = "W";
                $hora="23:00 - 00:00 Hrs";
                break;
            case 0:
                $aux1 = "X";
                $hora="00:00 - 01:00 Hrs";
                break;
        }
        $result=mysqli_query($link, "SELECT idOcurrencias, COUNT(*) AS numero FROM Ocurrencias WHERE idOcurrencias LIKE 'OC%".$aux1."%".$mes."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."') AND estado = 'Aprobado'");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$hora."',".$fila['numero']."]";
        }
    }
    $fragmento="['Horario','Cantidad']".$fragmento;
    return $fragmento;
}
function NumTotalOcurrenciasPlantaMes($mes,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT * FROM Planta WHERE estado = '1'");
    while ($fila=mysqli_fetch_array($result)){
        $numero=0;
        $result1 = mysqli_query($link, "SELECT idUbicacion, COUNT(*) AS numero FROM Ocurrencias WHERE idOcurrencias LIKE 'OC___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$fila['idPlanta']."')");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $numero=$numero+$fila1['numero'];
        }
        $fragmento = ",['" . $fila['descripcion'] . "', " . $numero . "]";
        $fragmento1 = $fragmento . $fragmento1;
    }
    $fragmento1="['Planta','Cantidad']".$fragmento1;
    return $fragmento1;
}
function NumTotalReportanteOCPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM InvolucradosOCUR WHERE idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE idOcurrencias LIKE 'OC___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) AND idTipoParticipante ='4' GROUP BY dni");
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
function NumTotalReportanteOCMes($mes,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM InvolucradosOCUR WHERE idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE idOcurrencias LIKE 'OC___%".$mes."%' AND estado ='Aprobado') AND idTipoParticipante ='4' GROUP BY dni");
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
function NumTotalReportadoOCPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM InvolucradosOCUR WHERE idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE idOcurrencias LIKE 'OC___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) AND idTipoParticipante ='6' GROUP BY dni");
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
function NumTotalReportadoOCMes($mes,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM InvolucradosOCUR WHERE idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE idOcurrencias LIKE 'OC___%".$mes."%' AND estado ='Aprobado') AND idTipoParticipante ='6' GROUP BY dni");
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
function NumTotalClaseOCMes($mes,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idClase, COUNT(*) AS numero FROM Ocurrencias WHERE idOcurrencias LIKE 'OC___%".$mes."%' AND estado ='Aprobado' GROUP BY idClase");
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

function NumTotalClaseOCPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idClase, COUNT(*) AS numero FROM Ocurrencias WHERE idOcurrencias LIKE 'OC___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."') GROUP BY idClase");
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
function NumTotalUbicacionOCMes($mes, $planta,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idUbicacion, COUNT(*) AS numero FROM Ocurrencias WHERE idOcurrencias LIKE 'OC___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."') GROUP BY idUbicacion");
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
function NumAccionesCorrectivasxEstadoOCPlantaMes($mes,$planta,$link) {
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idEstado, COUNT(*) AS numero FROM AccionesCorrectivas WHERE idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACOCUR WHERE idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE idOcurrencias LIKE 'OC___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."'))) GROUP BY idEstado");
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

function NumAccionesCorrectivasxEstadoOCMes($mes,$link) {
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idEstado, COUNT(*) AS numero FROM AccionesCorrectivas WHERE idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACOCUR WHERE idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE idOcurrencias LIKE 'OC___%".$mes."%' AND estado ='Aprobado')) GROUP BY idEstado");
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
function NumOcurrenciasPersonalesReportanteMes($dni,$mes,$link){
    $frag="";
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
    $result=mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM InvolucradosOCUR WHERE idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE idOcurrencias LIKE 'OC___%".$mes."%' AND estado = 'Aprobado') AND dni = '".$dni."' AND idTipoParticipante ='4'");
    while ($fila=mysqli_fetch_array($result)){
        $frag=",['$aux1',".$fila['numero']."]";
    }
    $fragmento1="['Mes','Cantidad']".$frag;
    return $fragmento1;
}

function NumOcurrenciasPersonalesReportadoMes($dni,$mes,$link){
    $frag="";
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
    $result=mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM InvolucradosOCUR WHERE idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE idOcurrencias LIKE 'OC___%".$mes."%' AND estado = 'Aprobado') AND dni = '".$dni."' AND idTipoParticipante ='6'");
    while ($fila=mysqli_fetch_array($result)){
        $frag=",['$aux1',".$fila['numero']."]";
    }
    $fragmento1="['Mes','Cantidad']".$frag;
    return $fragmento1;
}
function NumAccionesCorrectivasPersonalesOCMes($dni,$mes,$link){
    $frag="";
    $result=mysqli_query($link, "SELECT idEstado, COUNT(*) AS numero FROM AccionesCorrectivas WHERE dni = '".$dni."' AND idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACOCUR WHERE idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE idOcurrencias LIKE 'OC___%".$mes."%' AND estado ='Aprobado')) GROUP BY idEstado");
    while ($fila=mysqli_fetch_array($result)){
        $result1=mysqli_query($link,"SELECT * FROM EstadoACMS WHERE idEstado ='".$fila['idEstado']."'");
        while ($fila1=mysqli_fetch_array($result1)){
            $frag=",['".$fila1['descripcion']."',".$fila['numero']."]";
        }
        $fragmento1="['Estado','Cantidad']".$frag;
    }
    return $fragmento1;
}

/*CAPs*/
function NumTotalCAPMes($mes,$link){
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
    $result=mysqli_query($link,"SELECT *, COUNT(*) AS numero FROM CAP WHERE idCAP LIKE 'CAP___%".$mes."%' AND estado ='Aprobado'");
    while ($fila=mysqli_fetch_array($result)){
        $fragmento=",['".$aux1."', ".$fila['numero']."]";
        $fragmento1=$fragmento.$fragmento1;
    }
    $fragmento1="['Nro de CAPs','Cantidad']".$fragmento1;
    return $fragmento1;
}
function NumTotaCAPPlantaUnicaMes($mes,$planta,$link){
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
    $result1 = mysqli_query($link, "SELECT idUbicacion, COUNT(*) AS numero FROM CAP WHERE idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta = '".$planta."') AND idCAP LIKE 'CAP___%".$mes."%' AND estado ='Aprobado'");
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
function NumTotalCAPPlantaMes($mes,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT * FROM Planta WHERE estado = '1'");
    while ($fila=mysqli_fetch_array($result)){
        $numero=0;
        $result1 = mysqli_query($link, "SELECT idUbicacion, COUNT(*) AS numero FROM CAP WHERE idCAP LIKE 'CAP___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$fila['idPlanta']."')");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $numero=$numero+$fila1['numero'];
        }
        $fragmento = ",['" . $fila['descripcion'] . "', " . $numero . "]";
        $fragmento1 = $fragmento . $fragmento1;
    }
    $fragmento1="['Planta','Cantidad']".$fragmento1;
    return $fragmento1;
}
function NumTotalReportanteCAPPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM InvolucradosCAP WHERE idCAP IN (SELECT idCAP FROM CAP WHERE idCAP LIKE 'CAP___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) AND idTipoParticipante ='4' GROUP BY dni");
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
function NumTotalReportanteCAPMes($mes,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM InvolucradosCAP WHERE idCAP IN (SELECT idCAP FROM CAP WHERE idCAP LIKE 'CAP___%".$mes."%' AND estado ='Aprobado') AND idTipoParticipante ='4' GROUP BY dni");
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
function NumTotalFelicitadoCAPPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM InvolucradosCAP WHERE idCAP IN (SELECT idCAP FROM CAP WHERE idCAP LIKE 'CAP___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) AND idTipoParticipante ='5' GROUP BY dni");
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
function NumTotalFelicitadoCAPMes($mes,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM InvolucradosCAP WHERE idCAP IN (SELECT idCAP FROM CAP WHERE idCAP LIKE 'CAP___%".$mes."%' AND estado ='Aprobado') AND idTipoParticipante ='5' GROUP BY dni");
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
function NumTotalComportamientoCAPMes($mes,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idComportamiento, COUNT(*) AS numero FROM CAP WHERE idCAP LIKE 'CAP___%".$mes."%' AND estado ='Aprobado' GROUP BY idComportamiento");
    while ($fila=mysqli_fetch_array($result)){
        $result1=mysqli_query($link,"SELECT * FROM Comportamiento WHERE idComportamiento ='".$fila['idComportamiento']."'");
        while ($fila1=mysqli_fetch_array($result1)){
            $fragmento=",['".$fila1['descripcion']."', ".$fila['numero']."]";
            $fragmento1=$fragmento.$fragmento1;
        }
    }
    $fragmento1="['Comportamiento','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalComportamientoCAPPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idComportamiento, COUNT(*) AS numero FROM CAP WHERE idCAP LIKE 'CAP___%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."') GROUP BY idComportamiento");
    while ($fila=mysqli_fetch_array($result)){
        $result1=mysqli_query($link,"SELECT * FROM Comportamiento WHERE idComportamiento ='".$fila['idComportamiento']."'");
        while ($fila1=mysqli_fetch_array($result1)){
            $fragmento=",['".$fila1['descripcion']."', ".$fila['numero']."]";
            $fragmento1=$fragmento.$fragmento1;
        }
    }
    $fragmento1="['Comportamiento','Cantidad']".$fragmento1;
    return $fragmento1;
}
function NumCAPPersonalesReportanteMes($dni,$mes,$link){
    $frag="";
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
    $result=mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM InvolucradosCAP WHERE idCAP IN (SELECT idCAP FROM CAP WHERE idCAP LIKE 'CAP___%".$mes."%' AND estado = 'Aprobado') AND dni = '".$dni."' AND idTipoParticipante ='4'");
    while ($fila=mysqli_fetch_array($result)){
        $frag=",['$aux1',".$fila['numero']."]";
    }
    $fragmento1="['Mes','Cantidad']".$frag;
    return $fragmento1;
}

function NumCAPPersonalesFelicitadoMes($dni,$mes,$link){
    $frag="";
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
    $result=mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM InvolucradosCAP WHERE idCAP IN (SELECT idCAP FROM CAP WHERE idCAP LIKE 'CAP___%".$mes."%' AND estado = 'Aprobado') AND dni = '".$dni."' AND idTipoParticipante ='5'");
    while ($fila=mysqli_fetch_array($result)){
        $frag=",['$aux1',".$fila['numero']."]";
    }
    $fragmento1="['Mes','Cantidad']".$frag;
    return $fragmento1;
}

/*INC*/
function NumTotaloIncPlantaMes($mes,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT * FROM Planta WHERE estado = '1'");
    while ($fila=mysqli_fetch_array($result)){
        $numero=0;
        $result1 = mysqli_query($link, "SELECT idUbicacion, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$fila['idPlanta']."')");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $numero=$numero+$fila1['numero'];
        }
        $fragmento = ",['" . $fila['descripcion'] . "', " . $numero . "]";
        $fragmento1 = $fragmento . $fragmento1;
    }
    $fragmento1="['Planta','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalIncPlantaUnicaMes($mes,$planta,$link){
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
    $result1 = mysqli_query($link, "SELECT idUbicacion, COUNT(*) AS numero FROM Incidentes WHERE idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta = '".$planta."') AND idIncidentes LIKE 'INC___%".$mes."%'");
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

function NumTotalIncidentesMes($mes,$link){
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
    $result=mysqli_query($link,"SELECT *, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%'");
    while ($fila=mysqli_fetch_array($result)){
        $fragmento=",['".$aux1."', ".$fila['numero']."]";
        $fragmento1=$fragmento.$fragmento1;
    }
    $fragmento1="['Nro de Incidentes','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalLesionIncMes($mes,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idTipoLesion, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%' GROUP BY idTipoLesion");
    while ($fila=mysqli_fetch_array($result)){
        $result1=mysqli_query($link,"SELECT * FROM TipoLesion WHERE idTipoLesion ='".$fila['idTipoLesion']."'");
        while ($fila1=mysqli_fetch_array($result1)){
            if($fila1['idTipoLesion']==='6'){

            }else {
                $fragmento = ",['" . $fila1['siglas'] . "', " . $fila['numero'] . "]";
                $fragmento1 = $fragmento . $fragmento1;
            }
        }
    }
    $fragmento1="['Clasificación de la Lesión','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalLesionIncPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idTipoLesion, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."') GROUP BY idTipoLesion");
    while ($fila=mysqli_fetch_array($result)){
        $result1=mysqli_query($link,"SELECT * FROM TipoLesion WHERE idTipoLesion ='".$fila['idTipoLesion']."'");
        while ($fila1=mysqli_fetch_array($result1)){
            if($fila1['idTipoLesion']==='6'){

            }else {
                $fragmento = ",['" . $fila1['siglas'] . "', " . $fila['numero'] . "]";
                $fragmento1 = $fragmento . $fragmento1;
            }
        }
    }
    $fragmento1="['Clasificación de la Lesión','Cantidad']".$fragmento1;
    return $fragmento1;
}
function NumTotalUbicacionIncMes($mes, $planta,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idUbicacion, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."') GROUP BY idUbicacion");
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
function NumTotalConsActIncMes($mes,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idConsecuencia, COUNT(*) AS numero FROM IncidentesConsecuencia WHERE tipo = 'Actual' AND idIncidentes IN (SELECT idIncidentes FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%') GROUP BY idConsecuencia");
    while ($fila = mysqli_fetch_array($result)) {
        $result1 = mysqli_query($link, "SELECT * FROM Consecuencia WHERE idConsecuencia ='" . $fila['idConsecuencia'] . "'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $fragmento = ",['" . $fila1['siglas'] . "', " . $fila['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Consecuencia Actal','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalConsActIncPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idConsecuencia, COUNT(*) AS numero FROM IncidentesConsecuencia WHERE tipo = 'Actual' AND idIncidentes IN (SELECT idIncidentes FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) GROUP BY idConsecuencia");
    while ($fila = mysqli_fetch_array($result)) {
        $result1 = mysqli_query($link, "SELECT * FROM Consecuencia WHERE idConsecuencia ='" . $fila['idConsecuencia'] . "'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $fragmento = ",['" . $fila1['siglas'] . "', " . $fila['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Consecuencia Actal','Cantidad']".$fragmento1;
    return $fragmento1;
}
function NumTotalConsPotIncMes($mes,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idConsecuencia, COUNT(*) AS numero FROM IncidentesConsecuencia WHERE tipo = 'Potencial' AND idIncidentes IN (SELECT idIncidentes FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%') GROUP BY idConsecuencia");
    while ($fila = mysqli_fetch_array($result)) {
        $result1 = mysqli_query($link, "SELECT * FROM Consecuencia WHERE idConsecuencia ='" . $fila['idConsecuencia'] . "'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $fragmento = ",['" . $fila1['siglas'] . "', " . $fila['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Consecuencia Potencial','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalConsPotIncPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idConsecuencia, COUNT(*) AS numero FROM IncidentesConsecuencia WHERE tipo = 'Potencial' AND idIncidentes IN (SELECT idIncidentes FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) GROUP BY idConsecuencia");
    while ($fila = mysqli_fetch_array($result)) {
        $result1 = mysqli_query($link, "SELECT * FROM Consecuencia WHERE idConsecuencia ='" . $fila['idConsecuencia'] . "'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $fragmento = ",['" . $fila1['siglas'] . "', " . $fila['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Consecuencia Potencial','Cantidad']".$fragmento1;
    return $fragmento1;
}
function NumTotalIncIntEnergMes($mes,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT intercambioenergia, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%' GROUP BY intercambioenergia");
    while ($fila=mysqli_fetch_array($result)){
        if($fila['intercambioenergia']==="1"){
            $aux1="SI";
        }else{
            $aux1="NO";
        }
        $fragmento=",['".$aux1."', ".$fila['numero']."]";
        $fragmento1=$fragmento.$fragmento1;
    }
    $fragmento1="['Incidentes con Intercambio de Energía','Cantidad']".$fragmento1;
    return $fragmento1;
}
function NumTotalIncRepeticionMes($mes,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT repeticion, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%' GROUP BY repeticion");
    while ($fila=mysqli_fetch_array($result)){
        if($fila['repeticion']==="1"){
            $aux1="SI";
        }elseif($fila['repeticion']==="0"){
            $aux1="NO";
        }else{
            $aux1="Sin Definir";
        }
        $fragmento=",['".$aux1."', ".$fila['numero']."]";
        $fragmento1=$fragmento.$fragmento1;
    }
    $fragmento1="['Incidentes Repetidos','Cantidad']".$fragmento1;
    return $fragmento1;
}
function NumTotalIncIntEnergPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT intercambioenergia, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta = '{$planta}') GROUP BY intercambioenergia");
    while ($fila=mysqli_fetch_array($result)){
        if($fila['intercambioenergia']==="1"){
            $aux1="SI";
        }else{
            $aux1="NO";
        }
        $fragmento=",['".$aux1."', ".$fila['numero']."]";
        $fragmento1=$fragmento.$fragmento1;
    }
    $fragmento1="['Incidentes con Intercambio de Energía','Cantidad']".$fragmento1;
    return $fragmento1;
}
function NumTotalIncRepeticionPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result=mysqli_query($link,"SELECT repeticion, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta = '{$planta}') GROUP BY repeticion");
    while ($fila=mysqli_fetch_array($result)){
        if($fila['repeticion']==="1"){
            $aux1="SI";
        }elseif($fila['repeticion']==="0"){
            $aux1="NO";
        }else{
            $aux1="Sin Definir";
        }
        $fragmento=",['".$aux1."', ".$fila['numero']."]";
        $fragmento1=$fragmento.$fragmento1;
    }
    $fragmento1="['Incidentes Repetidos','Cantidad']".$fragmento1;
    return $fragmento1;
}
function NumTotalParteCuerpoIncMes($mes,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idParteCuerpo, COUNT(*) AS numero FROM InvolucradoParteCuerpo WHERE idInvolucradosIncidente IN (SELECT idInvolucradosIncidente FROM InvolucradosIncidente WHERE idIncidentes LIKE 'INC___%".$mes."%') GROUP BY idParteCuerpo");
    while ($fila = mysqli_fetch_array($result)) {
        $result1 = mysqli_query($link, "SELECT * FROM ParteCuerpo WHERE idParteCuerpo ='" . $fila['idParteCuerpo'] . "'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $fragmento = ",['" . $fila1['descripcion'] . "', " . $fila['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Parte del Cuerpo','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalParteCuerpoIncPlantaUnicaMes($mes,$planta,$link){
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idParteCuerpo, COUNT(*) AS numero FROM InvolucradoParteCuerpo WHERE idInvolucradosIncidente IN (SELECT idInvolucradosIncidente FROM InvolucradosIncidente WHERE idIncidentes IN (SELECT idIncidentes FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."'))) GROUP BY idParteCuerpo");
    while ($fila = mysqli_fetch_array($result)) {
        $result1 = mysqli_query($link, "SELECT * FROM ParteCuerpo WHERE idParteCuerpo ='" . $fila['idParteCuerpo'] . "'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $fragmento = ",['" . $fila1['descripcion'] . "', " . $fila['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Parte del Cuerpo','Cantidad']".$fragmento1;
    return $fragmento1;
}
function NumIncidentesHorarioMes($mes,$link){
    $fragmento="";
    for ($i = 0; $i < 24; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $hora="01:00 - 02:00 Hrs";
                break;
            case 2:
                $aux1 = "B";
                $hora="02:00 - 03:00 Hrs";
                break;
            case 3:
                $aux1 = "C";
                $hora="03:00 - 04:00 Hrs";
                break;
            case 4:
                $aux1 = "D";
                $hora="04:00 - 05:00 Hrs";
                break;
            case 5:
                $aux1 = "E";
                $hora="05:00 - 06:00 Hrs";
                break;
            case 6:
                $aux1 = "F";
                $hora="06:00 - 07:00 Hrs";
                break;
            case 7:
                $aux1 = "G";
                $hora="07:00 - 08:00 Hrs";
                break;
            case 8:
                $aux1 = "H";
                $hora="08:00 - 09:00 Hrs";
                break;
            case 9:
                $aux1 = "I";
                $hora="09:00 - 10:00 Hrs";
                break;
            case 10:
                $aux1 = "J";
                $hora="10:00 - 11:00 Hrs";
                break;
            case 11:
                $aux1 = "K";
                $hora="11:00 - 12:00 Hrs";
                break;
            case 12:
                $aux1 = "L";
                $hora="12:00 - 13:00 Hrs";
                break;
            case 13:
                $aux1 = "M";
                $hora="13:00 - 14:00 Hrs";
                break;
            case 14:
                $aux1 = "N";
                $hora="14:00 - 15:00 Hrs";
                break;
            case 15:
                $aux1 = "O";
                $hora="15:00 - 16:00 Hrs";
                break;
            case 16:
                $aux1 = "P";
                $hora="16:00 - 17:00 Hrs";
                break;
            case 17:
                $aux1 = "Q";
                $hora="17:00 - 18:00 Hrs";
                break;
            case 18:
                $aux1 = "R";
                $hora="18:00 - 19:00 Hrs";
                break;
            case 19:
                $aux1 = "S";
                $hora="19:00 - 20:00 Hrs";
                break;
            case 20:
                $aux1 = "T";
                $hora="20:00 - 21:00 Hrs";
                break;
            case 21:
                $aux1 = "U";
                $hora="21:00 - 22:00 Hrs";
                break;
            case 22:
                $aux1 = "V";
                $hora="22:00 - 23:00 Hrs";
                break;
            case 23:
                $aux1 = "W";
                $hora="23:00 - 00:00 Hrs";
                break;
            case 0:
                $aux1 = "X";
                $hora="00:00 - 01:00 Hrs";
                break;
        }
        $result=mysqli_query($link, "SELECT idIncidentes, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC%".$aux1."%".$mes."%'");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$hora."',".$fila['numero']."]";
        }
    }
    $fragmento="['Horario','Cantidad']".$fragmento;
    return $fragmento;
}

function NumIncidentesHorarioMesxPlanta($mes,$planta,$link){
    $fragmento="";
    for ($i = 0; $i < 24; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $hora="01:00 - 02:00 Hrs";
                break;
            case 2:
                $aux1 = "B";
                $hora="02:00 - 03:00 Hrs";
                break;
            case 3:
                $aux1 = "C";
                $hora="03:00 - 04:00 Hrs";
                break;
            case 4:
                $aux1 = "D";
                $hora="04:00 - 05:00 Hrs";
                break;
            case 5:
                $aux1 = "E";
                $hora="05:00 - 06:00 Hrs";
                break;
            case 6:
                $aux1 = "F";
                $hora="06:00 - 07:00 Hrs";
                break;
            case 7:
                $aux1 = "G";
                $hora="07:00 - 08:00 Hrs";
                break;
            case 8:
                $aux1 = "H";
                $hora="08:00 - 09:00 Hrs";
                break;
            case 9:
                $aux1 = "I";
                $hora="09:00 - 10:00 Hrs";
                break;
            case 10:
                $aux1 = "J";
                $hora="10:00 - 11:00 Hrs";
                break;
            case 11:
                $aux1 = "K";
                $hora="11:00 - 12:00 Hrs";
                break;
            case 12:
                $aux1 = "L";
                $hora="12:00 - 13:00 Hrs";
                break;
            case 13:
                $aux1 = "M";
                $hora="13:00 - 14:00 Hrs";
                break;
            case 14:
                $aux1 = "N";
                $hora="14:00 - 15:00 Hrs";
                break;
            case 15:
                $aux1 = "O";
                $hora="15:00 - 16:00 Hrs";
                break;
            case 16:
                $aux1 = "P";
                $hora="16:00 - 17:00 Hrs";
                break;
            case 17:
                $aux1 = "Q";
                $hora="17:00 - 18:00 Hrs";
                break;
            case 18:
                $aux1 = "R";
                $hora="18:00 - 19:00 Hrs";
                break;
            case 19:
                $aux1 = "S";
                $hora="19:00 - 20:00 Hrs";
                break;
            case 20:
                $aux1 = "T";
                $hora="20:00 - 21:00 Hrs";
                break;
            case 21:
                $aux1 = "U";
                $hora="21:00 - 22:00 Hrs";
                break;
            case 22:
                $aux1 = "V";
                $hora="22:00 - 23:00 Hrs";
                break;
            case 23:
                $aux1 = "W";
                $hora="23:00 - 00:00 Hrs";
                break;
            case 0:
                $aux1 = "X";
                $hora="00:00 - 01:00 Hrs";
                break;
        }
        $result=mysqli_query($link, "SELECT idIncidentes, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC%".$aux1."%".$mes."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$hora."',".$fila['numero']."]";
        }
    }
    $fragmento="['Horario','Cantidad']".$fragmento;
    return $fragmento;
}
function NumAccionesCorrectivasxEstadoIncPlantaMes($mes,$planta,$link) {
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idEstado, COUNT(*) AS numero FROM AccionesCorrectivas WHERE idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACINC WHERE idIncidentes IN (SELECT idIncidentes FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."'))) GROUP BY idEstado");
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

function NumAccionesCorrectivasxEstadoIncMes($mes,$link) {
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idEstado, COUNT(*) AS numero FROM AccionesCorrectivas WHERE idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACINC WHERE idIncidentes IN (SELECT idIncidentes FROM Incidentes WHERE idIncidentes LIKE 'INC___%".$mes."%')) GROUP BY idEstado");
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