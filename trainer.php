<?php require 'database.php'; ?>
<?php include 'trainer_course.php'; ?>
<?php include 'trainer_student.php'; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Trainer (<?php echo $_SESSION['username']; ?>)</title>
	<link rel="stylesheet" type="text/css" href="trainer.css">
	<script type="text/javascript" src="trainer.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>
	<!--profile picture-->
	<div id="profile_container">
		<div id="profile_picture_container">
			<div id="profile_picture">
				<img src=<?php echo $_SESSION['profile_picture']; ?>>
			</div>
		</div>
	</div>
	<!--nagivation-->
	<div id="nagivation_bar">
		<li class="nav_button">Course</li>
		<li class="nav_button">Student</li>
		<li class="nav_button">Logout</li>
	</div>
	<!--content-->
	<div id="content_container">
		<!--course-->
		<div id="course_container">
			<?php dynamic_course(); ?>
		</div>

		<!--student-->
		<div id="student_container">
			<div id="student_content_container">
				<?php dynamic_student(); ?>
			</div>
		</div>
	</div>

	<!--notification-->
	<div id="notification_container"></div>

	<!--video player-->
	<div id="video_player_container">
		<i class="fa fa-times" id="close_video_player_button" title="Close"></i>
		<iframe src="" id="video_player"></iframe>
	</div>

</body>
</html>