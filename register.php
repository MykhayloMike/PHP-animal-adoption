<?php
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	// Start session
	if(session_status() == PHP_SESSION_NONE)
	{
		session_start();
	}
	
	// Connection to database
	include ("db_connect.php"); 
	
	$username = '';
	$password = '';
	$passwordagain = '';
	
	if(isset($_POST['username']))
	{
		$username = $_POST['username'];
	}
	if(isset($_POST['pass']))
	{
		$password = $_POST['pass'];
	}
	if(isset($_POST['passAgain']))
	{
		$passwordagain = $_POST['passAgain'];
	}
	
	// Validation
	if($username == '' || $password == '' || $passwordagain == '')
	{
		if($username == ''){
			$usernameError = "Username field is mandatory";  
		}
		if($password == ''){
			$passwordError = "Password field is mandatory";
		}
		if($passwordagain == ''){
			$passwordAgainError = "Re enter Password filed is mandatory";
		}
	} else if(($password == $passwordagain) == 0)
	{
		// Validation matching password
		$passwordError = "Your password didn't match";
	}
	else
	{
		$sql = "SELECT * FROM user WHERE userId = '". $username . "' AND password = '". $password . "'";
		$res = mysqli_query($link, $sql);
		
		if(mysqli_num_rows($res) == 0)
		{			
			// Add new user
			$result = mysqli_query($link, "INSERT INTO user (userId, staff, password) VALUES ('" . $username . "', 0, '". $password ."')");
			header("Location: userhomepage.php");
			exit();
		}
		else
		{
			// Validation User exists
			$usernameError = "Following username already exists";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Register page</title>
	<link rel="stylesheet" href="baseguide-master/css/baseguide.min.css">
</head>
<body>
	<section class="container">
	<h1>Register</h1>
		<form action="register.php" method="POST">
			<div>
				<?php
						if((isset($usernameError) && $usernameError != ''))
						{
							echo '<div id="usernameError" style="color:red">';					
							echo $usernameError;					
							echo '</div>';
						}
				?>
				<div class="row form-group">
					<div class="col-sm-2">
						<label for="username">Username:</label>
					</div>
					<div class="col-sm-4">
						<input id="username" name="username" type="text" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''; ?>">
					</div>
				</div>
				<?php
						if((isset($passwordError) && $passwordError != ''))
						{
							echo '<div id="passwordError" style="color:red">';					
							echo $passwordError;					
							echo '</div>';
						}
				?>
				<div class="row form-group">
					<div class="col-sm-2">
						<label for="pass">Password:</label>
					</div>
					<div class="col-sm-4">
						<input id="pass" name="pass" type="password">
					</div>
				</div>
				<?php
						if((isset($passwordAgainError) && $passwordAgainError != ''))
						{
							echo '<div id="passwordAgainError" style="color:red">';					
							echo $passwordAgainError;					
							echo '</div>';
						}
				?>
				<div class="row form-group">
					<div class="col-sm-2">
						<label for="passAgain">Re enter Password:</label>
					</div>
					<div class="col-sm-4">
						<input id="passAgain" name="passAgain" type="password">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4 col-sm-offset-2">
						<a class="btn-secondary" href="login.php" role="button">Log in</a>
						<input class="btn" type="submit" name="submit" value="Register"/>
					</div>
				</div>			
			</div>	
		</form>
	</section>
</body>
</html>