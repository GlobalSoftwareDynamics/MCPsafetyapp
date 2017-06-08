<?php

function NumPersObsyPersRetTotalMes($mes){
    $link = mysqli_connect("localhost", "root", "", "seapp");
    mysqli_query($link,"SET NAMES 'utf8'");
    $numpersobs=0;
    $numpersret=0;
    $result=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE%".$mes."%' AND estado ='Aprobado'");
    while ($fila=mysqli_fetch_array($result)){
        $persobs=$fila['nropersobservadas'];
        $persret=$fila['nropersretroalimentadas'];
        $numpersobs=$numpersobs+$persobs;
        $numpersret=$numpersret+$persret;
    }
    $fragmento="['TipoPersona', 'Cantidad'],['Pers.Observadas', ".$numpersobs."],['Pers.Retroalimentadas', ".$numpersret."]";
    return $fragmento;
}

function NumPersObsyPersRetTotalPlantaUnicaMes($mes,$planta){
    $link = mysqli_connect("localhost", "root", "", "seapp");
    mysqli_query($link,"SET NAMES 'utf8'");
    $numpersobs=0;
    $numpersret=0;
    $result=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')");
    while ($fila=mysqli_fetch_array($result)){
        $persobs=$fila['nropersobservadas'];
        $persret=$fila['nropersretroalimentadas'];
        $numpersobs=$numpersobs+$persobs;
        $numpersret=$numpersret+$persret;
    }
    $fragmento="['TipoPersona', 'Cantidad'],['Pers.Observadas', ".$numpersobs."],['Pers.Retroalimentadas', ".$numpersret."]";
    return $fragmento;
}

function NumTotalClaseMes($mes){
    $link = mysqli_connect("localhost", "root", "", "seapp");
    mysqli_query($link,"SET NAMES 'utf8'");
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idClase, COUNT(*) AS numero FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE%".$mes."%' AND estado ='Aprobado') GROUP BY idClase");
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

function NumTotalClasePlantaUnicaMes($mes,$planta){
    $link = mysqli_connect("localhost", "root", "", "seapp");
    mysqli_query($link,"SET NAMES 'utf8'");
    $fragmento1="";
    $result=mysqli_query($link,"SELECT idClase, COUNT(*) AS numero FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) GROUP BY idClase");
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

function NumTotalCategoriaMes($mes){
    $link = mysqli_connect("localhost", "root", "", "seapp");
    mysqli_query($link,"SET NAMES 'utf8'");
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idCategoria, COUNT(*) AS numero FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE%".$mes."%' AND estado ='Aprobado') GROUP BY idCategoria");
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

function NumTotalCategoriaPlantaUnicaMes($mes,$planta){
    $link = mysqli_connect("localhost", "root", "", "seapp");
    mysqli_query($link,"SET NAMES 'utf8'");
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idCategoria, COUNT(*) AS numero FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) GROUP BY idCategoria");
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

function NumTotalUbicacionMes($mes, $planta){
    $link = mysqli_connect("localhost", "root", "", "seapp");
    mysqli_query($link,"SET NAMES 'utf8'");
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idUbicacion, COUNT(*) AS numero FROM SafetyEyes WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) GROUP BY idUbicacion");
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

function NumTotalLiderMes($mes){
    $link = mysqli_connect("localhost", "root", "", "seapp");
    mysqli_query($link,"SET NAMES 'utf8'");
    $fragmento1="";
    $result = mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM ParticipantesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE%".$mes."%' AND estado ='Aprobado') AND idTipoParticipante ='1' GROUP BY dni");
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

function NumTotalLiderPlantaUnicaMes($mes,$planta){
    $link = mysqli_connect("localhost", "root", "", "seapp");
    mysqli_query($link,"SET NAMES 'utf8'");
    $fragmento1="";
    $result = mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM ParticipantesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')) AND idTipoParticipante ='1' GROUP BY dni");
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

function NumTotalPlantaMes($mes){
    $link = mysqli_connect("localhost", "root", "", "seapp");
    mysqli_query($link,"SET NAMES 'utf8'");
    $fragmento1="";
    $result1 = mysqli_query($link, "SELECT idPlanta, COUNT(*) AS numero FROM Ubicacion WHERE idUbicacion IN (SELECT idUbicacion FROM SafetyEyes WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE%".$mes."%' AND estado ='Aprobado') GROUP BY idUbicacion) GROUP BY idPlanta");
    while ($fila1 = mysqli_fetch_array($result1)) {
        $result2=mysqli_query($link,"SELECT * FROM Planta WHERE idPlanta ='".$fila1['idPlanta']."'");
        while ($fila2=mysqli_fetch_array($result2)){
            $fragmento = ",['" . $fila2['descripcion'] . "', " . $fila1['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Planta','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalPlantaUnicaMes($mes,$planta){
    $link = mysqli_connect("localhost", "root", "", "seapp");
    mysqli_query($link,"SET NAMES 'utf8'");
    $fragmento1="";
    $result1 = mysqli_query($link, "SELECT idPlanta, COUNT(*) AS numero FROM Ubicacion WHERE idUbicacion IN (SELECT idUbicacion FROM SafetyEyes WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE%".$mes."%' AND estado ='Aprobado') AND idPlanta = '".$planta."' GROUP BY idUbicacion) GROUP BY idPlanta");
    while ($fila1 = mysqli_fetch_array($result1)) {
        $result2=mysqli_query($link,"SELECT * FROM Planta WHERE idPlanta ='".$fila1['idPlanta']."'");
        while ($fila2=mysqli_fetch_array($result2)){
            $fragmento = ",['" . $fila2['descripcion'] . "', " . $fila1['numero'] . "]";
            $fragmento1 = $fragmento . $fragmento1;
        }
    }
    $fragmento1="['Planta','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumTotalSafetyEyesMes($mes){
    $link = mysqli_connect("localhost", "root", "", "seapp");
    mysqli_query($link,"SET NAMES 'utf8'");
    $fragmento1="";
    $result=mysqli_query($link,"SELECT *, COUNT(*) AS numero FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE%".$mes."%' AND estado ='Aprobado'");
    while ($fila=mysqli_fetch_array($result)){
            $fragmento=",['Nro. de SafetyEyes', ".$fila['numero']."]";
            $fragmento1=$fragmento.$fragmento1;
    }
    $fragmento1="['Nro de Safety Eyes','Cantidad']".$fragmento1;
    return $fragmento1;
}

function NumAccionesCorrectivasxEstadoPlantaMes($mes,$planta) {
    $link = mysqli_connect("localhost", "root", "", "seapp");
    mysqli_query($link,"SET NAMES 'utf8'");
    $fragmento1="";
    $result=mysqli_query($link,"SELECT estado, COUNT(*) AS numero FROM AccionesCorrectivas WHERE idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACSE WHERE idObservacionesSE IN (SELECT idObservacionesSE FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE%".$mes."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')))) GROUP BY estado");
    while ($fila=mysqli_fetch_array($result)){
        $fragmento=",['".$fila['estado']."', ".$fila['numero']."]";
        $fragmento1=$fragmento.$fragmento1;
    }
    $fragmento1="['Estado','Cantidad']".$fragmento1;
    return $fragmento1;
}
?>