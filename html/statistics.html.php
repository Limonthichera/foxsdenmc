	<title>Fox's Den - Statistics</title>
	<link rel="stylesheet" href="css/profile.css">
	<script type="text/javascript" src="src/assets/js/canvasjs.min.js"></script>
</head>
<body>
	<a href="javascript:" id="return-to-top"><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span></a>
	<div id="overall_container" class="container">

	<?php include("html/modules/nav_bar.html.php");?>

	<div class="row" style="padding:15px">
		<div id="left_side" class="col-md-8">
			<!-- - - - - - STATS - - - - - -->
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<span onclick="toggle_element('panel_body_stats_public_messages')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Stats - Public Messages
						</div>
						<div class="panel-body" style="display:block;" id="panel_body_stats_public_messages">	
							<div id="chartContainer_Messages_Sent_Public" style="height:200px; width:100%;">
		   					</div>
		   				</div>
		   			</div>
	   			</div>
	   		
	   			<div class="col-md-6">
		   			<div class="panel panel-primary">
		   				<div class="panel-heading">
							<span onclick="toggle_element('panel_body_stats_private_messages_sent_recieved')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Stats - Private Messages
						</div>
						<div class="panel-body" style="display:block;" id="panel_body_stats_private_messages_sent_recieved">	
							<div id="chartContainer_Messages_Sent_Recieved_Private" style="height:200px; width:100%;">
		   					</div>
		   				</div>
		   			</div>
		   		</div>

		   		<!-- <div class="col-md-6">
		   			<div class="panel panel-primary">
		   				<div class="panel-heading">
							<span onclick="toggle_element('panel_body_stats_private_messages_sent')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Stats - Private Messages (sent)
						</div>
						<div class="panel-body" style="display:block;" id="panel_body_stats_private_messages_sent">	
							<div id="chartContainer_Messages_Sent_Private" style="height:200px; width:100%;">
		   					</div>
		   				</div>
		   			</div>
		   		</div>
		   	
		   		<div class="col-md-6">
					<div class="panel panel-primary">
		   				<div class="panel-heading">
							<span onclick="toggle_element('panel_body_stats_private_messages_recieved')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Stats - Private Messages (recieved)
						</div>
						<div class="panel-body" style="display:block;" id="panel_body_stats_private_messages_recieved">	
							<div id="chartContainer_Messages_Recieved_Private" style="height:200px; width:100%;">
		   					</div>
		   				</div>
		   			</div>	
	   			</div> -->

	   			<div class="col-md-6">
					<div class="panel panel-primary">
		   				<div class="panel-heading">
							<span onclick="toggle_element('panel_body_stats_post_upvotes_downvotes')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Stats - Upvotes/Downvotes
						</div>
						<div class="panel-body" style="display:block;" id="panel_body_stats_post_upvotes_downvotes">	
							<div id="chartContainer_Weekly_Upvotes_Downvotes" style="height:200px; width:100%;">
		   					</div>
		   				</div>
		   			</div>	
	   			</div>

	   			<!-- <div class="col-md-6">
					<div class="panel panel-primary">
		   				<div class="panel-heading">
							<span onclick="toggle_element('panel_body_stats_post_upvotes')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Stats - Upvotes Recieved
						</div>
						<div class="panel-body" style="display:block;" id="panel_body_stats_post_upvotes">	
							<div id="chartContainer_Weekly_Upvotes" style="height:200px; width:100%;">
		   					</div>
		   				</div>
		   			</div>	
	   			</div>

	   			<div class="col-md-6">
					<div class="panel panel-primary">
		   				<div class="panel-heading">
							<span onclick="toggle_element('panel_body_stats_post_downvotes')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Stats - Downvotes Recieved
						</div>
						<div class="panel-body" style="display:block;" id="panel_body_stats_post_downvotes">	
							<div id="chartContainer_Weekly_Downvotes" style="height:200px; width:100%;">
		   					</div>
		   				</div>
		   			</div>	
	   			</div> -->

	   			<div class="col-md-6">
					<div class="panel panel-primary">
		   				<div class="panel-heading">
							<span onclick="toggle_element('panel_body_stats_post_upvotes_and_downvotes')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Stats - Total Upvotes vs. Downvotes
						</div>
						<div class="panel-body" style="display:block;" id="panel_body_stats_post_upvotes_and_downvotes">	
							<div id="chartContainer_Total_Upvotes_and_Downvotes" style="height:200px; width:100%;">
		   					</div>
		   				</div>
		   			</div>	
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