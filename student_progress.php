<?php
	require 'database.php';

	//Globals variable

	$GLOBALS['progress_data'] = [];

	//Retrieve data from user_statistical_info
	$sql = "SELECT * FROM user_statistical_info
			WHERE email='".$_SESSION['email']."'  ";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$progress_temp_data['email'] = $row['email'];
			$progress_temp_data['course'] = $row['course'];
			$progress_temp_data['stamina'] = $row['stamina'];
			$progress_temp_data['skill'] = $row['skill'];
			$progress_temp_data['luck'] = $row['luck'];
			$progress_temp_data['video'] = $row['video'];
			$progress_temp_data['time_spent'] = $row['time_spent'];

			array_push($GLOBALS['progress_data'], $progress_temp_data);
		}
	}

	//Function
	function dynamic_progress(){
		$num_course = 0;

		for($i=0; $i < sizeof($GLOBALS['progress_data']); $i++){
			if($GLOBALS['progress_data'][$i]['course'] != null){
				echo '<div class="selected_course_container">
						<h1 class="course_name">'.$GLOBALS['progress_data'][$i]['course'].'</h1>
						<i class="fa fa-times remove_course_btn" title="Remove course"></i>
						<div class="video_container">
							<h2>Video</h2>
							<div class="video_source_container">
								<div class="video_source">
									<label title="Upload video">
										<input type="file" name="video" multiple="multiple" class="video">
										<img src="Image/video.png" class="video_image">
									</label>
								</div>
								<span class="upload_message">Upload progress</span>
							</div>
						</div>
						<div class="statistic_container">
							<h2>Statistic</h2>
							<div class="statistic_details_container">
								<h3>Stamina</h3>
									<div class="progress_bar_container">
										<div class="progress_bar" style="width:'.$GLOBALS['progress_data'][$i]['stamina'].'%;">
											<span class="value_label">'.$GLOBALS['progress_data'][$i]['stamina'].'%</span>
										</div>
									</div>
								<h3>Skill</h3>
									<div class="progress_bar_container">
										<div class="progress_bar" style="width:'.$GLOBALS['progress_data'][$i]['skill'].'%;">
											<span class="value_label">'.$GLOBALS['progress_data'][$i]['skill'].'%</span>
										</div>
									</div>
								<h3>Luck</h3>
									<div class="progress_bar_container">
										<div class="progress_bar" style="width:'.$GLOBALS['progress_data'][$i]['luck'].'%;">
											<span class="value_label">'.$GLOBALS['progress_data'][$i]['luck'].'%</span>
										</div>
									</div>
							</div>
						</div>
						<div class="time_spent_container">
							<h2>Time Spent</h2>
							<div class="time_spent">
								<h1>'.$GLOBALS['progress_data'][$i]['time_spent'].'</h1>
								<h2>Hours</h2>
							</div>
						</div>
					 </div>';
					 $num_course++;
			}
		}

		if($num_course <= 0){
			echo '<div class="enroll_info_container">Enroll a course to view your progress !</div>';
		}
	}

?>