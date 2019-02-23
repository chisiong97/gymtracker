<?php
	require 'database.php';

	$GLOBALS['unique_file_name'] = null;
	$GLOBALS['confirm_password_message'] = null;
	$GLOBALS['user_image_message'] = null;
	$register_message = null;

	function validate_password_and_confirm_password(){
		if($_POST['register_password'] !=  $_POST['register_confirm_password']){
			$GLOBALS['confirm_password_message']  = "Confirm password and password not same";
			return false;
		}
		return true;
	}

	function validate_image(){
		//User image
		$name = $_FILES['register_user_image']['name'];
		//Set default image if user not going upload own image
		if(!$_FILES['register_user_image']['name']){
			$name = 'default_user_image.jpg';
		}
		$target_dir = 'Upload/';
		$target_file = $target_dir.basename($_FILES['register_user_image']['name']);
	
		//Select file type
		$image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		//Available file extensions
		$available_file_types = ['jpg','jpeg','png'];
		//Validate file type
		if(in_array($image_file_type, $available_file_types)){
			//Unique the file name
			$GLOBALS['unique_file_name'] = 'Upload/'.$_POST['register_email'].'_profile_picture.jpg';
			//Save image to 'upload' folder
  			move_uploaded_file($_FILES['register_user_image']['tmp_name'], $GLOBALS['unique_file_name']);
			return $GLOBALS['unique_file_name'];
		}else if($name == 'default_user_image.jpg'){
			return $target_dir.'default_user_image.jpg';
		}else if(!in_array($image_file_type, $available_file_types)){
			$GLOBALS['user_image_message'] = "File is NOT an image";
			return false;
		}
	}

	//Get data
	if(isset($_POST['register_submit'])){
		$email = $_POST['register_email'];
		$username = $_POST['register_username'];
		$password = $_POST['register_confirm_password'];
		$position = $_POST['register_position'];
		$image_name = validate_image();

		//Store data into database
		if(validate_password_and_confirm_password() == true && validate_image() != false){
			$sql = "INSERT INTO user_account (email,username,password,position,profile_picture)
					VALUES ('$email','$username','$password','$position','$image_name')";

			if($conn->query($sql) == true){
				$register_message = "Successfully registered";
			}else{
				$register_message = "$email occupied, Please change a new Email";
			}
		}
	}
?>