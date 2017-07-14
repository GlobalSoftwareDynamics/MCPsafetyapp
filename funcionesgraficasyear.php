<?php

/*Safety Eyes*/
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
        $result=mysqli_query($link, "SELECT idSafetyEyes, COUNT(*) AS numero FROM ParticipantesSE WHERE dni ='".$dni."' AND idTipoParticipante !='3' AND idSafetyEyes IN (SELECT idSafetyEyes FROM SafetyEyes WHERE idSafetyEyes LIKE 'SE".$año[1]."_%".$aux1."%' AND estado = 'Aprobado')");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}

/*Ocurrencias*/
function NumOcurrenciasAnio($anio,$link){
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
        $result=mysqli_query($link, "SELECT idOcurrencias, COUNT(*) AS numero FROM Ocurrencias WHERE idOcurrencias LIKE 'OC".$año[1]."_%".$aux1."%' AND estado = 'Aprobado'");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}
function NumOcurrenciasAnioxPlanta($anio,$planta,$link){
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
        $result=mysqli_query($link, "SELECT idOcurrencias, COUNT(*) AS numero FROM Ocurrencias WHERE idOcurrencias LIKE 'OC".$año[1]."_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."') AND estado = 'Aprobado'");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}
function NumOcurrenciasAnioxPlantaComparacion($anio,$link){
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
            $result = mysqli_query($link, "SELECT idOcurrencias, COUNT(*) AS numero FROM Ocurrencias WHERE idOcurrencias LIKE 'OC" . $año[1] . "_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='" . $fila0['idPlanta'] . "') AND estado = 'Aprobado'");
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
function NumClaseOCxAnioxPlanta($anio,$planta,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM Clase WHERE categoria ='OC'");
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
        $result0=mysqli_query($link,"SELECT * FROM Clase WHERE categoria = 'OC'");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idOcurrencias, COUNT(*) AS numero FROM Ocurrencias WHERE idClase = ".$fila0['idClase']." AND idOcurrencias LIKE 'OC" . $año[1] . "_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='" . $planta . "') AND estado = 'Aprobado'");
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

function NumClaseOCxAnio($anio,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM Clase WHERE categoria ='OC'");
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
        $result0=mysqli_query($link,"SELECT * FROM Clase WHERE categoria = 'OC'");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idOcurrencias, COUNT(*) AS numero FROM Ocurrencias WHERE idClase = ".$fila0['idClase']." AND idOcurrencias LIKE 'OC" . $año[1] . "_%".$aux1."%' AND estado = 'Aprobado'");
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
function NumAccionesCorrectivasOCxAnio($anio,$link){
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
            $result1=mysqli_query($link,"SELECT idAccionesCorrectivas, COUNT(*) AS numero FROM AccionesCorrectivas WHERE idEstado = '".$fila['idEstado']."' AND idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACOCUR WHERE idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE idOcurrencias LIKE 'OC".$año[1]."_%".$aux1."%' AND estado ='Aprobado'))");
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

function NumAccionesCorrectivasOCxAnioxPlanta($anio,$planta,$link){
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
            $result1=mysqli_query($link,"SELECT idAccionesCorrectivas, COUNT(*) AS numero FROM AccionesCorrectivas WHERE idEstado = '".$fila['idEstado']."' AND idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACOCUR WHERE idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE idOcurrencias LIKE 'OC".$año[1]."_%".$aux1."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')))");
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
function NumAccionesCorrectivasxPersonaOCAño($dni,$anio,$link){
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
            $result1=mysqli_query($link,"SELECT idAccionesCorrectivas, COUNT(*) AS numero FROM AccionesCorrectivas WHERE dni = '".$dni."' AND idEstado = '".$fila['idEstado']."' AND idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACOCUR WHERE idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE idOcurrencias LIKE 'OC".$año[1]."_%".$aux1."%' AND estado ='Aprobado'))");
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

function NumOcurrenciasxPersonaReportanteAño($dni,$anio,$link){
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
        $result=mysqli_query($link, "SELECT idOcurrencias, COUNT(*) AS numero FROM InvolucradosOCUR WHERE dni ='".$dni."' AND idTipoParticipante ='4' AND idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE idOcurrencias LIKE 'OC".$año[1]."_%".$aux1."%' AND estado = 'Aprobado')");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}

function NumOcurrenciasxPersonaReportadoAño($dni,$anio,$link){
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
        $result=mysqli_query($link, "SELECT idOcurrencias, COUNT(*) AS numero FROM InvolucradosOCUR WHERE dni ='".$dni."' AND idTipoParticipante ='6' AND idOcurrencias IN (SELECT idOcurrencias FROM Ocurrencias WHERE idOcurrencias LIKE 'OC".$año[1]."_%".$aux1."%' AND estado = 'Aprobado')");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}
function NumTotalUbicacionOCAño($anio, $planta,$link){
    $año=explode("0",$anio);
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idUbicacion, COUNT(*) AS numero FROM Ocurrencias WHERE idOcurrencias LIKE 'OC".$año[1]."%' AND estado ='Aprobado' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."') GROUP BY idUbicacion");
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

/*CAP*/
function NumCAPAnio($anio,$link){
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
        $result=mysqli_query($link, "SELECT idCAP, COUNT(*) AS numero FROM CAP WHERE idCAP LIKE 'CAP".$año[1]."_%".$aux1."%' AND estado = 'Aprobado'");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}
function NumCAPAnioxPlanta($anio,$planta,$link){
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
        $result=mysqli_query($link, "SELECT idCAP, COUNT(*) AS numero FROM CAP WHERE idCAP LIKE 'CAP".$año[1]."_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."') AND estado = 'Aprobado'");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}
function NumCAPAnioxPlantaComparacion($anio,$link){
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
            $result = mysqli_query($link, "SELECT idCAP, COUNT(*) AS numero FROM CAP WHERE idCAP LIKE 'CAP" . $año[1] . "_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='" . $fila0['idPlanta'] . "') AND estado = 'Aprobado'");
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
function NumComportamientoxAnioxPlanta($anio,$planta,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM Comportamiento");
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
        $result0=mysqli_query($link,"SELECT * FROM Comportamiento");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idCAP, COUNT(*) AS numero FROM CAP WHERE idComportamiento = ".$fila0['idComportamiento']." AND idCAP LIKE 'CAP" . $año[1] . "_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='" . $planta . "') AND estado = 'Aprobado'");
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

function NumComportamientoxAnio($anio,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM Comportamiento");
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
        $result0=mysqli_query($link,"SELECT * FROM Comportamiento");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idCAP, COUNT(*) AS numero FROM CAP WHERE idComportamiento = ".$fila0['idComportamiento']." AND idCAP LIKE 'CAP" . $año[1] . "_%".$aux1."%' AND estado = 'Aprobado'");
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
function NumCAPxPersonaReportanteAño($dni,$anio,$link){
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
        $result=mysqli_query($link, "SELECT idCAP, COUNT(*) AS numero FROM InvolucradosCAP WHERE dni ='".$dni."' AND idTipoParticipante ='4' AND idCAP IN (SELECT idCAP FROM CAP WHERE idCAP LIKE 'CAP".$año[1]."_%".$aux1."%' AND estado = 'Aprobado')");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}

function NumCAPxPersonFelicitadoAño($dni,$anio,$link){
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
        $result=mysqli_query($link, "SELECT idCAP, COUNT(*) AS numero FROM InvolucradosCAP WHERE dni ='".$dni."' AND idTipoParticipante ='5' AND idCAP IN (SELECT idCAP FROM CAP WHERE idCAP LIKE 'CAP".$año[1]."_%".$aux1."%' AND estado = 'Aprobado')");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}
function NumTotalFelicitadoCAPAño($anio,$link){
    $año=explode("0",$anio);
    $fragmento1="";
    $result = mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM InvolucradosCAP WHERE idCAP IN (SELECT idCAP FROM CAP WHERE idCAP LIKE 'CAP".$año[1]."%' AND estado ='Aprobado') AND idTipoParticipante ='5' GROUP BY dni");
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
function NumTotalReportanteCAPAño($anio,$link){
    $año=explode("0",$anio);
    $fragmento1="";
    $result = mysqli_query($link, "SELECT dni, COUNT(*) AS numero FROM InvolucradosCAP WHERE idCAP IN (SELECT idCAP FROM CAP WHERE idCAP LIKE 'CAP".$año[1]."%' AND estado ='Aprobado') AND idTipoParticipante ='4' GROUP BY dni");
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

/*Incidentes*/
function NumIncidentesAnio($anio,$link){
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
        $result=mysqli_query($link, "SELECT idIncidentes, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC".$año[1]."_%".$aux1."%'");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}

function NumIncidentesxPlanta($anio,$planta,$link){
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
        $result=mysqli_query($link, "SELECT idIncidentes, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC".$año[1]."_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')");
        while ($fila=mysqli_fetch_array($result)){
            $fragmento=$fragmento.",['".$mes."',".$fila['numero']."]";
        }
    }
    $fragmento="['Mes','Cantidad']".$fragmento;
    return $fragmento;
}

function NumIncidentesAnioxPlantaComparacion($anio,$link){
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
            $result = mysqli_query($link, "SELECT idIncidentes, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC" . $año[1] . "_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='" . $fila0['idPlanta'] . "')");
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
function NumConsActIncxAnioxPlanta($anio,$planta,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM Consecuencia ORDER BY idConsecuencia DESC");
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
        $result0=mysqli_query($link,"SELECT * FROM Consecuencia ORDER BY idConsecuencia DESC");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idIncidentes, COUNT(*) AS numero FROM IncidentesConsecuencia WHERE tipo ='Actual' AND idConsecuencia = ".$fila0['idConsecuencia']." AND idIncidentes IN (SELECT idIncidentes FROM Incidentes WHERE idIncidentes LIKE 'INC" . $año[1] . "_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='" . $planta . "'))");
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

function NumConsActIncxAnio($anio,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM Consecuencia ORDER BY idConsecuencia DESC");
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
        $result0=mysqli_query($link,"SELECT * FROM Consecuencia ORDER BY idConsecuencia DESC");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idIncidentes, COUNT(*) AS numero FROM IncidentesConsecuencia WHERE tipo = 'Actual' AND idConsecuencia = ".$fila0['idConsecuencia']." AND idIncidentes IN (SELECT idIncidentes FROM Incidentes WHERE idIncidentes LIKE 'INC" . $año[1] . "_%".$aux1."%')");
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
function NumConsPotIncxAnioxPlanta($anio,$planta,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM Consecuencia ORDER BY idConsecuencia DESC");
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
        $result0=mysqli_query($link,"SELECT * FROM Consecuencia ORDER BY idConsecuencia DESC");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idIncidentes, COUNT(*) AS numero FROM IncidentesConsecuencia WHERE tipo ='Potencial' AND idConsecuencia = ".$fila0['idConsecuencia']." AND idIncidentes IN (SELECT idIncidentes FROM Incidentes WHERE idIncidentes LIKE 'INC" . $año[1] . "_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='" . $planta . "'))");
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

function NumConsPotIncxAnio($anio,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM Consecuencia ORDER BY idConsecuencia DESC");
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
        $result0=mysqli_query($link,"SELECT * FROM Consecuencia ORDER BY idConsecuencia DESC");
        while ($fila0=mysqli_fetch_array($result0)) {
            $numero1=0;
            $result = mysqli_query($link, "SELECT idIncidentes, COUNT(*) AS numero FROM IncidentesConsecuencia WHERE tipo = 'Potencial' AND idConsecuencia = ".$fila0['idConsecuencia']." AND idIncidentes IN (SELECT idIncidentes FROM Incidentes WHERE idIncidentes LIKE 'INC" . $año[1] . "_%".$aux1."%')");
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
function NumLesionIncxAnioxPlanta($anio,$planta,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM TipoLesion ORDER BY idTipoLesion DESC");
    while ($fila0=mysqli_fetch_array($result0)) {
        if($fila0['idTipoLesion']==='6'){

        }else{
            $frag=",'".$fila0['siglas']."'";
            $fragmentoparcial=$fragmentoparcial.$frag;
        }
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
        $result0=mysqli_query($link,"SELECT * FROM TipoLesion ORDER BY idTipoLesion DESC");
        while ($fila0=mysqli_fetch_array($result0)) {
            if($fila0['idTipoLesion']==='6'){

            }else {
                $numero1 = 0;
                $result = mysqli_query($link, "SELECT idIncidentes, COUNT(*) AS numero FROM Incidentes WHERE idTipoLesion ='{$fila0['idTipoLesion']}' AND idIncidentes LIKE 'INC" . $año[1] . "_%" . $aux1 . "%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='" . $planta . "')");
                while ($fila = mysqli_fetch_array($result)) {
                    $numero1 = $numero1 + $fila['numero'];
                    $frag1 = $frag1 . "," . $numero1;
                }
            }
        }
        $frag2=$frag2.",['".$mes."'".$frag1."]";
    }
    $fragmentofinal=$fragmento.$frag2;
    return $fragmentofinal;
}

function NumLesionIncxAnio($anio,$link){
    $año=explode("0",$anio);
    $fragmentoparcial="";
    $frag2="";
    $result0=mysqli_query($link,"SELECT * FROM TipoLesion ORDER BY idTipoLesion DESC");
    while ($fila0=mysqli_fetch_array($result0)) {
        if($fila0['idTipoLesion']==='6'){

        }else{
            $frag=",'".$fila0['siglas']."'";
            $fragmentoparcial=$fragmentoparcial.$frag;
        }
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
        $result0=mysqli_query($link,"SELECT * FROM TipoLesion ORDER BY idTipoLesion DESC");
        while ($fila0=mysqli_fetch_array($result0)) {
            if($fila0['idTipoLesion']==='6'){

            }else {
                $numero1 = 0;
                $result = mysqli_query($link, "SELECT idIncidentes, COUNT(*) AS numero FROM Incidentes WHERE idTipoLesion ='{$fila0['idTipoLesion']}' AND idIncidentes LIKE 'INC" . $año[1] . "_%" . $aux1 . "%'");
                while ($fila = mysqli_fetch_array($result)) {
                    $numero1 = $numero1 + $fila['numero'];
                    $frag1 = $frag1 . "," . $numero1;
                }
            }
        }
        $frag2=$frag2.",['".$mes."'".$frag1."]";
    }
    $fragmentofinal=$fragmento.$frag2;
    return $fragmentofinal;
}
function NumIntEnergiaIncAnio($anio,$link){
    $año=explode("0",$anio);
    $fragmento1="";
    $result=mysqli_query($link,"SELECT intercambioenergia, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC" . $año[1] . "%' GROUP BY intercambioenergia");
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

function NumIntEnergiaIncxPlantaAnio($anio,$planta,$link){
    $año=explode("0",$anio);
    $fragmento1="";
    $result=mysqli_query($link,"SELECT intercambioenergia, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC" . $año[1] . "%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta = '{$planta}') GROUP BY intercambioenergia");
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
function NumRepeticionIncAnio($anio,$link){
    $año=explode("0",$anio);
    $fragmento1="";
    $result=mysqli_query($link,"SELECT repeticion, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC" . $año[1] . "%' GROUP BY repeticion");
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

function NumRepeticionIncxPlantaAnio($anio,$planta,$link){
    $año=explode("0",$anio);
    $fragmento1="";
    $result=mysqli_query($link,"SELECT repeticion, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC" . $año[1] . "%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta = '{$planta}') GROUP BY repeticion");
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
function NumTotalUbicacionIncAño($anio, $planta,$link){
    $año=explode("0",$anio);
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idUbicacion, COUNT(*) AS numero FROM Incidentes WHERE idIncidentes LIKE 'INC".$año[1]."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."') GROUP BY idUbicacion");
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
function NumTotalParteCuerpoIncAnio($anio,$link){
    $año=explode("0",$anio);
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idParteCuerpo, COUNT(*) AS numero FROM InvolucradoParteCuerpo WHERE idInvolucradosIncidente IN (SELECT idInvolucradosIncidente FROM InvolucradosIncidente WHERE idIncidentes LIKE 'INC".$año[1]."%') GROUP BY idParteCuerpo");
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

function NumTotalParteCuerpoIncPlantaUnicaAnio($anio,$planta,$link){
    $año=explode("0",$anio);
    $fragmento1="";
    $result = mysqli_query($link, "SELECT idParteCuerpo, COUNT(*) AS numero FROM InvolucradoParteCuerpo WHERE idInvolucradosIncidente IN (SELECT idInvolucradosIncidente FROM InvolucradosIncidente WHERE idIncidentes IN (SELECT idIncidentes FROM Incidentes WHERE idIncidentes LIKE 'INC".$año[1]."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."'))) GROUP BY idParteCuerpo");
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
function NumAccionesCorrectivasIncxAnio($anio,$link){
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
            $result1=mysqli_query($link,"SELECT idAccionesCorrectivas, COUNT(*) AS numero FROM AccionesCorrectivas WHERE idEstado = '".$fila['idEstado']."' AND idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACINC WHERE idIncidentes LIKE 'INC".$año[1]."_%".$aux1."%')");
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

function NumAccionesCorrectivasIncxAnioxPlanta($anio,$planta,$link){
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
            $result1=mysqli_query($link,"SELECT idAccionesCorrectivas, COUNT(*) AS numero FROM AccionesCorrectivas WHERE idEstado = '".$fila['idEstado']."' AND idAccionesCorrectivas IN (SELECT idAccionesCorrectivas FROM ACINC WHERE idIncidentes IN (SELECT idIncidentes FROM Incidentes WHERE idIncidentes LIKE 'INC".$año[1]."_%".$aux1."%' AND idUbicacion IN (SELECT idUbicacion FROM Ubicacion WHERE idPlanta ='".$planta."')))");
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

function multilabeltipolesion($link) {
    $aux=0;
    $frag="";
    $result=mysqli_query($link,"SELECT * FROM TipoLesion");
    while ($fila=mysqli_fetch_array($result)){
        if($fila['idTipoLesion']==="6"){

        }else{
            $aux++;
            $frag=$frag.",".$aux.",{ calc: 'stringify', sourceColumn: ".$aux.", type: 'string', role: 'annotation' }";
        }
    }
    $fragmento="[0".$frag."]";
    return $fragmento;
}