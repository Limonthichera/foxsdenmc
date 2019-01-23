	<title>Fox's Den - About</title>
	<link rel="stylesheet" href="css/profile.css">
	<link rel="stylesheet" href="css/bootstrap-make-col-same-height.css" />
	<style>
		.navbar {
		    margin-bottom:-10px !important;
		}
	</style>
</head>
<body>
	<a href="javascript:" id="return-to-top"><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span></a>
	
	<?php if($logged == TRUE):?>
		<?php include("html/modules/nav_bar.html.php");?>
	<?php endif;?>
	<?php if($logged == FALSE):?>
		<nav class="navbar navbar-inverse">
	        <div class="container">
	          	<div class="navbar-header">
		            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
			            <span class="sr-only">Toggle navigation</span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
		            </button>
	            <a class="navbar-brand" href="http://foxsdenmc.com">The Fox's Den</a>
	          	</div>
	          	<div class="navbar-collapse collapse">
		            <ul class="nav navbar-nav">
			            <li class="active"><a href="http://foxsdenmc.com"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;&nbsp;Home</a></li>
			            <li><a href="http://foxsdenmc.com/about.php"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;&nbsp;About</a></li>
			            <li><a href="http://foxsdenmc.com/contact.php"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;&nbsp;Contact us</a></li>
			        </ul>
			        <ul class="nav navbar-nav navbar-right">
			            <li><a href="http://foxsdenmc.com/login.php"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;&nbsp;Login</a></li>
			            <li><a href="http://foxsdenmc.com/register.php"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;&nbsp;Sign up</a></li>
			            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
			        </ul>
		              	
		            
		           
	          	</div><!--/.nav-collapse -->
	        </div>
	    </nav>
	<?php endif;?>

	<div class="thumbnail">
       	<div class="wrapper">
	   		<div class="caption post-content">
	            <h2>Welcome to the Fox's Den!</h2>
	            <h3><span class="hidden-xs">IP :  </span>TheFoxsDen.mcserver.ws<br/>23.95.34.182<br/></h3> 
	            <p>(Open in 1.10.2, and fully -no- functioning!!!!)</p> 
            </div>
        </div>
    </div>

	<!-- iv id='bg_image' class='bg_image'>
		<img src='img/background/cover2.jpg' class='bg_image'/>
	</div> 

	<div id='general_info'>
		<br/><br/><br/><br/>Welcome to the Fox's Den!<br/><br/>
		<span id='secondary_info'>IP :  TheFoxsDen.mcserver.ws<br/>23.95.34.182<br/></span><span id='third_info'>(Open in 1.10.2, and fully -no- functioning!!!!)</span>
	</div> -->
	
	<div id='announcements' style="width:100%">
		<div style="width:100%">
			<div class="container">
				<?=$short_text."<br/>~".$author?>
				<p class='read_more'><a href='news.php' class='read_more'>Read more</a></p>
			</div>
		</div>
	</div>

	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
	<!-- - - - - - - - - DISPLAY ON SAME ROW - - - - - - - - - -->
	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
	<div id="overall_container" class="container hidden-sm hidden-xs">
		<div style="padding-top:20px;">
			<div class="row row-eq-height">
				<div class="col-md-4">
					<div class="panel panel-primary" style="width:100%; height:95%">
						<div class="panel-heading">Hey all!
						</div>
					  	<div class="panel-body" style="width:100%">
							<p>I am relatively new at this server owning business, so some of what you see may need improvement.
							I've been working hard to get both server and website fully functional - but there may still be a few rough edges!
							If you have any questions or ideas regarding the server, plugins or website, please let me know.
								I look forward to seeing you online in the future!
							<br/><br/>
								~ Foxwolfy
							</p>
						</div>
					</div>
				</div>
				
				<div class="col-md-4" style="height:auto">
					<div class="panel panel-primary" style="width:100%; height:95%">
						<div class="panel-heading">What is Fox's Den?
						</div>
					  	<div class="panel-body" style="width:100%">	
							<p>The Fox's Den has been created because as members of the global creative community, we wanted to try something new. 
							Something that would become everything we look for in a server. 
							<br/>We wanted a dedicated, EULA compliant server centered around the player - something to encourage both experienced and newer builders, 
							whichever style of building they prefer to work with. 
							<br/>A server that trusted both staff and players, welcoming and encouraging feedback from both. 
							We also wanted to add a sense of continuous progression, so that there's success for players whether they're fast builders, or slow.
							</p>
						</div>
					</div>
				</div>
				
				<div class="col-md-4" style="height:auto">
					<div class="panel panel-primary" style="width:100%; height:95%">
						<div class="panel-heading">What do we offer?
						</div>
					  	<div class="panel-body" style="width:100%">
							<p>The Fox's Den has a number of worlds; a plotworld for new members, 
							a normal freebuild world, and a flat freebuild world. 
							At the moment, there are no aims for a world border (server processing permitting). 
							Plugins are set up to allow players to earn over time; both block claims - 
							to allow increasing build size, and in game money - which allows the purchase
							of fun permissions, tools and cosmetics.</p>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>

	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
	<!-- - - - - - - - DISPLAY ON THREE ROWS - - - - - - - - - -->
	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
	<div id="overall_container" class="container hidden-md hidden-lg">
		<div style="padding-top:20px;">
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-primary" style="width:100%; height:95%">
						<div class="panel-heading">Hey all!
						</div>
					  	<div class="panel-body" style="width:100%">
							<p>I am relatively new at this server owning business, so some of what you see may need improvement.
							I've been working hard to get both server and website fully functional - but there may still be a few rough edges!
							If you have any questions or ideas regarding the server, plugins or website, please let me know.
								I look forward to seeing you online in the future!
							<br/><br/>
								~ Foxwolfy
							</p>
						</div>
					</div>
				</div>
				
				<div class="col-md-4" style="height:auto">
					<div class="panel panel-primary" style="width:100%; height:95%">
						<div class="panel-heading">What is Fox's Den?
						</div>
					  	<div class="panel-body" style="width:100%">	
							<p>The Fox's Den has been created because as members of the global creative community, we wanted to try something new. 
							Something that would become everything we look for in a server. 
							<br/>We wanted a dedicated, EULA compliant server centered around the player - something to encourage both experienced and newer builders, 
							whichever style of building they prefer to work with. 
							<br/>A server that trusted both staff and players, welcoming and encouraging feedback from both. 
							We also wanted to add a sense of continuous progression, so that there's success for players whether they're fast builders, or slow.
							</p>
						</div>
					</div>
				</div>
				
				<div class="col-md-4" style="height:auto">
					<div class="panel panel-primary" style="width:100%; height:95%">
						<div class="panel-heading">What do we offer?
						</div>
					  	<div class="panel-body" style="width:100%">
							<p>The Fox's Den has a number of worlds; a plotworld for new members, 
							a normal freebuild world, and a flat freebuild world. 
							At the moment, there are no aims for a world border (server processing permitting). 
							Plugins are set up to allow players to earn over time; both block claims - 
							to allow increasing build size, and in game money - which allows the purchase
							of fun permissions, tools and cosmetics.</p>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
	

 	

 	