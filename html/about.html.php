	<title>Fox's Den - About</title>
	<link rel="stylesheet" href="css/profile.css">
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
			            <li><a href="http://foxsdenmc.com"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;&nbsp;Home</a></li>
			            <li class="active"><a href="http://foxsdenmc.com/about.php"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;&nbsp;About</a></li>
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
	<div id="overall_container" class="container">
	<div class="row" style="padding:15px">
		<div id="left_side" class="col-md-12">
			<!-- - - - - - SEARCH RESULT - - - - - -->
			<div id="about_wrapper" class="panel panel-primary">
				<div class="panel-heading">
					<span onclick="toggle_element('panel_body_about')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;About
				</div>
				<div class="panel-body" style="display:block" id="panel_body_about">
					<p>
						<a href="http://thefoxsdenmc.com">The Fox's Den</a> has been created because as members of the global creative community, we wanted to try something new. Something that would become everything we look for in a server. We've been online for over a year now, and while there have been a few problems along the way, the server continues to grow and improve!
					</p>
					<p>
						We wanted a dedicated, EULA compliant server centered around the player - something to encourage both experienced and newer builders, whichever style of building they prefer to work with.
					</p>
					<p>
						A server that trusted both staff and players, welcoming and encouraging feedback from both. We also wanted to add a sense of continuous progression, so that there's success for players whether they're fast builders, or slow.
					</p>
					<p>
						The Fox's Den has a number of worlds; a plotworld for new members, a normal freebuild world, and a flat freebuild world. At the moment, there are no aims for a world border (server processing permitting). Plugins are set up to allow players to earn over time; both block claims - to allow increasing build size, and in game money - which allows the purchase of fun permissions, tools and cosmetics.
					</p>					
			    </div>
			</div>

			<div id="rules_wrapper" class="panel panel-primary">
				<div class="panel-heading">
					<span onclick="toggle_element('panel_body_rules')" style="cursor:pointer" class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>&nbsp;&nbsp;Server Rules
				</div>
				<div class="panel-body" style="display:block" id="panel_body_rules">
					<h2>Server Rules</h2>

					<p>
						You will be given a rulebook and a server guidebook when you join. Please make sure you're familiar with the rules. If you need to refresh your memory at any time, they are in full detail here, or you can gain another copy of the rulebook using the ingame command /rulebooks Rules.
					</p>
					<h3><i>Ignorance is no excuse!</i></h3>

					<p>
						Disrupting player building or server functionality is a capital offense! In simple terms, this means no griefing, hacking or lag machines. However, this also includes general bad conduct while building. Building too close to a player, or deliberately placing claims or blocks to be annoying, counts as disruption!
					</p>
					<p>
						<b>Respect players</b> - staff or not! Being polite really doesn't cost anything. Any form of bullying, racism, or general idiocy towards players is not permitted.
					</p>
						There is no rule against swearing or capital letters; however, constant abuse or spamming of caps will not be permitted. Caps by accident, or for comedic affect are not really a problem. Just pay attention if a member of staff warns you about spamming!
					</p>
						<b>Advertising.</b> Here on Fox's Den, advertising is not a major issue. If you want to discuss a server, then it's not a problem. However, handing out IP's, cajoling players to leave this server and join another, or spamming websites or adverts, are obviously not appreciated and will end up in a mute/kick, and possibly a ban if behavior continues.
						<br/>If it is found that you are advertising the Fox's Den on other servers in an inappropriate manner, you will be banned. 'Advertising wars' are not cool.
					</p>
					<p>
						<b>This is not a Roleplay server.</b> Seriously. It spams up the server, and achieves no real purpose other than to annoy players. If you really /must/ roleplay, then keep it strictly to private messages or take it to an appropriate forum somewhere on the internet.
					</p>
					<p>
						<b>Don't build inappropriately.</b> Immature subject matter will not be tolerated. If you build something offensive for the sake of being offensive, say, standalone genitalia to culturally offensive symbols, they will be removed, and you will be banned. However, if such subject matter works to improve your artwork, then by all means, go on ahead. We're aiming for a mature server, mature subject matter, handled correctly, is more than welcome here. However, above all, be extremely careful! Be familiar with controversial subject matter before including it in your work - offending someone because you were ignorant about a subject you decided to tackle will be treated with similar harshness.
					</p>
					<p>
						We're a server for architecture and organics. When building, please be aware that pixel art, and stand alone redstone won't get you ranked, and will just be cleared. If you wish to use pixel art in a mural, or have a complex redstone gate as part of a bigger build, that's no problem, they will be judged by the same standards as other builds. We're considering a terraforming tree, but we don't have the experience with that subject yet to be confident in judging such a tree.
					</p>
					<p>
						Don't ask for ranks or staff positions. Applications are only accepted through the proper means, and are likely to be denied if asked for constantly. That being said, if it's clear staff are taking too long on a decision, please post a comment in the appropriate thread saying so!
					</p>
					<p>
						Suggestions and ideas are greatly appreciated! Suggestions or bug reports can be directed to appropriate threads on the forums - we'll get to them quickly, and appreciate ideas on possible plugins, competitions, or... pretty much anything, really. In our player reports section, you can report misbehaving players or staff (or you can mail a member of staff in confidence), but also give a shout out to exceptional players, either for building ability, or to thank them for their help with coaching or advising. We want to know which players you think make the best staff members!
					</p>
					<p>
						Any further questions? You can contact un in-game or at <a href="contact@foxsden.com">contact@foxsden.com</a>!
					</p>
					<br/>
					<p>
						Thank you for taking the time to read these rules!
					</p>	
			    </div>
			</div>
		</div>

 	</div>


 	