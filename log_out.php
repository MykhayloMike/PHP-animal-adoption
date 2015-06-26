<?php 
	session_start();

	session_unset(); 
	session_destroy(); 

	header("Location: /PHP-animal-adoption/login.php"); /* Re-directing browser to the login page */

	/* Make sure no code is run after re-direct to the login page.*/
	exit;
?>