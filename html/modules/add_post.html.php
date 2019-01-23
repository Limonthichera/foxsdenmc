<div class="well well-lg">
	<form action="src/php/upload_post.php" method="post">
		<table class="table">
			<tr id="add_post_title_tr">
				<td>
					<input type="text" class="form-control" name="title" placeholder="Write your build's name here"/>
				</td>
			</tr>

			<tr id="add_post_tags_tr">
				<td>
					<input type="text" class="form-control" name="tag_list" placeholder="Tag your build team (@username1@username2@username3...)"/>
				</td>
			</tr>

			<tr>
				<td>
					<div class="btn-group" id="add_post_BB_div" style="padding-bottom:1px;">
						<button type="button" class="btn btn-default btn-sm" title="Bold" onclick="add_post_input_tag('bold')"><span class="glyphicon glyphicon-bold" aria-hidden="true"></span></button>
						<button type="button" class="btn btn-default btn-sm" title="Italic" onclick="add_post_input_tag('italic')"><span class="glyphicon glyphicon-italic" aria-hidden="true"></span></button>
						<button type="button" class="btn btn-default btn-sm" title="Text Color" onclick="add_post_input_tag('color')"><span class="glyphicon glyphicon-text-color" aria-hidden="true"></span></button>
						<button type="button" class="btn btn-default btn-sm" title="Text Size" onclick="add_post_input_tag('size')"><span class="glyphicon glyphicon-text-size" aria-hidden="true"></span></button>
						<button type="button" class="btn btn-default btn-sm" title="User" onclick="add_post_input_tag('user')"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>
						<button type="button" class="btn btn-default btn-sm" title="Link" onclick="add_post_input_tag('link')"><span class="glyphicon glyphicon-link" aria-hidden="true"></span></button>
						<button type="button" class="btn btn-default btn-sm" title="Import Photo" onclick="add_post_input_tag('photo')"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></button>
						<button type="button" class="btn btn-default btn-sm" title="Import Video" onclick="add_post_input_tag('video')"><span class="glyphicon glyphicon-film" aria-hidden="true"></span></button>
						<button type="button" class="btn btn-default btn-sm" title="Table" onclick="add_post_input_tag('table')"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>
					</div>
					
					<textarea type="text" id="post_textarea" style="resize:vertical" class="form-control" name="text" placeholder="Describe your building. Include screenshots. Don't know how to include screenshots? Message us in-game for help."></textarea>
					<p class="allign-right pull-right" id="charNum"><small>0/8000 characters</small></p>
				</td>
			</tr>
			<tr>
				<td>
					<div class="btn-group pull-right" role="group" aria-label="...">
						<div class="btn-group">
							<button id="select_newpost_view_button" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							  	&nbsp;<span class="glyphicon glyphicon-globe" aria-hidden="true"></span>&nbsp;Public <span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li role="separator" class="divider"></li>
								<li>&nbsp;&nbsp;<input onclick="change_newpost_view_visual_effect_to('public')" type="radio" name="view_permission" id="view_permission_public" value="public" checked/><label for="view_permission_public">&nbsp;<span class="glyphicon glyphicon-globe" aria-hidden="true"></span>&nbsp;Public</label></li>
								<li role="separator" class="divider"></li>
								<li>&nbsp;&nbsp;<input onclick="change_newpost_view_visual_effect_to('friends')" type="radio" name="view_permission" id="view_permission_friends" value="friends"/><label for="view_permission_friends">&nbsp;<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Friends</label></li>
								<li role="separator" class="divider"></li>
								<li>&nbsp;&nbsp;<input onclick="change_newpost_view_visual_effect_to('private')" type="radio" name="view_permission" id="view_permission_private" value="private"/><label for="view_permission_private">&nbsp;<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Only me</label></li>
								<li role="separator" class="divider"></li>
							</ul>
						</div>
					  	<input type="submit" value="Post" class="btn btn-default" id="submit_new_post_button" disabled/>
					</div>
				</td>
			</tr>
		</table>
	</form>
</div>

<script>
	function show_add_post_form() {
		document.getElementById("add_post_title_tr").style.display = "block";
		document.getElementById("add_post_tags_tr").style.display = "block";
		document.getElementById("add_post_BB_div").style.display = "block";
	}

	function change_newpost_view_visual_effect_to(val) {
		if(val == "public") {
			document.getElementById("select_newpost_view_button").innerHTML = '&nbsp;<span class="glyphicon glyphicon-globe" aria-hidden="true"></span>&nbsp;Public <span class="caret"></span>';
		}
		if(val == "friends") {
			document.getElementById("select_newpost_view_button").innerHTML = '&nbsp;<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Friends <span class="caret"></span>';
		}
		if(val == "private") {
			document.getElementById("select_newpost_view_button").innerHTML = '&nbsp;<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Only me <span class="caret"></span>';
		}
	}

	$('#post_textarea').keyup(function () {
		var len = $(this).val().length;
		if(len>8000 || len<5) {
			document.getElementById('charNum').innerHTML = '<small style="color:red">' + len + '/8000 characters</small>';
			document.getElementById("submit_new_post_button").setAttribute("disabled", "");
		}
		else {
			document.getElementById('charNum').innerHTML = '<small>' + len + '/8000 characters</small>';
			document.getElementById("submit_new_post_button").removeAttribute("disabled");
		}
		
	});

	function add_post_input_tag(val) {
		switch(val) {
		    case "bold":
		        document.getElementById('post_textarea').value = document.getElementById('post_textarea').value + "<b>Bold text here</b>";
		        break;
		    case "italic":
		        document.getElementById('post_textarea').value = document.getElementById('post_textarea').value + "<i>Italic text here</i>";
		        break;
		    case "color":
		        document.getElementById('post_textarea').value = document.getElementById('post_textarea').value + "<span style='color:red'>Colored text here</span>";
		    	break;
		    case "size":
		        document.getElementById('post_textarea').value = document.getElementById('post_textarea').value + "<span size='14px'>Sized text here</span>";
		        break;
		    case "user":
		        document.getElementById('post_textarea').value = document.getElementById('post_textarea').value + "<user>Username here</user>";
		        break;
		    case "link":
		        document.getElementById('post_textarea').value = document.getElementById('post_textarea').value + "<a href='link here'>Text here</a>";
		        break;
		    case "photo":
		        document.getElementById('post_textarea').value = document.getElementById('post_textarea').value + "<img src='write link to image here'/>";
		        break;
		    case "video":
		        document.getElementById('post_textarea').value = document.getElementById('post_textarea').value + "<b>Bold text here</b>";
		        break;
		    case "table":
		        document.getElementById('post_textarea').value = document.getElementById('post_textarea').value + "<table><tr><td></td><td></td></tr><tr><td></td><td></td></tr></table>";
		        break;
		    default:
		    	break;
		        
		} 
		var len = $("#post_textarea").val().length;
		if(len>8000 || len<5) {
			document.getElementById('charNum').innerHTML = '<small style="color:red">' + len + '/8000 characters</small>';
			document.getElementById("submit_new_post_button").setAttribute("disabled", "");
		}
		else {
			document.getElementById('charNum').innerHTML = '<small>' + len + '/8000 characters</small>';
			document.getElementById("submit_new_post_button").removeAttribute("disabled");
		}
	}
</script>