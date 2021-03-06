<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "web_db";

	//Connect to server
	$conn = new mysqli($servername, $username, $password);

	//Create database if not exists
	$sql = "CREATE DATABASE IF NOT EXISTS ".$database;

	if($conn->query($sql) === TRUE){
		echo '<script> console.log("Successfully created database"); </script>';
	}else{
		echo '<script> console.log("Error creating database: ".$conn->error"); </script>';
	}

	//Connect to database
	$conn = new mysqli($servername, $username, $password, $database);

	//Create user_account table if not exists
	$sql = "CREATE TABLE IF NOT EXISTS user_account(
			email VARCHAR(50) NOT NULL PRIMARY KEY,
			username VARCHAR(50) NOT NULL,
			password VARCHAR(50) NOT NULL,
			position VARCHAR(50) NOT NULL,
			profile_picture VARCHAR(100) NULL )";

	if($conn->query($sql) === TRUE){
		//echo "Successfully created table";
	}else{
		echo "Error creating database: ".$conn->error;
	}

	//Create course table if not exists
	$sql = "CREATE TABLE IF NOT EXISTS course(
			id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			course VARCHAR(50) NOT NULL,
			course_image VARCHAR(50),
			type_1 VARCHAR(50),
			type_2 VARCHAR(50),
			type_3 VARCHAR(50),
			type_4 VARCHAR(50),
			type_5 VARCHAR(50),
			type_6 VARCHAR(50),
			type_7 VARCHAR(50),
			type_8 VARCHAR(50),
			type_9 VARCHAR(50),
			type_10 VARCHAR(50)
			)";

	if($conn->query($sql) === TRUE){
		//echo "Successfully created table";
	}else{
		echo "Error creating database: ".$conn->error;
	}

	//Create user_statistical_info to statistics data
	$sql = "CREATE TABLE IF NOT EXISTS user_statistical_info(
			email VARCHAR(50) NOT NULL,
			course VARCHAR(50),
			stamina INT,
			skill INT,
			luck INT,
			video VARCHAR(50),
			time_spent INT,
			date INT)";

	if($conn->query($sql) === TRUE){
		//echo "Successfully created table";
	}else{
		echo "Error creating database: ".$conn->error;
	}

?>