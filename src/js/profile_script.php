<script>
	function edit_profile() {
		var mood = document.getElementById('mood_content').innerHTML;
		document.getElementById('mood_content').innerHTML = '<input type="text" id="mood" name="mood" value="'+mood+'"/>';

		var skype = document.getElementById('skype_content').innerHTML;
		document.getElementById('skype_content').innerHTML = '<input type="text" id="skype" name="skype" value="'+skype+'"/>';

		var birthday = document.getElementById('birthday_content').innerHTML;
		document.getElementById('birthday_content').innerHTML = '<input type="text" id="birthday" name="birthday" value="'+birthday+'"/>'; 

		var profile_pic = document.getElementById('profile_pic_content').innerHTML;
		document.getElementById("profile_pic_content").style.display = "block";
		document.getElementById('profile_pic_content').innerHTML = '<input type="text" style="width:100%; margin-top:10px" id="profile_pic_address_text" name="profile_pic" value="'+profile_pic+'"/>';

	
		document.getElementById('edit_profile_button').innerHTML = "<button class='btn btn-primary' onclick='confirm_edit()' style='margin-bottom:10px'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span>&nbsp;&nbsp;Save changes</button>&nbsp;&nbsp;"+
		"<button class='btn btn-primary' onclick='discard_edit()' style='margin-bottom:10px'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>&nbsp;&nbsp;Discard changes</button>";
	}

	function confirm_edit() {
        var mood = $("#mood").val();
        var skype = $("#skype").val();
        var birthday = $("#birthday").val();
        var profile_pic = $("#profile_pic_address_text").val();
        $.ajax({
            type: "POST",
            url: "src/php/update_profile.php", 
            data: {mood: mood, skype: skype, birthday: birthday, profile_pic: profile_pic},
        });
        //console.log(profile_pic);
        location.reload(true);
        return false;
            
	}

	function discard_edit() {
		location.reload(true);
	}

	function accept_request() {
		var target = $("#profile_username").html();
		$.ajax({
            type: "POST",
            url: "src/php/accept_request.php", 
            data: {target: target},
        }).done(function (){
        	location.reload(true);
        	console.log("Done running accept request");
        });       
	}

	function decline_request() {
		var target = $("#profile_username").html();
		$.ajax({
            type: "POST",
            url: "src/php/decline_request.php", 
            data: {target: target},
        }).done(function (){
        	location.reload(true);
        	console.log("Done running accept request");
        });       
	}

	function send_request() {
		var target = $("#profile_username").html();
		$.ajax({
            type: "POST",
            url: "src/php/send_request.php", 
            data: {target: target},
        }).done(function (){
        	location.reload(true);
        	console.log("qwertyhj");
        });
	}
</script>