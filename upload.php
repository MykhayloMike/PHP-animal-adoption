<?php
$save_file = "images/" . basename($_FILES["fileToUpdate"]["name"]);
if (file_exists($save_file)) {
    $fileToUpdateError = "Sorry, file already exists.";
}
else
{
	$imageFileType = pathinfo($save_file,PATHINFO_EXTENSION);
	// Check if image file
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpdate"]["tmp_name"]);
		if($check !== false) {		
			exit();		
			// Upload file
			move_uploaded_file($_FILES["fileToUpdate"]["tmp_name"], $save_file);
		} else {
			$fileToUpdateError = "File is not an image.";
		}
	}
}
?>