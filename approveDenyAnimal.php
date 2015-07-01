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
	
	// Connection to database
	include ("db_connect.php"); 
	
	if (isset($_POST['approve'])) {
			  if(isset($_POST['radio']))
			  {
					$selected_radio = $_POST['radio'];

					if ($selected_radio == 'approved') {
						// Update adoption request
						$result = mysqli_query($link, "UPDATE adoptionrequest SET approved = 1 WHERE adoptionID = ". $_POST['adoptionID']);
						$result = mysqli_query($link, "INSERT INTO own (userId, animalId) VALUES (". $_POST['userID'] .", ". $_POST['animalId'] .")");
						header("Location: staffhomepage.php");
						exit();
					}
					else if ($selected_radio == 'declined') {
						// Update adoption request
						$result = mysqli_query($link, "UPDATE animal SET available = 1 WHERE animalId = ". $_POST['animalId']);
						$result = mysqli_query($link, "UPDATE adoptionrequest SET approved = 0 WHERE adoptionID = ". $_POST['adoptionID']);
						header("Location: staffhomepage.php");
						exit();
					}
			  }
}
?>
<!DOCTYPE html>	
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Approve request</title>
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
			<li><a href="/PHP-animal-adoption/staffAllRequests.php">All Animals</a></li>
			<li><a href="/PHP-animal-adoption/log_out.php">Log out</a></li>
		</ul>
	</nav>
	<h1>Approve request</h1>
	<div id="approveRequestPage" class="container" style="margin-right: 0; margin-left: 0;">
		<section id="request">
			<h2>Request</h2>
			<form action="approveDenyAnimal.php" method="POST">					
					<?php				
					if(isset($_GET['adoptionId']))
					{
						// Request
						$result = mysqli_query($link, "SELECT a.name, a.dateofbirth,a.animalType, a.photo, a.animalId, r.userID, r.adoptionID
														FROM adoptionrequest r, animal a
														WHERE r.animalID = a.animalId
														and r.adoptionID = ". $_GET['adoptionId']);
						$firstrow = mysqli_fetch_assoc($result);
						$firstrow['dateofbirth'] = date("Y-m-d");
					}
					else
					{
						if($_SERVER['REQUEST_METHOD'] === 'POST')
						{
							// Redirect to Staff page
							header("Location: staffhomepage.php");
							exit();
						}
					}
					?>
					<input type="hidden" name="adoptionID" value="<?php if(isset($firstrow['adoptionID'])) echo $firstrow['adoptionID']; ?>">
					<input type="hidden" name="userID" value="<?php if(isset($firstrow['userID'])) echo $firstrow['userID']; ?>">
					<input type="hidden" name="animalId" value="<?php if(isset($firstrow['animalId'])) echo $firstrow['animalId']; ?>">
					<div class="row">
						<div class="col col-sm-4"><span>User:</span></div>
						<div class="col col-sm-4"><span><?php if(isset($firstrow['userID'])) echo $firstrow['userID']; ?></span></div>
					</div>
					<div class="row">
						<div class="col col-sm-4"><span>Animal name:</span></div>
						<div class="col col-sm-4"><span><?php if(isset($firstrow['name'])) echo $firstrow['name']; ?></span></div>
					</div>
					<div class="row">
						<div class="col col-sm-4"><span>Date of birth:</span></div>
						<div class="col col-sm-4"><span><?php if(isset($firstrow['dateofbirth'])) echo $firstrow['dateofbirth']; ?></span></div>
					</div>
					<div class="row">
						<div class="col col-sm-4"><span>Animal type:</span></div>
						<div class="col col-sm-4"><span><?php if(isset($firstrow['animalType'])) echo $firstrow['animalType']; ?></span></div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col col-sm-4">
								<div class="radio">
									<input id="approve" type="radio" name="radio" value="approved">
									<label for="approve">Approve</label>
								</div>
							</div>
							<div class="col col-sm-4">
								<div class="radio">
									<input id="decline" type="radio" name="radio" value="declined">
									<label for="decline">Decline</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col col-sm-4">
							<input class="btn" type="submit" name="approve" value="Submit"/>
						</div>					
					</div>
				</form>
		</section>
	</div>
</section>
</body>
</html>