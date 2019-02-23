<?php session_start(); ?>
<?php include 'student_progress.php'; ?>
<?php include 'updatestudenttable_ajax.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Studnet: <?php echo $_SESSION['username']; ?></title>
	<link rel="stylesheet" type="text/css" href="student.css">
	<script type="text/javascript" src="student.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>

<div id="track_email"><?php echo $_SESSION['email']; ?></div>

<div id="overall_container">
	<!--user information-->
	<div id="user_container">
		<!--user image-->
		<div id="user_image_container">
			<div id="user_image">
				<img src=<?php echo $_SESSION['profile_picture']; ?>>
			</div>
		</div>
		<!--user name-->
		<div id="user_name_container">
			<h1><?php echo $_SESSION['username']; ?></h1>
		</div>
		<!--icon option-->
		<div id="icon_option_container">
			<i class="fas fa-clipboard-list" id="to_do_list_button" title="To do list"></i>
			<i class="fas fa-bell" id="show_reminder_button" title="Reminder"></i>
			<i class="fas fa-sign-out-alt" id="logout_button" title="Logout"></i>
		</div>
		<!--option-->
		<div id="option_container">
			<li class="word_option" value="0">Schedule</li>
			<li class="word_option" value="1">Progress</li>
			<li class="word_option" value="2">Courses</li>
			<li class="word_option" value="3">Help</li>
		</div>
		<!--to do list-->
		<div id="to_do_list_container">
			<h1>To do</h1>
			<?php
				$sql = "SELECT course FROM user_statistical_info
						WHERE email='".$_SESSION['email']."' ";
				$result = $conn->query($sql);


				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						echo '<li class="to_do_list_task">'.$row['course'].'</li>';
					}
				}
			?>
		</div>
	</div>

	<!--functional container-->
	<!--schedule container-->
	<div id="schedule_container" class="functional_container">
		<!--calender-->
		<?php showtable(); ?>
	</div>
	<!--progress container-->
	<div id="progress_container" class="functional_container">
		<?php dynamic_progress(); ?>
	</div>
	<!--courses container-->
	<div id="courses_container" class="functional_container">
		
		<!--row 1-->
		<div class="courses_row_container">
			<div class="sub_course_container" id="yoga">
				<!--image-->
				<img src="Image/yoga.jpg">
				<!--types-->
				<div class="sub_course_types_container">
					<h1>Yoga</h1>
					<li class="courseBtn">Hatha Yoga</li>
					<li class="courseBtn">Iyengar Yoga</li>
					<li class="courseBtn">Bikram Yoga</li>
					<li class="courseBtn">Vinyasa Yoga</li>
					<li class="courseBtn">Kundalini Yoga</li>
				</div>
			</div>
			<div class="sub_course_container" id="gym">
				<!--image-->
				<img src="Image/gym.jpg">
				<!--types-->
				<div class="sub_course_types_container">
					<h1>Gym</h1>
					<li class="courseBtn">Shoulder</li>
					<li class="courseBtn">Back</li>
					<li class="courseBtn">Legs</li>
					<li class="courseBtn">Chest</li>
					<li class="courseBtn">Abs</li>
				</div>
			</div>
			<div class="sub_course_container" id="swimming">
				<!--image-->
				<img src="Image/swimming.jpg">
				<!--label-->
				<span class="course_label">Swimming</span>
				<!--types-->
				<div class="sub_course_types_container">
					<h1>Swimming</h1>
					<li class="courseBtn">Free styles</li>
					<li class="courseBtn">Breast stroke</li>
					<li class="courseBtn">Back stroke</li>
					<li class="courseBtn">Overarm stroke</li>
					<li class="courseBtn">Butterfly stroke</li>
				</div>
			</div>
		</div>
		<!--row 2-->
		<div class="courses_row_container">
			<div class="sub_course_container" id="dance">
				<!--image-->
				<img src="Image/dance.jpg">
				<!--label-->
				<span class="course_label">Dance</span>
				<!--types-->
				<div class="sub_course_types_container">
					<h1>Dance</h1>
					<li class="courseBtn">Ballet</li>
					<li class="courseBtn">Jazz</li>
					<li class="courseBtn">Modern</li>
					<li class="courseBtn">Hip-hop</li>
					<li class="courseBtn">Zumba</li>
				</div>
			</div>
		</div>
	</div>
	<!--help container-->
	<div id="help_container" class="functional_container">
		<div class="contact_container">
			<i class="fas fa-phone"></i>
			<h1>012-3456789</h1>
		</div>
		<div class="contact_container">
			<i class="fas fa-envelope"></i>
			<h1>fitness@gmail.com</h1>
		</div>
		<div class="contact_container">
			<i class="fas fa-map-marker-alt"></i>
			<h1>Persiaran Multimedia, 63100 Cyberjaya, Selangor</h1>
		</div>
	</div>
	<!--reminder-->
	<div id="reminder_container_background">
		<div id="reminder_container">
			<div id="header">
				<h1>Reminder</h1>
				<i class="fas fa-times" id="hide_reminder_button"></i>
			</div>
			<div id="body">
				<h1>Exercise to do today</h1>
				<h2>
				<?php
					$sql = "SELECT course FROM user_statistical_info
							WHERE email='".$_SESSION['email']."' ";
					$result = $conn->query($sql);


					if($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							echo '<li class="to_do_list_task">'.$row['course'].'</li>';
						}
					}
				?>
				</h2>
			</div>
		</div>
	</div>

</div>

</body>
</html>