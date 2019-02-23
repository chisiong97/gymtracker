<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="trainer.js"></script>
</head>
<body>

<?php
	
	require 'database.php';

	$GLOBALS['new_course_data'] = [];
	$course_name = $_GET['course_name'];
	$course_type = $_GET['course_type'];
	$type_index = 1;

	//Get type index
	$sql = "SELECT * FROM course
			WHERE course='".$course_name."' ";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$new_course_temp_data['course'] = $row['course'];
			$new_course_temp_data['course_image'] = $row['course_image'];
			$new_course_temp_data['type_1'] = $row['type_1'];
			$new_course_temp_data['type_2'] = $row['type_2'];
			$new_course_temp_data['type_3'] = $row['type_3'];
			$new_course_temp_data['type_4'] = $row['type_4'];
			$new_course_temp_data['type_5'] = $row['type_5'];
			$new_course_temp_data['type_6'] = $row['type_6'];
			$new_course_temp_data['type_7'] = $row['type_7'];
			$new_course_temp_data['type_8'] = $row['type_8'];
			$new_course_temp_data['type_9'] = $row['type_9'];
			$new_course_temp_data['type_10'] = $row['type_10'];
			
			array_push($GLOBALS['new_course_data'], $new_course_temp_data);
		}
	}
	
	foreach ($GLOBALS['new_course_data'][0] as $key => $value) {
		if($value != null && strpos($key, 'type_') !== false){
			$type_index++;
		}
	}


	//print_r($GLOBALS['new_course_data']);
	//echo sizeof($GLOBALS['new_course_data']);
	//print_r($GLOBALS['new_course_data'][0]);

	//Update data
	$course_name = $_GET['course_name'];
	$course_type = $_GET['course_type'];

	//Retrieve data and display it
	$sql = "UPDATE course
			SET type_".$type_index."='".$course_type."'
			WHERE course='".$course_name."' ";
	
	if($conn->query($sql) === TRUE){
		//echo "Successfully created table";
	}else{
		echo $conn->error.'<br>';
	}




	$GLOBALS['new_course_data'] = [];
	$course_name = $_GET['course_name'];

	//Retrieve data and display it
	$sql = "SELECT * FROM course
			WHERE course='".$course_name."' ";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$new_course_temp_data['course'] = $row['course'];
			$new_course_temp_data['course_image'] = $row['course_image'];
			$new_course_temp_data['type_1'] = $row['type_1'];
			$new_course_temp_data['type_2'] = $row['type_2'];
			$new_course_temp_data['type_3'] = $row['type_3'];
			$new_course_temp_data['type_4'] = $row['type_4'];
			$new_course_temp_data['type_5'] = $row['type_5'];
			$new_course_temp_data['type_6'] = $row['type_6'];
			$new_course_temp_data['type_7'] = $row['type_7'];
			$new_course_temp_data['type_8'] = $row['type_8'];
			$new_course_temp_data['type_9'] = $row['type_9'];
			$new_course_temp_data['type_10'] = $row['type_10'];
			
			array_push($GLOBALS['new_course_data'], $new_course_temp_data);
		}
	}
	
	foreach($GLOBALS['new_course_data'][0] as $key => $value){
		if($value != null && strpos($key, 'type_') !== false){
			echo '<li class="course_type_list"><i class="fa fa-minus" title="Remove"></i>'.$value.'</li>';
		}
	}

?>



</body>
</html>