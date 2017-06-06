<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	} else {
		$bandera = false;
// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$link = mysqli_connect("gsdynamicscom.ipagemysql.com", "gsdsafeatwork", "6DQ~kTpyHPn+Zs$^","seapp");
// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysqli_real_escape_string($link, $username);
		$password = mysqli_real_escape_string($link, $password);
// Selecting Database
//		$db = mysqli_select_db($link,"seapp");
		mysqli_query($link,"SET NAMES 'utf8'");
// SQL query to fetch information of registered users and finds user match.
		$query = mysqli_query($link,"select * from Colaboradores where password='$password' AND usuario='$username'");
		$rows = mysqli_num_rows($query);
		if ($rows == 1) {
			while($search = mysqli_fetch_array($query)){
				switch($search['idTipoUsuario']){
					case 1:
						$_SESSION['login']=$username; // Initializing Session
						header('Location:http://gsdynamics.com/gsdsafeatwork/mainAdmin.php');
						break;
					case 2:
						$_SESSION['login']=$username; // Initializing Session
						header('Location:http://gsdynamics.com/gsdsafeatwork/mainSupervisor.php');
						break;
					case 3:
						$_SESSION['login']=$username; // Initializing Session
						header('Location:http://gsdynamics.com/gsdsafeatwork/mainSistemas.php');
						break;
					case 4:
						$_SESSION['login']=$username; // Initializing Session
						header('Location:http://gsdynamics.com/gsdsafeatwork/mainRRHH.php');
						break;
				}
			}
		} else {
			$error = "Username or Password is invalid";
		}
		mysqli_close($link); // Closing Connection
	}
}
?>