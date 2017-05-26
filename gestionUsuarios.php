<!DOCTYPE html>

<html lang="es">

<?php
/*require('funciones.php');
session_start();
if(isset($_SESSION['login'])){
*/
$link = mysqli_connect("localhost", "root", "", "seapp");

mysqli_query($link,"SET NAMES 'utf8'");

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>             PLACEHOLDER         </title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script>
        function getUsuario(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:'gestionUsuarios_usuario='+val,
                success: function(data){
                    $("#usuario").html(data);
                }
            });
        }
        function getPassword(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:'gestionUsuarios_password='+val,
                success: function(data){
                    $("#password").html(data);
                }
            });
        }
        function getTipoUsuario(val) {
            $.ajax({
                type: "POST",
                url: "getAjax.php",
                data:'gestionUsuarios_tipoUsuario='+val,
                success: function(data){
                    $("#tipoUsuario").html(data);
                }
            });
        }
    </script>
</head>

<body>
<header>
    <nav>
    </nav>
</header>



<section class="container">
    <div>
        <h3>Interfaz de Gestión de Usuarios</h3>
    </div>
    <hr>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Tipo de Usuario</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<hr>

<section class="container">
    <div>
        <form>
            <div class="form-group">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center"><label for="dni">DNI</label></th>
                            <th class="text-center"><label for="Usuario">Usuario</label></th>
                            <th class="text-center"><label for="Contraseña">Contraseña</label></th>
                            <th class="text-center"><label for="Tipo">Tipo de Usuario</label></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><select class="form-control" onchange="getUsuario(this.value);getPassword(this.value);getTipoUsuario(this.value)">
                                    <option selected="selected">Seleccionar</option>
                                    <?php
                                    $query = mysqli_query($link,"SELECT * FROM Colaboradores ORDER BY apellidos");
                                    while($row = mysqli_fetch_array($query)){
                                        echo "<option value='".$row['dni']."'>".$row['apellidos']." ".$row['nombre']." - ".$row['dni']."</option>";
                                    }
                                    ?>
                                </select></td>
                                <td><div id="usuario"><input type="text" class="form-control" name="Usuario" id="Usuario" value="Valor Automático" readonly></div></td>
                                <td><div id="password"><input type="text" class="form-control" name="Contraseña" id="Contraseña" value="Valor Automático" readonly></div></td>
                            <td><select class="form-control" id="tipoUsuario">
                                    <option>Seleccionar</option>
                                </select></td>
                            <td><input type="submit" class="btn btn-success" name="submit" value="Agregar"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<footer class="panel-footer navbar-fixed-bottom">
</footer>
</body>

<?php
/*}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}*/
?>

</html>