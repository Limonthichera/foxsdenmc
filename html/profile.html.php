	<title>Fox's Den - <?=$user_profile?></title>
	<link rel="stylesheet" href="css/profile.css">
</head>
<body>

<a href="javascript:" id="return-to-top"><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span></a>
<div id="overall_container" class="container">

	<?php include("html/modules/nav_bar.html.php");?>

	<div class="row" id="profile_header" style="padding:15px; padding-left:28px; padding-right:28px;">
		<div class="panel panel-primary">
			<div class="panel-heading"></div>
			<div class="panel-body">
				<div id="profile_username" style="display:none" data-username="<?=$user_profile?>"><?=$user_profile?></div>
				<div class="col-sm-4" id="profile_pic">
					<?php if($edit_button == TRUE || ($perm_profile_picture ==1 && $friend_status == 1) || $perm_profile_picture == 2){
						echo '<img id="profile_picture" src="'.$profile_picture.'" class="img-circle"/>';
					}
					else {
						echo '<img id="profile_picture" src="img/profile/default_profile.jpg" class="img-circle/>';
					}?>
					<div id="profile_pic_content" style="display:none;"><?php 
							if($edit_button == TRUE || ($perm_profile_picture ==1 && $friend_status == 1) || $perm_profile_picture == 2){
								echo $profile_picture;
							}
							else {
								echo "img/profile/default_profile.jpg";
							}
					?></div>
				</div>
				<div class="col-sm-8" id="profile_name">
					<h1><?="<small><span style='color:".$rank_complement_color."'>[</span><span style='color:".$rank_color."'>".$rank_name."</span><span style='color:".$rank_complement_color."'>]</span></small>".$user_profile." <small>@".$in_game_name."</small>";?></h1>
					<h4>- <?=$number_of_friends?> friend<?php if($number_of_friends!=1) echo "s";?> - <a href="#friend_list" onclick="show_element('panel_body_friend_list'); hide_element('panel_body_user_posts')">See friend list</a></h4>
					<div id="profile_menu">
						<?php if($edit_button == TRUE){?>
							<div id='edit_profile_button'>
								<button class='btn btn-primary' onclick='edit_profile()'>
									<span class=' glyphicon glyphicon-pencil' aria-hidden='true'></span>&nbsp;&nbsp;Edit profile
								</button>
							</div>
						<?php }
						elseif($friend_status == 1) {?>
							Friends;
						<?php }
						elseif($friend_status == 2) {?>
							Friend request sent;
						<?php }
						elseif($friend_status == 3) {?>
							Friend request recieved -
							<br/>
							<button onclick='accept_request()'>
								<span class=' glyphicon glyphicon-ok' aria-hidden='true'></span>&nbsp;&nbsp;Accept friend request
							</button>
							<button onclick='decline_request()'>
								<span class=' glyphicon glyphicon-ok' aria-hidden='true'></span>&nbsp;&nbsp;Decline friend request
							</button>;
						<?php }
						elseif($friend_status == 4) {?>
							<button class='btn btn-primary' onclick='send_request()'>
								<span class=' glyphicon glyphicon-plus' aria-hidden='true'></span>&nbsp;&nbsp;Send friend request
							</button>;
						<?php }?>
					</div>

					<div id='basic_info'>
						<h4>
							<table class="table"><tbody>
								<tr>
									<td>Mood:</td>
									<td id="mood_content"><?php if($edit_button == TRUE || ($perm_mood ==1 && $friend_status == 1) || $perm_mood == 2){
										echo $mood;
									}
									else {
										echo "No mood to show";
									}?></td>
								</tr>
								<tr>
									<td>Skype:</td>
									<td id="skype_content"><?php if($edit_button == TRUE || ($perm_skype ==1 && $friend_status == 1) || $perm_skype == 2){
											echo $skype;
										}
										else {
											echo "No skype id to show";
										}?></td>
								</tr>
								<tr>
									<td>Birthday:</td>
									<td id="birthday_content"><?php if($edit_button == TRUE || ($perm_birthday ==1 && $friend_status == 1) || $perm_birthday == 2){
											echo $birthday;
										}
										else {
											echo "No birthday to show";
										}?></td>
								</tr>
							</tbody></table>
						</h4>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row" style="padding:15px">
		<div id="left_side" class="col-md-8">
			<!-- - - - - - USER POSTS - - - - - -->
			<div class="panel panel-primary" id="latest_posts">
				<div class="panel-heading">
					<span onclick="toggle_element('panel_body_user_posts')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Latest builds
				</div>
				<div class="panel-body" style="display:block" id="panel_body_user_posts">
					<div id="user_posts_container">
					
					<?php if($edit_button == TRUE) {include("html/modules/add_post.html.php");}?>

					<?php foreach ($post_array["news"] as $row): ?>
						<?php include("html/modules/user_post.html.php");?>
					<?php endforeach; ?>
					</div>
					<div style=<?php if($post_array['can_load'] == TRUE) {echo "'text-align: center;'";} else {echo "'text-align: center; display:none;'";}?>>
						<button type="button" class="btn btn-default">
							Load more posts
						</button>
					</div>
			    </div>
			</div>
			<!-- - - - - - FRIEND LIST - - - - - -->
			<div class="panel panel-primary" id="friend_list">
				<div class="panel-heading">
					<span onclick="toggle_element('panel_body_friend_list')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Friend list
				</div>
				<div class="panel-body" style="display:none" id="panel_body_friend_list">
					<?php foreach($friend_array as $friend):?>
						<div class="well well-lg">
							<div class="media">
								<div class="media-left">
							    	<a href= <?='"http://foxsdenmc.com/profile.php?user='.$friend["username"].'"'?>>
							      		<img style="width:64px; height:64px;" class="media-object" src=<?='"'.$friend["profile_pic"].'"'?>>
							    	</a>
							  	</div>
							  	<div class='media-body'>
							    	<h4 class='media-heading'><a href= <?='"http://foxsdenmc.com/profile.php?user='.$friend["username"].'"'?>><?=$friend["name"]?></a></h4>
							    	-&nbsp;<?=$friend["number_of_friends"]?> friend<?php if($friend["number_of_friends"]!=1) echo "s";?>&nbsp;-
							    
							  	</div>
							</div>
						</div>
					<?php endforeach;?>
			    </div>
			</div>
		</div>
		<!-- CHATBOX -->
		<div id="right_side" class="col-md-4">
			<div id="chat_wrapper" class="panel panel-primary">
				<div class="panel-heading">
					<span onclick="toggle_element('panel_body_chatbox')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Chatbox - PRIVATE (<?=$user_profile?>)
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




