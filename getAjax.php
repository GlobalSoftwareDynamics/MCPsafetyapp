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
//}
?>