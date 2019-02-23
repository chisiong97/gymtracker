<?php
	$GLOBALS['student_data'] = [];

	//Retrieve data from user_statistical_info
	$sql = "SELECT * FROM user_statistical_info";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$student_temp_data['email'] = $row['email'];
			$student_temp_data['course'] = $row['course'];
			$student_temp_data['stamina'] = $row['stamina'];
			$student_temp_data['skill'] = $row['skill'];
			$student_temp_data['luck'] = $row['luck'];
			$student_temp_data['video'] = $row['video'];

			array_push($GLOBALS['student_data'], $student_temp_data);
		}
	}

	//Student name
	$GLOBALS['student_name'] = [];

	$sql = "SELECT user_account.username
			FROM user_account
			INNER JOIN user_statistical_info ON user_account.email = user_statistical_info.email";
	
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			array_push($GLOBALS['student_name'], $row['username']);
		}
	}

	//print_r($GLOBALS['student_name']);


	function dynamic_student(){
		$num_student_enrolled = 0;

		for($i=0; $i < sizeof($GLOBALS['student_data']); $i++){
			if($GLOBALS['student_data'][$i]['course'] != null){
				echo '<div class="student_content">
					<h1 class="track_email">'.$GLOBALS['student_data'][$i]['email'].'</h1>
					<div class="upper_container">
						'.$GLOBALS['student_data'][$i]['course'].'
					</div>
					<div class="middle_container">
						<!--student profile-->
						<div class="student_profile_container">
							<!--student image-->
							<div class="student_image_container">
								<div class="student_image">
									<img src="Image/default_user_image.jpg">
								</div>
							</div>
							<!--student name-->
							<h1 class="student_name">'.$GLOBALS['student_name'][$i].'</h1>
						</div>
						<!--statistic-->
						<div class="student_statistic_container">
							<div class="status_container">
								<!--status info-->
								<div class="status_info_container">
									<div class="status_info">Stamina</div>
									<div class="status_info">Skill</div>
									<div class="status_info">Luck</div>
								</div>
								<!--status input-->
								<div class="status_input_container">
									<div class="status_input"><input type="range" name="stamina_value" min="0" max="100" value="'.$GLOBALS['student_data'][$i]['stamina'].'" class="status_value"></div>
									<div class="status_input"><input type="range" name="skill_value" min="0" max="100" value="'.$GLOBALS['student_data'][$i]['skill'].'" class="status_value"></div>
									<div class="status_input"><input type="range" name="luck_value" min="0" max="100" value="'.$GLOBALS['student_data'][$i]['luck'].'" class="status_value"></div>
								</div>
								<!--status range-->
								<div class="status_range_container">
									<div class="status_range">'.$GLOBALS['student_data'][$i]['stamina'].'</div>
									<div class="status_range">'.$GLOBALS['student_data'][$i]['skill'].'</div>
									<div class="status_range">'.$GLOBALS['student_data'][$i]['luck'].'</div>
								</div>
							</div>
						</div>
						<!--video-->
						<div class="student_video_container">
							<div class="student_video">
								<div>
								<label>
									<span class="video_data">'.$GLOBALS['student_data'][$i]['video'].'</span>
									<img src="" class="video_image" title="Watch progress video">
								</label>
								</div>
							</div>
						</div>
					</div>
					<div class="lower_container">
						<!--save-->
						<div class="submit_container">
							<button class="save_button">Update</button>
						</div>
					</div>
				</div>';
				$num_student_enrolled++;
			}
		}
		if($num_student_enrolled <= 0){
			echo '<div id="student_info">No student enroll any course</div>';
		}

	}

?>