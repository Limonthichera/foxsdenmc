<script>
	$( document ).ready(function() {
		refresh_message_notification_list();
        setInterval (function(){refresh_message_notification_list();}, 5000);
    });

	function toggle_element(id) {
		if(document.getElementById(id).style.display == "block"){
			document.getElementById(id).style.display = "none";
		}
		else {
			document.getElementById(id).style.display = "block";
		}
	}

	function show_element(id) {
		document.getElementById(id).style.display = "block";
	}

	function show_element_inline(id) {
		document.getElementById(id).style.display = "inline";
	}

	function hide_element(id) {
		document.getElementById(id).style.display = "none";
	}

	function refresh_message_notification_list() {
	    var target = $("#profile_username").attr('data-username');
        console.log("Refreshed message notification list");
        $.ajax({
        url: "src/php/find_unread_messages.php",
        cache: false,
        type: "POST",
        data: {target: target},
        success: function(data){
            $("#message_notification_list").html($.parseJSON(data)); 
        },
	    });
	}

	function continue_reading(id) {
		show_element_inline("hidden_post_text_id_" + id);
		hide_element("show_hidden_post_text_id_" + id);
	}

	// ===== Scroll to Top ==== 
	$(window).scroll(function() {
	    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
	        $('#return-to-top').fadeIn(200);    // Fade in the arrow
	    } else {
	        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
	    }
	});
	
	$('#return-to-top').click(function() {      // When arrow is clicked
	    $('body,html').animate({
	        scrollTop : 0                       // Scroll to top of body
	    }, 500);
	});

	function upvote_post_of_id(id) {
        $.ajax({
            type: "POST",
            url: "src/php/upvote_post.php", 
            data: {post_id: id},
        });
        //downvote_post_button_of_id_
        if(document.getElementById("downvote_post_button_of_id_"+id).className == "btn btn-default active") {
        	document.getElementById("downvote_post_button_of_id_"+id).className = "btn btn-default";
        	var str1 = document.getElementById("downvote_post_button_of_id_"+id).innerHTML;

        	var res1 = str1.split(" ");
        	var tempres1 = res1[4].split("<");
        	tempres1[0]--;

        	str1 = res1[0] + " " + res1[1] + " " + res1[2] + " " + res1[3] + " " + tempres1[0] + "<" + tempres1[1] + " " + res1[5] + " " + res1[6] + " " + res1[7];

        	document.getElementById("downvote_post_button_of_id_"+id).innerHTML = str1;
    	}

        if(document.getElementById("upvote_post_button_of_id_"+id).className == "btn btn-default") {
        	document.getElementById("upvote_post_button_of_id_"+id).className = "btn btn-default active";
        	var str2 = document.getElementById("upvote_post_button_of_id_"+id).innerHTML;

        	var res2 = str2.split(" ");
        	var tempres2 = res2[4].split("<");
        	tempres2[0]++;

        	str2 = res2[0] + " " + res2[1] + " " + res2[2] + " " + res2[3] + " " + tempres2[0] + "<" + tempres2[1] + " " + res2[5] + " " + res2[6] + " " + res2[7];

        	document.getElementById("upvote_post_button_of_id_"+id).innerHTML = str2;
        }
        else {
        	document.getElementById("upvote_post_button_of_id_"+id).className = "btn btn-default";
        	var str2 = document.getElementById("upvote_post_button_of_id_"+id).innerHTML;

        	var res2 = str2.split(" ");
        	var tempres2 = res2[4].split("<");
        	tempres2[0]--;

        	str2 = res2[0] + " " + res2[1] + " " + res2[2] + " " + res2[3] + " " + tempres2[0] + "<" + tempres2[1] + " " + res2[5] + " " + res2[6] + " " + res2[7];

        	document.getElementById("upvote_post_button_of_id_"+id).innerHTML = str2;
        }
        
        return false;
	}

	function downvote_post_of_id(id) {
        $.ajax({
            type: "POST",
            url: "src/php/downvote_post.php", 
            data: {post_id: id},
        });
        //downvote_post_button_of_id_
        if(document.getElementById("upvote_post_button_of_id_"+id).className == "btn btn-default active") {
        	document.getElementById("upvote_post_button_of_id_"+id).className = "btn btn-default";
        	var str1 = document.getElementById("upvote_post_button_of_id_"+id).innerHTML;

        	var res1 = str1.split(" ");
        	var tempres1 = res1[4].split("<");
        	tempres1[0]--;

        	str1 = res1[0] + " " + res1[1] + " " + res1[2] + " " + res1[3] + " " + tempres1[0] + "<" + tempres1[1] + " " + res1[5] + " " + res1[6] + " " + res1[7];

        	document.getElementById("upvote_post_button_of_id_"+id).innerHTML = str1;
        }

        if(document.getElementById("downvote_post_button_of_id_"+id).className == "btn btn-default") {
        	document.getElementById("downvote_post_button_of_id_"+id).className = "btn btn-default active";
        	var str2 = document.getElementById("downvote_post_button_of_id_"+id).innerHTML;

        	var res2 = str2.split(" ");
        	var tempres2 = res2[4].split("<");
        	tempres2[0]++;

        	str2 = res2[0] + " " + res2[1] + " " + res2[2] + " " + res2[3] + " " + tempres2[0] + "<" + tempres2[1] + " " + res2[5] + " " + res2[6] + " " + res2[7];

        	document.getElementById("downvote_post_button_of_id_"+id).innerHTML = str2;

        }
        else {
        	document.getElementById("downvote_post_button_of_id_"+id).className = "btn btn-default";
        	var str2 = document.getElementById("downvote_post_button_of_id_"+id).innerHTML;

        	var res2 = str2.split(" ");
        	var tempres2 = res2[4].split("<");
        	tempres2[0]--;

        	str2 = res2[0] + " " + res2[1] + " " + res2[2] + " " + res2[3] + " " + tempres2[0] + "<" + tempres2[1] + " " + res2[5] + " " + res2[6] + " " + res2[7];

        	document.getElementById("downvote_post_button_of_id_"+id).innerHTML = str2;
        }
        
        return false;
	}
	
</script>