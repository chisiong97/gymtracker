<?php
	session_start();
	require 'database.php';

	$course = $_GET['course'];
	$email = $_SESSION['email'];

	$sql = "DELETE FROM user_statistical_info
			WHERE course='".$course."' AND email='".$email."' ";
	
	if($conn->query($sql) === TRUE){
		echo '<script> console.log("Successfully created database"); </script>';
	}



?>