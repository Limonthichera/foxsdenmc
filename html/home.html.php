	<title>Fox's Den - Home</title>
	<link rel="stylesheet" href="css/profile.css">
</head>
<body>
	<a href="javascript:" id="return-to-top"><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span></a>

	<?php include("html/modules/nav_bar.html.php");?>

	<div id="overall_container" class="container">

	<div class="row" style="padding:15px">
		<div id="left_side" class="col-md-8">
			<!-- - - - - - USER POSTS - - - - - -->
			<div class="panel panel-primary" id="latest_posts">
				<div class="panel-heading">
					<span onclick="toggle_element('panel_body_user_posts')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Latest builds
				</div>
				<div class="panel-body" style="display:block" id="panel_body_user_posts">
					
					<?php include("html/modules/add_post.html.php");?>
					
					<?php foreach ($post_array["news"] as $row): ?>
						<?php include("html/modules/user_post.html.php");?>
					<?php endforeach; ?>
					<?php if($post_array['can_load'] == TRUE): ?> 
						<a href=#>Load more Builds</a>

					<?php endif;?>
			    </div>
			</div>
		</div>

		<div id="right_side" class="col-md-4">
			<div id="chat_wrapper" class="panel panel-primary">
				<div class="panel-heading">
					<span onclick="toggle_element('panel_body_chatbox')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Chatbox - PUBLIC
				</div>
				<div class="panel-body" style="display:block" id="panel_body_chatbox">
					<div class="well well-sm">
						<div class="input-group">
							<input name="usermsg" id="usermsg" type="text" class="form-control" placeholder="Type message here...">
						    <span class="input-group-btn">
						        <button id="submitmsg" class="btn btn-secondary" onclick="onSubmit()" type="button">Send message</button>
						    </span>
						</div>
					    <div id="chatbox">
	 
					    </div>
					</div>
			    </div>
			</div>
	    </div>
 	</div>