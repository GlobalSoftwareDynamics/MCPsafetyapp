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
                <a href="mainSupervisor.php?user=<?php echo $_GET['user'];?>" class="navbar-brand"><img src="image/Logo.png" height="60"></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="mainSupervisor.php?user=<?php echo $_GET['user'];?>">Inicio</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
<?php
?>