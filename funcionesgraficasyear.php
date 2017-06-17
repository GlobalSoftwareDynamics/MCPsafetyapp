<?php

function NumSafetyEyesAnio($anio,$link){
    $año=explode("0",$anio);
    $fragmento="";
    for ($i = 1; $i < 13; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $mes="Enero";
                break;
            case 2:
                $aux1 = "B";
                $mes="Febrero";
                break;
            case 3:
                $aux1 = "C";
                $mes="Marzo";
                break;
            case 4:
                $aux1 = "D";
                $mes="Abril";
                break;
            case 5:
                $aux1 = "E";
                $mes="Mayo";
                break;
            case 6:
                $aux1 = "F";
                $mes="Junio";
                break;
            case 7:
                $aux1 = "G";
                $mes="Julio";
                break;
            case 8:
                $aux1 = "H";
                $mes="Agosto";
                break;
            case 9:
                $aux1 = "I";
                $mes="Septiembre";
                break;
            case 10:
                $aux1 = "J";
                $mes="Octubre";
                break;
            case 11:
                $aux1 = "K";
                $mes="Noviembre";
                break;
            case 12:
                $aux1 = "L";
                $mes="Diciembre";
                break;
        }
        $result=mysqli_query($link, "SELECT idSafetyEyes, COUNT(*) AS numero FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE".$año[1]."_%".$aux1."%' AND estado = 'Aprobado'");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}

function NumSafetyEyesAnioxPlanta($anio,$planta,$link){
    $año=explode("0",$anio);
    $fragmento="";
    for ($i = 1; $i < 13; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $mes="Enero";
                break;
            case 2:
                $aux1 = "B";
                $mes="Febrero";
                break;
            case 3:
                $aux1 = "C";
                $mes="Marzo";
                break;
            case 4:
                $aux1 = "D";
                $mes="Abril";
                break;
            case 5:
                $aux1 = "E";
                $mes="Mayo";
                break;
            case 6:
                $aux1 = "F";
                $mes="Junio";
                break;
            case 7:
                $aux1 = "G";
                $mes="Julio";
                break;
            case 8:
                $aux1 = "H";
                $mes="Agosto";
                break;
            case 9:
                $aux1 = "I";
                $mes="Septiembre";
                break;
            case 10:
                $aux1 = "J";
                $mes="Octubre";
                break;
            case 11:
                $aux1 = "K";
                $mes="Noviembre";
                break;
            case 12:
                $aux1 = "L";
                $mes="Diciembre";
                break;
        }
        $result=mysqli_query($link, "SELECT idSafetyEyes, COUNT(*) AS numero FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE".$año[1]."_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."') AND estado = 'Aprobado'");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}

function NumSafetyEyesAnioxPlantaComparacion($anio,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM Planta WHERE estado = '1'");
    while ($fila0=mysqli_fetch_array($result0)) {
        $frag=",'".$fila0['descripcion']."'";
        $fragmentoparcial=$fragmentoparcial.$frag;

    }
    $fragmento="['Mes'".$fragmentoparcial."]";
    for ($i = 1; $i < 13; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $mes="Enero";
                break;
            case 2:
                $aux1 = "B";
                $mes="Febrero";
                break;
            case 3:
                $aux1 = "C";
                $mes="Marzo";
                break;
            case 4:
                $aux1 = "D";
                $mes="Abril";
                break;
            case 5:
                $aux1 = "E";
                $mes="Mayo";
                break;
            case 6:
                $aux1 = "F";
                $mes="Junio";
                break;
            case 7:
                $aux1 = "G";
                $mes="Julio";
                break;
            case 8:
                $aux1 = "H";
                $mes="Agosto";
                break;
            case 9:
                $aux1 = "I";
                $mes="Septiembre";
                break;
            case 10:
                $aux1 = "J";
                $mes="Octubre";
                break;
            case 11:
                $aux1 = "K";
                $mes="Noviembre";
                break;
            case 12:
                $aux1 = "L";
                $mes="Diciembre";
                break;
        }
        $frag1="";
        $result0=mysqli_query($link,"SELECT * FROM Planta WHERE estado = '1'");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idSafetyEyes, COUNT(*) AS numero FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE" . $año[1] . "_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='" . $fila0['idPlanta'] . "') AND estado = 'Aprobado'");
            while ($fila = mysqli_fetch_array($result)) {
                $numero1 = $numero1 + $fila['numero'];
                $frag1=$frag1.",".$numero1;
            }
        }
        $frag2=$frag2.",['".$mes."'".$frag1."]";
    }
    $fragmentofinal=$fragmento.$frag2;
    return $fragmentofinal;
}

function NumClasexAnioxPlanta($anio,$planta,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM Clase WHERE categoria ='SE'");
    while ($fila0=mysqli_fetch_array($result0)) {
        $frag=",'".$fila0['siglas']."'";
        $fragmentoparcial=$fragmentoparcial.$frag;

    }
    $fragmento="['Mes'".$fragmentoparcial."]";
    for ($i = 1; $i < 13; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $mes="Enero";
                break;
            case 2:
                $aux1 = "B";
                $mes="Febrero";
                break;
            case 3:
                $aux1 = "C";
                $mes="Marzo";
                break;
            case 4:
                $aux1 = "D";
                $mes="Abril";
                break;
            case 5:
                $aux1 = "E";
                $mes="Mayo";
                break;
            case 6:
                $aux1 = "F";
                $mes="Junio";
                break;
            case 7:
                $aux1 = "G";
                $mes="Julio";
                break;
            case 8:
                $aux1 = "H";
                $mes="Agosto";
                break;
            case 9:
                $aux1 = "I";
                $mes="Septiembre";
                break;
            case 10:
                $aux1 = "J";
                $mes="Octubre";
                break;
            case 11:
                $aux1 = "K";
                $mes="Noviembre";
                break;
            case 12:
                $aux1 = "L";
                $mes="Diciembre";
                break;
        }
        $frag1="";
        $result0=mysqli_query($link,"SELECT * FROM Clase WHERE categoria = 'SE'");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idSafetyEyes, COUNT(*) AS numero FROM ObservacionesSE WHERE idClase = ".$fila0['idClase']." AND idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE" . $año[1] . "_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='" . $planta . "') AND estado = 'Aprobado')");
            while ($fila = mysqli_fetch_array($result)) {
                $numero1 = $numero1 + $fila['numero'];
                $frag1=$frag1.",".$numero1;
            }
        }
        $frag2=$frag2.",['".$mes."'".$frag1."]";
    }
    $fragmentofinal=$fragmento.$frag2;
    return $fragmentofinal;
}

function NumClasexAnio($anio,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM Clase WHERE categoria ='SE'");
    while ($fila0=mysqli_fetch_array($result0)) {
        $frag=",'".$fila0['siglas']."'";
        $fragmentoparcial=$fragmentoparcial.$frag;

    }
    $fragmento="['Mes'".$fragmentoparcial."]";
    for ($i = 1; $i < 13; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $mes="Enero";
                break;
            case 2:
                $aux1 = "B";
                $mes="Febrero";
                break;
            case 3:
                $aux1 = "C";
                $mes="Marzo";
                break;
            case 4:
                $aux1 = "D";
                $mes="Abril";
                break;
            case 5:
                $aux1 = "E";
                $mes="Mayo";
                break;
            case 6:
                $aux1 = "F";
                $mes="Junio";
                break;
            case 7:
                $aux1 = "G";
                $mes="Julio";
                break;
            case 8:
                $aux1 = "H";
                $mes="Agosto";
                break;
            case 9:
                $aux1 = "I";
                $mes="Septiembre";
                break;
            case 10:
                $aux1 = "J";
                $mes="Octubre";
                break;
            case 11:
                $aux1 = "K";
                $mes="Noviembre";
                break;
            case 12:
                $aux1 = "L";
                $mes="Diciembre";
                break;
        }
        $frag1="";
        $result0=mysqli_query($link,"SELECT * FROM Clase WHERE categoria = 'SE'");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idSafetyEyes, COUNT(*) AS numero FROM ObservacionesSE WHERE idClase = ".$fila0['idClase']." AND idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE" . $año[1] . "_%".$aux1."%' AND estado = 'Aprobado')");
            while ($fila = mysqli_fetch_array($result)) {
                $numero1 = $numero1 + $fila['numero'];
                $frag1=$frag1.",".$numero1;
            }
        }
        $frag2=$frag2.",['".$mes."'".$frag1."]";
    }
    $fragmentofinal=$fragmento.$frag2;
    return $fragmentofinal;
}

function NumCategoriaxAnioxPlanta($anio,$planta,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM Categoria");
    while ($fila0=mysqli_fetch_array($result0)) {
        $frag=",'".$fila0['siglas']."'";
        $fragmentoparcial=$fragmentoparcial.$frag;

    }
    $fragmento="['Mes'".$fragmentoparcial."]";
    for ($i = 1; $i < 13; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $mes="Enero";
                break;
            case 2:
                $aux1 = "B";
                $mes="Febrero";
                break;
            case 3:
                $aux1 = "C";
                $mes="Marzo";
                break;
            case 4:
                $aux1 = "D";
                $mes="Abril";
                break;
            case 5:
                $aux1 = "E";
                $mes="Mayo";
                break;
            case 6:
                $aux1 = "F";
                $mes="Junio";
                break;
            case 7:
                $aux1 = "G";
                $mes="Julio";
                break;
            case 8:
                $aux1 = "H";
                $mes="Agosto";
                break;
            case 9:
                $aux1 = "I";
                $mes="Septiembre";
                break;
            case 10:
                $aux1 = "J";
                $mes="Octubre";
                break;
            case 11:
                $aux1 = "K";
                $mes="Noviembre";
                break;
            case 12:
                $aux1 = "L";
                $mes="Diciembre";
                break;
        }
        $frag1="";
        $result0=mysqli_query($link,"SELECT * FROM Categoria");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idSafetyEyes, COUNT(*) AS numero FROM ObservacionesSE WHERE idCategoria = ".$fila0['idCategoria']." AND idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE" . $año[1] . "_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='" . $planta . "') AND estado = 'Aprobado')");
            while ($fila = mysqli_fetch_array($result)) {
                $numero1 = $numero1 + $fila['numero'];
                $frag1=$frag1.",".$numero1;
            }
        }
        $frag2=$frag2.",['".$mes."'".$frag1."]";
    }
    $fragmentofinal=$fragmento.$frag2;
    return $fragmentofinal;
}

function NumCategoriaxAnio($anio,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM Categoria");
    while ($fila0=mysqli_fetch_array($result0)) {
        $frag=",'".$fila0['siglas']."'";
        $fragmentoparcial=$fragmentoparcial.$frag;

    }
    $fragmento="['Mes'".$fragmentoparcial."]";
    for ($i = 1; $i < 13; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $mes="Enero";
                break;
            case 2:
                $aux1 = "B";
                $mes="Febrero";
                break;
            case 3:
                $aux1 = "C";
                $mes="Marzo";
                break;
            case 4:
                $aux1 = "D";
                $mes="Abril";
                break;
            case 5:
                $aux1 = "E";
                $mes="Mayo";
                break;
            case 6:
                $aux1 = "F";
                $mes="Junio";
                break;
            case 7:
                $aux1 = "G";
                $mes="Julio";
                break;
            case 8:
                $aux1 = "H";
                $mes="Agosto";
                break;
            case 9:
                $aux1 = "I";
                $mes="Septiembre";
                break;
            case 10:
                $aux1 = "J";
                $mes="Octubre";
                break;
            case 11:
                $aux1 = "K";
                $mes="Noviembre";
                break;
            case 12:
                $aux1 = "L";
                $mes="Diciembre";
                break;
        }
        $frag1="";
        $result0=mysqli_query($link,"SELECT * FROM Categoria");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idSafetyEyes, COUNT(*) AS numero FROM ObservacionesSE WHERE idCategoria = ".$fila0['idCategoria']." AND idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE" . $año[1] . "_%".$aux1."%' AND estado = 'Aprobado')");
            while ($fila = mysqli_fetch_array($result)) {
                $numero1 = $numero1 + $fila['numero'];
                $frag1=$frag1.",".$numero1;
            }
        }
        $frag2=$frag2.",['".$mes."'".$frag1."]";
    }
    $fragmentofinal=$fragmento.$frag2;
    return $fragmentofinal;
}

function NumCOPxAnioxPlanta($anio,$planta,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM COPs");
    while ($fila0=mysqli_fetch_array($result0)) {
        $frag=",'".$fila0['siglas']."'";
        $fragmentoparcial=$fragmentoparcial.$frag;

    }
    $fragmento="['Mes'".$fragmentoparcial."]";
    for ($i = 1; $i < 13; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $mes="Enero";
                break;
            case 2:
                $aux1 = "B";
                $mes="Febrero";
                break;
            case 3:
                $aux1 = "C";
                $mes="Marzo";
                break;
            case 4:
                $aux1 = "D";
                $mes="Abril";
                break;
            case 5:
                $aux1 = "E";
                $mes="Mayo";
                break;
            case 6:
                $aux1 = "F";
                $mes="Junio";
                break;
            case 7:
                $aux1 = "G";
                $mes="Julio";
                break;
            case 8:
                $aux1 = "H";
                $mes="Agosto";
                break;
            case 9:
                $aux1 = "I";
                $mes="Septiembre";
                break;
            case 10:
                $aux1 = "J";
                $mes="Octubre";
                break;
            case 11:
                $aux1 = "K";
                $mes="Noviembre";
                break;
            case 12:
                $aux1 = "L";
                $mes="Diciembre";
                break;
        }
        $frag1="";
        $result0=mysqli_query($link,"SELECT * FROM COPs");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idSafetyEyes, COUNT(*) AS numero FROM ObservacionesSE WHERE idCOPs = ".$fila0['idCOPs']." AND idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE" . $año[1] . "_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='" . $planta . "') AND estado = 'Aprobado')");
            while ($fila = mysqli_fetch_array($result)) {
                $numero1 = $numero1 + $fila['numero'];
                $frag1=$frag1.",".$numero1;
            }
        }
        $frag2=$frag2.",['".$mes."'".$frag1."]";
    }
    $fragmentofinal=$fragmento.$frag2;
    return $fragmentofinal;
}

function NumCOPxAnio($anio,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM COPs");
    while ($fila0=mysqli_fetch_array($result0)) {
        $frag=",'".$fila0['siglas']."'";
        $fragmentoparcial=$fragmentoparcial.$frag;

    }
    $fragmento="['Mes'".$fragmentoparcial."]";
    for ($i = 1; $i < 13; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $mes="Enero";
                break;
            case 2:
                $aux1 = "B";
                $mes="Febrero";
                break;
            case 3:
                $aux1 = "C";
                $mes="Marzo";
                break;
            case 4:
                $aux1 = "D";
                $mes="Abril";
                break;
            case 5:
                $aux1 = "E";
                $mes="Mayo";
                break;
            case 6:
                $aux1 = "F";
                $mes="Junio";
                break;
            case 7:
                $aux1 = "G";
                $mes="Julio";
                break;
            case 8:
                $aux1 = "H";
                $mes="Agosto";
                break;
            case 9:
                $aux1 = "I";
                $mes="Septiembre";
                break;
            case 10:
                $aux1 = "J";
                $mes="Octubre";
                break;
            case 11:
                $aux1 = "K";
                $mes="Noviembre";
                break;
            case 12:
                $aux1 = "L";
                $mes="Diciembre";
                break;
        }
        $frag1="";
        $result0=mysqli_query($link,"SELECT * FROM COPs");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idSafetyEyes, COUNT(*) AS numero FROM ObservacionesSE WHERE idCOPs = ".$fila0['idCOPs']." AND idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE" . $año[1] . "_%".$aux1."%' AND estado = 'Aprobado')");
            while ($fila = mysqli_fetch_array($result)) {
                $numero1 = $numero1 + $fila['numero'];
                $frag1=$frag1.",".$numero1;
            }
        }
        $frag2=$frag2.",['".$mes."'".$frag1."]";
    }
    $fragmentofinal=$fragmento.$frag2;
    return $fragmentofinal;
}

function NumAccionesCorrectivasxAnio($anio,$link){
    $año=explode("0",$anio);
    $frag1="";
    $result=mysqli_query($link,"SELECT * FROM EstadoACMS");
    while ($fila=mysqli_fetch_array($result)) {
        $frag1 = $frag1 . ",'" . $fila['descripcion']."'";
    }
    $fragmento="['Mes'".$frag1."]";
    $frag="";
    for ($i = 1; $i < 13; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $mes="Enero";
                break;
            case 2:
                $aux1 = "B";
                $mes="Febrero";
                break;
            case 3:
                $aux1 = "C";
                $mes="Marzo";
                break;
            case 4:
                $aux1 = "D";
                $mes="Abril";
                break;
            case 5:
                $aux1 = "E";
                $mes="Mayo";
                break;
            case 6:
                $aux1 = "F";
                $mes="Junio";
                break;
            case 7:
                $aux1 = "G";
                $mes="Julio";
                break;
            case 8:
                $aux1 = "H";
                $mes="Agosto";
                break;
            case 9:
                $aux1 = "I";
                $mes="Septiembre";
                break;
            case 10:
                $aux1 = "J";
                $mes="Octubre";
                break;
            case 11:
                $aux1 = "K";
                $mes="Noviembre";
                break;
            case 12:
                $aux1 = "L";
                $mes="Diciembre";
                break;
        }
        $frag2="";
        $result=mysqli_query($link, "SELECT * FROM EstadoACMS");
        while ($fila=mysqli_fetch_array($result)){
            $numero1=0;
            $result1=mysqli_query($link,"SELECT idAccionesCorrectivas, COUNT(*) AS numero FROM AccionesCorrectivas WHERE idEstado = '".$fila['idEstado']."' AND idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACSE WHERE idObservacionesSE IN (SELECT idObservacionesSE FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE".$año[1]."_%".$aux1."%' AND estado ='Aprobado')))");
            while ($fila1=mysqli_fetch_array($result1)) {
                $numero1 = $numero1 + $fila1['numero'];
                $frag2=$frag2.",".$numero1;
            }
        }
        $frag=$frag.",['".$mes."'".$frag2."]";
    }
    $fragmentofinal=$fragmento.$frag;
    return $fragmentofinal;
}

function NumAccionesCorrectivasxAnioxPlanta($anio,$planta,$link){
    $año=explode("0",$anio);
    $frag1="";
    $result=mysqli_query($link,"SELECT * FROM EstadoACMS");
    while ($fila=mysqli_fetch_array($result)) {
        $frag1 = $frag1 . ",'" . $fila['descripcion']."'";
    }
    $fragmento="['Mes'".$frag1."]";
    $frag="";
    for ($i = 1; $i < 13; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $mes="Enero";
                break;
            case 2:
                $aux1 = "B";
                $mes="Febrero";
                break;
            case 3:
                $aux1 = "C";
                $mes="Marzo";
                break;
            case 4:
                $aux1 = "D";
                $mes="Abril";
                break;
            case 5:
                $aux1 = "E";
                $mes="Mayo";
                break;
            case 6:
                $aux1 = "F";
                $mes="Junio";
                break;
            case 7:
                $aux1 = "G";
                $mes="Julio";
                break;
            case 8:
                $aux1 = "H";
                $mes="Agosto";
                break;
            case 9:
                $aux1 = "I";
                $mes="Septiembre";
                break;
            case 10:
                $aux1 = "J";
                $mes="Octubre";
                break;
            case 11:
                $aux1 = "K";
                $mes="Noviembre";
                break;
            case 12:
                $aux1 = "L";
                $mes="Diciembre";
                break;
        }
        $frag2="";
        $result=mysqli_query($link, "SELECT * FROM EstadoACMS");
        while ($fila=mysqli_fetch_array($result)){
            $numero1=0;
            $result1=mysqli_query($link,"SELECT idAccionesCorrectivas, COUNT(*) AS numero FROM AccionesCorrectivas WHERE idEstado = '".$fila['idEstado']."' AND idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACSE WHERE idObservacionesSE IN (SELECT idObservacionesSE FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE".$año[1]."_%".$aux1."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."'))))");
            while ($fila1=mysqli_fetch_array($result1)) {
                $numero1 = $numero1 + $fila1['numero'];
                $frag2=$frag2.",".$numero1;
            }
        }
        $frag=$frag.",['".$mes."'".$frag2."]";
    }
    $fragmentofinal=$fragmento.$frag;
    return $fragmentofinal;
}

function multilabel($tabla,$link) {
    $aux=0;
    $frag="";
    $result=mysqli_query($link,"SELECT * FROM $tabla");
    while ($fila=mysqli_fetch_array($result)){
        $aux++;
        $frag=$frag.",".$aux.",{ calc: 'stringify', sourceColumn: ".$aux.", type: 'string', role: 'annotation' }";
    }
    $fragmento="[0".$frag."]";
    return $fragmento;
}

function multilabelconid($tabla,$campo,$valor,$link) {
    $aux=0;
    $frag="";
    $result=mysqli_query($link,"SELECT * FROM $tabla WHERE $campo ='".$valor."'");
    while ($fila=mysqli_fetch_array($result)){
        $aux++;
        $frag=$frag.",".$aux.",{ calc: 'stringify', sourceColumn: ".$aux.", type: 'string', role: 'annotation' }";
    }
    $fragmento="[0".$frag."]";
    return $fragmento;
}
function NumAccionesCorrectivasxPersonaAño($dni,$anio,$link){
    $año=explode("0",$anio);
    $frag1="";
    $result=mysqli_query($link,"SELECT * FROM EstadoACMS");
    while ($fila=mysqli_fetch_array($result)) {
        $frag1 = $frag1 . ",'" . $fila['descripcion']."'";
    }
    $fragmento="['Mes'".$frag1."]";
    $frag="";
    for ($i = 1; $i < 13; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $mes="Enero";
                break;
            case 2:
                $aux1 = "B";
                $mes="Febrero";
                break;
            case 3:
                $aux1 = "C";
                $mes="Marzo";
                break;
            case 4:
                $aux1 = "D";
                $mes="Abril";
                break;
            case 5:
                $aux1 = "E";
                $mes="Mayo";
                break;
            case 6:
                $aux1 = "F";
                $mes="Junio";
                break;
            case 7:
                $aux1 = "G";
                $mes="Julio";
                break;
            case 8:
                $aux1 = "H";
                $mes="Agosto";
                break;
            case 9:
                $aux1 = "I";
                $mes="Septiembre";
                break;
            case 10:
                $aux1 = "J";
                $mes="Octubre";
                break;
            case 11:
                $aux1 = "K";
                $mes="Noviembre";
                break;
            case 12:
                $aux1 = "L";
                $mes="Diciembre";
                break;
        }
        $frag2="";
        $result=mysqli_query($link, "SELECT * FROM EstadoACMS");
        while ($fila=mysqli_fetch_array($result)){
            $numero1=0;
            $result1=mysqli_query($link,"SELECT idAccionesCorrectivas, COUNT(*) AS numero FROM AccionesCorrectivas WHERE dni = '".$dni."' AND idEstado = '".$fila['idEstado']."' AND idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACSE WHERE idObservacionesSE IN (SELECT idObservacionesSE FROM ObservacionesSE WHERE idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE".$año[1]."_%".$aux1."%' AND estado ='Aprobado')))");
            while ($fila1=mysqli_fetch_array($result1)) {
                $numero1 = $numero1 + $fila1['numero'];
                $frag2=$frag2.",".$numero1;
            }
        }
        $frag=$frag.",['".$mes."'".$frag2."]";
    }
    $fragmentofinal=$fragmento.$frag;
    return $fragmentofinal;
}

function NumSafetyEyesxPersonaLiderAño($dni,$anio,$link){
    $año=explode("0",$anio);
    $fragmento="";
    for ($i = 1; $i < 13; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $mes="Enero";
                break;
            case 2:
                $aux1 = "B";
                $mes="Febrero";
                break;
            case 3:
                $aux1 = "C";
                $mes="Marzo";
                break;
            case 4:
                $aux1 = "D";
                $mes="Abril";
                break;
            case 5:
                $aux1 = "E";
                $mes="Mayo";
                break;
            case 6:
                $aux1 = "F";
                $mes="Junio";
                break;
            case 7:
                $aux1 = "G";
                $mes="Julio";
                break;
            case 8:
                $aux1 = "H";
                $mes="Agosto";
                break;
            case 9:
                $aux1 = "I";
                $mes="Septiembre";
                break;
            case 10:
                $aux1 = "J";
                $mes="Octubre";
                break;
            case 11:
                $aux1 = "K";
                $mes="Noviembre";
                break;
            case 12:
                $aux1 = "L";
                $mes="Diciembre";
                break;
        }
        $result=mysqli_query($link, "SELECT idSafetyEyes, COUNT(*) AS numero FROM ParticipantesSE WHERE dni ='".$dni."' AND idTipoParticipante ='1' AND idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE".$año[1]."_%".$aux1."%' AND estado = 'Aprobado')");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}

function NumSafetyEyesxPersonaParticipanteAño($dni,$anio,$link){
    $año=explode("0",$anio);
    $fragmento="";
    for ($i = 1; $i < 13; $i++) {
        switch ($i) {
            case 1:
                $aux1 = "A";
                $mes="Enero";
                break;
            case 2:
                $aux1 = "B";
                $mes="Febrero";
                break;
            case 3:
                $aux1 = "C";
                $mes="Marzo";
                break;
            case 4:
                $aux1 = "D";
                $mes="Abril";
                break;
            case 5:
                $aux1 = "E";
                $mes="Mayo";
                break;
            case 6:
                $aux1 = "F";
                $mes="Junio";
                break;
            case 7:
                $aux1 = "G";
                $mes="Julio";
                break;
            case 8:
                $aux1 = "H";
                $mes="Agosto";
                break;
            case 9:
                $aux1 = "I";
                $mes="Septiembre";
                break;
            case 10:
                $aux1 = "J";
                $mes="Octubre";
                break;
            case 11:
                $aux1 = "K";
                $mes="Noviembre";
                break;
            case 12:
                $aux1 = "L";
                $mes="Diciembre";
                break;
        }
        $result=mysqli_query($link, "SELECT idSafetyEyes, COUNT(*) AS numero FROM ParticipantesSE WHERE dni ='".$dni."' AND idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE".$año[1]."_%".$aux1."%' AND estado = 'Aprobado')");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}