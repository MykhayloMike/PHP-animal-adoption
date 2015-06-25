<?php
	// Check session
	session_start();
	
	if (!isset($_SESSION['user_type']))
	{
		// Redirect to log in page
		header("Location: login.php");
	}
	else if($_SESSION['user_type'] == "user")
	{
		// Redirect to user homepage page
		header("Location: userhomepage.php");
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
    <title>Staff Home page</title>
	<link rel="stylesheet" href="baseguide-master/css/baseguide.min.css">
	<link rel="stylesheet" href="baseguide-master/css/demo.css">
</head>
<body>
<section id="staffSection" class="container">
	<nav>
		<ul class="list-equal">
			<li>Home</li>
			<li><a href="/PHP-animal-adoption/addNewAnimal.php">Add Animal</a></li>
			<li><a href="/PHP-animal-adoption/.php">Adoption Requests</a></li>
			<li><a href="#"></a></li>
			<li><a href="/PHP-animal-adoption/.php">Log out</a></li>
		</ul>
	</nav>
	<h1>Home page</h1>
	<div id="staffHomePage" class="container" style="margin-right: 0; margin-left: 0;">
		<section id="forAdoption">
			<h2>Animals available for adoption:</h2>
			
				<?php
				// Animals available for adoption
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
			<h2>Pending adoption requests:</h2>
			
				<?php
				// Animals available for adoption
				$result = mysqli_query($link, "SELECT a.name, a.dateofbirth, r.userID, r.adoptionID
												FROM adoptionrequest r, animal a
												WHERE r.animalID = a.animalId
												and r.approved IS NULL");
				
					echo "<table class='table'>
						   <tr>
						   <th>User ID</th>
						   <th>Animal Name</th>
						   <th>Animal DOB</th>
						   <th></th>
						   <th></th></tr>";
					foreach($result as $row) {							
						$row['dateofbirth'] = date("Y-m-d");
						$approveUrl = '/coursework/approveAnimal.php?adoptionId=' . $row['adoptionID'];
						$declineUrl = '/coursework/declineAnimal.php?adoptionId=' . $row['adoptionID'];
						echo "<tr>";
						echo '<td>' . $row['userID'] . "</td>";
						echo '<td>' . $row['name'] . "</td>";
						echo '<td>' . $row['dateofbirth'] . "</td>";
						echo '<td>' . "<a href='". $approveUrl ."'>Approve</a>" . "</td>";
						echo '<td>' . "<a href='". $declineUrl ."'>Decline</a>" . "</td>";
						echo "</tr>";
					}
					echo "</table>";
				?>

		</section>
	</div>
</section>
</body>
</html>