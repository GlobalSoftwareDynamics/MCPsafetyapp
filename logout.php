<?php
session_start();
session_unset();
if(session_destroy()) // Destroying All Sessions
{
	header('Location:http://gsdynamics.com/gsdsafeatwork/index.php'); // Redirecting To Home Page
}
?>