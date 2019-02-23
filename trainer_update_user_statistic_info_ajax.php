<?php
	require 'database.php';

	$email = $_GET['email'];
	$course = $_GET['course'];
	$stamina = $_GET['stamina'];
	$skill = $_GET['skill'];
	$luck = $_GET['luck'];

	$sql = "UPDATE user_statistical_info
			SET stamina='".$stamina."', skill='".$skill."', luck='".$luck."'
			WHERE email='".$email."' and course='".$course."'   ";

	if($conn->query($sql) === TRUE){
		//echo "Successfully created table";
	}else{
		echo "Error creating database: ".$conn->error;
	}

?>