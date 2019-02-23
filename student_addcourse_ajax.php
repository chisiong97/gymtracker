<?php
	session_start();
	require 'database.php';
	
	$course_chosen = $_GET['course_chosen'];
	$dateInput = $_GET['dateInput'];
	
	$sql = "INSERT INTO user_statistical_info (email, course, stamina, skill, luck, time_spent,date)
			VALUES ('".$_SESSION[email]."', '".$course_chosen."', '0', '0', '0','0','".$dateInput."')";
	
	$conn->query($sql);
?>