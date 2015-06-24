<?php 
	// Tester Toster Vova
	// Connection to database code
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "angusdata";

	$usernameError = "";
	$passwordError = "";
	$loginError = "";
	
	$link = mysqli_connect($host, $user, $pass, $db);
	if (!$link)
         {
            die('Could not connect: ' . mysql_error());
         }
	
	mysqli_select_db($link, $db);
?>
