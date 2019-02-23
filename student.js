window.onload = function(){
	var logout_button = document.getElementById('logout_button');
	var to_do_list_button = document.getElementById('to_do_list_button');
	var show_reminder_button = document.getElementById('show_reminder_button');
	var hide_reminder_button = document.getElementById('hide_reminder_button');
	var word_option = document.getElementsByClassName('word_option');
	var functional_container = document.getElementsByClassName('functional_container');
	var functional_container = document.getElementsByClassName('functional_container');

	var sub_course_container = document.getElementsByClassName('sub_course_container');
	var sub_course_types_container = document.getElementsByClassName('sub_course_types_container');

	function go_to_login_page(){
		window.location.assign('login.php');
	}

	var to_do_list_current_status = 'show';
	function hide_or_show_to_do_list(){
		var to_do_list_container = document.getElementById('to_do_list_container');
		if(to_do_list_current_status == 'show'){
			to_do_list_container.style.display = 'none';
			to_do_list_current_status = 'hide';
		}else{
			to_do_list_container.style.display = 'inline';
			to_do_list_current_status = 'show';
		}
	}

	function show_reminder(){
		var reminder_container_background = document.getElementById('reminder_container_background');
		
		reminder_container_background.style.animation = 'reminder_in .5s forwards';
	}

	function hide_reminder(){
		var reminder_container_background = document.getElementById('reminder_container_background');
		
		reminder_container_background.style.animation = 'reminder_out .5s forwards';
	}

	//user container fade in
	var user_container = document.getElementById('user_container');
	user_container.style.animation = 'user_container_in .5s forwards';
	//set default word option
	var default_word_option = document.getElementsByClassName('word_option')[0];
	var default_container = document.getElementsByClassName('functional_container')[0];

	default_word_option.style.backgroundColor = '#E42F2F';
	default_word_option.style.color = 'white';
	default_container.style.animation = 'container_in .5s forwards';

	function swap_container(){
		//change back to default
		default_word_option.style.backgroundColor = '#f2f2f2';
		default_word_option.style.color = 'black';
		default_container.style.animation = 'container_out .5s forwards';

		new_word_option = document.getElementsByClassName('word_option')[this.value];
		new_container = document.getElementsByClassName('functional_container')[this.value];
		
		//change to selected
		new_word_option.style.backgroundColor = '#E42F2F';
		new_word_option.style.color = 'white';
		new_container.style.animation = 'container_in 1s forwards';

		default_word_option = new_word_option;
		default_container = new_container;
	}

	function hide_others_course_types_and_show_own(show){
		for(var i = 0; i < sub_course_types_container.length; i++){
			if(i == show){
				sub_course_types_container[i].style.animation = 'sub_course_types_container_in .5s forwards';
			}else{
				sub_course_types_container[i].style.animation = 'sub_course_types_container_out .5s forwards';
			}
		}
	}

	function show_course_types(){
		switch(this.id){
			case 'yoga':
				hide_others_course_types_and_show_own(0);
				break;
			case 'gym':
				hide_others_course_types_and_show_own(1);
				break;
			case 'swimming':
				hide_others_course_types_and_show_own(2);
				break;
			case 'dance':
				hide_others_course_types_and_show_own(3);
				break;
		}
	}

	for(var i = 0; i < word_option.length; i++){
		word_option[i].addEventListener('click',swap_container);
	}
	for (var i = 0; i < sub_course_container.length; i++) {
		sub_course_container[i].addEventListener('click',show_course_types);
	}
	logout_button.addEventListener('click',go_to_login_page);
	to_do_list_button.addEventListener('click',hide_or_show_to_do_list);
	show_reminder_button.addEventListener('click',show_reminder);
	hide_reminder_button.addEventListener('click',hide_reminder);

	//****************************************************************** Progress ********************************************************************************
	//Upload video
	var video = document.getElementsByClassName('video');
	var upload_message = document.getElementsByClassName('upload_message');
	var video_image = document.getElementsByClassName('video_image');
	var course_name = document.getElementsByClassName('course_name');
	var track_email = document.getElementById('track_email');

	function upload_video(i){
		return function(){
			//Validate file type
			var available_file_type = ['.mp4','.wmv','.ogg','.3gp'];
			var file = video[i].files[0].name;
			var num_validate = 4;

			for(var j = 0; j < available_file_type.length; j++){
				if(file.includes(available_file_type[j]) == true){
					//console.log('yes: ' + available_file_type[j]);
					video_image[i].src = 'Image/successful.png';
					video_image[i].style.cursor = 'default';
					video_image[i].title = '';
					video_image[i].onclick = function(){return false};

					upload_message[i].innerHTML = 'Successfully uploaded';

					//Upload file
					var xhttp = new XMLHttpRequest();

					xhttp.onreadystatechange = function(){
			            if (this.readyState == 4 && this.status == 200) {
			                document.getElementById("test").innerHTML = this.responseText;
			            }
			        };
			        
					xhttp.open("GET", "student_upload_video.php?email=" + track_email.innerText + "&course=" + course_name[i].innerText + "&video=" + file , true);
					xhttp.send();

					break;
				}
				num_validate--;
			}

			//If file not video
			if(num_validate == 0){
				upload_message[i].innerHTML = 'Uploaded file is NOT video';
			}

			return false;
		}
	}

	for(var i = 0; i < video.length; i++){
		video[i].onchange = upload_video(i);
	}

	var remove_course_btn = document.getElementsByClassName('remove_course_btn');
	var course_name = document.getElementsByClassName('course_name');
	var selected_course_container = document.getElementsByClassName('selected_course_container');


	function remove_course(i){
		return function(){
			console.log(course_name[i].innerHTML);
			selected_course_container[i].style.display = 'none';
			var xhttp = new XMLHttpRequest();

			xhttp.open('GET','student_remove_course_ajax.php?course=' + course_name[i].innerHTML,true);
			xhttp.send();

			return false;
		}
	}

	for(var i = 0; i < remove_course_btn.length; i++){
		remove_course_btn[i].onclick = remove_course(i);
	}

	//****************************************************************** To do ********************************************************************************
	var to_do_list_task = document.getElementsByClassName('to_do_list_task');

	function remove_task(i){
		return function(){
			console.log(to_do_list_task[i].innerText);
			to_do_list_task[i].style.textDecoration = 'line-through';

			var xhttp = new XMLHttpRequest();

			xhttp.open('GET','student_to_do_list_ajax.php?course=' + to_do_list_task[i].innerText,true);
			xhttp.send();
			return false;
		}
	}

	for (var i = 0; i < to_do_list_task.length; i++) {
		to_do_list_task[i].onclick = remove_task(i);
	}

	//****************************************************************** Course ********************************************************************************
	var courseBtn = document.getElementsByClassName('courseBtn');
	
	function course_update(i){
		return function(){
			var today = new Date();
			var dateInput = prompt("Please enter date - February Only ", today.getDate());
			console.log(dateInput);
			courseBtn[i].onclick = dateInput;
			alert("Date selected: "+dateInput);
			
			//console.log(courseBtn[i].innerText);
			var course_chosen = new XMLHttpRequest();
			course_chosen.open('GET', 'student_addcourse_ajax.php?course_chosen='+courseBtn[i].innerText+"&dateInput="+ dateInput , true);
			course_chosen.send();
			return false;
		}
	}
	
	
	
	for(var i = 0; i < courseBtn.length; i++){
		courseBtn[i].onclick = course_update(i);
	}
}