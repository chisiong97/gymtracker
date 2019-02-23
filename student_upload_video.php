<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
	require 'database.php';
	
	$email = $_GET['email'];
	$course = $_GET['course'];
	$video = $_GET['video'];
	$target_dir = 'Upload/';

	//Unique file name
	$unique_file_name = $email.'_'.$course.'.mp4';
	
	ini_set('memory_limit', '1024M');
	$data = file_get_contents('Image/'.$video);

	file_put_contents($target_dir.$unique_file_name, $data);


	//Save path into database
	$sql = "UPDATE user_statistical_info
			SET video='".$target_dir.$unique_file_name."'
			WHERE email='".$email."' ";

	if($conn->query($sql) === TRUE){
		//Successfully saved path
	}

?>



</body>
</html>