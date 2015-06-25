<?php
// Check session
session_start();

if (!isset($_SESSION['user_type']))
{
	// Redirect to log in page
	header("Location: login.php");
}
else if($_SESSION['user_type'] == "staff")
{
	// Redirect to staff homepage page
	header("Location: staffhomepage.php");
}

if($_SERVER['REQUEST_METHOD'] === 'GET')
{
	// Connection to database
	include ("db_connect.php"); 
}
?>
<!DOCTYPE html>	
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>User Home page</title>
	<link rel="stylesheet" href="baseguide-master/css/baseguide.min.css">
	<link rel="stylesheet" href="baseguide-master/css/demo.css">
</head>
<body>
<section id="userSection"  class="container">
	<nav>
		<ul class="list-equal">
			<li>Home page</li>
			<li><a href="/PHP-animal-adoption/userAvailableAdoptionPage.php">Animals available for adoption</a></li>
			<li><a href="/PHP-animal-adoption/userAdoptionRequests.php">Adoption Requests</a></li>
			<li><a href="#"></a></li>
			<li><a href="/PHP-animal-adoption/log_out.php">Log out</a></li>
		</ul>
	</nav>
	<h1>Home page</h1>
	<div id="userHomePage" class="container" style="margin-right: 0; margin-left: 0;">
		<section id="userAnimals">
			<h2>Your animals:</h2>
			
				<?php
				// Users adopted animals
				$result = mysqli_query($link, "SELECT * FROM animal WHERE available = 1");
				
					echo "<table class='table'>
						   <tr>
						   <th>Animal Name</th>
						   <th>Date of Birth</th>
						   <th>Photos</th>
						   <th>Description</th>
						   <th>Animal type</th></tr>";
					foreach($result as $row) {							
						$row['dateofbirth'] = date("Y-m-d");
						echo "<tr>";
						echo '<td>' . $row['name'] . "</td>";
						echo '<td>' . $row['dateofbirth'] . "</td>";
						echo '<td><img src = "images/' . $row['photo'] . "\" style=\"width: 150px; height: 90px;\"></td>";
						echo '<td>' . $row['description'] . "</td>";
						echo '<td>' . $row['animalType'] . "</td>";
						echo "</tr>";
					}
					echo "</table>";
				?>
			
		</section>
		<section id="adoptionRequest">
			<h2>Your adoption requests:</h2>
			
				<?php
				// Users adoption request
				$result = mysqli_query($link, 'SELECT * FROM animal a, own o WHERE a.animalId = o.animalId and o.userId = ' . $_SESSION['user']);
				
					echo "<table class='table'>
						   <tr>
						   <th>Animal Name</th>
						   <th>Animal DOB</th>
						   </tr>";
					foreach($result as $row) {							
						$row['dateofbirth'] = date("Y-m-d");
						echo "<tr>";
						echo '<td>' . $row['name'] . "</td>";
						echo '<td>' . $row['dateofbirth'] . "</td>";
						echo "</tr>";
					}
					echo "</table>";
				?>

		</section>
	</div>
</section>
</body>
</html>