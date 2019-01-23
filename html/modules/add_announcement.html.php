<div class="well well-lg">
	<form action="src/php/upload_news.php" method="post">
		<table class="table">
			<tr id="add_post_title_tr">
				<td>
					<input type="text" class="form-control" name="title" placeholder="This is a short description of the announcement"/>
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
					
					<textarea type="text" id="post_textarea" style="resize:vertical" class="form-control" name="text" placeholder="This text will appear in the pop-out area when you click 'Read More' on the announcement. Put all the details here"></textarea>
					<p class="allign-right pull-right" id="charNum"><small>0/8000 characters</small></p>
				</td>
			</tr>
			<tr>
				<td>
					<div class="btn-group pull-right" role="group" aria-label="...">
					  	<input type="submit" value="Add News" class="btn btn-default" id="submit_new_post_button" disabled/>
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

	$('#post_textarea').keyup(function () {
		var len = $(this).val().length;
		if(len>8000 || len<50) {
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