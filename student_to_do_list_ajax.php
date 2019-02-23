<?php
	session_start();
	require 'database.php';

	$course = $_GET['course'];
	$email = $_SESSION['email'];
	$temp_time_spent = 0;

	$sql = "SELECT course, time_spent FROM user_statistical_info
			WHERE email='".$email."' AND course='".$course."' ";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			//echo $row['course'].' '.$row['time_spent'];
			$temp_time_spent = $row['time_spent'];
		}
	}

	$temp_time_spent += 2;
	//echo $temp_time_spent;

	$sql = "UPDATE user_statistical_info
			SET time_spent='".$temp_time_spent."'
			WHERE email='".$email."' ";

	if($conn->query($sql) === TRUE){
		//echo "Successfully created table";
	}
	
?>