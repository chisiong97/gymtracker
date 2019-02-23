<?php
	
	require 'database.php';
	$GLOBALS['calendarData']=[]; 
	
	//query course and date
	$sql = "SELECT course,date from user_statistical_info where email ='".$_SESSION['email']."'";
	
	$result=$conn->query($sql);
	
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$calendar_temp_data['course'] = $row['course'];
			$calendar_temp_data['date'] = $row['date'];
			array_push($GLOBALS['calendarData'], $calendar_temp_data);
		}
	}
	
	//print_r ($GLOBALS['calendarData'][1]['date']);
	
	function showtable(){
		
		
		echo "<div id='calender_container'>
			<!--year & month-->
			<div id='year_month_container'>
				<div id='left'>
					<i class='fas fa-angle-left' id='left_arrow'></i>
				</div>
				<div id='mid'>
					<h1 id='year'>2019</h1>
					<h1 id='month'>February</h1>
				</div>
				<div id='right'>
					<i class='fas fa-angle-right' id='right_arrow'></i>
				</div>
			</div>
			<!--week & day-->
			<table id='week_day_container'>
				<tr>
					<th>Mon</th>
					<th>Tue</th>
					<th>Wed</th>
					<th>Thu</th>
					<th>Fri</th>
					<th>Sat</th>
					<th>Sun</th>
				</tr>";
				
				for($i=0; $i < 28; $i++){
					
					if($i != 0 && $i % 7 == 0){
						echo '</tr>';
						//echo 'end: '.$i;
					}
					//start
					if($i % 7 == 0){
						echo '<tr>';
						//echo 'start: '.$i;
					}
					
					
					if(sizeof($GLOBALS['calendarData'])==null){
						echo "<td>".($i+1)."</td>";
					}else{
						//$GLOBALS['calendarData'][0]['date']
						//echo sizeof($GLOBALS['calendarData']);
						for($j=0; $j < sizeof($GLOBALS['calendarData']); $j++){
							$detect = false;
							//echo $GLOBALS['calendarData'][$j]['date'];
							if($GLOBALS['calendarData'][$j]['date']== ($i+1)){
								echo "<td class ='calBtn' title='".$GLOBALS['calendarData'][$j]['course']."'>".($i+1)."</td>";
								$detect = true;
								break;
							}
						}
						if($detect == false){
							echo "<td>".($i+1)."</td>";
						}
						
					}
					
				}
				
			echo"</table>";
		echo"</div>";
	}
	
	//show date to table
	//if clicked then show courses

?>