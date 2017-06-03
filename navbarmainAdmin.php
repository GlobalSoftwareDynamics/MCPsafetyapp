<?php
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="mainAdmin.php?user=<?php echo $_GET['user'];?>" class="navbar-brand"><img src="image/Logo.png" height="60"></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ESTADÍSTICAS DE SEGURIDAD<span class="caret"></span></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">GESTIÓN DE REPORTES<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="mainSafetyEyes.php?user=<?php echo $_GET['user'];?>">Reportes Safety Eyes</a></li>
                        <li><a href="mainRegOcurrencias.php?user=<?php echo $_GET['user'];?>">Reportes de Ocurrencias</a></li>
                        <li><a href="mainIncidentes.php?user=<?php echo $_GET['user'];?>">Reportes de Incidentes</a></li>
                        <li><a href="mainRepCap.php?user=<?php echo $_GET['user'];?>">Reportes CAP</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">GESTIÓN DE AC Y MEJORAS<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="registrosaccionescorrectivas.php?user=<?php echo $_GET['user'];?>">Acciones Correctivas</a></li>
                        <li><a href="registroaccionesinmediatas.php?user=<?php echo $_GET['user'];?>">Acciones Inmediatas</a></li>
                        <li><a href="registromejorasseguridad.php?user=<?php echo $_GET['user'];?>">Mejoras de Seguridad</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<?php
?>