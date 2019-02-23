<?php
/*
echo $row["course"].'<br>';
echo $row["type_1"].'<br>';
echo $row["type_2"].'<br>';
echo $row["type_3"].'<br>';
echo $row["type_4"].'<br>';
echo $row["type_5"].'<br>';

$sql = "INSERT INTO course (course, course_image, type_1, type_2, type_3, type_4, type_5)
		VALUES ('Swimming','Image/swimming.jpg','Free styles','Breast stroke','Back stroke','Overarm stroke','Butterfly stroke')";

if($conn->query($sql) === TRUE){
	//echo "Successfully created table";
}else{
	echo "Error creating temp_database: ".$conn->error;
}
*/
	$GLOBALS['course_data'] = [];

	//Retrieve course temp_data and pass to $data
	$sql = "SELECT * FROM course";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$course_temp_data['course'] = $row['course'];
			$course_temp_data['course_image'] = $row['course_image'];
			$course_temp_data['type_1'] = $row['type_1'];
			$course_temp_data['type_2'] = $row['type_2'];
			$course_temp_data['type_3'] = $row['type_3'];
			$course_temp_data['type_4'] = $row['type_4'];
			$course_temp_data['type_5'] = $row['type_5'];
			$course_temp_data['type_6'] = $row['type_6'];
			$course_temp_data['type_7'] = $row['type_7'];
			$course_temp_data['type_8'] = $row['type_8'];
			$course_temp_data['type_9'] = $row['type_9'];
			$course_temp_data['type_10'] = $row['type_10'];
			array_push($GLOBALS['course_data'], $course_temp_data);
		}
	}

	//print_r($GLOBALS['data']);
	//echo sizeof($GLOBALS['data']);
	//print_r($GLOBALS['data'][0]);
	
	function dynamic_course(){
		for($i=0; $i < sizeof($GLOBALS['course_data']); $i++){
			//end
			if($i != 0 && $i % 3 == 0){
				echo '</div>';
				//echo 'end: '.$i;
			}
			//start
			if($i % 3 == 0){
				echo '<div class="course_positioning_container">';
				//echo 'start: '.$i;
			}
			
			echo'<!--'.$GLOBALS['course_data'][$i]['course'].'-->
				<div class="course_image_container">
					<div class="course_image">
						<!--image-->
						<img src='.$GLOBALS['course_data'][$i]['course_image'].'>
					</div>
					<div class="course_details">
						<!--title-->
						<h1 class="course_name">'.$GLOBALS['course_data'][$i]['course'].'</h1>
						<!--types-->
						<span class="course_type_ajax"></span>
					</div>
					<div class="add_new_type">
						<input type="text" name="new_type" placeholder="New course..." class="new_course_type_input">
						<button class="add_new_type_button">Add</button>
					</div>
				</div>';
			}
		echo '</div>';
	}
?>