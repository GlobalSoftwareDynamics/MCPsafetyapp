<?php
require_once __DIR__ . '/lib/mpdf/mpdf.php';

session_start();
$link = mysqli_connect("gsdynamicscom.ipagemysql.com", "gsdsafeatwork", "6DQ~kTpyHPn+Zs$^", "seapp");
mysqli_query($link,"SET NAMES 'utf8'");
/*if(isset($_SESSION['login'])){*/

    $html='
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/Formatospdf.css" rel="stylesheet">
    </head>
    <body class="portrait">
    ';
    $result=mysqli_query($link,"SELECT * FROM SafetyEyes WHERE idSafetyEyes='".$_POST['idSE']."'");
    while ($fila=mysqli_fetch_array($result)) {
        $html .= '
            <section class="contenedor bordes">
                <div>
                    <h5>1. Datos de Ubicación</h5>
                </div>
            </section>
            <section class="contenedor bordeslados">
                    <div class="descladoizquierdo">
                        <div class="col-sm-12">
                            <span class="label">Planta:</span>';
        $result1 = mysqli_query($link, "SELECT * FROM Ubicacion WHERE idUbicacion='" . $fila['idUbicacion'] . "'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $result2 = mysqli_query($link, "SELECT * FROM Planta WHERE idPlanta='" . $fila1['idPlanta'] . "'");
            while ($fila2 = mysqli_fetch_array($result2)) {
                $html .='<span id="planta"> '.$fila2['descripcion'].'</span>';
            }
        }
        $html .= '
                    </div>
                </div>
                <div class="descladoderecho">
                    <div class="col-sm-12">
                        <span class="label">Ubicación:</span>';
        $result1 = mysqli_query($link, "SELECT * FROM Ubicacion WHERE idUbicacion='" . $fila['idUbicacion'] . "'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $html .='<span id="ubicacion"> '.$fila1['descripcion'].'</span>';
        }
        $html .= '
                    </div>
                </div>
        </section>
        <section class="contenedor bordes">
            <div class="tituloseccion">
                <h5>2. Datos de Actividad</h5>
            </div>
        </section>
        <section class="contenedor bordeslados">
            <br>
            <div class="descripcion">
            <p><b>Descripción:</b><br><br>'.$fila['actividadObservada'].'</p>
            </div>
            <div class="descladoizquierdo">
                <div class="col-sm-12 text-center">
                    <br>
                    <span class="label">Nro. Personas Observadas:</span>
                    <span id="persobs">'.$fila['nropersobservadas'].'</span>
                </div>
            </div>
            <div class="descladoderecho">
                <div class="col-sm-12 text-center">
                    <br>
                    <span class="label">Nro. Personas Retroalimentadas:</span>
                    <span id="persret">'.$fila['nropersretroalimentadas'].'
                    </span>
                </div>
            </div>
        </section>
        <section class="contenedor bordes">
            <div>
                <h5>3. Equipo Observador</h5>
            </div>
        </section>
        <section class="contenedor bordeslados">
            <div class="descladoizquierdo pdtoplider">
                <div class="middlealign text-center">
                    <span class="label">Líder del Equipo:</span>
                </div>
                <div class="middlealign text-center">';
        $result1 = mysqli_query($link, "SELECT * FROM ParticipantesSE WHERE idSafetyEyes='" . $_POST['idSE'] . "' AND idTipoParticipante='1'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $result2 = mysqli_query($link, "SELECT * FROM Colaboradores WHERE dni ='" . $fila1['dni'] . "'");
            while ($fila2 = mysqli_fetch_array($result2)) {
                $html .='<span id="lider">'.$fila2['nombre'] . ' ' . $fila2['apellidos'].'</span>';
            }
        }
        $html .= '
                </div>
            </div>
            <div class="descladoderecho">
                <div class="text-left middlealign">
                    <span class="label">Observadores:</span>
                </div>
                <div>
                    <ul>';
        $result1 = mysqli_query($link, "SELECT * FROM ParticipantesSE WHERE idSafetyEyes='" . $_POST['idSE'] . "' AND idTipoParticipante='2'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $result2 = mysqli_query($link, "SELECT * FROM Colaboradores WHERE dni ='" . $fila1['dni'] . "'");
            while ($fila2 = mysqli_fetch_array($result2)) {
                $html .= '<li>' . $fila2['nombre'] . ' ' . $fila2['apellidos'] . '</li>';
            }
        }
        $html .= '
                    </ul>
                </div>
            </div>
        </section>
        <section class="contenedor bordes">
            <div>
                <h5>4. Resultados de la Observación</h5>
            </div>
        </section>
        <section class="contenedor bordeslados">
            <br>
            <div class="col-sm-12">
                <table class="tabla text-center">
                    <thead>
                        <tr class="trborder">
                            <th>Nro.</th>
                            <th>Observación</th>
                            <th>Categoría</th>
                            <th>Clase</th>
                            <th>COP</th>
                        </tr>
                    </thead>
                    <tbody>';

        $aux = 0;
        $result0 = mysqli_query($link, "SELECT * FROM ObservacionesSE WHERE idSafetyEyes='" . $_POST['idSE'] . "'");
        while ($fila0 = mysqli_fetch_array($result0)) {
            $html .= '
                        <tr class="trborder">
            ';
            $aux++;
            $html .= '
                            <td>' . $aux . '</td>
                            <td class="text-left">' . $fila0['descripcion'] . '</td>
                        ';
            $result1 = mysqli_query($link, "SELECT * FROM Categoria WHERE idCategoria='" . $fila0['idCategoria'] . "'");
            while ($fila1 = mysqli_fetch_array($result1)) {
                $html .= '
                                <td>' . $fila1['siglas'] . '</td>
                            ';
            }
            $result3 = mysqli_query($link, "SELECT * FROM Clase WHERE idClase='" . $fila0['idClase'] . "'");
            while ($fila3 = mysqli_fetch_array($result3)) {
                $html .= '
                                <td>' . $fila3['siglas'] . '</td>
                            ';
            }
            $result2 = mysqli_query($link, "SELECT * FROM COPs WHERE idCOPs='" . $fila0['idCOPs'] . "'");
            while ($fila2 = mysqli_fetch_array($result2)) {
                $html .= '
                                <td>' . $fila2['siglas'] . '</td>
                            ';
            }
            $html .= '
                            </tr>
                        ';
        }
        $html .= '
                    </tbody>
                </table>
            </div>
            <div class="">
                <div class="descladoizquierdoul">
                    <div>
                        <span class="label">Categorías:</span>
                    </div>
                    <div>
                        <ul class="ulleft">';
        $result1 = mysqli_query($link, "SELECT * FROM Categoria");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $html .= '
                                <li>' . $fila1['siglas'] . ' - ' . $fila1['descripcion'] . '</li>
                            ';
        }
        $html .= '
                        </ul>
                    </div>
                </div>
                <div class="descladoderechoul">
                    <div>
                        <span class="label">Clases</span>
                    </div>
                    <div>
                        <ul class="ulleft">';
        $result1 = mysqli_query($link, "SELECT * FROM Clase WHERE categoria='SE'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $html .= '
                                <li>' . $fila1['siglas'] . ' - ' . $fila1['descripcion'] . '</li>
                            ';
        }
        $html .= '
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="contenedor bordes">
            <div>
                <h5>5. Acciones Inmediatas Tomadas</h5>
            </div>
        </section>
        <section class="contenedor bordeslados">
            <br>
            <div class="col-sm-12">
                <table class="tabla text-center">
                    <thead>
                        <tr class="trborder">
                            <th>Nro.</th>
                            <th>Acción Inmediata</th>
                            <th>Responsable</th>
                        </tr>
                    </thead>
                    <tbody>';
        $aux = 0;
        $result0 = mysqli_query($link, "SELECT * FROM AISE WHERE idSafetyEyes='" . $_POST['idSE'] . "'");
        while ($fila0 = mysqli_fetch_array($result0)) {
            $html .= '
                        <tr class="trborder">
                    ';
            $aux++;
            $html .= '<td>' . $aux . '</td>';
            $result1 = mysqli_query($link, "SELECT * FROM AccionesInmediatas WHERE idAccionesInmediatas='" . $fila0['idAccionesInmediatas'] . "'");
            while ($fila1 = mysqli_fetch_array($result1)) {
                $html .= '
                                <td class="text-left">' . $fila1['descripcion'] . '</td>
                            ';
                $result2 = mysqli_query($link, "SELECT * FROM Colaboradores WHERE dni ='" . $fila1['dni'] . "'");
                while ($fila2 = mysqli_fetch_array($result2)) {
                    $html .= '
                                    <td>' . $fila2['nombre'] . ' ' . $fila2['apellidos'] . '</td>
                                ';
                }
            }
            $html .= '
                            <tr>
                        ';
        }
        $html .= '
                    </tbody>
                </table>
            </div>
        </section>
        <section class="contenedor bordes">
            <div>
                <h5>6. Mejoras de Seguridad</h5>
            </div>
        </section>
        <section class="contenedor bordeslados">
            <br>
            <div class="col-sm-12">
                <table class="tabla text-center">
                    <thead>
                        <tr class="trborder">
                            <th>Nro.</th>
                            <th>Descripción</th>
                            <th>Propuesta Por</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>';
        $aux = 0;
        $result0 = mysqli_query($link, "SELECT * FROM MESE WHERE idSafetyEyes='" . $_POST['idSE'] . "'");
        while ($fila0 = mysqli_fetch_array($result0)) {
            $html .= '
                        <tr class="trborder">
                    ';
            $aux++;
            $html .= '<td>' . $aux . '</td>';
            $result1 = mysqli_query($link, "SELECT * FROM MejorasSeguridad WHERE idMejoras='" . $fila0['idMejoras'] . "'");
            while ($fila1 = mysqli_fetch_array($result1)) {
                $html .= '
                                <td class="text-left">' . $fila1['descripcion'] . '</td>
                            ';
                $result2 = mysqli_query($link, "SELECT * FROM Colaboradores WHERE dni ='" . $fila1['dni'] . "'");
                while ($fila2 = mysqli_fetch_array($result2)) {
                    $html .= '
                                    <td>' . $fila2['nombre'] . ' ' . $fila2['apellidos'] . '</td>
                                ';
                }
                $html .= '
                                <td>' . $fila1['estado'] . '</td>
                            ';
            }
            $html .= '
                            <tr>
                        ';
        }
        $html .= '
                    </tbody>
                </table>
            </div>
        </section>
        <section class="contenedor bordes">
            <div>
                <h5>7. Acciones Correctivas</h5>
            </div>
        </section>
        <section class="contenedor bordeslados">
            <br>
            <div class="col-sm-12">
                <table class="tabla text-center">
                    <thead>
                        <tr class="trborder">
                            <th>Nro.</th>
                            <th>Descripción</th>
                            <th>Responsable</th>
                            <th>Fecha Planeada</th>
                            <th>Fecha Real</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>';
        $aux = 0;
        $result0 = mysqli_query($link, "SELECT * FROM ObservacionesSE WHERE idSafetyEyes='" . $_POST['idSE'] . "'");
        while ($fila0 = mysqli_fetch_array($result0)) {
            $result3 = mysqli_query($link, "SELECT * FROM ACSE WHERE idObservacionesSE='" . $fila0['idObservacionesSE'] . "'");
            while ($fila3 = mysqli_fetch_array($result3)) {
                $html .= '
                        <tr class="trborder">
                    ';
                $aux++;
                $html .= '<td>' . $aux . '</td>';
                $result1 = mysqli_query($link, "SELECT * FROM AccionesCorrectivas WHERE idAccionesCorrectivas='" . $fila3['idAccionesCorrectivas'] . "'");
                while ($fila1 = mysqli_fetch_array($result1)) {
                    $html .= '
                                    <td class="text-left">' . $fila1['descripcion'] . '</td>
                                ';
                    $result2 = mysqli_query($link, "SELECT * FROM Colaboradores WHERE dni ='" . $fila1['dni'] . "'");
                    while ($fila2 = mysqli_fetch_array($result2)) {
                        $html .= '
                                        <td>' . $fila2['nombre'] . ' ' . $fila2['apellidos'] . '</td>
                                    ';
                    }
                    $html .= '
                                <td>' . $fila1['fechaPlan'] . '</td>
                                <td>' . $fila1['fechaReal'] . '</td>
                                <td>' . $fila1['estado'] . '</td>
                            ';
                }
                $html .= '
                            <tr>
                        ';
            }
        }
        $html .= '
                    </tbody>
                </table>
            </div>
        </section>
        <section class="contenedor bordes">
            <div class="col-sm-12" style="padding-bottom: 0.1cm; padding-top: 0.1cm;">
                <span class="label">Nombre del Revisor:</span>';
        $result1 = mysqli_query($link, "SELECT * FROM ParticipantesSE WHERE idSafetyEyes='" . $_POST['idSE'] . "' AND idTipoParticipante='3'");
        while ($fila1 = mysqli_fetch_array($result1)) {
            $result2 = mysqli_query($link, "SELECT * FROM Colaboradores WHERE dni ='" . $fila1['dni'] . "'");
            while ($fila2 = mysqli_fetch_array($result2)) {
                $html .='<span id="revisor" style="font-size: 12px;"> '.$fila2['nombre'] . ' ' . $fila2['apellidos'].'</span>';
            }
        }
        $html .= '
            </div>
        </section>';
    }
    $html .='
        </body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    ';
    $htmlheader='
        <header>
            <div id="descripcionbrand">
                <img style="margin-top: 20px" width="auto" height="70" src="image/Logo.png"/>
            </div>
            <div id="tituloreporte">
                <div class="titulo">
                    <h4>Formulario Safety Eyes</h4>
                    <h5 class="desctitulo">'.$_POST['idSE'].'</h5>
                </div>
            </div>
        </header>
    ';
    $htmlfooter='
          <div class="footer">
                <span style="font-size: 10px;">GSD-Safe@Work</span>
                                   
                                 
                              
                <span style="font-size: 10px">© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
          </div>
    ';
    $nombrearchivo=$_POST['idSE'].'.pdf';
    $mpdf = new mPDF('','A4',0,'','15',15,35,15,6,6);

// Write some HTML code:
    $mpdf->SetHTMLHeader($htmlheader);
    $mpdf->SetHTMLFooter($htmlfooter);
    $mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
    $mpdf->Output($nombrearchivo,'D');
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>
