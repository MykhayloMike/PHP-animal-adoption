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
			<li><a href="/PHP-animal-adoption/StaffHomePage.php">Home</a></li>
			<li><a href="/PHP-animal-adoption/addNewAnimal.php">Add Animal</a></li>
			<li>Adoption Requests</li>
			<li><a href="/PHP-animal-adoption/staffAllAnimals.php">All Animals</a></li>
			<li><a href="/PHP-animal-adoption/log_out.php">Log out</a></li>
		</ul>
	</nav>
	<h1>Home page</h1>
	<div id="staffAllRequests" class="container" style="margin-right: 0; margin-left: 0;">
		<section id="adoptionRequest">
			<h2>All Adoption requests:</h2>			
				<?php
				// Animals available for adoption
				$result = mysqli_query($link, "SELECT a.name, a.dateofbirth, r.userID, r.approved
												FROM adoptionrequest r, animal a
												WHERE r.animalID = a.animalId");
				
					echo "<table class='table'>
						   <tr>
						   <th>User ID</th>
						   <th>Animal Name</th>
						   <th>Animal DOB</th>
						   <th>Status</th></tr>";
					foreach($result as $row) {							
						$row['dateofbirth'] = date("Y-m-d");						
						echo "<tr>";
						echo '<td>' . $row['userID'] . "</td>";
						echo '<td>' . $row['name'] . "</td>";
						echo '<td>' . $row['dateofbirth'] . "</td>";
						echo '<td>';
						if($row['approved'] == '1')
						{echo "Approved";} 
						else if($row['approved'] == '0')
						{echo "Declined";} 
						else
						{echo "Pending";}
						echo "</td>";
						echo "</tr>";
					}
					echo "</table>";
				?>

		</section>
	</div>
</section>
</body>
</html>