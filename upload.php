<?php
$save_file = "images/" . basename($_FILES["fileToUpdate"]["name"]);
if (file_exists($save_file)) {
    $fileToUpdateError = "Sorry, file already exists.";
}
else
{
	$imageFileType = pathinfo($save_file,PATHINFO_EXTENSION);
	if(isset($_POST["submit"])) {
		// Allow only images
		if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
		|| $imageFileType == "gif" ) {
			// Upload file
			move_uploaded_file($_FILES["fileToUpdate"]["tmp_name"], $save_file);
		} else {
			$fileToUpdateError = "Only JPG, JPEG, PNG & GIF files are allowed.";
		}
	}
}
?>