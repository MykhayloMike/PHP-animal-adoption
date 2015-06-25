<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Start session
	if(session_status() == PHP_SESSION_NONE)
	{
		session_start();
	}
	
	// Connection to database
	include ("db_connect.php"); 
	
	$username = $_POST['username'];
	$password = $_POST['pass'];
	
	// Validation
	if($username == '' || $password == '')
	{
		if(isset($username) && $username == ''){
			$usernameError = "Username is mandatory";  
		}
		if(isset($password) && $password == ''){
			$passwordError = "Password is mandatory";
		}
	}

	if($username != '' && $password != '')
	{
		$sql = "SELECT * FROM user WHERE userId = '". $username . "' AND password = '". $password . "'";
		$res = mysqli_query($link, $sql);
		
		if(mysqli_num_rows($res) == 1)
		{			
			$firstrow = mysqli_fetch_assoc($res);
			$url_redirect;
			if($firstrow["staff"] == "1")
			{
				$_SESSION['user_type']= 'staff';
				// Set staff page
				$url_redirect = "Location: staffhomepage.php";
			}
			else
			{
				$_SESSION['user_type']= 'user';
				// Set user page
				$url_redirect = "Location: userHomePage.php";
			}
				
				// Set user ID
				$_SESSION['user'] = $firstrow["userId"];
				
				// Redirect to user type page
				header($url_redirect);
				exit();
		}
		else
		{
			$loginError = "Your log in has failed!";
		}
	}
}
?>

<!DOCTYPE html>	
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style>
		#loginText {
		text-align: center ;
  		}
		.loginBlock {
		position: relative;
		left: 15px;
		}
		#LoginError {
		color: red;
		}
		#userError {
		color: red;
		}
		#passError {
		color: red;
		}

	</style>
    <meta charset="utf-8" />
    <title>PHP Log in page</title>
	<link rel="stylesheet" href="baseguide-master/css/baseguide.min.css">
	<link rel="stylesheet" href="baseguide-master/css/demo.css">
</head>
<body>
	<h1 id ="loginText">Login</h1>
	<form action="login.php" method="POST">
		<div id="LoginError">
				<?php
					echo ((isset($loginError) && $loginError != '') ? $loginError : '');
				?>
		</div>
		<div class="loginBlock">
			<div class="row form-group">
				<div id="userError">
					<?php
						echo ((isset($usernameError) && $usernameError != '') ? $usernameError : '');
					?>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-sm-2">
					<label for="username">Username:</label>
				</div>
				<div class="col-sm-4">
					<input id="username" name="username" type="text" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''; ?>">
				</div>
			</div>
			<div class="row form-group">
				<div id="passError">
					<?php
						echo ((isset($passwordError) && $passwordError != '') ? $passwordError : '');
					?>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-sm-2">
					<label for="pass">Password:</label>
				</div>
				<div class="col-sm-4">
					<input id="pass" name="pass" type="password">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<input class="btn" type="submit" name="submit" value="Log in"/>
				</div>
			</div>
		</div>		
	</form>
</body>
</html>