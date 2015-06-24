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

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['animalId']))
{
	// Connection to database
	include ("db_connect.php"); 

		$sql = "SELECT * FROM animal WHERE animalId = ". $_GET['animalId'] . " AND available = 1";
		$res = mysqli_query($link, $sql);
		
		if(mysqli_num_rows($res) >= 0)
		{			
			// Add new user
			$result = mysqli_query($link, "UPDATE animal SET available = 0 WHERE animalId = ". $_GET['animalId']);
			$resultAdopt = mysqli_query($link, "INSERT INTO adoptionrequest (userID, animalID) VALUES (". $_SESSION['user'] .", ". $_GET['animalId'] .")");
			header("Location: userAvailableAdoptionPage.php");
			exit();
		}
		else
		{
			// Validation animal exists
			$animalError = "Following animal not available for adoption.";
		}
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
    <title>Adoption page</title>
	<link rel="stylesheet" href="baseguide-master/css/baseguide.min.css">
	<link rel="stylesheet" href="baseguide-master/css/demo.css">
</head>
<body>
<section id="userSection"  class="container">
	<nav>
		<ul class="list-equal">
			<li><a href="/coursework/userHomePage.php">Home page</a></li>
			<li>Animals available for adoption</li>
			<li><a href="/coursework/userAdoptionRequests.php">Adoption Requests</a></li>
			<li><a href="#"></a></li>
			<li><a href="/coursework/log_out.php">Log out</a></li>
		</ul>
	</nav>
	<h1>Adoption page</h1>
	<div id="userAvailableAdoptionPage" class="container">
		<section id="availableAdoption">
			<h2>Available adoptions:</h2>
				<?php
						if((isset($animalError) && $animalError != ''))
						{
							echo '<div id="animalError" style="color:red">';					
							echo $animalError;					
							echo '</div>';
						}
				?>
				<?php
				// Users adoption request
				$result = mysqli_query($link, 'SELECT a.animalId, a.name, a.dateofbirth, a.photo FROM animal a WHERE a.available = 1');
				
					echo "<table class='table'>
						   <tr>
						   <th>Animal Name</th>
						   <th>Animal DOB</th>
						   <th>Photo</th>
						   <th></th>
						   </tr>";
					foreach($result as $row) {					
						$adoptUrl = '/coursework/userAvailableAdoptionPage.php?animalId=' . $row['animalId'];					
						$row['dateofbirth'] = date("Y-m-d");
						echo "<tr>";
						echo '<td>' . $row['name'] . "</td>";
						echo '<td>' . $row['dateofbirth'] . "</td>";
						echo '<td>' . $row['dateofbirth'] . "</td>";
						echo '<td>' . "<a href='". $adoptUrl ."'>Adopt</a>" . "</td>";
						echo "</tr>";
					}
					echo "</table>";
				?>
		</section>
	</div>
</section>
</body>
</html>