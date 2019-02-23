window.onload = function(){
	//Nav_button
	var nav_button = document.getElementsByClassName('nav_button');

	//default nav_button (course)
	var default_nav_button = nav_button[0];
	default_nav_button.style.borderBottom = 'solid 2px red';

	function switch_content(){
		var course_container =  document.getElementById('course_container');
		var student_container =  document.getElementById('student_container');

		if(this.innerHTML == 'Course'){
			course_container.style.visibility = 'visible';
			student_container.style.visibility = 'hidden';
		}else if(this.innerHTML == 'Student'){
			course_container.style.visibility = 'hidden';
			student_container.style.visibility = 'visible';
		}else{
			window.location.assign('login.php');
		}
		
		default_nav_button.style.borderBottom = 'solid 2px white';
		this.style.borderBottom = 'solid 2px red';
		default_nav_button = this;
	}

	for(var i = 0; i < nav_button.length; i++){
		nav_button[i].addEventListener('click',switch_content);
	}

	//***************************************************************************** Course *************************************************************************
	//Get course type after page loaded
	var course_name = document.getElementsByClassName('course_name');

	function get_course_type_after_page_loaded(i){
		//console.log(course_name[i].innerText + ": loaded");

		var xhttp = new XMLHttpRequest();

		xhttp.onreadystatechange = function(){
	        if(this.readyState == 4 && this.status == 200){
                document.getElementsByClassName("course_type_ajax")[i].innerHTML = this.responseText;
        	}
    	};

		xhttp.open("GET", "trainer_get_course_type_after_page_loaded_ajax.php?course_name=" + course_name[i].innerText , true);
		xhttp.send();	
	}

	for(var i = 0; i < course_name.length; i++){
		get_course_type_after_page_loaded(i);
	}

	//Update new course type into database
	var new_course_type_input = document.getElementsByClassName('new_course_type_input');
	var add_new_type_button = document.getElementsByClassName('add_new_type_button');
	var course_name = document.getElementsByClassName('course_name');

	function update_new_course_type(i){	
		return function(){
			//console.log(new_course_type_input[i].value);
			var xhttp = new XMLHttpRequest();

			xhttp.onreadystatechange = function(){
    	        if (this.readyState == 4 && this.status == 200) {
	                document.getElementsByClassName("course_type_ajax")[i].innerHTML = this.responseText;
            	}
        	};

			xhttp.open("GET", "trainer_update_new_course_type_ajax.php?course_name=" + course_name[i].innerText + "&course_type=" + new_course_type_input[i].value , true);
			xhttp.send();

			return false;
		}
	}
	
	for(var i = 0; i < add_new_type_button.length; i++){
		add_new_type_button[i].onclick = update_new_course_type(i);
	}

	//Remove course type
	var course_type_list = document.getElementsByClassName('course_type_list');

	function remove_course_type(i){
		return function(){
			console.log(course_type_list[i].innerText);
			return false;
		}
	}

	for(var i = 0; i < course_type_list.length; i++){
		console.log('test: ' + course_type_list[i].innerHTML );
	}	
	
	//***************************************************************************** Student *************************************************************************
	//Change range value based on input
	var status_value = document.getElementsByClassName('status_value');
	var status_range = document.getElementsByClassName('status_range');

	function change_value_for_range_input(i){
		return function(){
			status_range[i].innerText = this.value;
			return false;
		}
	}

	for(var i = 0; i < status_value.length; i++){
		status_value[i].oninput = change_value_for_range_input(i);
	}

	//Save data and show notification
	var save_button = document.getElementsByClassName('save_button');
	var status_range = document.getElementsByClassName('status_range');
	var track_email = document.getElementsByClassName('track_email');
	var upper_container = document.getElementsByClassName('upper_container');

	function show_notification(){
		//show notification
		var notification = document.getElementById('notification_container');
		notification.innerHTML = 'Updated';

		notification.style.animation = 'notification_slide_in .5s forwards';
		setTimeout(function(){notification.style.animation = 'notification_slide_out .5s forwards';}, 5000);
	}

	function save_data(i){
		return function(){

			//Save data to database
			var xhttp = new XMLHttpRequest();

	        xhttp.open("GET","trainer_update_user_statistic_info_ajax.php?email="+ track_email[i].innerText +"&course="+ upper_container[i].innerText +"&stamina="+ status_range[i*3].innerText +"&skill="+ status_range[i*3 + 1].innerText +"&luck="+ status_range[i*3 + 2].innerText ,true);
	        xhttp.send();

			return false;
		}
	}

	for (var i = 0; i < save_button.length; i++) {
		save_button[i].addEventListener('click',show_notification);
		save_button[i].onclick = save_data(i);
	}

	//Watch video
	var video_image = document.getElementsByClassName('video_image');
	var video_data = document.getElementsByClassName('video_data');
	var video_player = document.getElementById('video_player');
	var video_player_container = document.getElementById('video_player_container');	
	
	function determine_video(i){
		//console.log(video_data[i].innerHTML);
		if(video_data[i].innerHTML != ""){
			video_image[i].src = "Image/successful.png";
		}else if(video_data[i].innerHTML == ""){
			video_image[i].src = "Image/no_video.png";
			video_image[i].title = "No progress video";
			video_image[i].style.cursor = "not-allowed";
		}
	}

	function show_video_player(i){
		return function(){
			if(video_data[i].innerHTML != ""){
				video_player_container.style.display = 'inline';
				video_player.src = video_data[i].innerHTML;
			}
			return false;
		}
	}

	document.getElementById('close_video_player_button').onclick = function(){
		video_player_container.style.display = 'none';
		video_player.src = '';
	};

	for(var i = 0; i < video_data.length; i++){
		determine_video(i);
	}

	for (var i = 0; i < video_image.length; i++) {
		video_image[i].onclick = show_video_player(i);
	}
}