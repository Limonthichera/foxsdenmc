	<title>Fox's Den - Search</title>
	<link rel="stylesheet" href="css/profile.css">
</head>
<body>
	<a href="javascript:" id="return-to-top"><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span></a>
	<div id="overall_container" class="container">

	<?php include("html/modules/nav_bar.html.php");?>

	<div class="row" style="padding:15px">
		<div id="left_side" class="col-md-8">
			<!-- - - - - - SEARCH RESULT - - - - - -->
			<div id="search_wrapper" class="panel panel-primary">
				<div class="panel-heading">
					<span onclick="toggle_element('panel_body_search_result')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Search Result
				</div>
				<div class="panel-body" style="display:block" id="panel_body_search_result">
					<?php foreach($search_result_array as $row):?>
						<div class="well well-lg">
							<div class="media">
								<div class="media-left">
							    	<a href= <?='"http://foxsdenmc.com/profile.php?user='.$row["username"].'"'?>>
							      		<img style="width:64px; height:64px;" class="media-object" src=<?='"'.$row["profile_picture"].'"'?>>
							    	</a>
							  	</div>
							  	<div class='media-body'>
							    	<h4 class='media-heading'><a href= <?='"http://foxsdenmc.com/profile.php?user='.$row["username"].'"'?>><?=$row["name"]?></a></h4>
							    	-&nbsp;<?=$row["number_of_friends"]?> friend<?php if($row["number_of_friends"]!=1) echo "s";?>&nbsp;-
							    
							  	</div>
							</div>
						</div>
					<?php endforeach;?>
			    </div>
			</div>
		</div>

		<div id="right_side" class="col-md-4">
			<div id="chat_wrapper" class="panel panel-primary">
				<div class="panel-heading">
					<span onclick="toggle_element('panel_body_chatbox')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Chatbox - PUBLIC
				</div>
				<div class="panel-body" style="display:block" id="panel_body_chatbox">
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