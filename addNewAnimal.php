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
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$name = '';
		$dob = '';
		$description = '';
		$animalType = '';
		$fileToUpdate = '';
		
		if(isset($_POST['name']))
		{
			$name = $_POST['name'];	
		}
		
		if(isset($_POST['dob']))
		{
			$dob = $_POST['dob'];
		}
		
		if(isset($_POST['description']))
		{
			$description = $_POST['description'];
		}
		
		if(isset($_POST['animalType']))
		{
			$animalType = $_POST['animalType'];
		}
		
		if(isset($_POST['fileToUpdate']))
		{
			$fileToUpdate = $_POST['fileToUpdate'];
		}
	
		// Validation
		if($name == '' || $dob == '' || $description == '' || $animalType == '' || $fileToUpdate == '')
		{
			$nameError;
			$dobError;
			$descriptionError;
			$animalTypeError;
			$fileToUpdateError;
			
			if(($name == '') == 1){				
				$nameError = "Name is mandatory";  
			}
			if(($dob == '') == 1){
				$dobError = "Date of birth is mandatory";
			}
			if(($description == '') == 1){
				$descriptionError = "Description is mandatory";  
			}
			if(($animalType == '') == 1){
				$animalTypeError = "Animal type is mandatory";  
			}
			if(($fileToUpdate == '') == 1){
				$fileToUpdateError = "Photo is mandatory";  
			}
		}
		
		// Add new animal
		 if(isset($_POST['radio']))
		 {
				if ($selected_radio == 'approved') {
					// Add new animal
					$result = mysqli_query($link, "INSERT INTO animal (name, dateofbirth, description, animaltype, photo) VALUES (". $_POST['name'] .", ". $_POST['dob'] .", ". $_POST['description'] .", ". $_POST['animalType'] .", ". $_POST['photo'] . ")");
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
    <title>Add Animal</title>
	<link rel="stylesheet" href="baseguide-master/css/baseguide.min.css">
	<link rel="stylesheet" href="baseguide-master/css/demo.css">
</head>
<body>
	<h1>Add new animal</h1>
	<div id="addAnimalPage" class="container" style="margin-right: 0; margin-left: 0;">
		<section id="request">
			<h2>Request</h2>
			<form action="addNewAnimal.php" method="POST">
					<?php
						if((isset($nameError) && $nameError != ''))
						{
							echo '<div id="nameError" style="color:red">';					
							echo $nameError;					
							echo '</div>';
						}
					?>
					<div class="row">
						<div class="col col-sm-2">
							<label for="name">Name:</label>
						</div>
						<div class="col col-sm-4">
							<input id="name" name="name" type="text" placeholder="Enter first name" value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : ''; ?>">
						</div>
					</div>
					<?php
						if((isset($dobError) && $dobError != ''))
						{
							echo '<div id="dobError" style="color:red">';					
							echo $dobError;					
							echo '</div>';
						}
					?>
					<div class="row">
						<div class="col col-sm-2">
							<label for="dob">Date of birth:</label>
						</div>
						<div class="col col-sm-4">
							<input type="date" id="dob" name="dob" min="1890-01-01" placeholder="Enter DoB" value="<?php echo (isset($_POST['dob'])) ? $_POST['dob'] : ''; ?>">
						</div>
					</div>
					<?php
						if((isset($descriptionError) && $descriptionError != ''))
						{
							echo '<div id="descriptionError" style="color:red">';					
							echo $descriptionError;					
							echo '</div>';
						}
					?>
					<div class="row">
						<div class="col col-sm-2">
							<label for="description">Description:</label>
						</div>
						<div class="col col-sm-4">
							<textarea id="description" name="description" placeholder="Enter comment"><?php echo (isset($_POST['description'])) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
						</div>
					</div>
					<?php
						if((isset($animalTypeError) && $animalTypeError != ''))
						{
							echo '<div id="animalTypeError" style="color:red">';					
							echo $animalTypeError;					
							echo '</div>';
						}
					?>
					<div class="row">
						<div class="col col-sm-2">
							<label for="animalType">Animal type:</label>
						</div>
						<div class="col col-sm-4">
							<input id="animalType" name="animalType" type="text" placeholder="Enter animal type" value="<?php echo (isset($_POST['animalType'])) ? $_POST['animalType'] : ''; ?>">
						</div>
					</div>
					<?php
						if((isset($fileToUpdate) && $fileToUpdate != ''))
						{
							echo '<div id="fileToUpdate" style="color:red">';					
							echo $fileToUpdate;					
							echo '</div>';
						}
					?>
					<div class="row">
						<div class="form-group">
							<div class="col col-sm-2">
								<label for="fileToUpdate">Photo:</label>
							</div>
							<div class="col col-sm-4">
								<input id="fileToUpdate" type="file" name="fileToUpload" value="<?php echo (isset($_POST['fileToUpload'])) ? $_POST['fileToUpload'] : ''; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col col-sm-4">
							<input class="btn" type="submit" name="submit" value="Submit"/>
						</div>					
					</div>
				</form>
		</section>
	</div>
</body>
</html>