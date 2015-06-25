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
    <title>Adoption requests page</title>
	<link rel="stylesheet" href="baseguide-master/css/baseguide.min.css">
	<link rel="stylesheet" href="baseguide-master/css/demo.css">
</head>
<body>
<section id="userSection"  class="container">
	<nav>
		<ul class="list-equal">
			<li><a href="/PHP-animal-adoption/userHomePage.php">Home page</a></li>
			<li><a href="/PHP-animal-adoption/userAvailableAdoptionPage.php">Animals available for adoption</a></li>
			<li>Adoption Requests</li>
			<li><a href="#"></a></li>
			<li><a href="/PHP-animal-adoption/log_out.php">Log out</a></li>
		</ul>
	</nav>
	<h1>Adoption requests page</h1>
	<div id="userAvailableAdoptionPage" class="container">
		<section id="availableAdoption">
			<h2>Your adoption requests:</h2>
				<?php
				// Users adoption request
				$result = mysqli_query($link, 'SELECT a.name, a.dateofbirth, a.description, a.animalType, a.photo, a.available FROM animal a, adoptionrequest r WHERE a.animalId = r.animalID and r.userID = ' . $_SESSION['user']);
				$numOfRows = mysqli_num_rows($result);

					echo "<table class='table'>
						   <tr>
						   <th>Animal Name</th>
						   <th>Animal DOB</th>
						   <th>Photo</th>
						   <th></th>
						   </tr>";
					if($numOfRows >= 1)
					{
						foreach($result as $row) {									
							$row['dateofbirth'] = date("Y-m-d");
							echo "<tr>";
							echo '<td>' . $row['name'] . "</td>";
							echo '<td>' . $row['dateofbirth'] . "</td>";
							echo '<td>' . $row['dateofbirth'] . "</td>";
							echo '<td>';
							if(isset($_POST['animalId']) && ($_POST['animalId'] == 1))
							{
								echo "Approved";
							}
							else if(isset($_POST['animalId']) && ($_POST['animalId'] == 0))
							{
								echo "Declined";
							}
							else if(isset($_POST['animalId']) && ($_POST['animalId'] == null))
							{
								echo "Pending";
							}
							echo "</td>";
							echo "</tr>";
						}
					}
					echo "</table>";
				?>
		</section>
	</div>
</section>
</body>
</html>