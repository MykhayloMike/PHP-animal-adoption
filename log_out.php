<?php 
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

	header("Location: /PHP-animal-adoption/login.php"); /* Re-directing browser to the login page */

	/* Make sure no code is run after re-direct to the login page.*/
	exit;
?>