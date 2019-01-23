<nav class="navbar navbar-inverse">
    <div class="container">
      	<div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
            </button>
        <a class="navbar-brand" href="http://foxsdenmc.com">Fox's Den</a>
      	</div>
      	<div class="navbar-collapse collapse">
      		<form class="navbar-form navbar-left" role="search" id="search_bar" action="search.php" method="post">
            	<div class="input-group">
				  	<input type="text" class="form-control" name="search_text" placeholder="Who are you looking for?"/>
				  	<span class="input-group-btn">
				  		<input type="submit" class="btn btn-default" value="Search"/>
				  	</span>
			  	</div>
			</form>
	        <ul class="nav navbar-nav navbar-right">  
	        	<li title="Home / Community" <?php if($_SESSION['location'] == "home.php") echo 'class="active"';?>><a href="http://foxsdenmc.com/home.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span><span class="hidden-md hidden-lg hidden-sm">&nbsp;&nbsp;Home / Community</span></a></li>
	        	<li <?php if($_SESSION['location'] == "profile.php" && $edit_button == TRUE) echo 'class="active"';?>><a href="http://foxsdenmc.com/profile.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;Profile</a></li>
	            <li title="About"><a href="http://foxsdenmc.com/about.php"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span><span class="hidden-md hidden-lg hidden-sm">&nbsp;&nbsp;About</span></a></li>
	        	<li class="dropdown" id="message_notification_list" title="New messages">
              	</li> 
              	<li class="dropdown" id="message_notification_list" title="Notifications">
              		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-bell" aria-hidden="true" title="Notifications"></span></a>
              		<ul class="dropdown-menu">
              			<li role="separator" class="divider"></li>
	                  	<li id="friend_request_nav_notification"><a href=#>No new friend requests</a></li>
	                  	<li role="separator" class="divider"></li>
	                  	<li id="post_tag_nav_notification"><a href=#>No new updates</a></li>
	                  	<li role="separator" class="divider"></li>
	                  	<li role="separator" class="divider"></li>
	                  	<li><a href="http://foxsdenmc.com/settings.php"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;&nbsp;Settings</a></li>
	                  	<li><a href="http://foxsdenmc.com/statistics.php"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;&nbsp;Statistics</a></li>
	                  	<li><a href="http://foxsdenmc.com/contact.php"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;&nbsp;Contact us</a></li>
	                  	<li role="separator" class="divider"></li>
	                  	<li><a href="http://foxsdenmc.com/src/php/logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;Logout</a></li>
	                </ul>
              	</li>
              	<li>
              		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              	</li>
            </ul>
      	</div><!--/.nav-collapse -->
    </div>
</nav>
