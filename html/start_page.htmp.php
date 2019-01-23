	<title>Fox's Den - About</title>
	<link rel="stylesheet" href="css/profile.css">
</head>
<body>
	<a href="javascript:" id="return-to-top"><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span></a>
	<div id="overall_container" class="container">
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
			            <li><a href="http://foxsdenmc.com/"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;&nbsp;Login</a></li>
			            <li><a href="http://foxsdenmc.com/register.php"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;&nbsp;Sign up</a></li>
			            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
			        </ul>
		              	
		            
		           
	          	</div><!--/.nav-collapse -->
	        </div>
	    </nav>
	<?php endif;?>

	<div class="row" style="padding:15px">
		

 	</div>


 	